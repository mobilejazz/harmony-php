<?php

echo "Before start break of XDebug";

xdebug_break();
var_dump($_SERVER);

echo "After start break of XDebug";
