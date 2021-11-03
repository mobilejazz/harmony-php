<?php

namespace Harmony\Core\Module\Config;

interface ResolverInterface {
  /**
   * @return array<string, callable>
   */
  public function __invoke(): array;
}
