<?php


namespace Siam\Annotation\Worker;


use Siam\Annotation\App;

class LineAnnotation
{
    public static function parse($file_path)
    {
        $fn = fopen($file_path,"a+");

        $tmp = tempnam("/tmp",'');
        $fn_tmp = fopen($tmp, 'w');


        $config = App::$config;
        while(! feof($fn))  {
            $result = fgets($fn);
            // 是否以//开头  并且不包含index dadadu（增量处理）
            $trim_result = trim($result);
            if (strpos($result, "//") !== false
                && strpos($trim_result, "//") === 0
                && strpos($result, $config->getIndexText()) === false
            ){
                // 计算左侧有几个空格 保存用于对齐
                $space = substr($result, 0, strpos($result, "//"));

                // 把注释内容 全部记录到缓存
                $i = App::$dict->setIndexNode($result);

                // 删除当前行(不插入即为删除)
                // 做标号 // line3  // line13
                fputs($fn_tmp, "{$space}// {$config->getIndexText()}{$i}\r\n");
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