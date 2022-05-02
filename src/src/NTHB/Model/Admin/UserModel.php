<?php

namespace NTHB\Model\Admin;

use Exception;
use Ninja\DatabaseTable;
use Ninja\NinjaException;
use NTHB\Entity\UserEntity;

class UserModel
{
    private DatabaseTable $user_table_helper;
    
    public function __construct(DatabaseTable $user_table_helper)
    {
        $this->user_table_helper = $user_table_helper;
    }

    public function get_all($orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->user_table_helper->findAll($orderBy, $orderDirection, $limit, $offset);
    }

    public function count()
    {
        return $this->user_table_helper->total();
    }
    
    public function get_by_email($email)
    {
        $results = $this->user_table_helper->find(UserEntity::KEY_EMAIL, $email);
        return count($results) == 0 ? null : $results[0];
    }
    
    public function get_by_id($id)
    {
        return $this->user_table_helper->findById($id);
    }

    /**
     * @throws Exception
     */
    public function create($first_name, $last_name, $email, $password, $intro, $profile)
    {
        if (empty($first_name))
            throw new NinjaException('Vui lòng nhập tên');
        
        if (empty($last_name))
            throw new NinjaException('Vui lòng nhập họ đệm');
        
        if (empty($email))
            throw new NinjaException('Vui lòng nhập email');
        
        if (empty($password))
            throw new NinjaException('Vui lòng nhập mật khẩu');
        
        $existing = $this->get_by_email($email);
        if ($existing instanceof UserEntity)
            throw new NinjaException("Địa chỉ email $email đã được đăng ký");
        
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        return $this->user_table_helper->save([
            UserEntity::KEY_FIRST_NAME => $first_name,
            UserEntity::KEY_LAST_NAME => $last_name,
            UserEntity::KEY_EMAIL => $email,
            UserEntity::KEY_PASSWORD => $password_hash,
            UserEntity::KEY_INTRO => $intro,
            UserEntity::KEY_PROFILE => $profile,
        ]);
    }
}
