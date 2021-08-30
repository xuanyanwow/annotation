<?php
require_once "../vendor/autoload.php";

$config = new \Siam\Annotation\Config();
$config->setBaseDir("F:\PHPEnv\phpEnv\www\zaojiu\barSystem\application\\");
$config->setWorkDir("./");
$config->setDictDir("F:\PHPEnv\phpEnv\www\zaojiu\barSystem\application\\");
$config->setDictName("dict.siam");

// 开始生成
// \Siam\Annotation\App::make($config);
\Siam\Annotation\App::reset_dict($config);