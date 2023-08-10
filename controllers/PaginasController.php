<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
class PaginasController {

  public static function index(Router $router) {

    $propiedades = Propiedad::get(3);
    $inicio = true;
    
    $router->render('paginas/index', [
      'propiedades' => $propiedades,
      'inicio' => $inicio
    ]);
  }

  public static function nosotros(Router $router) {
    
    $router->render('paginas/nosotros');
  }

  public static function propiedades(Router $router) {

    $propiedades = Propiedad::all();
    
    $router->render('paginas/propiedades', [
      'propiedades' => $propiedades
    ]);
  }

  public static function propiedad(Router $router) {

    $id = validarORedireccionar('/propiedades');

    // Buscar la Propiedad por su ID
    $propiedad = Propiedad::find($id);

    $router->render('paginas/propiedad', [
      'propiedad' => $propiedad
    ]);
  }

  public static function blog(Router $router) {
    
    $router->render('paginas/blog');
  }

  public static function entrada(Router $router) {
    
    $router->render('/paginas/entrada');
  }

  public static function contacto(Router $router) {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      //* Crear una Instancia de PHPMailer
      $mail = new PHPMailer();

      //* Configurar el Protocolo SMTP
      $mail->isSMTP();
      // $mail->Host = 'sandbox.smtp.mailtrap.io';
      $mail->Host = 'smtp.mailtrap.io';
      $mail->SMTPAuth = true;
      // $mail->Username = 'f1ecf0cbfbb712';
      $mail->Username = 'd24e350850a869';
      // $mail->Password = '********e82f';
      $mail->Password = '84f5068e077a6b';
      $mail->SMTPSecure ='tls';
      $mail->Port= 2525 ;

      //* Configurar el Contenido del Email
      $mail->setFrom('admin@bienesraices.com');
      $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
      $mail->Subject = 'Tienes un Nuevo Mensaje';

      //* Habilitar HTML
      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';

      //* Definir el Contenido
      $contenido = '<html> <p>Tienes un Nuevo Mensaje</p> </html>';
      $mail->Body = $contenido;
      $mail->AltBody = 'Esto es un Texto Alternativo sin HTML';

      //* Enviar el Email
      if($mail->send()) {
        echo "Mensaje Enviado Correctamente";
      } else {
        echo "El Mensaje No se Pudo Enviar...";
      }
    }
    
    $router->render('paginas/contacto', [


    ]);
  }

  public static function salida() {
    echo "Cierre de Sesión";
  }
}
