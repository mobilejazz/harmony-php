<?php

namespace Harmony\Core\Repository\Query;

enum Criteria
{
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
