<main class="contenedor seccion">
        <h1>Contacto</h1>

       
        <?php  if($mensaje) { ?> 
                   <p class ='alerta exito'>  <?php echo $mensaje ?>  </p>
              <?php } ?>

        

        <picture>
            <source srcset="build/img/destacada3.webp" type="webp">
            <source srcset="build/img/destacada3.jpg" type="jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]" required>

                
                
                <label for="mensaje">Mensaje:</label>
                <textarea  id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>Informacion sobre la propiedad
                <label for="opciones">Vende o compra:</label>
                <select name="contacto[tipo]" id="opciones" required>
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[precio]" required>
            </fieldset>

            <fieldset>
            <legend>Contacto</legend>
                <p>Como desea ser contactado:</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input  type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>
                    
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
                </div>

                <div id="contacto"></div>

            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>

    </main>