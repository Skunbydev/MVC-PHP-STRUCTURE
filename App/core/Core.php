<?php
require_once __DIR__ . '/../router/routes.php';

class Core
{
  public function run($routes)
  {
    // Configura a URL com uma barra inicial e processa o GET
    $url = '/';

    $url .= isset($_GET['url']) ? $_GET['url'] : '';
    $url = rtrim($url, '/'); // Remove qualquer barra final extra

    $routerFound = false;

    foreach ($routes as $path => $controller) {

      // Modifica o padrão para ignorar a barra final
      $pattern = '#^' . preg_replace('/{id}/', '(\w+)', rtrim($path, '/')) . '$#';

      if (preg_match($pattern, $url, $matches)) {
        array_shift($matches);

        $routerFound = true;

        [$currentController, $action] = explode('@', $controller);

        require_once __DIR__ . "/../controllers/$currentController.php";

        $newController = new $currentController();
        $newController->$action($matches);
        break; // Encerra o loop ao encontrar a rota correspondente
      }
    }

    // Redireciona para NotFoundedController caso nenhuma rota seja encontrada
    if (!$routerFound) {
      require_once __DIR__ . "/../controllers/NotFoundController.php";
      $controller = new NotFoundedController();
      $controller->index();
    }
  }
}
