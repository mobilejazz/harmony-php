<?php

namespace harmony\eloquent\repository\mapper;

use App\Models\SettingEloquent;
use harmony\core\repository\BaseEntity;
use harmony\core\repository\error\MapException;
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

        $class = $this->getTypeTo();
        $reflection = new ReflectionClass($class);
        $constructor = $reflection->getConstructor();
        $parameters = $constructor->getParameters();

        $ordered_parameters = [];

        foreach($parameters AS $key => $parameter){
            if(!isset($cast[$parameter->name])) {
                throw new MapException('No value for constructor parameter "' . $parameter->name
                . '" at Class "' . $class . '"');
            }

            $ordered_parameters[] = $cast[$parameter->name];
        }

        $to = new $class(...$ordered_parameters);

        return $to;
    }
}
