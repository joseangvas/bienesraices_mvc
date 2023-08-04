<?php

namespace MVC;

class Router {

  public $rutasGET = [];
  public $rutasPOST = [];

  public function get($url, $fn) {
    $this->rutasGET[$url] = $fn;
  }

  public function comprobarRutas()
  {
    $urlActual = $_SERVER['PATH_INFO'] ?? '/';
    $metodo = $_SERVER['REQUEST_METHOD'];

    if($metodo === 'GET') {
      $fn = $this->rutasGET[$urlActual] ?? null;
    }

    if($fn) {
      // La URL Existe y hay una Función Asociada
      call_user_func($fn, $this);
    } else {
      echo "Página No Encontrada";
    }
  }

  //* Mostrar una Vista
  public function render($view) {

    ob_start();   // Almacenamiento en Memoria
    include_once __DIR__ . "/views/$view.php";
    $contenido = ob_get_clean();  // Limpia el Buffer de Memoria
    include_once __DIR__ . "/views/layout.php";
  }
}