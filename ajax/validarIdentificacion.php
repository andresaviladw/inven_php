<?php

class ValidarIdentificacion

{

    static public function validacionInicial($documentoId, $caracteres){
        if (empty($documentoId)) {
            throw new Exception('Valor no puede estar vacio');

            echo 'Valor no puede estar vacio';
        }
        if (!ctype_digit($documentoId)) {
            throw new Exception('Valor ingresado solo puede tener dígitos');
        }
        if (strlen($documentoId) != $caracteres) {
            throw new Exception('Valor ingresado debe tener '.$caracteres.' caracteres');
        }
        return true;
                
    }





    static public function validarCodigoProvincia($documentoId)
    {
        if ($documentoId < 0 OR $documentoId > 24) {
            throw new Exception('Codigo de Provincia (dos primeros dígitos) no deben ser mayor a 24 ni menores a 0');
        }
        return true;
    }

    static public function validarTercerDigito($documentoId, $tipo)
    {
        switch ($tipo) {
            case 'cedula':
            case 'ruc_natural':
            if ($documentoId < 0 OR $documentoId > 5) {
                throw new Exception('Tercer dígito debe ser mayor o igual a 0 y menor a 6 para cédulas y RUC de persona natural');
            }
                break;
            case 'ruc_privada':
            if ($documentoId != 9) {
                throw new Exception('Tercer dígito debe ser igual a 9 para sociedades privadas');
            }
                break;
            case 'ruc_publica':
            if ($documentoId != 6) {
                throw new Exception('Tercer dígito debe ser igual a 6 para sociedades públicas');
            }
                
                break;
            default:
            throw new Exception('Tipo de Identificación no existe.');
                break;
        }

    }

    
    static public function algoritmoModulo10($digitosIniciales, $digitoVerificador)
    {
        $arrayCoeficientes = array(2,1,2,1,2,1,2,1,2);
        $digitoVerificador = (int)$digitoVerificador;
        $digitosIniciales = str_split($digitosIniciales);
        $total = 0;
        foreach ($digitosIniciales as $key => $value) {
            $valorPosicion = ( (int)$value * $arrayCoeficientes[$key] );
            if ($valorPosicion >= 10) {
                $valorPosicion = str_split($valorPosicion);
                $valorPosicion = array_sum($valorPosicion);
                $valorPosicion = (int)$valorPosicion;
            }
            $total = $total + $valorPosicion;
        }
        $residuo =  $total % 10;
        if ($residuo == 0) {
            $resultado = 0;
        } else {
            $resultado = 10 - $residuo;
        }
        if ($resultado != $digitoVerificador) {
            echo 'Dígitos iniciales no validan contra Dígito Idenficador';
        }else {
           

            return true;
        }  
    }

    static public function validarCodigoEstablecimiento($documentoId)
    {
        if ($documentoId < 1) {
            echo 'Código de establecimiento no puede ser 0';
        }else {
            return true;
        }
       
    }

    static public function algoritmoModulo11($digitosIniciales, $digitoVerificador, $tipo)
    {
        switch ($tipo) {
            case 'ruc_privada':
                $arrayCoeficientes = array(4, 3, 2, 7, 6, 5, 4, 3, 2);
                break;
            case 'ruc_publica':
                $arrayCoeficientes = array(3, 2, 7, 6, 5, 4, 3, 2);
                break;
            default:
                echo 'Tipo de Identificación no existe.';
                break;
        }
        $digitoVerificador = (int)$digitoVerificador;
        $digitosIniciales = str_split($digitosIniciales);
        $total = 0;
        foreach ($digitosIniciales as $key => $value) {
            $valorPosicion = ( (int)$value * $arrayCoeficientes[$key] );
            $total = $total + $valorPosicion;
        }
        $residuo =  $total % 11;
        if ($residuo == 0) {
            $resultado = 0;
        } else {
            $resultado = 11 - $residuo;
        }
        if ($resultado != $digitoVerificador) {
            echo 'Dígitos iniciales no validan contra Dígito Idenficador';
        }else {
            return true;
        }
        
    }  
}