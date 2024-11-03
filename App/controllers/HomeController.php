<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../controllers/UserController.php'; // Incluindo o UserController

class HomeController extends RenderView
{
    public function index()
    {
        try {
            $userModel = new UserModel();
            $users = $userModel->fetch();

            if (isset($users['error'])) {
                throw new Exception($users['error']);
            }

            $this->loadView('home', [
                'title' => 'Página Inicial',
                'users' => $users
            ]);
        } catch (Exception $e) {
            $this->loadView('error', [
                'message' => 'Erro ao carregar a página inicial: ' . $e->getMessage()
            ]);
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userController = new UserController();
            $userController->create($username, $password);
        } else {
            $this->loadView('register', [
                'title' => 'Cadastro de Usuário'
            ]);
        }
    }
}
