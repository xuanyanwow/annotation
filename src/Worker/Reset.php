<?php


namespace Siam\Annotation\Worker;


use Siam\Annotation\App;

class Reset
{
    public static function parse($file_path)
    {
        $fn = fopen($file_path,"a+");

        $tmp = tempnam("/tmp",'');
        $fn_tmp = fopen($tmp, 'w');


        $config = App::$config;
        while(! feof($fn))  {
            $result = fgets($fn);
            // 以//开头  并且包含index
            $trim_result = trim($result);
            if (strpos($result, "//") !== false
                && strpos($trim_result, "//") === 0
                && strpos($result, $config->getIndexText()) !== false
            ){
                $index = substr($result, strpos($result, $config->getIndexText()) + strlen($config->getIndexText()), -1);
                $index = trim($index);

                // 获取下标号
                $node = App::$dict->getIndexNode($index);
                // 删除当前行(不插入即为删除)
                // 替换回注释
                fputs($fn_tmp, "{$node}");
            }else{
                // 不是注释的则继续拼接，还原文件
                fputs($fn_tmp, $result);
            }
        }


        fclose($fn);
        fclose($fn_tmp);
        rename($tmp,$file_path);
    }
}