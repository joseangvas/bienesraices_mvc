<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes');

//* Incluir Plantilla en otro Archivo
function incluirTemplate( string $nombre, bool $inicio = false ) {
  include TEMPLATES_URL . "/$nombre.php";
}

//* Verificar Autenticación del Usuario
function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']) {
      header('Location: /');
    }
}

//* Ejecutar var_dump()
function debuguear($variable) {
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  
  exit;
}

//* Escapa / Sanitizar el HTML
function s($html) : string {
  $s = htmlspecialchars($html);
  return $s;
}

//* Validar Tipo de Contenido
function validarTipoContenido($tipo) {
  $tipos = ['vendedor', 'propiedad'];

  return in_array($tipo, $tipos);
}

//* Mostrar Mensajes
Function mostrarNotificacion($codigo) {
  $mensaje = '';

  switch($codigo) {
    case 1:
      $mensaje = "Creado Correctamente";
      break;

    case 2:
      $mensaje = "Actualizado Correctamente";
      break;

    case 3:
      $mensaje = "Eliminado Correctamente";
      break;
      
    default:
      $mensaje = false;
      break;
  }

  return $mensaje;
}

function validarORedireccionar(string $url) {
    //* Obtener id de la Propiedad a Consultar y Validar si es Entero
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
  
    //* Validar el id en la URL para que sea un Número Entero
    if(!$id) {
      header("Location: $url");
    }

    return $id;
}