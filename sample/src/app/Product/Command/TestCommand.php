<?php

namespace Sample\Product\Command;

use Harmony\Core\Module\Console\ControllerCommandInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command implements ControllerCommandInterface {
  protected static $defaultName = "api:test";

  protected function execute(
    InputInterface $input,
    OutputInterface $output,
  ): int {
    $output->write("\nSome text output...\n");
    return Command::SUCCESS;
  }
}
