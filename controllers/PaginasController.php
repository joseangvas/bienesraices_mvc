<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';

// require 'phpmailer/src/PHPMailer.php';
// require 'phpmailer/src/SMTP.php';
// require 'phpmailer/src/Exception.php';

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

    $mensaje = null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      $respuestas = $_POST['contacto'];

      //* Crear una Instancia de PHPMailer
      $mail = new PHPMailer(true);

      try {
        //* Configurar el Protocolo SMTP
        $mail->isSMTP();

        $mail->Mailer = 'SMTP';
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'f1ecf0cbfbb712';
        $mail->Password = '996cf78b53e82f';
        $mail->SMTPSecure = 'tls';
        $mail->Port= 465 ;
        // $mail->Timeout = 5;

        //* Configurar el Contenido del Email
        $mail->setFrom('softech.javp@gmail.com');
        $mail->addAddress('sistemadonai@gmail.com', 'BienesRaices.com');
        $mail->addCC('joseangvas@gmail.com');
        $mail->Subject = 'Prueba para Enviar Correo desde PHP';

        //* Adjuntar Archivo y Renombrarlo
        // $mail->addAttachment('docs/documento.pdf', 'Manual.pdf');

        //* Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        //* Definir el Contenido
        $contenido = '<html>';
        $contenido .= '<p>Tienes un Nuevo Mensaje...</p>';
        $contenido .= '<p>Nombre:         ' . $respuestas['nombre'] . ' </p>';
        
        //* Enviar de Forma Condicional Algunos Campos de Email o Teléfono
        if($respuestas['contacto'] === 'telefono') {
          // Se Envían los Datos del Teléfono
          $contenido .= '<p>Eligió ser Contactado por Teléfono:</p>';
          $contenido .= '<p>Teléfono:       ' . $respuestas['telefono'] . ' </p>';
          $contenido .= '<p>Fecha contacto: ' . $respuestas['fecha'] . ' </p>';
          $contenido .= '<p>Hora:           ' . $respuestas['hora'] . ' </p>';
        } else {
          // Se Envían los Datos del Email
            $contenido .= '<p>Eligió ser Contactado por Email:</p>';
            $contenido .= '<p>Email:          ' . $respuestas['email'] . ' </p>';
        }

        $contenido .= '<p>Mensaje:        ' . $respuestas['mensaje'] . ' </p>';
        $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . ' </p>';
        $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . ' </p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;
        $mail->AltBody = 'Esto es un Texto Alternativo sin HTML';

        //* Enviar el Email
        $mail->send();

        $mensaje = 'El Correo Ha Sido Enviado Correctamente';

      } catch(Exception $e) {
        $mensaje = 'El Correo No se Pudo Enviar...';      //. $mail->ErrorInfo;
      }
    }
    
    $router->render('paginas/contacto', [
      'mensaje' => $mensaje
    ]);
  }

  public static function salida() {
    echo "Cierre de Sesión";
  }
}
