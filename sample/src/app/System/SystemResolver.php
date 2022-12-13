<?php

namespace Sample\System;

use Harmony\Core\Module\Config\ResolverInterface;
use Harmony\Core\Module\Pdo\PdoFactory;
use Harmony\Core\Module\Pdo\PdoWrapper;
use Latitude\QueryBuilder\Engine\MySqlEngine;
use Latitude\QueryBuilder\QueryFactory;

class SystemResolver implements ResolverInterface {
  public function __invoke(): array {
    return [
      QueryFactory::class => function () {
        return new QueryFactory(new MySqlEngine());
      },
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
