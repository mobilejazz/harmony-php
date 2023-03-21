<?php

namespace Harmony\Core\Data\Query\Criteria;

enum Criteria {
  case In;
  case NotIn;
  case Eq;
  case NotEq;
  case Gt;
  case Gte;
  case Lt;
  case Lte;
  case IsNull;
  case IsNotNull;
}
