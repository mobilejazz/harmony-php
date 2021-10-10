<?php

namespace Harmony\Core\Module\Kernel;

use Exception;
use Symfony\Component\Console\Application;

class ConsoleKernel extends Kernel {
  /**
   * @return int
   * @throws Exception
   */
  public function handleCommand(): int {
    $application = new Application();

    foreach ($this->moduleCommands as $command) {
      $application->add(new $command());
    }

    return $application->run();
  }
}
