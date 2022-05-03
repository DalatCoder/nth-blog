<?php

namespace NTHB\Model\Admin;

use Exception;
use Ninja\DatabaseTable;
use Ninja\NinjaException;
use Ninja\Utils\NJStringUtils;
use NTHB\Entity\CategoryEntity;
use NTHB\Entity\PostEntity;
use NTHB\Model\Admin\Pivot\PostCategoryModel;
use NTHB\Model\Admin\Pivot\PostTagModel;

class PostModel
{
    private DatabaseTable $post_table_helper;
    private PostCategoryModel $post_category_model;
    private PostTagModel $post_tag_model;
    
    public function __construct(DatabaseTable $post_table_helper, PostCategoryModel $post_category_model, PostTagModel $post_tag_model)
    {
        $this->post_table_helper = $post_table_helper;
        $this->post_category_model = $post_category_model;
        $this->post_tag_model = $post_tag_model;
    }
    
    public function get_all($orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->post_table_helper->findAll($orderBy, $orderDirection, $limit, $offset);
    }

    public function get_all_published($orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->post_table_helper->find(PostEntity::KEY_PUBLISHED_AT, null, 'is not', $orderBy, $orderDirection, $limit, $offset);
    }

    public function get_all_published_by_category_id($category_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null): array
    {
        $posts = $this->post_category_model->get_by_category_id($category_id);
        
        $results = [];
        
        foreach ($posts as $post) {
            if (!is_null($post->{PostEntity::KEY_PUBLISHED_AT}))
                $results[] = $post;
        }
        
        return $results;
    }

    public function get_all_published_by_tag_id($tag_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null): array
    {
        $posts = $this->post_tag_model->get_posts_by_tag_id($tag_id);

        $results = [];

        foreach ($posts as $post) {
            if (!is_null($post->{PostEntity::KEY_PUBLISHED_AT}))
                $results[] = $post;
        }

        return $results;
    }

    public function get_by_slug($slug)
    {
        $results = $this->post_table_helper->find(PostEntity::KEY_SLUG, $slug);
        
        if (count($results) == 0)
            return null;
        
        return $results[0];
    }
    
    public function get_by_id($id)
    {
        return $this->post_table_helper->findById($id);
    }

    public function get_by_author_id($author_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->post_table_helper->find(PostEntity::KEY_AUTHOR_ID, $author_id);
    }

    public function get_published_by_author_id($author_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null): array
    {
        $posts = $this->post_table_helper->find(PostEntity::KEY_AUTHOR_ID, $author_id);
        $filtered = [];

        foreach ($posts as $post) {
            if (!is_null($post->{PostEntity::KEY_PUBLISHED_AT}))
                $filtered[] = $post;
        }
        
        return $filtered;
    }
    
    public function count()
    {
        return $this->post_table_helper->total();
    }

    /**
     * @throws Exception
     */
    public function create($author_id, $parent_id, $title, $meta_title, $summary, $content, $cover_image_id = null, $published_at = null)
    {
        if (is_null($parent_id)) $parent_id = 0;
        
        $unique_id = '';

        while (true) {
            if (empty($unique_id)) {
                $unique_slug = NJStringUtils::slugify($title);
            }
            else {
                $unique_slug = NJStringUtils::slugify($title . ' ' . $unique_id);
            }
            
            $results = $this->post_table_helper->find(PostEntity::KEY_SLUG, $unique_slug);
            if (count($results) == 0)
                break;
            else 
                $unique_id = uniqid();
        }
        
        return $this->post_table_helper->save([
            PostEntity::KEY_AUTHOR_ID => $author_id,
            PostEntity::KEY_PARENT_ID => $parent_id,
            PostEntity::KEY_TITLE => $title,
            PostEntity::KEY_META_TITLE => $meta_title,
            PostEntity::KEY_SLUG => $unique_slug,
            PostEntity::KEY_SUMMARY => $summary,
            PostEntity::KEY_CONTENT => $content,
            PostEntity::KEY_COVER_IMAGE_ID => $cover_image_id,
            PostEntity::KEY_PUBLISHED_AT => $published_at
        ]);
    }

    /**
     * @throws Exception
     */
    public function update($post_id, PostEntity $updated_post)
    {
        $slug = NJStringUtils::slugify($updated_post->{PostEntity::KEY_TITLE});
        if ($slug != $updated_post->{PostEntity::KEY_SLUG}) {
            $unique_id = '';

            while (true) {
                if (empty($unique_id)) {
                    $unique_slug = NJStringUtils::slugify($updated_post->{PostEntity::KEY_TITLE});
                }
                else {
                    $unique_slug = NJStringUtils::slugify($updated_post->{PostEntity::KEY_TITLE} . ' ' . $unique_id);
                }

                $results = $this->post_table_helper->find(PostEntity::KEY_SLUG, $unique_slug);
                if (count($results) == 0)
                    break;
                else
                    $unique_id = uniqid();
            }
            
            $updated_post->{PostEntity::KEY_SLUG} = $unique_slug;
        }
        
        $updated_post->{PostEntity::KEY_UPDATED_AT} = new \DateTime();

        return $this->post_table_helper->save([
            PostEntity::KEY_ID => $post_id,
            PostEntity::KEY_SLUG => $updated_post->{PostEntity::KEY_SLUG},
            PostEntity::KEY_TITLE => $updated_post->{PostEntity::KEY_TITLE},
            PostEntity::KEY_META_TITLE => $updated_post->{PostEntity::KEY_META_TITLE},
            PostEntity::KEY_SUMMARY => $updated_post->{PostEntity::KEY_SUMMARY},
            PostEntity::KEY_CONTENT => $updated_post->{PostEntity::KEY_CONTENT},
            PostEntity::KEY_PARENT_ID => $updated_post->{PostEntity::KEY_PARENT_ID},
            PostEntity::KEY_AUTHOR_ID => $updated_post->{PostEntity::KEY_AUTHOR_ID},
            PostEntity::KEY_COVER_IMAGE_ID => $updated_post->{PostEntity::KEY_COVER_IMAGE_ID},
            PostEntity::KEY_PUBLISHED_AT => $updated_post->{PostEntity::KEY_PUBLISHED_AT},
            PostEntity::KEY_UPDATED_AT => $updated_post->{PostEntity::KEY_UPDATED_AT}
        ], true);
    }
}
