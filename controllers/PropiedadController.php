<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
  public static function index(Router $router) {

    $propiedades = Propiedad::all();
    
    //* Muestra Mensaje Condicional 
    $resultado = $_GET['resultado'] ?? null;

    $router->render('propiedades/admin', [
      'propiedades' => $propiedades,
      'resultado' => $resultado
    ]);
  }

  public static function crear(Router $router) {

    $propiedad = new Propiedad;
    $vendedores = Vendedor::all();

    //* Arreglo con Mensaje de Errores
    $errores = Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
      //* Crear una Nueva Instancia
      $propiedad = new Propiedad($_POST['propiedad']);
  
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
      
    $router->render('propiedades/crear', [
      'propiedad' => $propiedad,
      'vendedores' => $vendedores,
      'errores' => $errores
    ]);
  }

  public static function actualizar() {
    echo 'Actualizar Propiedad';
  }
}