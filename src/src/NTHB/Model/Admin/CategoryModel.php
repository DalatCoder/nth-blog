<?php

namespace NTHB\Model\Admin;

use Exception;
use Ninja\DatabaseTable;
use NTHB\Entity\CategoryEntity;

class CategoryModel
{
    private DatabaseTable $category_table_helper;

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

    /**
     * @throws Exception
     */
    public function create($title, $meta_title, $slug, $content)
    {
        return $this->category_table_helper->save([
            CategoryEntity::KEY_TITLE => $title,
            CategoryEntity::KEY_META_TITLE => $meta_title,
            CategoryEntity::KEY_SLUG => $slug,
            CategoryEntity::KEY_CONTENT => $content
        ]);
    }
}
