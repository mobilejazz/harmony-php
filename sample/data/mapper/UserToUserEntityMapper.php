<?php

namespace sample\data\mapper;

use sample\data\entity\UserEntity;
use sample\domain\entity\User;
use src\data\mapper\Mapper;

class UserToUserEntityMapper implements Mapper {

    /**
     * User mapper
     *
     * @param mixed $input
     *
     * @return UserEntity
     */
    public function map($input) : UserEntity
    {
        if(!$input instanceof User) {
            throw new \InvalidArgumentException('Input != User');
        }
        return new UserEntity($input->getId());
    }
}