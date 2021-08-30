<?php


namespace Siam\Annotation;

/**
 * 配置
 * @package Siam\Annotation
 */
class Config
{
    protected $base_dir;
    protected $work_dir;
    protected $index_text = "dadadu";
    protected $dict_name = "dict.siam";
    protected $dict_dir;

    /**
     * @return mixed
     */
    public function getBaseDir()
    {
        return $this->base_dir;
    }

    /**
     * @param mixed $base_dir
     */
    public function setBaseDir($base_dir)
    {
        $this->base_dir = $base_dir;
    }

    /**
     * @return mixed
     */
    public function getWorkDir()
    {
        return $this->work_dir;
    }

    /**
     * @param mixed $work_dir
     */
    public function setWorkDir($work_dir)
    {
        $this->work_dir = $work_dir;
    }

    /**
     * @return string
     */
    public function getIndexText()
    {
        return $this->index_text;
    }

    /**
     * @param string $index_text
     */
    public function setIndexText($index_text)
    {
        $this->index_text = $index_text;
    }

    /**
     * @return string
     */
    public function getDictName()
    {
        return $this->dict_name;
    }

    /**
     * @param string $dict_name
     */
    public function setDictName($dict_name)
    {
        $this->dict_name = $dict_name;
    }

    /**
     * @return mixed
     */
    public function getDictDir()
    {
        return $this->dict_dir;
    }

    /**
     * @param mixed $dict_dir
     */
    public function setDictDir($dict_dir)
    {
        $this->dict_dir = $dict_dir;
    }





}