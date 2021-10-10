<?php

namespace Harmony\Core\Module\FileSystem\Error;

use Harmony\Core\Shared\Error\HarmonyException;

class FileNotExistException extends HarmonyException {
  public function __construct(string $filePath) {
    parent::__construct("File not exist: " . $filePath);
  }
}
