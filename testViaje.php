<?php
//incluimos los archivos
include_once 'viaje.php';
include_once 'pasajero.php';
include_once 'Responsable.php';

function opcionesInternas()
{

    echo "
          |*************************************************************************|                                                                         
          |                        MENU                                             |
          |                        1 ) Cargar el viaje:                             |
          |                        2 ) Modificar los datos:                         |
          |                        3 ) ver los datos:                               |
          |                        4 ) salir:                                       | 
          |                                                                         |
          |*************************************************************************|
          \n";
}


function menuCargarDatos()
{
    echo "
          |*************************************************************************|                                                                         
          |                        Cargar informacion del viaje:                    |         
          |                        1 ) Cargar Viaje:                                |
          |                        2 ) Cargar Pasajero:                             |
          |                        3 ) Cargar Responsable:                          | 
          |                        4 ) salir                                        |
          |                                                                         |
          |*************************************************************************|
          \n";
    $respuesta = trim(fgets(STDIN));
    return $respuesta;
}

function menuModificarDatos()
{
    echo "
          |*************************************************************************|                                                                         
          |                       Modificar informacion del viaje:                  |         
          |                        1 ) Modificar Pasajeros :                        |
          |                        2 ) Modificar Responsable :                      |
          |                        3 ) Modificar viaje :                            |
          |                        4 ) salir                                        |
          |                                                                         |
          |                                                                         |
          |*************************************************************************|
          \n";

    $respuesta = trim(fgets(STDIN));
    return $respuesta;
}

function menuVerDatos()
{
    echo "
          |*************************************************************************|                                                                         
          |                        Ver informacion del viaje:                       |         
          |                        1 ) Ver datos del viaje :                        |
          |                        2 ) Ver datos del  Responsable :                 |
          |                        3 ) Ver datos del  Pasajeros :                   |
          |                        4 ) salir                                        |
          |                                                                         |
          |                                                                         |
          |*************************************************************************|
          \n";

    $respuesta = trim(fgets(STDIN));
    return $respuesta;
}


//precargamos un pasajero
$objPasajero = new Pasajero("Diego", "Rios", "12000", "29961234");
$objpasajero1 = new Pasajero("Juan", "Perez", "34567890", "30012345");
$objpasajero2 = new Pasajero("Maria", "Lopez", 98765432, "30165432");
$objpasajero3 = new Pasajero("Pedro", "Gutierrez", 12345678, "30223456");
$objpasajero4 = new Pasajero("Ana", "Martinez", 45678901, "30387654");
$objpasajero5 = new Pasajero("Carlos", "Garcia", 78901234, "30456789");

$objResponsable = new Responsable(10, 01, "barco", "valen");

$arrayPasajeros = array($objPasajero, $objpasajero1, $objpasajero2, $objpasajero3, $objpasajero4, $objpasajero5);



//actualizar menu (salir/volver)
//borrar base de datos precargada
//


