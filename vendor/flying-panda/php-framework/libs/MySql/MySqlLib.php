<?php

namespace Libs\MySql;

use Manage\CoreManage;
use mysql_xdevapi\Exception;
use PDO;
use Swoole\Database\PDOConfig;
use Swoole\Database\PDOPool;

class MySqlLib
{
    private $ConfigWrite;
    private $ConfigRead;
    private PDOPool  $poolRead;
    private PDOPool  $poolWrite;

    public function __construct($config)
    {
        $ConfigWrite = new PDOConfig();
        $ConfigWrite->withHost($config["write"]['host']);
        $ConfigWrite->withPort($config["write"]['port']);
        $ConfigWrite->withDbName($config["write"]['dataBaseName']);
        $ConfigWrite->withCharset('utf8mb4');
        $ConfigWrite->withUsername($config["write"]['userName']);
        $ConfigWrite->withPassword($config["write"]['password']);
        $this->poolWrite = new PDOPool($ConfigWrite);
        $this->ConfigWrite = $ConfigWrite;


        $ConfigRead = new PDOConfig();
        $ConfigRead->withHost($config["read"]['host']);
        $ConfigRead->withPort($config["read"]['port']);
        $ConfigRead->withDbName($config["read"]['dataBaseName']);
        $ConfigRead->withCharset('utf8mb4');
        $ConfigRead->withUsername($config["read"]['userName']);
        $ConfigRead->withPassword($config["read"]['password']);
        $this->poolRead = new PDOPool($ConfigRead);
        $this->ConfigRead = $ConfigRead;

    }

    function getParamList($list): array
    {

        $placeholder = "";
        $ret = [];
        foreach ($list as $item) {
            $placeholder .= "s";
        }
        return array_merge([$placeholder], $list);
    }

    /**
     * @param $sql
     * @param $parameterList
     * @return int
     */
    public function insert($sql, $parameterList): int
    {
        CoreManage::$log->info($sql);
        $pool = $this->getPool($sql);

        $db = $pool->get();
        $stmt = $db->prepare($sql);
        $result = $stmt->execute($parameterList);

        $pool->put($db);
        return $result === true ? $db->lastInsertId() : 0;
    }

    /**
     * @param $sql
     * @return int
     */
    public function insertBatch($sql, $parameterList)
    {
        CoreManage::$log->info($sql);
        $pool = $this->getPool($sql);
        $db = $pool->get();

        $stmt = $db->prepare($sql);
        $result = $stmt->execute($parameterList);

        $pool->put($db);
        return $result === true ? $db->affected_rows : 0;
    }

    /**
     * @param $sql
     * @param $parameterList
     * @return int
     */
    public function update($sql, $parameterList)
    {
        CoreManage::$log->info($sql);
        $pool = $this->getPool($sql);
        $db = $pool->get();
        $stmt = $db->prepare($sql);
        $result = $stmt->execute($parameterList);
        $pool->put($db);
        return $result === true ? $stmt->rowCount() : 0;
    }

    public function getOne($sql, $parameterList)
    {
        if (strpos($sql, 'limit') == -1) {
            $sql .= " limit 1 ";
        }
        $result = $this->getOne($sql, $parameterList);
        return count($result) > 0 ? $result[0] : null;
    }

    /**
     * @param $sql
     * @param $parameterList
     * @return array|bool
     */
    public function search($sql, $parameterList)
    {
        CoreManage::$log->info($sql);

        // var_dump($sql);
        $pool = $this->getPool($sql);
        $db = $pool->get();
        //var_dump($sql,$parameterList);
        $stmt = $db->prepare($sql);
        //$stmt->bind_param(...$this->getParamList($parameterList));
        $stmt->execute($parameterList);
        // $result=$stmt->fetchAll();

        //$stmt->bind_result($result);
        //$pool->put($db);
//        $List = [];
//        while ($row = $stmt->fetchAssoc()) {
//            $List[] = $row;
//        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        foreach ($result as $item) {
            $list[] = json_decode(json_encode($item));
        }
        $pool->put($db);
        return $list;
    }

    private function getPool(string $sql): PDOPool
    {
        if (strpos($sql, "update ") > -1 ||
            strpos($sql, "insert into") > -1 ||
            strpos($sql, "delete ") > -1) {
            // var_dump("Write+++++++++++++++++++++++++++++++++++++++++++++++++++");
            return $this->poolWrite;
        } else {

            return $this->poolRead;
        }


    }
}
