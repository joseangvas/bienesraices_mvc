<main class="contenedor seccion">
  <h1>Contacto</h1>

  <picture>
    <source srcset="build/img/destacada3.webp" type="image/webp">
    <source srcset="build/img/destacada3.jpg" type="image/jpeg">
    <img src="build/img/destacada3.jpg" alt="Imagen de contacto" loading="lazy">
  </picture>

  <h2>Llene el Formulario de Contacto</h2>

  <form action="/contacto" class="formulario" method="POST">
    <fieldset>
      <legend>Información Personal</legend>

      <label for="nombre">Nombre:</label>
      <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>

      <label for="email">E-Mail:</label>
      <input type=email" placeholder="Tu Correo" id="email" name="contacto[email]" required>

      <label for="telefono">Telefono:</label>
      <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">

      <label for="email">Mensaje:</label>
      <textarea placeholder="Escribe un Mensaje" id="mensaje"  name="contacto[mensaje]" required></textarea>
    </fieldset>

    <fieldset>
      <legend>Información sobre la Propiedad</legend>

      <label for="opciones">Vende o Compra:</label>
      <select id="opciones" name="contacto[tipo]" required>
        <option value="" disabled selected>-- Seleccione --</option>
        <option value="Compra">Compra</option>
        <option value="Vende">Vende</option>
      </select>

      <label for="presupuesto">Precio o Presupuesto:</label>
      <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="contacto[precio]" required>
    </fieldset>

    <fieldset>
      <legend>Información sobre el Contacto</legend>

      <p>Cómo desea ser Contactado:</p>
      <div class="forma-contacto">
        <label for="contactar-telefono">Teléfono:</label>
        <input name="contacto" type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

        <label for="contactar-email">E-mail:</label>
        <input name="contacto" type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
      </div>

      <p>Si eligió Teléfono, elija la Fecha y la Hora:</p>

      <label for="fecha">Fecha:</label>
      <input type="date" id="fecha" name="contacto[fecha]">

      <label for="hora">Hora:</label>
      <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
    </fieldset>

    <input type="submit" value="Enviar" class="boton-verde">
  </form>
</main>
