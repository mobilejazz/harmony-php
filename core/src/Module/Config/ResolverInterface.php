<?php

namespace Harmony\Core\Module\Config;

interface ResolverInterface {
  /**
   * @return array<string, callable>
   */
  public function getDefinitions(): array;
}
