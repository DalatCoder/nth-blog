<?php

namespace NTHB\Entity\Pivot;

class PostCategoryEntity
{
    const PRIMARY_KEY = 'id';
    const TABLE = 'post_category';
    const CLASS_NAME = '\\NTHB\\Entity\\PostCategoryEntity';

    const KEY_ID = 'id';
    const KEY_POST_ID = 'post_id';
    const KEY_CATEGORY_ID = 'category_id';
}
