<main class="contenedor seccion">
  <h1>Más sobre nosotros</h1>

  <?php include 'iconos.php'; ?>  
</main>

<section class="seccion contenedor">
  <h2>Casas y Departamentos en Venta</h2>

  <?php
    include 'listado.php';
  ?>

  <div class="alinear-derecha">
    <a href="/propiedades" class="boton-verde">Ver Todas</a>
  </div>
</section>

<section class="imagen-contacto">
  <h2>Encuentra la Casa de tus Sueños</h2>
  <p>Llena el Formulario de Contacto y un Asesor se pondrá en Contacto contigo a la brevedad</p>
  <a href="/contacto" class="boton-amarillo">Contáctanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
  <section class="blog">
    <h3>Nuestro Blog</h3>
    
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog1.webp" type="image/webp">
          <source srcset="build/img/blog1.jpg" type="image/jpeg">
          <img src="build/img/blog1.jpg" alt="Texto entrada Blog" loading="lazy">
        </picture>
      </div>

      <div class="texto-entrada">
        <a href="/entrada">
          <h4>Terraza en el Techo de tu Casa</h4>
          <p class="informacion-meta">Escrito el: <span>20/03/2021</span> Por: <span>Admin</span></p>
          <p>
            Consejos para construir una Terraza en el Techo de tu Casa con los mejores materiales y ahorrando dinero
          </p>
        </a>
      </div>

      <div class="imagen">
        <picture>
          <source srcset="build/img/blog2.webp" type="image/webp">
          <source srcset="build/img/blog2.jpg" type="image/jpeg">
          <img src="build/img/blog2.jpg" alt="Texto entrada Blog" loading="lazy">
        </picture>
      </div>

      <div class="texto-entrada">
        <a href="/entrada">
          <h4>Guía para la Decoración de tu Hogar</h4>
          <p class="informacion-meta">Escrito el: <span>08/05/2021</span> Por: <span>Admin</span></p>
          <p>
            Maximiza el espacio en tu hogar con esta Guía. Aprende a combinar muebles y colores para darle vida a tu espacio
          </p>
        </a>
      </div>
    </article>
  </section>

  <section class="testimoniales">
    <h3>Testimoniales</h3>

    <div class="testimonial">
      <blockquote>
        El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas sus expectativas.
      </blockquote>
      <p>José Angel Vásquez</p>
    </div>
  </section>
</div>