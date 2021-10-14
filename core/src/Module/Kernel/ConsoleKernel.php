<?php

namespace Harmony\Core\Module\Kernel;

use Exception;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;

class ConsoleKernel extends Kernel {
  /**
   * @return int
   * @throws Exception
   */
  public function handleCommand(): int {
    $commands = [];

    foreach ($this->moduleCommands as $command) {
      $commands[$command::$consoleCommand] = function () use (
        $command,
      ): Command {
        return new $command();
      };
    }

    $commandLoader = new FactoryCommandLoader($commands);

    $application = new Application();
    $application->setCommandLoader($commandLoader);

    return $application->run();
  }
}
