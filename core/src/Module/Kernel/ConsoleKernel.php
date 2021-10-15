<?php

namespace Harmony\Core\Module\Kernel;

use Exception;
use Harmony\Core\Module\Symfony\Console\HarmonyCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;

class ConsoleKernel extends Kernel {
  /**
   * @return int
   * @throws Exception
   */
  public function handleCommand(): int {
    $commands = [];

    foreach ($this->moduleCommands as $command) {
      $commandName = $command::getDefaultName();

      if (is_string($commandName)) {
        $commands[$commandName] = function () use ($command): HarmonyCommand {
          return new $command();
        };
      }
    }

    $commandLoader = new FactoryCommandLoader($commands);

    $application = new Application();
    $application->setCommandLoader($commandLoader);

    return $application->run();
  }
}
