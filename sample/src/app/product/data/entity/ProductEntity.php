<?php

namespace Sample\product\data\entity;

use Carbon\Carbon;
use harmony\core\repository\BaseEntity;

class ProductEntity implements BaseEntity
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
        Carbon $created_at = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->setCreatedAt($created_at);
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

    /**
     * @param $created_at
     */
    protected function setCreatedAt($created_at): void
    {
        if (empty($created_at)) {
            $created_at = Carbon::now();
        }

        $this->created_at = $created_at;
    }
}
