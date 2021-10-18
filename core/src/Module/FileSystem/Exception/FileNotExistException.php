<?php

namespace Harmony\Core\Module\FileSystem\Exception;

use Harmony\Core\Domain\Exception\HarmonyException;

class FileNotExistException extends HarmonyException {
  public function __construct(string $filePath) {
    parent::__construct("File not exist: " . $filePath);
  }
}
