<fieldset>
                <legend>Informacion General</legend>

                <label for="nombre">Nombres:</label>
                <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombres Ejemplo" value="<?php echo s ( $vendedor->nombre) ;?>">

                <label for="apellido">Apellidos:</label>
                <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellidos Ejemplo" value="<?php echo s ( $vendedor->apellido ) ;?>">

               
                <label for="imagen">Foto Del Vendedor:</label>
                <input type="file" id="imagen"  accept="image/jpeg, image/png" name="vendedor[imagen]">

                <?php if($vendedor->imagen) : ?>
                    <img src="/imagenes/<?php echo $vendedor->imagen ?>" class="imagen-small">
                    <?php  endif; ?>

           
        </fieldset>

        <fieldset>
                    <legend>Información Extra</legend>
                    
                    <label for="telefono">Telefono:</label>
                <input type="input" id="telefono" name="vendedor[telefono]" placeholder="Ej:099999999" value="<?php echo s ( $vendedor->telefono ) ;?>">    
        </fieldset>