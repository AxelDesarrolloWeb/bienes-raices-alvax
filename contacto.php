<?php include 'includes/templates/header.php'; ?>

<main class="contenedor seccion">
    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form class="formulario">
        <fieldset>
            <legend>Informacion personal</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Tu nombre">

            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Tu email">

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" placeholder="Tu teléfono">

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" placeholder="Tu mensaje"></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o compra:</label>
            <select name="opciones" id="opciones">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="venta">Venta</option>
                <option value="compra">Compra</option>
            </select>

            <label for="presupuesto">Presupuesto:</label>
            <input type="number" id="presupuesto" placeholder="Tu precio o presupuesto">
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contacto-telefono">Teléfono:</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                <label for="contacto-email">Email:</label>
                <input name="contacto" type="radio" value="email" id="contactar-email">
            </div>

            <p>Si eligió teléfono, elija la fecha y hora</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha">
            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" placeholder="09:00 - 18:00">
        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>

<?php include 'includes/templates/footer.php'; ?>