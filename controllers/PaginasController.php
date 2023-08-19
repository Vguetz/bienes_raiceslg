<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }
    

    public static function propiedades(Router $router)  {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
        
        echo "desde propiedades";
    }

    public static function propiedad(Router $router) {

        $id = validarORedireccionar('/propiedades');

        //buscar la propiedad por su id
        $propiedad = Propiedad::find($id);


        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router) {

        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];
            
            //crear una instancia de php mailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '51bd7466f41a21';
            $mail->Password = '3ffe2a0229ba86';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //habilitar html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .=  '<p>Tienes un nuevo mensaje!</p>';
            $contenido .=  '<p>Nombre:' . $respuestas['nombre']  . '</p>';

            if($respuestas['contacto'] === 'telefono') {

                $contenido .= '<p>Eligio ser contactado por telefono</p>';
                $contenido .=  '<p>Telefono:' . $respuestas['telefono']  . '</p>';
                $contenido .=  '<p>Fecha contacto:' . $respuestas['fecha']  . '</p>';
                $contenido .=  '<p>Hora:' . $respuestas['hora']  . '</p>';
            } else {
                //caso contrario eligio email
                $contenido .= '<p>Eligio ser contactado por email</p>';
                $contenido .=  '<p>Email:' . $respuestas['email']  . '</p>';

            }
          
            $contenido .=  '<p>Mensaje:' . $respuestas['mensaje']  . '</p>';
            $contenido .=  '<p>Vende o compra:' . $respuestas['tipo']  . '</p>';
            $contenido .=  '<p>Precio o Presupuesto: $' . $respuestas['precio']  . '</p>';
            $contenido .=  '<p>Prefiere ser contactado por:' . $respuestas['contacto']  . '</p>';
            
            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = 'Texto alternativo sin html';

            //enviar el email
            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";

            } else {
                $mensaje = "El mensaje no se pudo enviar";
            }


        }
       $router->render('paginas/contacto', [
        'mensaje' => $mensaje
    ]);
    }


}   