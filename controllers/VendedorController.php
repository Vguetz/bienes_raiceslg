<?php 

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VendedorController {

    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        $vendedor = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedor' => $vendedor,
            'resultado' => $resultado
        ]);
    }
    
    public static function crear(Router $router) {

        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;
        $propiedad = propiedad::all();

        // Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Crea una nueva instancia */
            $vendedor = new Vendedor($_POST['vendedor']);

            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";


            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                $vendedor->setImagen($nombreImagen);
            }

            // Validar
            $errores = $vendedor->validar();
            if(empty($errores)) {

                // Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda en la base de datos
                $resultado = $vendedor->guardar();

                if($resultado) {
                    header('location: /admin');
                }
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor,
            'propiedad' => $propiedad
        ]);
    }

    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/vendedores');

        // Obtener los datos de la propiedad
        $vendedor = Vendedor::find($id);

       
        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Asignar los atributos
                $args = $_POST['vendedor'];

                $vendedor->sincronizar($args);

                // Validación
                $errores = $vendedor->validar();

                // Subida de archivos
                // Generar un nombre único
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

                if($_FILES['vendedor']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                    $vendedor->setImagen($nombreImagen);
                }


                
                if(empty($errores)) {
                    // Almacenar la imagen
                    if($_FILES['vendedor']['tmp_name']['imagen']) {
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }

                    // Guarda en la base de datos
                    $resultado = $vendedor->guardar();

                    if($resultado) {
                        header('location: /vendedores');
                    }
                }

        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    
    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar el ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }


} 
