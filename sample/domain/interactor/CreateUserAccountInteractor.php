<?php

namespace sample\domain\interactor;

use sample\domain\entity\User;
use src\data\dataSource\query\Query;
use src\data\repository\operation\Operation;
use src\domain\interactor\PutInteractor;

class CreateUserAccountInteractor {
    
    /** @var PutInteractor */
    private $putUserInteractor;
    /** @var PutInteractor */
    private $putEmailInteractor;

    /**
     * CreateUserAccountInteractor constructor.
     * @param PutInteractor $putUserInteractor
     * @param PutInteractor $putEmailInteractor
     */
    public function __construct(PutInteractor $putUserInteractor, PutInteractor $putEmailInteractor)
    {
        $this->putUserInteractor = $putUserInteractor;
        $this->putEmailInteractor = $putEmailInteractor;
    }

    /**
     * Execute
     *
     * @param string $email email
     *
     * @return User
     */
    public function execute(
        string $email
    ) : User {

        $user = $this->putUserInteractor->execute(
          new Query(), new Operation(), new User(null)
        );
        // TODO SEND EMAIL
        // $this->putEmailInteractor->execute(
        //    new Query(), new Operation(), $email
        //);
    }
}