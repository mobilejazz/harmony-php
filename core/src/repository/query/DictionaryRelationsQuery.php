<?php

namespace harmony\core\repository\query;

use harmony\core\shared\Dictionary;

class DictionaryRelationsQuery extends Query
{
    /** @var Dictionary */
    private $dictionary;
    /** @var array */
    private $relations;

    /**
     * DictionaryRelationsQuery constructor.
     *
     * @param Dictionary $dictionary
     * @param array      $relations
     */
    public function __construct(Dictionary $dictionary, array $relations)
    {
        $this->dictionary = $dictionary;
        $this->relations = $relations;
    }

    /**
     * @return Dictionary
     */
    public function geDictionary() : Dictionary
    {
        return $this->dictionary;
    }

    /**
     * @return array
     */
    public function getRelations() : array
    {
        return $this->relations;
    }
}
