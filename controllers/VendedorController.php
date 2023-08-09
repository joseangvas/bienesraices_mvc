<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {

  public static function index(Router $router) {

    $vendedores = Vendedor::all();
    
    //* Muestra Mensaje Condicional si se Realizó la Operación
    $resultado = $_GET['resultado'] ?? null;

    $router->render('vendedores/admin', [
      'vendedores' => $vendedores,
      'resultado' => $resultado
    ]);
  }

  //* CREAR UN VENDEDOR EN LA BASE DE DATOS
  public static function crear(Router $router) {

    $errores = Vendedor::getErrores();
    $vendedor = new Vendedor;

    //* Método POST para Crear una Propiedad
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
      //* Crear una Nueva Instancia
      $vendedor = new Vendedor($_POST['vendedor']);
  
      //* Validar los Datos
      $errores = $vendedor->validar();
  
      //* Comprobar si el Array de Errores esté Vacío
      if(empty($errores)) {
        //**  SUBIDA DE ARCHIVOS  **//
       
        //* guardar en la Base de Datos
        $vendedor->guardar();
      };
    };
      
    $router->render('vendedores/crear', [
      'vendedor' => $vendedor,
      'errores' => $errores
    ]);
  }

  //* ACTUALIZAR DATOS DE UN VENDEDOR EXISTENTE
  public static function actualizar(Router $router) {
    
    $id = validarORedireccionar('/vendedores/admin');

    // Obtener Datos de la Propiedad
    $vendedor = Vendedor::find($id);

    // Arreglo con Mensaje de Errores
    $errores = Vendedor::getErrores();

    //* Método POST para Actualizar Propiedad
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
      //* Asignar los Atributos
      $args = $_POST['vendedor'];

      $vendedor->sincronizar($args);

      //* Validar los Datos
      $errores = $vendedor->validar();
  
      //* Comprobar si el Array de Errores esté Vacío
      if(empty($errores)) {
        //**  SUBIDA DE ARCHIVOS  **//
        
        //* guardar en la Base de Datos
        $vendedor->guardar();
      };
    };

    $router->render('vendedores/actualizar', [
      'vendedor' => $vendedor,
      'errores' => $errores
    ]);
  }

  //* ELIMINAR UN VENDEDOR EXISTENTE
  public static function eliminar(Router $router) {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      //* Validar el ID
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);

      if($id) {
        // peticiones validas
        $tipo = $_POST['tipo'];
        
        if(validarTipoContenido($tipo) ) {
          // encontrar y eliminar la propiedad
          $vendedor = Vendedor::find($id);
          $vendedor->eliminar();
        }
      }
    }
  }
}