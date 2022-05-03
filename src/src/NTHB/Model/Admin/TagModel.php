<?php

namespace NTHB\Model\Admin;

use Exception;
use Ninja\DatabaseTable;
use Ninja\Utils\NJStringUtils;
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
    
    public function get_by_id($id)
    {
        return $this->tag_table_helper->findById($id);
    }
    
    public function get_by_slug($slug)
    {
        $results = $this->tag_table_helper->find(TagEntity::KEY_SLUG, $slug);
        return count($results) > 0 ? $results[0] : null;
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
        if (empty($slug)) {
            $unique_id = '';

            while (true) {
                if (empty($unique_id)) {
                    $unique_slug = NJStringUtils::slugify($title);
                }
                else {
                    $unique_slug = NJStringUtils::slugify($title . ' ' . $unique_id);
                }

                $results = $this->tag_table_helper->find(TagEntity::KEY_SLUG, $unique_slug);
                if (count($results) == 0)
                    break;
                else
                    $unique_id = uniqid();
            }
        }
        
        return $this->tag_table_helper->save([
            TagEntity::KEY_TITLE => $title,
            TagEntity::KEY_META_TITLE => $meta_title,
            TagEntity::KEY_SLUG => $unique_slug ?? $slug,
            TagEntity::KEY_CONTENT => $content
        ]);
    }
}
