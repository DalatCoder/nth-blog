<?php

namespace NTHB\Model\Admin\Pivot;

use Exception;
use Ninja\DatabaseTable;
use NTHB\Entity\CategoryEntity;
use NTHB\Entity\Pivot\PostCategoryEntity;

class PostCategoryModel
{
    private DatabaseTable $post_category_table_helper;
    private DatabaseTable $category_table_helper;
    
    public function __construct(DatabaseTable $post_category_table_helper, DatabaseTable $category_table_helper)
    {
        $this->post_category_table_helper = $post_category_table_helper;
        $this->category_table_helper = $category_table_helper;
    }

    public function get_by_post_id($post_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        $pairs = $this->get_by_post_id_raw($post_id, $orderBy, $orderDirection, $limit, $offset);
        $category_ids = [];
        
        foreach ($pairs as $item) {
            $category_ids[] = intval($item->{PostCategoryEntity::KEY_CATEGORY_ID});
        }

        return $this->category_table_helper->findIdIn(
            CategoryEntity::KEY_ID,
            $category_ids,
        );
    }

    public function get_by_post_id_raw($post_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->post_category_table_helper->find(
            PostCategoryEntity::KEY_POST_ID,
            $post_id,
            '=',
            $orderBy,
            $orderDirection,
            $limit,
            $offset
        );
    }

    public function get_by_category_id($category_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->post_category_table_helper->find(
            PostCategoryEntity::KEY_CATEGORY_ID,
            $category_id,
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
    public function create($post_id, $category_id, $check_unique = true)
    {
        if ($check_unique) {
            $results = $this->get_by_post_id($post_id);
            $exist_record = null;

            foreach ($results as $result) {
                if ($result->{PostCategoryEntity::KEY_CATEGORY_ID} == $category_id) {
                    $exist_record = $result;
                    break;
                }
            }

            if ($exist_record instanceof PostCategoryEntity) {
                return $exist_record;
            }
        }
        
        return $this->post_category_table_helper->save([
            PostCategoryEntity::KEY_POST_ID => $post_id,
            PostCategoryEntity::KEY_CATEGORY_ID => $category_id,
        ]);
    }
}
