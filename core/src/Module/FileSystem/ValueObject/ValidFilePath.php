<?php

namespace Harmony\Core\Module\FileSystem\ValueObject;

use Harmony\Core\Module\FileSystem\Exception\FileNotExistException;

class ValidFilePath {
  /**
   * @throws FileNotExistException
   */
  public function __construct(public string $value) {
    $this->validateOrFail();
  }

  /**
   * @throws FileNotExistException
   */
  protected function validateOrFail(): void {
    if (!file_exists($this->value)) {
      throw new FileNotExistException($this->value);
    }
  }
}
