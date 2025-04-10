<?php
class Cliente{
    private $nombreCliente;
    private $apellidoCliente;
    private $estado; //True si está dado de alta o false si esta dado de baja
    private $tipoDoc;
    private $numDoc;



/** Constructor
* @param STRING $nombreCliente
* @param STRING $apellidoCliente
* @param BOOL $estado
* @param STRING $tipoDoc
* @param INT $numDoc
*/
public function __construct($nombreCliente, $apellidoCliente, $estado, $tipoDoc, $numDoc){
    $this->nombreCliente = $nombreCliente;
    $this->apellidoCliente = $apellidoCliente;
    $this->estado = $estado;
    $this->tipoDoc = $tipoDoc;
    $this->numDoc = $numDoc;
}

//Getters

public function getNombreCliente(){
    return $this->nombreCliente;
}

public function getApellidoCliente(){
    return $this->apellidoCliente;
}

public function getEstado(){
    return $this->estado;
}

public function getTipoDoc(){
    return $this->tipoDoc;
}

public function getNumDoc(){
    return $this->numDoc;
}

//SETTERS

public function setNombreCliente($nombreCliente){
    $this->nombreCliente = $nombreCliente;
}

public function setApellidoCliente($apellidoCliente){
    $this->apellidoCliente = $apellidoCliente;
}

public function setEstado($estado){
    $this->estado = $estado;
}

public function setTipoDoc($tipoDoc){
    $this->tipoDoc = $tipoDoc;
}

public function setNumDoc($numDoc){
    $this->numDoc = $numDoc;
}

//TO STRING
public function __toString(){
    $estado = $this->getEstado() ? "Activo" : "Baja";
    return "Cliente: ". $this->getNombreCliente() . " " . $this->getApellidoCliente() ."\n". 
    "Tipo y Numero de Documento: ". $this->getTipoDoc() . " " . $this->getNumDoc() . "\n". 
    "Estado del Cliente: " . $estado . "\n";
}

}
?>

