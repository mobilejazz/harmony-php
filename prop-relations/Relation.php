<?php

/**
 * Relation<T>
 */
class Relation
{
  public function __construct (
    /** @var T */
    protected readonly ?object $value = null,
  ) {
  }

  /**
   * @return T
   */
  public function getValue (): object
  {
    $this->isInitializedOrFail();
    return $this->value;
  }

  protected function isInitializedOrFail (): void
  {
    if ($this->value === null) {
      throw new CollectionNotInitializedException();
    }
  }
}