//menu
do {

    $opcionesInternas = opcionesInternas();
    $opcionesInternas = trim(fgets(STDIN));

    if ($opcionesInternas == 1) {
        //menu de carga de datos
        $menuCargarDatos = menuCargarDatos();

        while ($menuCargarDatos == 1 || $menuCargarDatos == 2 || $menuCargarDatos == 3) {

            if ($menuCargarDatos == 1) {

                echo "Ingrese el codigo del viaje:";
                $codigoViaje = trim(fgets(STDIN));
                echo "Ingrese el destino:";
                $destinoViaje = trim(fgets(STDIN));
                echo "Ingrese la cantidad maxima de pasajeros:";
                $cantidadMaximaPasajeros = trim(fgets(STDIN));


                $objViaje = new Viaje($codigoViaje, $destinoViaje, $cantidadMaximaPasajeros, $arrayPasajeros, $objResponsable);
                

                $menuCargarDatos = menuCargarDatos();

            } elseif ($menuCargarDatos == 2) {
                echo "Ingrese el nombre del pasajero:";
                $nombrePasajero = trim(fgets(STDIN));
                echo "Ingrese el apellido del pasajero:";
                $apellidoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de documento del pasajero:";
                $numeroDocumentoPasajero = trim(fgets(STDIN));
                echo "Ingrese el telefono del pasajero:";
                $telefonoPasajero = trim(fgets(STDIN));

                $objPasajero = new Pasajero($nombrePasajero, $apellidoPasajero, $numeroDocumentoPasajero, $telefonoPasajero);
                array_push($arrayPasajeros, $objPasajero);
                $objViaje->setColObjPasajeros($arrayPasajeros);

                $menuCargarDatos = menuCargarDatos();

            } elseif ($menuCargarDatos == 3) {

                echo "Ingrese el numero de licencia :";
                $numeroLicenciaResponsable = trim(fgets(STDIN));
                echo "Ingrese el numero del responsable:";
                $numeroEmpleadoResponsable = trim(fgets(STDIN));
                echo "Ingrese el nombre del responsable:";
                $nombreResponsable = trim(fgets(STDIN));
                echo "Ingrese el apellido del responsable:";
                $apellidoResponsable = trim(fgets(STDIN));

                $objResponsable = new Responsable($numeroEmpleadoResponsable, $numeroLicenciaResponsable, $nombreResponsable, $apellidoResponsable);
                $objViaje->setObjResponsable($objResponsable);
                echo "se realizo el cambio :";

                $menuCargarDatos = menuCargarDatos();

            }
        } // fin del while

    } elseif ($opcionesInternas == 2) {

        $menuModificarDatos = menuModificarDatos();

        while ($menuModificarDatos == 1 || $menuModificarDatos == 2 || $menuModificarDatos == 3) {

            if ($menuModificarDatos == 1) {

                echo "ingrese el dni del pasajero a modificar:";
                $dniChequeable = trim(fgets(STDIN));

                if ($objViaje->encontrarPorDni($dniChequeable) >= 0) {

                    echo "Ingrese el nuevo nombre del pasajero:";
                    $nombrePasajeroMod = trim(fgets(STDIN));
                    echo "Ingrese el nuevo apellido del pasajero:";
                    $apellidoPasajeroMod = trim(fgets(STDIN));
                    echo "Ingrese el nuevo telefono del pasajero:";
                    $telefonoPasajeroMod = trim(fgets(STDIN));
                    
                    $objViaje->modificarArrayPasajeros($nombrePasajeroMod, $apellidoPasajeroMod, $objViaje->encontrarPorDni($dniChequeable), $telefonoPasajeroMod);
                    $menuModificarDatos = menuModificarDatos();

                } else {

                    echo "no se pudo encontrar al pasajero para modificar:";
                    $menuModificarDatos = menuModificarDatos();
                }

            } elseif ($menuModificarDatos == 2) {

                echo "ingrese el numero de empleado a chequear:";
                $numeroEmpleadoChequear = trim(fgets(STDIN));

                if ($objViaje->encontrarPorNumeroLicencia($numeroEmpleadoChequear)) {
                    echo "Ingrese el numero de licencia a modificar:";
                    $numeroLicenciaResponsableMod = trim(fgets(STDIN));
                    echo "Ingrese el numero del responsable a modificar:";
                    $numeroResponsableMod = trim(fgets(STDIN));
                    echo "Ingrese el numero de documento del responsable a modificar:";
                    $apellidoResponsableMod = trim(fgets(STDIN));
                    echo "ingrese el nombre del responsable a modificar:";
                    $nombreResponsableMod = trim(fgets(STDIN));
                    $objViaje->reemplazarResponsable($numeroResponsableMod, $numeroLicenciaResponsableMod, $nombreResponsableMod, $apellidoResponsableMod);
                    $menuModificarDatos = menuModificarDatos();
                } else {
                    echo "no se pudo encontrar el responsable para modificar:";
                    $menuModificarDatos = menuModificarDatos();
                }


            } elseif ($menuModificarDatos == 3) {

                echo "Ingrese el codigo del viaje:";
                $codigoViajeMod = trim(fgets(STDIN));
                echo "Ingrese el destino:";
                $destinoViajeMod = trim(fgets(STDIN));
                echo "Ingrese la cantidad maxima de pasajeros:";
                $cantidadMaximaPasajerosMod = trim(fgets(STDIN));

                $objViaje->reemplazarDatosViaje($codigoViajeMod, $destinoViajeMod, $cantidadMaximaPasajerosMod);
                $menuModificarDatos = menuModificarDatos();
            }
        }
    } elseif ($opcionesInternas == 3) {

        $menuVerDatos = menuVerDatos();

        while ($menuVerDatos == 1 || $menuVerDatos == 2 || $menuVerDatos == 3) {

            if ($menuVerDatos == 1) {

                echo $objViaje;

                $menuVerDatos = menuVerDatos();
            } elseif ($menuVerDatos == 2) {

                echo $objResponsable;

                $menuVerDatos = menuVerDatos();
            } elseif ($menuVerDatos == 3) {

                echo $objViaje->mostrarObjPasajero();

                $menuVerDatos = menuVerDatos();
            }
        }
    }
} while ($opcionesInternas != 4);
