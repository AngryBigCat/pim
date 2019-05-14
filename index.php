<?php

define('ROOT_PATH', __DIR__);

require_once ROOT_PATH.'/vendor/autoload.php';

require_once ROOT_PATH.'/src/Main.php';

Pim\Main::run();
