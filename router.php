<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];
    
    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {

        session_start();

        $auth = $_SESSION['login'] ?? null;
        //arreglo de rutas protegidas 
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
       $metodo = $_SERVER['REQUEST_METHOD'];   


       if ($metodo === 'GET') {
            $fn = $this->rutasGET[$currentUrl] ?? null;
        } else {
            $fn = $this->rutasPOST[$currentUrl] ?? null;
        }

        if (in_array($currentUrl, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if($fn) {
            //la url existe y hay una funcion asociada
            call_user_func($fn, $this);
        } else {
            echo 'Pagina no encontrada';
        }
    }



    //Muestra una vista
    public function render($view, $datos = []) {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //obtiene el contenido del buffer y lo limpia


        include __DIR__ . "/views/layout.php";


    }

}