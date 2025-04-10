<?php
include_once "Moto.php";
include_once "Cliente.php";
class Venta{
    private $numeroVenta;
    private $fecha;
    private $refCliente;
    private $refColeccionMotos;
    private $precioFinal;


    /** CONSTRUCT
     * @param INT $numeroVenta
     * @param STRING $fecha
     * @param CLIENTE $refCliente
     * @param ARRAY $refColeccionMotos
     * @param FLOAT $precioFinal
     */

    public function __construct($numeroVenta, $fecha, Cliente $refCliente, $refColeccionMotos, $precioFinal){
        $this->numeroVenta = $numeroVenta;
        $this->fecha = $fecha;
        $this->refCliente = $refCliente;
        $this->refColeccionMotos = $refColeccionMotos;
        $this->precioFinal = $precioFinal;   
    }
    //GETTERS
    public function getNumeroVenta(){
        return $this->numeroVenta;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getRefCliente(){
        return $this->refCliente;
    }
    public function getRefColeccionMotos(){
        return $this->refColeccionMotos;
    }
    public function getPrecioFinal(){
        return $this->precioFinal;
    }

    //SETTERS

    public function SetNumeroVenta($numeroVenta){
        $this->numeroVenta = $numeroVenta;
    }

    public function SetFecha($fecha){
        $this->fecha = $fecha;
    }

    public function SetRefCliente($refCliente){
        $this->refCliente = $refCliente;
    }

    public function SetRefColeccionMotos($refColeccionMotos){
        $this->refColeccionMotos = $refColeccionMotos;
    }

    public function SetPrecioFinal($precioFinal){
        $this->precioFinal = $precioFinal;
    }

    //INCORPORAR MOTO

    public function incorporarMoto(Moto $objMoto){
        $precio = $objMoto->darPrecioVenta();

        if ($precio > 0){
            $coleccion = $this->getRefColeccionMotos();
            $coleccion[] = $objMoto;
            $this->SetRefColeccionMotos($coleccion);

            $nuevoImporte = $this->getPrecioFinal() + $precio;
            $this->SetPrecioFinal($nuevoImporte);
        }
    }

    //TO STRING
    public function __toString(){
        $motos = $this->getRefColeccionMotos();
        $infoMotos = "";
        foreach ($motos as $moto) {
            $infoMotos .= $moto . "\n------------------\n";
        }

        return "Número de Venta: " . $this->getNumeroVenta() . "\n" .
           "Fecha: " . $this->getFecha() . "\n" .
            $this->getRefCliente() . "\n" .
           "Motos Vendidas:\n" . $infoMotos .
           "Precio Final: $" . number_format($this->getPrecioFinal(), 2);

    }

}
?>