<?php

namespace NTHB\Model\Admin\Pivot;

use Exception;
use Ninja\DatabaseTable;
use NTHB\Entity\Pivot\PostCategoryEntity;
use NTHB\Entity\Pivot\PostTagEntity;
use NTHB\Entity\TagEntity;

class PostTagModel
{
    private DatabaseTable $post_tag_table_helper;
    private DatabaseTable $tag_table_helper;
    
    public function __construct(DatabaseTable $post_tag_table_helper, DatabaseTable $tag_table_helper)
    {
        $this->post_tag_table_helper = $post_tag_table_helper;
        $this->tag_table_helper = $tag_table_helper;
    }

    public function get_by_post_id($post_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        $pairs = $this->get_by_post_id_raw($post_id, $orderBy, $orderDirection, $limit, $offset);
        $tag_ids = [];

        foreach ($pairs as $item) {
            $tag_ids[] = $item->{PostTagEntity::KEY_TAG_ID};
        }

        return $this->tag_table_helper->findIdIn(
            TagEntity::KEY_ID,
            $tag_ids
        );
    }

    public function get_by_post_id_raw($post_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->post_tag_table_helper->find(
            PostCategoryEntity::KEY_POST_ID, 
            $post_id,
            '=',
            $orderBy,
            $orderDirection,
            $limit,
            $offset
        );
    }

    public function get_by_tag_id($tag_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->post_tag_table_helper->find(
            PostCategoryEntity::KEY_CATEGORY_ID,
            $tag_id,
            '=',
            $orderBy,
            $orderDirection,
            $limit,
            $offset
        );
    }

    /**
     * @throws Exception
     */
    public function create($post_id, $tag_id, $check_unique = true)
    {
        if ($check_unique) {
            $results = $this->get_by_post_id($post_id);
            $exist_record = null;

            foreach ($results as $result) {
                if ($result->{PostTagEntity::KEY_TAG_ID} == $tag_id) {
                    $exist_record = $result;
                    break;
                }
            }

            if ($exist_record instanceof PostTagEntity) {
                return $exist_record;
            }
        }
        
        return $this->post_tag_table_helper->save([
            PostTagEntity::KEY_POST_ID => $post_id,
            PostTagEntity::KEY_TAG_ID => $tag_id,
        ]);
    }
}
