<?php

namespace harmony\eloquent\repository\mapper;

use App\Models\SettingEloquent;
use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\GenericMapper;
use harmony\eloquent\repository\EloquentEntity;
use ReflectionClass;

class EloquentToEntityMapper extends GenericMapper
{
    public function __construct(string $from_class, string $to_class)
    {
        parent::__construct($from_class, $to_class);

        $this->isReceivedClassLikeExpectedOrFail($from_class, EloquentEntity::class);
        $this->isReceivedClassLikeExpectedOrFail($to_class, BaseEntity::class);
    }


    protected function overrideMap($from): BaseEntity
    {
        /** @var SettingEloquent $from */
        $cast = $from->getAttributes();

        $reflection = new ReflectionClass($this->getTypeTo());
        $constructor = $reflection->getConstructor();
        $parameters = $constructor->getParameters();

        // dd("map eloquent to entity", $from);
        dd($parameters, $cast);
        // TODO: Implement overrideMap() method.
    }
}
