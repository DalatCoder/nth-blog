<?php

namespace NTHB\Entity;

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
}
