<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
  
  public static function index(Router $router) {

    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    
    //* Muestra Mensaje Condicional si se Realizó la Operación
    $resultado = $_GET['resultado'] ?? null;

    $router->render('propiedades/admin', [
      'propiedades' => $propiedades,
      'vendedores' => $vendedores,
      'resultado' => $resultado
    ]);
  }

  //* CREAR UNA PROPIEDAD EN LA BASE DE DATOS
  public static function crear(Router $router) {

    $errores = Propiedad::getErrores();
    $propiedad = new Propiedad;
    $vendedores = Vendedor::all();

    //* Método POST para Crear una Propiedad
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
      //* Crear una Nueva Instancia
      $propiedad = new Propiedad($_POST['propiedad']);
  
      //* Generar un Nombre Unico de Imagen
      $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";
  
      //* Realizar un Resize a la Imagen con Intervetion
      if($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
      }
  
      //* Validar los Datos
      $errores = $propiedad->validar();
  
      //* Comprobar si el Array de Errores esté Vacío
      if(empty($errores)) {
        //**  SUBIDA DE ARCHIVOS  **//
        //* Crear una Carpeta de Imagenes si no Existe
        if(!is_dir(CARPETA_IMAGENES)) {
          mkdir(CARPETA_IMAGENES);
        }
        
        //* Guardar la Imagen en el Servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        
        //* guardar en la Base de Datos
        $propiedad->guardar();

      };
    };
      
    $router->render('propiedades/crear', [
      'propiedad' => $propiedad,
      'vendedores' => $vendedores,
      'errores' => $errores
    ]);
  }

  //* ACTUALIZAR DATOS DE UNA PROPIEDAD EXISTENTE
  public static function actualizar(Router $router) {
    
    $id = validarORedireccionar('/admin');

    // Obtener Datos de la Propiedad
    $propiedad = Propiedad::find($id);

    // Consultar para Obtener Datos de Los Vendedores
    $vendedores = Vendedor::all();

    // Arreglo con Mensaje de Errores
    $errores = Propiedad::getErrores();

    //* Método POST para Actualizar Propiedad
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
      //* Asignar los Atributos
      $args = $_POST['propiedad'];

      $propiedad->sincronizar($args);

      //* Crear una Nueva Instancia
      // $propiedad = new Propiedad($_POST['propiedad']);

        //* Generar un Nombre Unico de Imagen
      $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";
  
      //* Setear la Imagen
      //* Realizar un Resize a la Imagen con Intervetion
      if($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
      }
  
      //* Validar los Datos
      $errores = $propiedad->validar();
  
      //* Comprobar si el Array de Errores esté Vacío
      if(empty($errores)) {
        //**  SUBIDA DE ARCHIVOS  **//
        //* Crear una Carpeta de Imagenes si no Existe
        if(!is_dir(CARPETA_IMAGENES)) {
          mkdir(CARPETA_IMAGENES);
        }
        
        //* Guardar la Imagen en el Servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        
        //* guardar en la Base de Datos
        $propiedad->guardar();

      };
    };

    $router->render('/propiedades/actualizar', [
      'propiedad' => $propiedad,
      'vendedores' => $vendedores,
      'errores' => $errores
    ]);
  }

  //* ELIMINAR UNA PROPIEDAD EXISTENTE
  public static function eliminar(Router $router) {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $tipo = $_POST['tipo'];

      // peticiones validas
      if(validarTipoContenido($tipo) ) {
        // Leer el id
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        // encontrar y eliminar la propiedad
        $propiedad = Propiedad::find($id);

        $propiedad->eliminar();

      }
    }
  }
}