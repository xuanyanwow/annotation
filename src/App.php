<?php


namespace Siam\Annotation;


use Siam\Annotation\Worker\LineAnnotation;
use Siam\Annotation\Worker\Reset;

class App
{
    /** @var \Siam\Annotation\Config */
    public static $config;
    /** @var \Siam\Annotation\Dict */
    public static $dict;
    /**
     * 生成注释字典
     */
    public static function make(Config  $config)
    {
        static::$config = $config;
        // 初始化
        static::init();

        // 文件列表扫描
        $scan_file = (new FileScan)->start($config->getBaseDir().$config->getWorkDir());
        // 单个文件分析、处理
        foreach ($scan_file as $file_path){
            LineAnnotation::parse($file_path);
        }

        // 单文件日志汇总、生成总dict
        static::render();
    }

    /**
     * 还原字典
     */
    public static function reset_dict(Config  $config)
    {
        static::$config = $config;
        // 初始化
        static::init();

        // 文件列表扫描
        $scan_file = (new FileScan)->start($config->getBaseDir().$config->getWorkDir());
        // 单个文件分析、处理
        foreach ($scan_file as $file_path){
            Reset::parse($file_path);
        }



    }

    public static function init()
    {
        // dict文件是否存在，存在则处理解析
        // [
        //     index:99// 当前index
        //     lists:[1~99]
        // ]
        $config = static::$config;
        $dict_file_path = $config->getDictDir() . DIRECTORY_SEPARATOR . $config->getDictName();
        if (file_exists($dict_file_path)){
            $content = json_decode(file_get_contents($dict_file_path), true);
            $dict = new Dict();
            $dict->setNextIndex($content['index']);
            $dict->setLists($content['lists']);
        }else{
            $dict = new Dict();
            $dict->setNextIndex(1);
        }
        static::$dict = $dict;
    }

    /**
     * 更新渲染dict
     */
    public static function render()
    {
        $config = static::$config;
        $dict_file_path = $config->getDictDir() . DIRECTORY_SEPARATOR . $config->getDictName();
        file_put_contents($dict_file_path, json_encode([
            'index'    => static::$dict->getNextIndex(),
            'base_dir' => $config->getBaseDir(),
            'lists'    => static::$dict->getLists(),
        ], 256));
    }
}