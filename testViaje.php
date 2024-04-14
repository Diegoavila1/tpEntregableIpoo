<?php
//incluimos los archivos
include_once 'viaje.php';
include_once 'pasajero.php';
include_once 'Responsable.php';

//precargamos un pasajero
$objPasajero = new Pasajero("Diego", "Rios", "12000", "29961234");
$objResponsable = new Responsable(10, 01, "barco", "valen");
$arrayPasajero[] = $objPasajero;

function opcionesInternas()
{
    do {
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

        $respuesta = trim(fgets(STDIN));

    } while ($respuesta != 1 && $respuesta != 2 && $respuesta != 3 && $respuesta != 4);

    return $respuesta;
}


function menuCargarDatos()
{
    echo "
          |*************************************************************************|                                                                         
          |                     -Cargar informacion del viaje:,                     |         
          |                        1 ) Cargar Responsable:                          |
          |                        2 ) Cargar Pasajero:                             |
          |                        3 ) Cargar Viaje:                                | 
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
          |                     -Modificar informacion del viaje:                   |         
          |                        1 )Modificar Pasajeros :                         |
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
          |                     -Modificar informacion del viaje:                   |         
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




//menu
do {

    $opcionesInternas = opcionesInternas();

    if ($opcionesInternas == 1) {
        //menu de carga de datos
        $menuCargarDatos = menuCargarDatos();

        while ($menuCargarDatos == 1 || $menuCargarDatos == 2 || $menuCargarDatos == 3) {

            if ($menuCargarDatos == 1) {

                echo "Ingrese el numero de licencia :";
                $numeroLicenciaResponsable = trim(fgets(STDIN));
                echo "Ingrese el numero del responsable:";
                $numeroEmpleadoResponsable = trim(fgets(STDIN));
                echo "Ingrese el numero de documento del pasajero:";
                $apellidoResponsable = trim(fgets(STDIN));

                $objResponsable = new Responsable($numeroEmpleadoResponsable, $numeroLicenciaResponsable, $numeroEmpleadoResponsable, $apellidoResponsable);

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

                $menuCargarDatos = menuCargarDatos();
            } elseif ($menuCargarDatos == 3) {
                echo "Ingrese el codigo del viaje:";
                $codigoViaje = trim(fgets(STDIN));
                echo "Ingrese el destino:";
                $destinoViaje = trim(fgets(STDIN));
                echo "Ingrese la cantidad maxima de pasajeros:";
                $cantidadMaximaPasajeros = trim(fgets(STDIN));


                $objViaje = new Viaje($codigoViaje, $destinoViaje, $cantidadMaximaPasajeros, $objPasajero, $objResponsable);
            }
        } // fin del while

    } elseif ($opcionesInternas == 2) {

        $menuModificarDatos = menuModificarDatos();

        while ($menuModificarDatos == 1 || $menuModificarDatos == 2 || $menuModificarDatos == 3) {

            if ($menuModificarDatos == 1) {

                $menuModificarDatos = menuModificarDatos();
                echo "ingrese el dni del pasajero a modificar:";
                $dniChequeable = trim(fgets(STDIN));

                if ($objViaje->encontrarPorDni($dniChequeable)) {
                    echo "Ingrese el nuevo nombre del pasajero:";
                    $nombrePasajeroMod = trim(fgets(STDIN));
                    echo "Ingrese el nuevo apellido del pasajero:";
                    $apellidoPasajeroMod = trim(fgets(STDIN));
                    echo "Ingrese el nuevo numero de documento del pasajero:";
                    $numeroDocumentoPasajeroMod = trim(fgets(STDIN));
                    echo "Ingrese el nuevo telefono del pasajero:";
                    $telefonoPasajeroMod = trim(fgets(STDIN));

                    $objViaje->modificarArrayPasajeros($nombrePasajeroMod, $apellidoPasajeroMod, $numeroDocumentoPasajeroMod, $telefonoPasajeroMod);
                    $menuModificarDatos = menuModificarDatos();
                } else {
                    echo "no se pudo encontrar al pasajero para modificar:";
                    $menuModificarDatos = menuModificarDatos();
                }
            } elseif ($menuModificarDatos == 2) {

                echo "ingrese el numero de empleado a chequear:";
                $numeroEmpleadoChequear = trim(fgets(STDIN));

                if ($objViaje->getObjResponsable()->encontrarPorNumeroLicencia($numeroEmpleadoChequear)) {
                    echo "Ingrese el numero de licencia a modificar:";
                    $numeroLicenciaResponsableMod = trim(fgets(STDIN));
                    echo "Ingrese el numero del responsable a modificar";
                    $numeroResponsableMod = trim(fgets(STDIN));
                    echo "Ingrese el numero de documento del responsable a modificar:";
                    $apellidoResponsableMod = trim(fgets(STDIN));
                    echo "ingrese el nombre del responsable a modificar:";
                    $nombreResponsableMod = trim(fgets(STDIN));
                    $objViaje->reemplazarResponsable($numeroResponsableMod, $numeroLicenciaResponsableMod, $nombreResponsableMod, $apellidoResponsableMod);
                }

                $menuModificarDatos = menuModificarDatos();
            } elseif ($menuModificarDatos == 3) {

                echo "Ingrese el codigo del viaje:";
                $codigoViajeMod = trim(fgets(STDIN));
                echo "Ingrese el destino:";
                $destinoViajeMod = trim(fgets(STDIN));
                echo "Ingrese la cantidad maxima de pasajeros:";
                $cantidadMaximaPasajerosMod = trim(fgets(STDIN));
                $objviaje->reemplazarDatosViaje($codigoViajeMod, $destinoViajeMod, $cantidadMaximaPasajerosMod);
            }
        }
    } elseif ($opcionesInternas == 3) {

        $menuVerDatos = menuVerDatos();

        while ($menuVerDatos == 1 || $menuVerDatos == 2 || $menuVerDatos == 3) {

            if ($menuVerDatos == 1) {
                echo $objViaje;
                $menuVerDatos = menuVerDatos();
            } elseif ($menuVerDatos == 2) {

                $menuVerDatos = menuVerDatos();
            } elseif ($menuVerDatos == 3) {

                $menuVerDatos = menuVerDatos();
            }
        }
    }

} while ($opcionesInternas);
