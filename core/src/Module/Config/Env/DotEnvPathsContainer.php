<?php

namespace Harmony\Core\Module\Config\Env;

use Harmony\Core\Module\FileSystem\Error\FileNotExistException;
use Harmony\Core\Module\FileSystem\ValueObject\ValidFilePath;

class DotEnvPathsContainer implements DotEnvPathsContainerInterface {
  /** @var ValidFilePath[] */
  protected array $paths = [];

  /**
   * @param string[] $paths
   *
   * @throws FileNotExistException
   */
  public function __construct(array $paths = []) {
    foreach ($paths as $path) {
      $this->add($path);
    }
  }

  /**
   * @throws FileNotExistException
   */
  public function add(string $path): void {
    $this->paths[] = new ValidFilePath($path);
  }

  /**
   * @return ValidFilePath[]
   */
  public function getEnvPaths(): array {
    return $this->paths;
  }
}
