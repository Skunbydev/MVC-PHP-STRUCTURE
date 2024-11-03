<?php

require_once 'vendor/autoload.php';
require_once __DIR__ . '/../utils/RenderView.php';
require_once __DIR__ . '/../config/config.php'; 
require_once __DIR__ . '/../models/UserModel.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserController extends RenderView
{
    private $config;

    public function __construct()
    {
        // Carrega a configuração
        $this->config = require __DIR__ . '/../config/config.php';
        if (!$this->config) {
            throw new Exception("Erro ao carregar as configurações.");
        }
    }

    public function create($username, $password)
    {
        try {
            $userModel = new UserModel();
            $userId = $userModel->createUser($username, $password);
            echo "Usuário criado com ID: " . $userId;
        } catch (Exception $e) {
            echo "Erro ao criar usuário: " . $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $id_usuario = $id[0];
            $userModel = new UserModel();
            $usuarioData = $userModel->fetchById($id_usuario);

            if ($usuarioData) {
                $usuarioData['token'] = $this->generateToken($usuarioData);
                $this->loadView('users', ['user' => $usuarioData]);
            } else {
                $this->loadView('error', ['message' => 'Usuário não encontrado']);
            }
        } catch (Exception $e) {
            $this->loadView('error', ['message' => 'Erro ao exibir usuário: ' . $e->getMessage()]);
        }
    }

    private function generateToken($user)
    {
        try {
            $secretKey = $user['jwt_secret_key'];
            if (!$secretKey) {
                throw new Exception("Chave secreta do usuário não encontrada.");
            }

            $payload = [
                'iss' => $this->config['app_identifier'],
                'sub' => $user['id_usuario'],
                'name' => $user['username'],
                'iat' => time(),
                'exp' => time() + 3600
            ];

            return JWT::encode($payload, $secretKey, 'HS256');
        } catch (Exception $e) {
            throw new Exception("Erro ao gerar o token JWT: " . $e->getMessage());
        }
    }

    public function verifyToken($jwt, $userId)
    {
        try {
            $userModel = new UserModel();
            $secretKey = $userModel->getUserSecretKey($userId);

            if (!$secretKey) {
                throw new Exception("Chave secreta do usuário não encontrada.");
            }

            return JWT::decode($jwt, new Key($secretKey, 'HS256'));
        } catch (Exception $e) {
            throw new Exception("Token inválido: " . $e->getMessage());
        }
    }
}
