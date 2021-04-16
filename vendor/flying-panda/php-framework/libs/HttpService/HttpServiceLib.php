<?php

namespace Libs\HttpService;

use Libs\Control\ControlLib;
use Libs\Control\ControlRequestLib;
use Swoole\Http\Response;
use Manage\CoreManage;
use Swoole\WebSocket\Server;
use Libs\Client\ClientLib;

class HttpServiceLib
{
    private string $url;
    private string $port;
    public array $clientList = [];
    private Server $http;

    function __construct($url, $port)
    {
        $this->url = $url;
        $this->port = $port;
    }

    public function push($list, $message)
    {
        if (!is_string($message)) {
            $message = json_encode($message);
        }
        foreach ($list as $item) {
            $this->http->push($item, $message);
        }
    }

    public function start($fun)
    {
        $this->http = new Server($this->url, $this->port);
        $this->http->set([
            'open_length_check' => 1,
            'package_max_length' => 20 * 1024 * 1024,  //允许包的最大长度2MB
            'package_length_type' => 'N',   //N：无符号、网络字节序、4字节 (常用)
            'package_length_offset' => 0,     //整个包头加包体计算长度
            'package_body_offset' => '4',     //包体从第4字节开始计算长度
            'buffer_output_size' => 30 * 1024 * 1024,     //设置输出缓冲区的大小
            'worker_num' => 1,
        ]);
        $this->http->on('start', function ($server) use ($fun) {
            echo "Swoole http server is started at http://$this->url:$this->port\n";
        });
        $this->http->on('WorkerStart', function ($server) use ($fun) {
            $fun();
        });
        $this->http->on('message', function ($server, $frame) {
            //echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
            //$server->push($frame->fd, "this is server");
            $this->webSocketService($server, $frame->fd, json_decode($frame->data, true));
        });
        $this->http->on('request', function (\Swoole\Http\Request $request, \Swoole\Http\Response $response) {
            $response->header('Content-Type', 'text/plain;charset=utf-8');
            $response->header('Access-Control-Allow-Origin', $request->header['origin']);
            $response->header('Access-Control-Allow-Methods', 'content-type');
            $response->header('Access-Control-Allow-Credentials', 'true');
            if (empty($request) || empty($request->cookie['client'])) {
                $request->cookie["client"] = session_create_id();
                $response->cookie('client', $request->cookie["client"], time() + 36000, "/", '', true, false, "None");
                //$response->cookie('client', $request->cookie["client"], time() + 36000, "/");
            }
            if (!empty($request->get["_token"]) || !empty($request->post["_token"])) {
                $request->cookie["client"] = empty($request->get["_token"]) ? $request->post["_token"] : $request->get["_token"];
            }
            $this->Service($request, $response);
        });
        CoreManage::$serviceEvent['/token'] = (new ControlLib())->addAction(function (object $data, ?object $auth, ClientLib $client) {
            $client->Send([
                "state" => 0,
                "client" => session_create_id()
            ]);
        });
        $this->http->start();
    }

    function webSocketService($server, $frame, $data)
    {
        if (isset(CoreManage::$serviceEvent[$data['service']])) {
            $service = CoreManage::$serviceEvent[$data['service']];
            $service->runAction(new WebSocketClientLib($frame, $server), $data);
        } else {
            $server->push($frame, json_encode(['state' => 1, 'message' => 'service does not exist']));
        }
    }

    public function service($request, $response)
    {
        CoreManage::$log->info($request->server['request_uri']);
        if (isset(CoreManage::$serviceEvent[$request->server['request_uri']])) {
            $parameters = array_merge(
                $request->get == null ? [] : $request->get,
                $request->post == null ? [] : $request->post,
                self::upload($request->files, [
                    'image/png', 'image/jpg', 'image/jpeg', 'image/zip'
                ]),
                ['_service' => $request->server]
            );
            $service = CoreManage::$serviceEvent[$request->server['request_uri']];
            $service->runAction(new HttpClientLib($request->cookie["client"], $request, $response), $parameters);
            $response->end('');
        } else {
            $response->end('404');
        }
    }

    public static function upload($files, $type)
    {
        $ext = [
            'image/png' => 'png',
            'image/jpg' => 'jpg',
            'image/jpeg' => 'jpeg',
            'image/zip' => 'zip'
        ];
        $uploadList = [];
        if (!$files || count($files) == 0) {
            return [];
        }
        foreach ($files as $key => $file) {
            if (in_array($file['type'], $type)) {
                $dir = "upload/" . date("Y/m/d", time());
                if (!file_exists($dir)) {
                    mkdir($dir, 777, true);
                }
                $imgName = $dir . time() . rand(100000000, 999999999) . "." . $ext[$file['type']];
                $bol = move_uploaded_file($file["tmp_name"], $imgName);
                if ($bol) {
                    $uploadList[$key] = $imgName;
                }
            }
        }
        return $uploadList;
    }
}
