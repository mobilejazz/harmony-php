<?php

namespace Harmony\Core\Module\Sql\Error;

use Exception;
use Harmony\Core\Error\HarmonyException;

class IdRequiredToUpdateSqlRowException extends Exception implements
  HarmonyException {
}
