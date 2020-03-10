<?php

namespace Sample\product\data\datasource\inMemory\model;

use Carbon\Carbon;
use harmony\core\repository\InMemoryEntity;

class ProductInMemory implements InMemoryEntity
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var string */
    protected $description;
    /** @var float */
    protected $price;
    /** @var Carbon */
    protected $created_at;

    public function __construct(
        int $id,
        string $name,
        string $description,
        float $price,
        Carbon $created_at
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }
}
