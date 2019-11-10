<?php

namespace harmony\core\repository\mapper;

interface Mapper
{
    /**
     * @param $input
     *
     * @return mixed
     */
    public function map($input);
}
