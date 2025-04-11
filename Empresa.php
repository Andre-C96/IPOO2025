<?php

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

    //RETORNAR MOTO 
    public function retornarMoto($codigoMoto) {
        $coleccion = $this->getColecMotos();
        $motoEncontrada = null;
        $i = 0;
    
        while ($i < count($coleccion) && $motoEncontrada == null) {
            if ($coleccion[$i]->getCodigoMoto() == $codigoMoto) {
                $motoEncontrada = $coleccion[$i]; 
        
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
    
            foreach ($colCodigosMoto as $codigo) {
                $moto = $this->retornarMoto($codigo);
    
                if ($moto !== null && $moto->getDisponibilidad()) {
                    $precio = $moto->darPrecioVenta();
                    $coleccionMotosVenta[] = $moto;
                    $precioTotal += $precio;
                    $moto->setDisponibilidad(false);
                }
                
            }
    
            if (count($coleccionMotosVenta) > 0) {
                $numeroVenta = count($this->getColecVentas()) + 1;
                $fechaHoy = date("d/m/Y");
                $objVenta = null;
                $objVenta = new Venta($numeroVenta, $fechaHoy, $objCliente, $coleccionMotosVenta, $precioTotal);
                $Colecventas = $this->getColecVentas();
                $Colecventas[] = $objVenta;
                $this->setColecVentas($Colecventas);
                $importeFinal = $precioTotal;
            }
        }
    
        return $importeFinal;
    }

    //RETORNAR VENTAS POR CLIENTE
    public function retornarVentasXCliente($tipoDoc, $numDoc) {
        $ventasCliente = [];
        $coleccionVenta = $this->getColecVentas();
    
        foreach ($coleccionVenta as $venta) {
            $cliente = $venta->getRefCliente();
    
            if ($cliente->getTipoDoc() == $tipoDoc && $cliente->getNumDoc() == $numDoc) {
                $ventasCliente[] = $venta;
            }
            
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




