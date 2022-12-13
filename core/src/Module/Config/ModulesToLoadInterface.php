<?php

namespace Harmony\Core\Module\Config;

interface ModulesToLoadInterface {
  /** @return class-string<ProviderInterface>[] */
  public function getProviders(): array;
}
