<?php

class UserController extends RenderView
{
  public function index()
  {
  }
  public function show($id)
  {
    $id_usuario = $id[0];

    $user = new UserModel();
    $this->loadView('users', ['user' => $user->fetchById($id_usuario)]);
  }
}
