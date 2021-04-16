<?php

namespace Libs\File;

class FileLib
{
    /**
     * @param array $folderArr 文件夹路径数组
     * @return array  文件目录列表中所有子目录文件路径
     */
    public static function getArrFileList($folderArr)
    {
        $file_list = [];
        if (is_array($folderArr) && count($folderArr) > 0) {
            foreach ($folderArr as $file) {
                if (is_dir($file)) {
                    $list = self::getFileList($file);
                    foreach ($list as $flist) {
                        $file_list[] = $flist;
                    }
                } else {
                    $file_list[] = $file;
                }
            }
        }
        return $file_list;
    }

    /** 获取文件夹下所有子文件路径并存放到一个数组中
     * @param String $path 文件夹
     * @return array
     */
    public static function getFileList($path)
    {
        $list = [];
        foreach (glob($path . '/*') as $single) {
            if (is_dir($single)) {
                $list = array_merge($list, self::getFileList($single));
            } else {
                $list[] = $single;
            }
        }
        return $list;
    }

    /** 获取文件夹下所有子文件路径并存放到一个数组中
     * @param String $path 文件夹
     * @return array
     */
    public static function getDirList($path)
    {
        $list = [];
        foreach (glob($path . '/*') as $single) {
            if (is_dir($single)) {
                $list[] = $single;
            }
        }
        return $list;
    }

    /** 获取文件size大小
     * @param string $file 文件路径
     */
    public static function getFileSize($file)
    {
        $byt = 1024;
        $mb = pow($byt, 2);
        $file_szie = filesize($file);
        if ($file_szie >= $mb) {
            $fsize = round($file_szie / $mb, 1) . 'mb';
        } elseif ($file_szie >= $byt) {
            $fsize = round($file_szie / $byt, 1) . 'kb';
        } else {
            $fsize = $file_szie . 'bytes';
        }
        return $fsize;
    }

    /** 判断文件夹是否存在，不存在则创建
     * @param string $dir 要创建的文件夹
     */
    public static function createDir($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true); //创建目录，第三个参数可选，规定是否设置递归模式。（PHP 5 中新增的）
        }
    }

    /**  复制带有多级子目录的文件夹
     * @param string $source 要复制的文件对象路径
     * @param string $target 复制到的目标文件路径
     * @param bool $remove 是否删除
     * @return bool|string
     */
    public static function copyDir($dirSrc, $dirTo, $remove = false)
    {
        // 检查原始目录是否存在, 不存在则退出
        if (!file_exists($dirSrc)) {
            return 'source_error';
        }

        self::createDir($dirTo); //判断目标文件夹是否存在，不存在则创建

        if ($dir_handle = opendir($dirSrc)) {
            //打开目录，并判断是否能成功打开
            while ($filename = readdir($dir_handle)) {
                //循环遍历目录下的所有文件
                if ($filename != '.' && $filename != '..') {
                    //一定要排除两个特殊的目录
                    $subFile = $dirSrc . '/' . $filename; //将目录下的子文件和当前目录相连
                    $sunToFile = $dirTo . '/' . $filename; //将目标目录的多级子目录相连
                    if (is_dir($subFile)) {
                        //如果为目录则条件成立
                        self::copyDir($subFile, $sunToFile);
                    } //递归调用自己复制子目录
                    if (is_file($subFile)) {
                        //如果是文件则条件成立
                        copy($subFile, $sunToFile);
                    } //直接复制到目标位置
                }
            }
            closedir($dir_handle); //关闭文件资源
        }

        if ($remove == true) {
            //是否删除原始文件
            self::delDir($dirSrc);
        }
        return true;
    }

    /** 删除目录及目录下所有文件
     * @param string $dir 文件夹路径
     */
    public static function delDir($dir)
    {
        $res = 0;
        if (is_dir($dir)) {
            if ($delHandle = opendir($dir)) {
                while (($file = readdir($delHandle)) != false) {
                    if ($file != '..' && $file != '.') {
                        if (is_dir($dir . '/' . $file)) {
                            // 是目录
                            self::delDir($dir . '/' . $file); // 是目录则递归继续进入该目录中去删除其中的文件
                        }
                        // 是文件
                        else {
                            unlink($dir . '/' . $file); // 则直接删除文件
                        }
                    }
                }
            }
            closedir($delHandle);
            $res = rmdir($dir); //删除空的目录
        } else {
            if (is_file($dir)) {
                $res = unlink($dir);
            }
        }
        return $res;
    }
}
