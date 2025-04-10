<?php
include_once "Cliente.php";
include_once "Moto.php";
include_once "Venta.php";
include_once "Empresa.php";

//OBJETOS CLIENTES
$objCliente1 = new Cliente("Jose", "Benitez", true, "DNI", 17654213);
$objCliente2 = new Cliente("Ramon", "Diaz", true, "DNI", 32654896);

//OBJETOS MOTOS
$objMoto1 = new Moto(11, 2230000, 2022, "Benelli Imperiale 400", 85, true);
$objMoto2 = new Moto(12, 584000, 2021, "Zanella Zr 150 Ohc", 70, true);
$objMoto3 = new Moto(13, 999900, 2023, "Zanella Patagonian Eagle 250", 55, false);

//OBJETOS EMPRESA

$colecClientes = [$objCliente1, $objCliente2];
$colecMotos = [$objMoto1, $objMoto2, $objMoto3];
$colecVentas = [];

$objEmpresa = new Empresa("Alta gama", "Av.Argentina 123", $colecClientes, $colecMotos, $colecVentas);

//REGISTRAR VENTAS 

$codigos = [11,12,13];
$venta1 = $objEmpresa->registrarVenta($codigos, $objCliente2);
echo $venta1 == -1 ? "Importe venta 1: Venta no disponible\n" : "Importe venta 1: $venta1\n";

$venta2 = $objEmpresa->registrarVenta([0], $objCliente2);
echo $venta2 == -1 ? "Importe venta 2: Venta no disponible\n" : "Importe venta 2: $venta2\n";

$venta3 = $objEmpresa->registrarVenta([2], $objCliente2);
echo $venta3 == -1 ? "Importe venta 3: Venta no disponible\n" : "Importe venta 3: $venta3\n";

//VENTAS POR CLIENTE
$ventasCliente1 = $objEmpresa->retornarVentasXCliente("DNI", 17654213);
echo "Ventas del Cliente 1:\n";
if (count($ventasCliente1) == 0) {
    echo "No se encontraron ventas.\n";
}
foreach ($ventasCliente1 as $venta) {
    echo $venta . "\n--------------------\n";
}

$ventasCliente2 = $objEmpresa->retornarVentasXCliente("DNI", 32654896);
echo "Ventas del Cliente 2:\n";
if (count($ventasCliente2) == 0) {
    echo "No se encontraron ventas.\n";
}
foreach ($ventasCliente2 as $venta) {
    echo $venta . "\n--------------------\n";
}

//MOSTRAR EMPRESA
echo "\nInformación de la Empresa:\n";
echo $objEmpresa;

?>
