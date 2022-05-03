<?php

namespace NTHB\Entity;

use Exception;

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
    protected $media_model;
    protected $user_model;
    protected $comment_model;
    
    protected $categories;
    protected $tags;
    protected $cover_image;
    protected $author;
    protected $comments;
    
    public function __construct($post_category_model, $post_tag_model, $media_model, $user_model, $comment_model)
    {
        $this->post_category_model = $post_category_model;
        $this->post_tag_model = $post_tag_model;
        $this->media_model = $media_model;
        $this->user_model = $user_model;
        $this->comment_model = $comment_model;
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

    public function fetch_comments()
    {
        if (!is_array($this->comments)) {
            $this->comments = $this->comment_model->get_all_by_post($this->{self::KEY_ID});
        }

        return $this->comments;
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
    
    public function get_published_date(): \DateTime
    {
        return \DateTime::createFromFormat('Y-m-d H:i:s', $this->{self::KEY_PUBLISHED_AT});
    }
    
    public function get_cover_image()
    {
        if (is_null($this->{self::KEY_COVER_IMAGE_ID}))
            return null;
        
        if (!$this->cover_image) {
            $this->cover_image = $this->media_model->get_by_id($this->{self::KEY_COVER_IMAGE_ID});
        }

        return $this->tags;
    }
    
    public function get_cover_image_path(): string
    {
        $this->get_cover_image();
        
        if (is_null($this->cover_image))
            return 'default.jpg';
        
        return $this->cover_image->{MediaEntity::KEY_FILE_LOCATION};
    }
    
    public function get_author()
    {
        if (!$this->author)
            $this->author = $this->user_model->get_by_id($this->{self::KEY_AUTHOR_ID});
        
        return $this->author;
    }
}
