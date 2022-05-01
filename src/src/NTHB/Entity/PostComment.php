<?php

namespace NTHB\Entity;

class PostComment
{
    const PRIMARY_KEY = 'id';
    const TABLE = 'post_comment';
    const CLASS_NAME = '\\NTHB\\Entity\\PostComment';
    
    const KEY_ID = 'id';
    const KEY_POST_ID = 'post_id';
    const KEY_PARENT_ID = 'parent_id';
    const KEY_CONTENT = 'content';
    const KEY_EMAIL = 'email';
    const KEY_FIRST_NAME = 'first_name';
    const KEY_LAST_NAME = 'last_name';
    const KEY_AUTHOR_ID = 'author_id';
    
    const KEY_PUBLISHED_AT = 'published_at';

    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';
    const KEY_DELETED_AT = 'deleted_at';
}
