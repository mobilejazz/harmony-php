<?php

namespace Harmony\Core\Module\Config\Env;

use Harmony\Core\Module\FileSystem\ValueObject\ValidFilePath;

interface DotEnvPathsContainerInterface {
  /**
   * @return ValidFilePath[]
   */
  public function getEnvPaths(): array;
}
