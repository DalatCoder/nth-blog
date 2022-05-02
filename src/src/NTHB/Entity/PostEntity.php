<?php

namespace NTHB\Entity;

use Exception;
use NTHB\Model\Pivot\PostCategoryModel;
use NTHB\Model\Pivot\PostTagModel;

class PostEntity
{
    const PRIMARY_KEY = 'id';
    const TABLE = 'post';
    const CLASS_NAME = '\\NTHB\\Entity\\PostEntity';

    const KEY_ID = 'id';
    const KEY_AUTHOR_ID = 'author_id';
    const KEY_PARENT_ID = 'parent_id';
    const KEY_TITLE = 'title';
    const KEY_META_TITLE = 'meta_title';
    const KEY_SLUG = 'slug';
    const KEY_SUMMARY = 'summary';
    const KEY_CONTENT = 'content';
    const KEY_PUBLISHED_AT = 'published_at';
    const KEY_COVER_IMAGE_ID = 'cover_image_id';
    
    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';
    const KEY_DELETED_AT = 'deleted_at';
    
    protected $post_category_model;
    protected $post_tag_model;
    
    protected $categories;
    protected $tags;
    
    public function __construct($post_category_model, $post_tag_model)
    {
        $this->post_category_model = $post_category_model;
        $this->post_tag_model = $post_tag_model;
    }
    
    public function fetch_categories()
    {
        if (!is_array($this->categories)) {
            $this->categories = $this->post_category_model->get_by_post_id($this->{self::KEY_ID});
        }
        
        return $this->categories;
    }

    public function fetch_tags()
    {
        if (!is_array($this->tags)) {
            $this->tags = $this->post_tag_model->get_by_post_id($this->{self::KEY_ID});
        }

        return $this->tags;
    }

    /**
     * @throws Exception
     */
    public function add_category($category_id)
    {
        return $this->post_category_model->create($this->{self::KEY_ID}, $category_id);
    }

    /**
     * @throws Exception
     */
    public function add_tag($tag_id)
    {
        return $this->post_tag_model->create($this->{self::KEY_ID}, $tag_id);
    }
}
