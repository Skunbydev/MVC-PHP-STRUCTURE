<?php


require_once __DIR__ . '/App/core/Core.php';
require_once __DIR__ . '/App/router/routes.php';

spl_autoload_register(function ($file) {
  if (file_exists(__DIR__ . "/App/utils/$file.php")) {
    require_once __DIR__ . "/App/utils/$file.php";
  } else if (file_exists(__DIR__ . "/App/models/$file.php")) {
    require_once __DIR__ . "/App/models/$file.php";
  }
});

$core = new Core();
$core->run($routes);
