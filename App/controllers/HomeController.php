<?php

class HomeController extends RenderView
{
  public function index()
  {
    $users = new UserModel();



    $this->loadView('home', [
      'title' => 'Home page',
      'users' => $users->fetch()

    ]);
  }
}
