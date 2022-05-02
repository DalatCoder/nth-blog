<?php

namespace NTHB\Model\Admin;

use Exception;
use Ninja\DatabaseTable;
use NTHB\Entity\TagEntity;

class TagModel
{
    private DatabaseTable $tag_table_helper;
    
    public function __construct(DatabaseTable $tag_table_helper)
    {
        $this->tag_table_helper = $tag_table_helper;
    }


    public function get_all($orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->tag_table_helper->findAll($orderBy, $orderDirection, $limit, $offset);
    }

    public function count()
    {
        return $this->tag_table_helper->total();
    }

    /**
     * @throws Exception
     */
    public function create($title, $meta_title, $slug, $content)
    {
        return $this->tag_table_helper->save([
            TagEntity::KEY_TITLE => $title,
            TagEntity::KEY_META_TITLE => $meta_title,
            TagEntity::KEY_SLUG => $slug,
            TagEntity::KEY_CONTENT => $content
        ]);
    }
}
