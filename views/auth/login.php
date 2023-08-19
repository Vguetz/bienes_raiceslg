<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
        <form class="formulario" method="POST" action="/login"> 
        <fieldset>
                <legend>Email y password</legend>

                <label for="email" class="email">Email</label>
                <input type="email" name="email" id="email" placeholder="example@gmail.com" require>
                
                <label for="nombre">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu password" require>

            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>