<?php

namespace harmony\core\repository\query;

use harmony\core\shared\Dictionary;

class DictionaryQuery extends Query
{
    /** @var Dictionary */
    private $dictionary;

    /**
     * DictionaryQuery constructor.
     *
     * @param Dictionary $dictionary
     */
    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * @return Dictionary
     */
    public function geDictionary() : Dictionary
    {
        return $this->dictionary;
    }
}
