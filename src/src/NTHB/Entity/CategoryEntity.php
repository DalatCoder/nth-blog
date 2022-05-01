<?php

namespace NTHB\Entity;

class CategoryEntity
{
    const PRIMARY_KEY = 'id';
    const TABLE = 'category';
    const CLASS_NAME = '\\NTHB\\Entity\\CategoryEntity';
    
    const KEY_ID = 'id';
    const KEY_TITLE = 'title';
    const KEY_META_TITLE = 'meta_title';
    const KEY_SLUG = 'slug';
    const KEY_CONTENT = 'content';

    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';
    const KEY_DELETED_AT = 'deleted_at';
}
