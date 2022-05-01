<?php

namespace NTHB\Entity;

class MediaEntity
{
    const PRIMARY_KEY = 'id';
    const TABLE = 'media';
    const CLASS_NAME = '\\NTHB\\Entity\\media';
    
    const KEY_ID = 'id';
    const KEY_FILE_NAME = 'file_name';
    const KEY_FILE_TYPE = 'file_type';
    const KEY_FILE_SIZE = 'file_size';
    const KEY_FILE_LOCATION = 'file_location';
    const KEY_MEDIA_TYPE = 'media_type';

    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';
    const KEY_DELETED_AT = 'deleted_at';
}
