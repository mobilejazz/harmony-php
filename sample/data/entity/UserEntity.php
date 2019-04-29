<?php

namespace sample\data\entity;

use src\data\entity\BaseEntity;

class UserEntity extends BaseEntity {

    /** @var integer */
    public $id;
    /** @var string */
    public $name;
}