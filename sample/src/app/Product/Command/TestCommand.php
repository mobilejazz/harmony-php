<?php

namespace Sample\Product\Command;

use Harmony\Core\Module\Symfony\Console\HarmonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends HarmonyCommand {
  protected static $defaultName = "api:test";

  protected function execute(
    InputInterface $input,
    OutputInterface $output,
  ): int {
    $output->write("\nSome text output...\n");
    return HarmonyCommand::SUCCESS;
  }
}
