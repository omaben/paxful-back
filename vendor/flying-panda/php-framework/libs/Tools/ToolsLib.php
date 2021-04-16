<?php


namespace Libs\Tools;


class ToolsLib
{
    public static function ConcatValues($Where){
        $str = "";
        foreach ($Where as $key => $value){
            $str = $str . "-" .$key."-".$value;
        }
        return $str;
    }
}