<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\EventosRegistros;

class PaginasController {
    public static function index(Router $router) {

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
            
            if($evento->dia_id === "1" && $evento->categoria_id === "1") {
                $eventos_formateados['conferencias_v'][] = $evento;
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "1") {
                $eventos_formateados['conferencias_s'][] = $evento;
            }

            if($evento->dia_id === "1" && $evento->categoria_id === "2") {
                $eventos_formateados['workshops_v'][] = $evento;
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "2") {
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        // Obtener el total de cada bloque
        $ponentes_total = Ponente::total();
        $conferencias_total = Evento::total('categoria_id', 1);
        $workshops_total = Evento::total('categoria_id', 2);

        // Obtener todos los ponentes
        $ponentes = Ponente::all();

        if (is_auth()){
            $nombre = $_SESSION['nombre'];
            $usuario_id = $_SESSION['id'];
            $registro = Registro::where('usuario_id', $usuario_id);  
            if(isset($registro)){
                $tablaEventos = EventosRegistros::where('registro_id', $registro->id); 
            }      
              
            }

    
        $datos = [
            'titulo' => 'Inicio',
            'eventos' => $eventos_formateados,
            'ponentes_total' => $ponentes_total,
            'conferencias_total' => $conferencias_total,
            'workshops_total' => $workshops_total,
            'ponentes' => $ponentes
        ];
        
        if (is_auth()) {
            $datos['nombre'] = $nombre;
            $datos['registro'] = $registro;
            if(isset($tablaEventos)){
                $datos['tablaEventos'] = $tablaEventos;
            }
        }
        
        $router->render('paginas/index', $datos);
    }
    public static function evento(Router $router) {
        if (is_auth()){
            $nombre = $_SESSION['nombre']; 
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if(isset($registro)){
                $tablaEventos = EventosRegistros::where('registro_id', $registro->id); 
            }  
            }
                $datos = [
                    'titulo' => 'Sobre DevWebCamp',               
                ];
                if (is_auth()) {
                    $datos['nombre'] = $nombre;
                    $datos['registro'] = $registro;
                    if(isset($tablaEventos)){
                        $datos['tablaEventos'] = $tablaEventos;
                    }
                }   
                     
                $router->render('paginas/devwebcamp', $datos);   
    }
    
    public static function paquetes(Router $router) {
        if (is_auth()){
            $nombre = $_SESSION['nombre'];   
            $registro = Registro::where('usuario_id', $_SESSION['id']); 
            if(isset($registro)){
                $tablaEventos = EventosRegistros::where('registro_id', $registro->id); 
            }     
        }
            $datos = [
                'titulo' => 'Paquetes DevWebCamp',           
            ];
            if (is_auth()) {
                $datos['nombre'] = $nombre;
                $datos['registro'] = $registro;
                if(isset($tablaEventos)){
                    $datos['tablaEventos'] = $tablaEventos;
                }
            }
        $router->render('paginas/paquetes', $datos);
    }

    public static function conferencias(Router $router) {

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
            
            if($evento->dia_id === "1" && $evento->categoria_id === "1") {
                $eventos_formateados['conferencias_v'][] = $evento;
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "1") {
                $eventos_formateados['conferencias_s'][] = $evento;
            }

            if($evento->dia_id === "1" && $evento->categoria_id === "2") {
                $eventos_formateados['workshops_v'][] = $evento;
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "2") {
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        if (is_auth()){
            $nombre = $_SESSION['nombre'];  
            $registro = Registro::where('usuario_id', $_SESSION['id']);    
            if(isset($registro)){
                $tablaEventos = EventosRegistros::where('registro_id', $registro->id); 
            } 
        } 
            $datos = [
                'titulo' => 'Conferencias & Workshops',
                'eventos' => $eventos_formateados,         
            ];
            if (is_auth()) {
                $datos['nombre'] = $nombre;
                $datos['registro'] = $registro;
                if(isset($tablaEventos)){
                    $datos['tablaEventos'] = $tablaEventos;
                }
            }
        $router->render('paginas/conferencias', $datos);
    }

    public static function error(Router $router) {
    

        if (is_auth()){
        $nombre = $_SESSION['nombre'];
        $registro = Registro::where('usuario_id', $_SESSION['id']);    
        if(isset($registro)){
            $tablaEventos = EventosRegistros::where('registro_id', $registro->id); 
        }      
 
        }
        $datos = [
            'titulo' => 'Página no encontrada',
        
        ];     
        if (is_auth()) {
            $datos['nombre'] = $nombre;
            $datos['registro'] = $registro;
            if(isset($tablaEventos)){
                $datos['tablaEventos'] = $tablaEventos;
            }
        }
        
        $router->render('paginas/error', $datos);
    }
}