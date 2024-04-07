<?php
//incluimos los archivos
include_once 'viaje.php';
include_once 'pasajeros.php';
include_once 'Responsable.php';

//precargamos un pasajero
$pasajero = new Pasajeros("Diego", "Rios", "123456789", "29961234");
$arrayPasajero[] = $pasajero;


function menuPrincipal()
{
    $opciones = [
        1 => "cargar el viaje:",
        2 => "salir:"
    ];

    $respuesta = "";
    foreach ($opciones as $indice => $opcion) {
        $respuesta .=  $indice . " ) $opcion" . "\n";
    }
    return $respuesta;
}

function opcionesInternas()
{
    $opciones = [
        1 => "cargar pasajero:",
        2 => "cargar 1 responsable:",
        3 => "cargar el viaje:"

    ];

    $respuesta = "";
    foreach ($opciones as $indice => $opcion) {
        $respuesta .=  $indice . " ) $opcion" . "\n";
    }
    return $respuesta;
}


$menu = menuPrincipal();
echo $menu;
$menu = trim(fgets(STDIN));
$restriccionResponsable = 0;
$cantidadMaximaPasajeros = 0;
$viaje = true;

switch ($menu) {
        // carga el viaje
    case 1:

        echo "ingrese el destino:";
        $destino = trim(fgets(STDIN));
        echo "ingrese el codigo de destino:";
        $CodigoDestino = trim(fgets(STDIN));

        //menu de las opciones internas 
        $opcion = opcionesInternas();
        echo $opcion;
        $opcion = trim(fgets(STDIN));


        //bucle de las opciones internas
        while ($opcion == 1 || $opcion == 2 || $opcion == 3 ) {

            if ($opcion == 1) {

                echo "informacion pasajero :" . "\n";
                echo "-----------------------------------------";
                echo "ingrese el nombre:";
                $nombre = trim(fgets(STDIN));
                echo "ingrese el apellido:";
                $apellido = trim(fgets(STDIN));
                echo "ingrese el dni:";
                $dni = trim(fgets(STDIN));
                echo "ingrese telefono:";
                $telefono = trim(fgets(STDIN));

                $objPasajero = new Pasajeros($nombre, $apellido, $dni, $telefono);
                $arrayPasajero[] = $objPasajero;
                $cantidadMaximaPasajeros++;

                //menu
                $opcion = opcionesInternas();
                echo $opcion;
                $opcion = trim(fgets(STDIN));

            }

            if ($opcion == 2) {

                if ($restriccionResponsable < 1) {

                    $restriccionResponsable++;

                    echo "informacion Responsable del viaje: \n";
                    echo "-------------------------------------- \n";
                    echo "ingrese numero de empleado:";
                    $numEmpleado = trim(fgets(STDIN));
                    echo "ingrese nombre:";
                    $nombre = trim(fgets(STDIN));
                    echo "ingrese numero de licencia:";
                    $nroLicencia = trim(fgets(STDIN));
                    echo "ingrese apellido:";
                    $apellido = trim(fgets(STDIN));

                    $objResponsable = new Responsable($numEmpleado, $nroLicencia, $nombre, $apellido);

                    //menu
                    $opcion = opcionesInternas();
                    echo $opcion;
                    $opcion = trim(fgets(STDIN));

                }else{
                    echo "no puede ingresar mas responsables";
                }

            }

            if($opcion == 3){

                if($restriccionResponsable > 0){
                    echo "-------------------------------------- \n";
                    $viaje = new Viaje($CodigoDestino,$destino,$cantidadMaximaPasajeros,$arrayPasajero,$objResponsable); 
                    echo $viaje."\n";
                    $opcion = 0;

                }
                else{
                    echo "no se puede realizar el viaje aun \n";

                    //menu
                    $opcion = opcionesInternas();
                    echo $opcion;
                    $opcion = trim(fgets(STDIN));
                }
            }

        }
        break;
    case 2 :
        echo "salio del menu";
        break;
}


/*
$objResponsable = new Responsable("barco","valen",12584655,"lagos al 100","barcoteamo<3;p@gmail.com",299345688);

$pasajero1 = new Pasajeros("carlos","fabian",3692555,2996445265);
$pasajero2 = new Pasajeros("nombre","fabian",3692555,2996445265);
$pasajero3 = new Pasajeros("carlos","fabian",3692555,2996445265);
$pasajero4 = new Pasajeros("carlos","fabian",3692555,2996445265);
$coleccionPasajero = [$pasajero1,$pasajero2,$pasajero3,$pasajero4];

$testViaje = new Viaje(123,"playas doradas",10,$coleccionPasajero,$objResponsable);
//echo $testViaje;
*/