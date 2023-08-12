<?php

namespace Model;

class Admin extends ActiveRecord {
  //* Bases de Datos
  protected static $tabla = 'usuarios';
  protected static $columnasDB = ['id', 'email', 'password'];

  public $id;
  public $email;
  public $password;

  public function __construct($args = []) {
    $this->id = $args['id'] ?? null;
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
  }

  //* Validar la Entrada de Datos del Usuario
  public function validar() {

    if(!$this->email) {
      self::$errores[] = 'El Email es Obligatorio';
    }

    if(!$this->password) {
      self::$errores[] = 'El Password es Obligatorio';
    }

    return self::$errores;
  }

  public function existeUsuario() {
    // Revisar si un Usuario Existe o No
    $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

    $resultado = self::$db->query($query);

    if(!$resultado->num_rows) {
      // No Existe el Usuario Ingresado (Mensaje de Error)
      self::$errores[] = 'El Usuario No Existe';
      return;
    }

    return $resultado;
  }

  public function comprobarPassword($resultado) {
    // Comprobamos el password contra lo que esta en la DB
    $usuario = $resultado->fetch_object();
    $autenticado = password_verify($this->password, $usuario->password);

    if(!$autenticado) {
      // Password Incorrecto (Mensaje de Error)
      self::$errores[] = 'El Password es Incorrecto';
    }

    return $autenticado;
  }

 public function autenticar() {
  session_start();

  // Llenar el Arreglo de Sesión
  $_SESSION['usuario'] = $this->email;
  $_SESSION['login'] = true;

  header('Location: /propiedades/admin');
 } 
}