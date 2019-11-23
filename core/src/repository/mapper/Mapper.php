<?php

namespace harmony\core\repository\mapper;

interface Mapper
{
    /**
     * @param object $from
     *
     * @return mixed
     */
    public function map(object $from);
}
