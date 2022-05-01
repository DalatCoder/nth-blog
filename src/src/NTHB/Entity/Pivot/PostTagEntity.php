<?php

namespace NTHB\Entity\Pivot;

class PostTagEntity
{
    const PRIMARY_KEY = 'id';
    const TABLE = 'post_tag';
    const CLASS_NAME = '\\NTHB\\Entity\\PostTagEntity';
    
    const KEY_ID = 'id';
    const KEY_POST_ID = 'post_id';
    const KEY_TAG_ID = 'tag_id';
}
