<?php
 if(!isset($_SESSION)) {
   session_start();
 }

 $auth = $_SESSION['login'] ?? false;

 if(isset($inicio)) {
   $inicio = true;
 }
?>

<!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/build/css/app.css">
  </head>
  
  <body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
      <div class="contenedor contenido-header">
        <div class="barra">
          <a href="/">
            <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raíces">
          </a>

          <div class="mobile-menu">
            <img src="/build/img/barras.svg" alt="Icono Menu Responsive">
          </div>

          <div class="derecha">
            <img src="/build/img/dark-mode.svg" alt="Imagen de Tema Oscuro" class="dark-mode-boton">

            <nav class="navegacion">
              <?php if(!$auth): ?>
                <a href="/login">Iniciar Sesión</a>
              <?php endif; ?>
              <a href="/nosotros">Nosotros</a>
              <a href="/propiedades">Anuncios</a>
              <a href="/blog">Blog</a>
              <a href="/contacto">Contacto</a>
              <?php if($auth): ?>
                <a href="/propiedades/admin">Administrar</a>
                <a href="/logout">Cerrar Sesión</a>
              <?php endif; ?>
            </nav>
          </div>
        </div>   <!-- .barra -->

        <!-- Mostrar Slogan con Código Ternario -->
        <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>

        <!-- Mostrar Slogan con Código Normal -->
        <?php // if($inicio) { ?>
          <!-- <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1> -->
        <?php // } ?>
      </div>
    </header>


    <?php echo $contenido; ?>


    <footer class="footer seccion">
      <div class="contenedor contenedor-footer">
        <nav class="navegacion">
          <a href="/nosotros">Nosotros</a>
          <a href="/anuncios">Anuncios</a>
          <a href="/blog">Blog</a>
          <a href="/contacto">Contacto</a>
        </nav>
      </div>

      <p class="copyright">Todos los Derechos Reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
  </body>
</html>