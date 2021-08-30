<?php


namespace Siam\Annotation;


class Dict
{

    protected $next_index = 0;
    protected $lists = [];


    /**
     * @return int
     */
    public function getNextIndex()
    {
        return $this->next_index;
    }

    /**
     * @param int $next_index
     */
    public function setNextIndex($next_index)
    {
        $this->next_index = $next_index;
    }

    public function incNextIndex()
    {
        $this->next_index += 1;
    }

    public function setLists($lists)
    {
        $this->lists = $lists;
    }

    public function getLists()
    {
        return $this->lists;
    }

    public function setIndexNode($text, $index = null)
    {
        if ($index === null) $index = $this->next_index;
        $this->lists[$index] = $text;
        $this->incNextIndex();
        return $index;
    }

    public function getIndexNode($index)
    {
        return isset($this->lists[$index]) ? $this->lists[$index] : '';
    }
}