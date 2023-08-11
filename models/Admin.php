<?php

namespace Model;

class Admin extends ActiveRecord {
  //* Bases de Datos
  protected static $tabla = 'usuarios';
  protected static $columnasDB = ['id', 'email', 'password'];

  public $id;
  public $email;
  public $password;

  public function __construc($args = []) {
    $this->id = $args['id'] ?? null;
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';

    
  }
}