<?php

namespace sample\data\dataSource;

use sample\data\entity\UserEntity;
use sample\domain\entity\User;
use src\data\dataSource\GetDataSource;
use src\data\dataSource\PutDataSource;
use src\data\dataSource\query\IntegerIdQuery;
use src\data\dataSource\query\Query;
use src\data\entity\BaseEntity;
use src\data\repository\DeleteDataSource;

class UserStorageDoctrineDataSource implements GetDataSource, PutDataSource, DeleteDataSource
{
    public function delete(Query $query)
    {
        // TODO: Implement delete() method.
    }

    public function deleteAll(Query $query)
    {
        // TODO: Implement deleteAll() method.
    }

    public function get(Query $query): BaseModel
    {
        if($query instanceof IntegerIdQuery) {

            return new User($query->getId(), ''); // This would be from DB using ORM
        }
        throw new \InvalidArgumentException('Query not supported');

    }

    public function getAll(Query $query): array
    {
        // TODO: Implement getAll() method.
    }

    public function put(Query $query, BaseEntity $baseEntity): BaseEntity
    {
        // TODO: Implement put() method.
    }

    public function putAll(Query $query, array $baseEntities)
    {
        // TODO: Implement putAll() method.
    }

}