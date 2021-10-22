<?php

namespace Sample\System;

use DI\ContainerBuilder;
use Harmony\Core\Module\DI\ResolverInterface;
use Harmony\Core\Module\Pdo\PdoFactory;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Latitude\QueryBuilder\Engine\MySqlEngine;
use Latitude\QueryBuilder\QueryFactory;

class SystemResolver implements ResolverInterface {
  public function register(ContainerBuilder $containerBuilder): void {
    $containerBuilder->addDefinitions($this->registerQueryFactory());
    $containerBuilder->addDefinitions($this->registerPdoWrapper());
  }

  public function registerQueryFactory(): array {
    return [
      QueryFactory::class => function () {
        return new QueryFactory(new MySqlEngine());
      },
    ];
  }

  public function registerPdoWrapper(): array {
    return [
      PdoWrapper::class => function () {
        return (new PdoFactory())(
          (string) getenv("MYSQL_USER"),
          (string) getenv("MYSQL_PASSWORD"),
          (string) getenv("MYSQL_HOST"),
          (string) getenv("MYSQL_DATABASE"),
        );
      },
    ];
  }
}
