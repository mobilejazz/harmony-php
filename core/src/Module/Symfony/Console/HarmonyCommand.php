<?php

namespace Harmony\Core\Module\Symfony\Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

class HarmonyCommand extends SymfonyCommand {
  final public function __construct(string $name = null) {
    parent::__construct($name);
  }
}
