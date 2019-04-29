<?php

namespace sample\data\mapper;

use sample\data\entity\UserEntity;
use sample\domain\entity\User;
use src\data\mapper\Mapper;

class UserEntityToUserMapper implements Mapper {

    /**
     * User mapper
     *
     * @param mixed $input
     *
     * @return User
     */
    public function map($input) : User
    {
        if(!$input instanceof UserEntity) {
            throw new \InvalidArgumentException('Input != UserEntity');
        }
        return new User($input->id);
    }
}