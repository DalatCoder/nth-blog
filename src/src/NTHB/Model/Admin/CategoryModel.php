<?php

namespace NTHB\Model\Admin;

use Ninja\DatabaseTable;

class CategoryModel
{
    private $category_table_helper;
    
    public function __construct(DatabaseTable $category_table_helper)
    {
        $this->category_table_helper = $category_table_helper;
    }
    
    public function get_all($orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->category_table_helper->findAll($orderBy, $orderDirection, $limit, $offset);
    }
    
    public function count()
    {
        return $this->category_table_helper->total();
    }
}
