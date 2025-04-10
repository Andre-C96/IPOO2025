<?php
class Moto{
    private $codigoMoto;
    private $costoMoto;
    private $anioFabricacion;
    private $descripcion;
    private $porcentajeIncrementoAnual;
    private $disponibilidad; //True si esta disponible, false en caso contrario


    /** CONSTRUCT
     * @param INT $codigoMoto
     * @param FLOAT $costoMoto
     * @param INT $anioFabricacion
     * @param STRING $descripcion
     * @param FLOAT $porcentajeIncrementoAnual
     * @param BOOL $disponibilidad
     */
    public function __construct($codigoMoto, $costoMoto, $anioFabricacion, $descripcion, $porcentajeIncrementoAnual, $disponibilidad){
        $this->codigoMoto = $codigoMoto;
        $this->costoMoto = $costoMoto;
        $this->anioFabricacion = $anioFabricacion;
        $this->descripcion = $descripcion;
        $this->porcentajeIncrementoAnual = $porcentajeIncrementoAnual;
        $this->disponibilidad = $disponibilidad;
    }

    //GETTERS

    public function getCodigoMoto(){
       return $this->codigoMoto;
    }
    public function getCostoMoto(){
        return $this->costoMoto;
     }
     public function getAnioFabricacion(){
        return $this->anioFabricacion;
     }
     public function getDescripcion(){
        return $this->descripcion;
     }
     public function getPorcentajeIncrementoAnual(){
        return $this->porcentajeIncrementoAnual;
     }
     public function getDisponibilidad(){
        return $this->disponibilidad;
     }

     //SETTERS

     public function setCodigoMoto($codigoMoto){
        $this->codigoMoto = $codigoMoto;
     }
     public function setCostoMoto($costoMoto){
        $this->costoMoto = $costoMoto;
     }
     public function setAnioFabricacion($anioFabricacion){
        $this->anioFabricacion = $anioFabricacion;
     }
     public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
     }
     public function setPorcentajeIncrementoAnual($porcentajeIncrementoAnual){
        $this->porcentajeIncrementoAnual = $porcentajeIncrementoAnual;
     }
     public function setDisponibilidad($disponibilidad){
        $this->disponibilidad = $disponibilidad;
     }


     //DAR PRECIO VENTA
     public function darPrecioVenta (){
        $anioActual = date("Y");
        $anios = $anioActual - $this->getAnioFabricacion();
        if ($this->getDisponibilidad()){
        $precioVenta = $this->getCostoMoto() + $this->getCostoMoto() * ($anios * ($this->getPorcentajeIncrementoAnual() / 100 ));
        } else {
            $precioVenta = -1;
        }
        return $precioVenta;
     }

     //TO STRING
     public function __toString(){
        $disponible = $this->getDisponibilidad() ? "Disponible" : "No Disponible";
        return "Codigo del producto: " . $this->getCodigoMoto() . "\n" .
        "Precio de costo: $" . number_format($this->getCostoMoto(), 2) . "\n" .
        "Año de fabricación: " . $this->getAnioFabricacion() . "\n" . 
        "Descripción del producto: " . $this->getDescripcion() . "\n" . 
        "Porcentaje de incremento anual: " . $this->getPorcentajeIncrementoAnual() . "%\n" .
        "Estado del producto: " . $disponible;

     }

}

?>