<?php

namespace harmony\core\repository\mapper;

interface Mapper
{
    /**
     * @param $from
     *
     * @return mixed
     */
    public function map($from);
}
