<?php

namespace NTHB\Entity;

class UserEntity
{
    const PRIMARY_KEY = 'id';
    const TABLE = 'user';
    const CLASS_NAME = '\\NTHB\\Entity\\UserEntity';
    
    const KEY_ID = 'id';
    const KEY_FIRST_NAME = 'first_name';
    const KEY_LAST_NAME = 'last_name';
    const KEY_EMAIL = 'email';
    const KEY_PASSWORD = 'password';
    const KEY_INTRO = 'intro';
    const KEY_PROFILE = 'profile';
    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';
    const KEY_DELETED_AT = 'deleted_at';
    
    public function get_created_at()
    {
        return \DateTime::createFromFormat('Y-m-d H:i:s', $this->{self::KEY_CREATED_AT});
    }
}
