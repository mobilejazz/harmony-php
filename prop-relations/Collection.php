<?php

/**
 * Collection<T[]>
 */
class Collection implements Iterator
{
  private int $position = 0;
  private ?array $array;

  public function __construct (
    /** @var T[] */
    ?array $items = null,
  ) {
    $this->array = $items;
  }

  public function rewind (): void
  {
    $this->isInitializedOrFail();
    $this->position = 0;
  }

  public function current ()
  {
    $this->isInitializedOrFail();
    return $this->array[$this->position];
  }

  public function key ()
  {
    $this->isInitializedOrFail();
    return $this->position;
  }

  public function next (): void
  {
    $this->isInitializedOrFail();
    ++$this->position;
  }

  public function valid (): bool
  {
    $this->isInitializedOrFail();
    return isset($this->array[$this->position]);
  }

  /**
   * @return T[]
   */
  public function getItems (): array
  {
    $this->isInitializedOrFail();
    return $this->array;
  }

  protected function isInitializedOrFail (): void
  {
    if ($this->array === null) {
      throw new CollectionNotInitializedException();
    }
  }
}
