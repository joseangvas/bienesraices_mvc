<main class="contenedor seccion cortar">
  <h1>Crear Propiedad</h1>

  <?php foreach($errores as $error): ?>
      <div class="alerta error">
        <?php echo $error; ?>
      </div>
  <?php endforeach; ?>

  <a href="/propiedades/admin" class="boton boton-verde btn-corto">Volver</a>

  <form class="formulario" method="POST" enctype="multipart/form-data">
    <?php include __DIR__ . '/formulario.php'; ?>
    <input type="submit" value="Crear Propiedad" class="boton boton-verde btn-corto">
  </form>
</main>