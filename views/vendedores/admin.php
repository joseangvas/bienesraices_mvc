<main>
  <h2>Administrador de Vendedores</h2>

  <?php
    if($resultado) {
      $mensaje = mostrarNotificacion( intval($resultado) ); 

      if($mensaje)  { ?>
        <p class="alerta exito"><?php echo s($mensaje) ?> </p>
      <?php }
    }
  ?>

  <section class="cortar">
    <a href="/vendedores/crear" class="boton boton-verde btn-corto">Nuevo Vendedor</a>

    <table class="vendedores">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody> <!-- Mostrar los Resultados -->
        <?php foreach( $vendedores as $vendedor ): ?>
        <tr>
          <td><?php echo $vendedor->id; ?></td>
          <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
          <td><?php echo $vendedor->telefono; ?></td>
          <td>
            <form method="POST" class="w-100" action="/vendedores/eliminar">
              <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
              <input type="hidden" name="tipo" value="vendedor">
              <input type="submit" class="boton-rojo-block" value="Eliminar">
            </form>
            
            <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</main>