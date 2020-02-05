<?php

namespace harmony\eloquent\repository\mapper;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\error\MapException;
use harmony\core\repository\mapper\GenericMapper;
use harmony\eloquent\repository\EloquentEntity;
use ReflectionClass;
use ReflectionException;
use ReflectionParameter;

class EloquentToEntityMapper extends GenericMapper
{
    public function __construct(string $from_class, string $to_class)
    {
        parent::__construct($from_class, $to_class);

        $this->isReceivedClassLikeExpectedOrFail($from_class, EloquentEntity::class);
        $this->isReceivedClassLikeExpectedOrFail($to_class, BaseEntity::class);
    }

    /**
     * @param $from
     *
     * @return BaseEntity
     * @throws MapException
     * @throws ReflectionException
     */
    protected function overrideMap($from): BaseEntity
    {
        /** @var EloquentEntity $from */
        $cast = $from->getAttributes();

        $class = $this->getTypeTo();
        $reflection = new ReflectionClass($class);
        $constructor = $reflection->getConstructor();
        $parameters = $constructor->getParameters();

        $ordered_parameters = $this->getOrderedParameters(
            $class,
            $parameters,
            $cast
        );

        $to = new $class(...$ordered_parameters);

        return $to;
    }

    /**
     * @param string $class
     * @param array  $parameters
     * @param array  $cast
     *
     * @return array
     * @throws MapException
     */
    protected function getOrderedParameters(
        string $class,
        array $parameters,
        array $cast
    ): array {
        $ordered_parameters = [];

        foreach ($parameters AS $parameter) {
            $this->existParameterOrFail(
                $class,
                $cast,
                $parameter
            );

            $ordered_parameters[] = $cast[$parameter->name];
        }

        return $ordered_parameters;
    }

    /**
     * @param string              $class
     * @param array               $cast
     * @param ReflectionParameter $parameter
     *
     * @throws MapException
     */
    protected function existParameterOrFail(
        string $class,
        array $cast,
        ReflectionParameter $parameter
    ): void {
        if (isset($cast[$parameter->name])) {
            return;
        }

        throw new MapException(
            'No value for constructor parameter "' . $parameter->name
            . '" at Class "' . $class . '"'
        );
    }
}
