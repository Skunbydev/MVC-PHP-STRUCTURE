<?php
require_once __DIR__ . '/Database.php';

class UserModel extends Database
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = $this->getConnection();
  }

  public function fetch()
  {
    try {
      $stm = $this->pdo->query("SELECT * FROM usuarios");

      if ($stm->rowCount() > 0) {
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return [];
      }
    } catch (PDOException $e) {
      return ['error' => $e->getMessage()];
    }
  }


  public function fetchById($id)
  {
    $stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
    $stm->execute([$id]);
    return $stm->fetch(PDO::FETCH_ASSOC);
  }

  public function createUser($username, $password)
  {
    $secretKey = bin2hex(random_bytes(32));

    $stmt = $this->pdo->prepare("INSERT INTO usuarios (usuario, senha, token_usuario) VALUES (?, ?, ?)");
    $stmt->execute([
      $username,
      password_hash($password, PASSWORD_DEFAULT), 
      $secretKey
    ]);

    return $this->pdo->lastInsertId();
  }

  public function getUserSecretKey($userId)
  {
    $stmt = $this->pdo->prepare("SELECT token_usuario FROM usuarios WHERE usuario = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
  }
}
