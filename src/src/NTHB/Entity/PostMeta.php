<?php

namespace NTHB\Entity;

class PostMeta
{
    const PRIMARY_KEY = 'id';
    const TABLE = 'post_meta';
    const CLASS_NAME = '\\NTHB\\Entity\\PostMeta';
    
    const KEY_ID = 'id';
    const KEY_POST_ID = 'post_id';
    const KEY_KEY = 'key';
    const KEY_VALUE = 'value';

    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';
    const KEY_DELETED_AT = 'deleted_at';
}
