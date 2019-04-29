<?php

namespace sample\application\controller;

use sample\domain\entity\User;

class UserResponse {

    /** @var User */
    private $user;

    /**
     * UserResponse constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function serialize()
    {
        return [
            'id' => $this->user->getId(),
            'name' => $this->user->getName()
        ];
    }
}