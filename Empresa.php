<?php
include_once "Cliente.php";
include_once "Moto.php";
include_once "Venta.php";

class Empresa{
    private $denominacion;
    private $direccion;
    private $colecClientes;
    private $colecMotos;
    private $colecVentas;


    /** CONSTRUCT
     * @param STRING $denominacion
     * @param STRING $direccion
     * @param ARRAY $colecClientes
     * @param ARRAY $colecMotos
     * @param ARRAY $colecVentas
     */

    public function __construct($denominacion, $direccion, $colecClientes, $colecMotos, $colecVentas){
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->colecClientes = $colecClientes;
        $this->colecMotos = $colecMotos;
        $this->colecVentas = $colecVentas;
    }

    //GETTER
    public function getDenominacion(){
        return $this->denominacion;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getColecClientes(){
        return $this->colecClientes;
    }

    public function getColecMotos(){
        return $this->colecMotos;
    }

    public function getColecVentas(){
        return $this->colecVentas;
    }

    //SETTERS

    public function setDenominacion($denominacion){
        $this->denominacion = $denominacion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setColecClientes($colecClientes){
        $this->colecClientes = $colecClientes;
    }

    public function setColecMotos($colecMotos){
        $this->colecMotos = $colecMotos;
    }

    public function setColecVentas($colecVentas){
        $this->colecVentas = $colecVentas;
    }

    public function retornarMoto($codigoMoto) {
        $coleccion = $this->getColecMotos();
        $motoEncontrada = -1;
        $encontrada = false;
        $i = 0;
    
        while ($i < count($coleccion) && !$encontrada) {
            if ($coleccion[$i]->getCodigoMoto() == $codigoMoto) {
                $motoEncontrada = $coleccion[$i]; 
                $encontrada = true;
            }
            $i++;
        }
    
        return $motoEncontrada; 
    }

    //REGISTRAR VENTA
    public function registrarVenta($colCodigosMoto, $objCliente) {
        $importeFinal = -1;
    
        if ($objCliente->getEstado()) {
            $coleccionMotosVenta = [];
            $precioTotal = 0;
            $i = 0;
    
            while ($i < count($colCodigosMoto)) {
                $codigo = $colCodigosMoto[$i];
                $moto = $this->retornarMoto($codigo);
    
                if (is_object($moto)) {
                    if ($moto->getDisponibilidad()) {
                        $precio = $moto->darPrecioVenta();
                        if (is_numeric($precio) && $precio > 0) {
                            $coleccionMotosVenta[] = $moto;
                            $precioTotal += $precio;
                            $moto->setDisponibilidad(false);
                        }
                    }
                }
                $i++;
            }
    
            if (count($coleccionMotosVenta) > 0) {
                $numeroVenta = count($this->getColecVentas()) + 1;
                $fechaHoy = date("d/m/Y");
    
                $venta = new Venta($numeroVenta, $fechaHoy, $objCliente, $coleccionMotosVenta, $precioTotal);
                $ventas = $this->getColecVentas();
                $ventas[] = $venta;
                $this->setColecVentas($ventas);
                $importeFinal = $precioTotal;
            }
        }
    
        return $importeFinal;
    }

    //RETORNAR VENTAS POR CLIENTE
    public function retornarVentasXCliente($tipo, $numDoc) {
        $ventasCliente = [];
        $i = 0;
        $coleccion = $this->getColecVentas();
    
        while ($i < count($coleccion)) {
            $venta = $coleccion[$i];
            $cliente = $venta->getRefCliente();
    
            if ($cliente->getTipoDoc() == $tipo && $cliente->getNumDoc() == $numDoc) {
                $ventasCliente[] = $venta;
            }
            $i++;
        }
    
        return $ventasCliente;
    }


    //TO STRING
    public function __toString(){
        $infoClientes = "";
        foreach ($this->getColecClientes() as $cliente) {
            $infoClientes .= $cliente . "\n------------------\n";
        }

        $infoMotos = "";
        foreach ($this->getColecMotos() as $moto) {
            $infoMotos .= $moto . "\n------------------\n";
        }

        $infoVentas = "";
        foreach ($this->getColecVentas() as $venta) {
            $infoVentas .= $venta . "\n------------------\n";
        }

        return "Denominación: " . $this->getDenominacion() . "\n" .
           "Dirección: " . $this->getDireccion() . "\n\n" .
           "Clientes:\n" . $infoClientes . "\n" .
           "Motos:\n" . $infoMotos . "\n" .
           "Ventas:\n" . $infoVentas;
    }
    
}




