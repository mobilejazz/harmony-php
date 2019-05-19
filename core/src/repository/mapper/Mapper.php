<?php

namespace harmony\core\repository\mapper;

/**
 * Interface Mapper
 */
interface Mapper
{
    /**
     * Map
     *
     * @param mixed $input input to be mapped
     *
     * @return mixed
     */
    public function map($input);
}
