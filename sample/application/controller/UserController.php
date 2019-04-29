<?php

namespace sample\application\controller;

use sample\data\dataSource\UserStorageDoctrineDataSource;
use sample\data\mapper\UserEntityToUserMapper;
use sample\data\mapper\UserToUserEntityMapper;
use sample\data\repository\doctrine\operation\CreateUserOperation;
use sample\domain\entity\User;
use src\data\dataSource\query\IntegerIdQuery;
use src\data\dataSource\query\Query;
use src\data\repository\operation\Operation;
use src\data\repository\RepositoryMapper;
use src\data\repository\SingleDataSourceRepository;
use src\domain\interactor\DeleteInteractor;
use src\domain\interactor\GetAllInteractor;
use src\domain\interactor\GetInteractor;
use src\domain\interactor\PutInteractor;

class UserController {

    public function provideGetInteractor()
    {
        $dataSource = new UserStorageDoctrineDataSource();
        $repository = new SingleDataSourceRepository(
            $dataSource,
            $dataSource,
            $dataSource
        );
        $repositoryMapper = new RepositoryMapper(
            $repository,
            $repository,
            $repository,
            new UserToUserEntityMapper(),
            new UserEntityToUserMapper()
        );
        return new GetInteractor($repositoryMapper);
    }

    /**
     * Get user
     *
     * @param $userId
     *
     * @return array
     */
    public function getUser($userId)
    {
        $getInteractor = $this->provideGetInteractor();
        /* @var User $user */
        $user = $getInteractor->execute(
            new IntegerIdQuery($userId), new Operation()
        );
        return (new UserResponse($user))->serialize();
    }

    /**
     * Get all users
     */
    public function getUsers()
    {
        $dataSource = new UserStorageDoctrineDataSource();
        $repository = new SingleDataSourceRepository(
            $dataSource,
            $dataSource,
            $dataSource
        );
        $repositoryMapper = new RepositoryMapper(
            $repository,
            $repository,
            $repository,
            new UserToUserEntityMapper(),
            new UserEntityToUserMapper()
        );
        $getAllInteractor = new GetAllInteractor($repositoryMapper);

        /* @var User $user */
        $users = $getAllInteractor->execute(
            null, new Operation()
        );

        $response = [];
        /* @var User $user */
        foreach ($users as $user) {
            $response[] = (new UserResponse($user))->serialize();
        }
        return $response;
    }

    /**
     * Post user
     *
     * @param $request
     *
     * @return array
     *
     */
    public function postUser($request)
    {
        $dataSource = new UserStorageDoctrineDataSource();
        $repository = new SingleDataSourceRepository(
            $dataSource,
            $dataSource,
            $dataSource
        );
        $repositoryMapper = new RepositoryMapper(
            $repository,
            $repository,
            $repository,
            new UserToUserEntityMapper(),
            new UserEntityToUserMapper()
        );
        $putInteractor = new PutInteractor($repositoryMapper);
        /* @var User $user */
        $user = $putInteractor->execute(
            new Query(),
            new CreateUserOperation(
                $request->id,
                $request->name
            ),
            new User(null)
        );
        return (new UserResponse($user))->serialize();
    }

    /**
     * Put user
     *
     * @param $userId
     * @param $request
     *
     * @return array
     */
    public function putUser(int $userId, $request)
    {
        $dataSource = new UserStorageDoctrineDataSource();
        $repository = new SingleDataSourceRepository(
            $dataSource,
            $dataSource,
            $dataSource
        );
        $repositoryMapper = new RepositoryMapper(
            $repository,
            $repository,
            $repository,
            new UserToUserEntityMapper(),
            new UserEntityToUserMapper()
        );
        $putInteractor = new PutInteractor($repositoryMapper);
        /* @var User $user */
        $user = $putInteractor->execute(
            new IntegerIdQuery($userId),
            new Operation(
                $request->id,
                $request->name
            ),
            new User($userId)
        );
        return (new UserResponse($user))->serialize();
    }

    /**
     * Delete user
     *
     * @param $userId
     */
    public function deleteUser($userId)
    {
        $dataSource = new UserStorageDoctrineDataSource();
        $repository = new SingleDataSourceRepository(
            $dataSource,
            $dataSource,
            $dataSource
        );
        $repositoryMapper = new RepositoryMapper(
            $repository,
            $repository,
            $repository,
            new UserToUserEntityMapper(),
            new UserEntityToUserMapper()
        );
        $deleteInteractor = new DeleteInteractor($repositoryMapper);
        $deleteInteractor->execute(new Query(), new Operation());
    }

}