<?php
//error_reporting(E_ERROR | E_PARSE);//Omite las notificaciones de undefined


    require 'validarIdentificacion.php';
    

    function validarCedula($documentoId,$tipo)
{
   
    $validar = new ValidarIdentificacion();
    // fuerzo parametro de entrada a string
    $documentoId = (string)$documentoId;
    // borro por si acaso errores de llamadas anteriores.
    
    // validaciones
    try {
        $validar->validacionInicial($documentoId, '10');
        $validar->validarCodigoProvincia(substr($documentoId, 0, 2));
        $validar->validarTercerDigito($documentoId[2], $tipo);
        $validar->algoritmoModulo10(substr($documentoId, 0, 9), $documentoId[9]);
    } catch (Exception $e) {
       
        return false;
    }
    return true;
}



function validarRucPersonaNatural($documentoId,$tipo)
{
   
    $validar = new ValidarIdentificacion();
    // fuerzo parametro de entrada a string
    $documentoId = (string)$documentoId;
    // borro por si acaso errores de llamadas anteriores.
    
    // validaciones
    try {
        $validar->validacionInicial($documentoId, '13');
        $validar->validarCodigoProvincia(substr($documentoId, 0, 2));
        $validar->validarTercerDigito($documentoId[2], $tipo);
        $validar->validarCodigoEstablecimiento(substr($documentoId, 10, 3));
        $validar->algoritmoModulo10(substr($documentoId, 0, 9), $documentoId[9]);
    } catch (Exception $e) {
        
        return false;
    }
    return true;
}


function validarRucSociedadPrivada($documentoId,$tipo)
{
    
    $validar = new ValidarIdentificacion();
    // fuerzo parametro de entrada a string
    $documentoId = (string)$documentoId;
    // borro por si acaso errores de llamadas anteriores.
   
    // validaciones
    try {
        $validar->validacionInicial($documentoId, '13');
        $validar->validarCodigoProvincia(substr($documentoId, 0, 2));
        $validar->validarTercerDigito($documentoId[2], $tipo);
        $validar->validarCodigoEstablecimiento(substr($documentoId, 10, 3));
        $validar->algoritmoModulo11(substr($documentoId, 0, 9), $documentoId[9], 'ruc_privada');
    } catch (Exception $e) {
        
        return false;
    }
    return true;
}


function validarRucSociedadPublica($documentoId,$tipo)
{
    
    $validar = new ValidarIdentificacion();
    // fuerzo parametro de entrada a string
    $documentoId = (string)$documentoId;
    // borro por si acaso errores de llamadas anteriores.

    // validaciones
    try {
        $validar->validacionInicial($documentoId, '13');
        $validar->validarCodigoProvincia(substr($documentoId, 0, 2));
        $validar->validarTercerDigito($documentoId[2], $tipo);
        $validar->validarCodigoEstablecimiento(substr($documentoId, 9, 4));
        $validar->algoritmoModulo11(substr($documentoId, 0, 8), $documentoId[8], $tipo);
    } catch (Exception $e) {
        
        return false;
    }
    return true;
}





