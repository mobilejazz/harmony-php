<?php

namespace Sample\User;

use Harmony\Core\Module\Config\ProviderInterface;

class UserProvider implements ProviderInterface {
  /**
   * @inheritDoc
   */
  public function getRoutes(): array {
    return (new UserRoutes())();
  }

  /**
   * @inheritDoc
   */
  public function getCommands(): array {
    return [];
  }

  /**
   * @inheritDoc
   */
  public function getResolverDefinitions(): array {
    return (new UserResolver())();
  }
}
