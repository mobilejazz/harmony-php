<?php

namespace Harmony\Core\Domain\Pagination;

class Pagination {
    /**
     * @param array $values
     */
    public function __construct(
        protected array $values,
    ) {
    }

    /**
     * @return array
     */
    public function getValues(): array {
        return $this->values;
    }
}
