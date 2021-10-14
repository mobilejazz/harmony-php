<?php

namespace Sample\Product\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command {
  protected static string $defaultName = "api:test";
  public static string $consoleCommand = "api:test";

  protected function execute(
    InputInterface $input,
    OutputInterface $output,
  ): int {
    $output->write("\nSome text output...\n");
    return Command::SUCCESS;
  }
}
