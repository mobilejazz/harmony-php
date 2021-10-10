<?php

namespace Harmony\Core\Module\Config;

interface ModulesToLoadInterface {
  /** @return class-string<ModuleInterface>[] */
  public function getModules(): array;
}
