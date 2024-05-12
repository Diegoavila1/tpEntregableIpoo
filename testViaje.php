<?php
//incluimos los archivos
include 'Persona.php';
include 'viaje.php';
include 'pasajero.php';
include 'Responsable.php';
include 'pasajeroVip.php';
include 'pasajeroNecesidadesEspeciales.php';




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
          |                        1 ) Iniciar un Viaje:                            |
          |                        2 ) Cargar Pasajeros:                            |
          |                        3 ) Cargar Responsable:                          | 
          |                        4 ) salir                                        |
          |                                                                         |
          |*************************************************************************|
          \n";

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
          |                        1 ) Ver informacion del viaje :                  |
          |                        2 ) Ver informacion del  Responsable :           |
          |                        3 ) Ver informacion del  Pasajeros :             |
          |                        4 ) salir                                        |
          |                                                                         |
          |                                                                         |
          |*************************************************************************|
          \n";

    $respuesta = trim(fgets(STDIN));
    return $respuesta;
}

function menuTipoPasajero()
{
    echo "
          |*************************************************************************|                                                                         
          |                        ¿Que tipo de pasajero eres ?:                    |         
          |                        1 ) Pasajero estandar:                           |
          |                        2 ) Pasajero con necesidades especiales:         |
          |                        3 ) Pasajero VIP                                 | 
          |                        4 ) salir                                        |
          |                                                                         |
          |*************************************************************************|
          \n";
    $respuesta = trim(fgets(STDIN));
    return $respuesta;
}

$arrayPasajeros= [];
$objpasajero = new Pasajero("primerPasajero","0","0","0","0","0");
$arrayPasajeros[] = $objpasajero;
$contViaje = 0;

//guardar el precio final con el pasajero
//ponerle colorcito a la interfaz
//seguir pulindolo negro , faltan cosas de las otras funciones ajajjaja 

//menu

do {
    $opcionesInternas = opcionesInternas();
    $opcionesInternas = trim(fgets(STDIN));

    if ($opcionesInternas == 1) {
        //menu de carga de datos
        menuCargarDatos();
        $menuCargarDatos = trim(fgets(STDIN));

        while ($menuCargarDatos == 1 || $menuCargarDatos == 2 || $menuCargarDatos == 3) {

            if ($menuCargarDatos == 1) {

                echo "Ingrese el codigo del viaje:";
                $codigoViaje = trim(fgets(STDIN));
                echo "Ingrese el destino:";
                $destinoViaje = trim(fgets(STDIN));
                echo "Ingrese la cantidad maxima de pasajeros:";
                $cantidadMaximaPasajeros = trim(fgets(STDIN));
                $objViaje = new Viaje($codigoViaje, $destinoViaje, $cantidadMaximaPasajeros, $arrayPasajeros, null,1000);
                $contViaje++;

                menuCargarDatos();
                $menuCargarDatos = trim(fgets(STDIN));

            } elseif ($menuCargarDatos == 2) {
                 
                echo "Ingrese el nombre del pasajero:";
                $nombrePasajero = trim(fgets(STDIN));
                echo "Ingrese el apellido del pasajero:";
                $apellidoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de documento del pasajero:";
                $numeroDocumentoPasajero = trim(fgets(STDIN));
                echo "Ingrese el telefono del pasajero:";
                $telefonoPasajero = trim(fgets(STDIN));
                //$nroAsiento,$nroTicket ??????????

                $tipoPasajero = menuTipoPasajero();

                switch ($tipoPasajero) {
                    case 1:
                        echo "Hemos guardado sus datos con exito:\n";
                        break;
                    case 2:
                        echo "ingrese su numero de viajero frecuente";
                        $nroViajeroFrecuente = trim(fgets(STDIN));
                        echo "Necesita una silla de ruedas ?:(si/no)";
                        $sillaRuedas = trim(fgets(STDIN));
                        $sillaRuedas = ($sillaRuedas === "si");
                        echo "Necesita que lo asistan para embarcar:(si/no)";
                        $asistenciaParaEmbarque = trim(fgets(STDIN));
                        $asistenciaParaEmbarque = ($asistenciaParaEmbarque === "si");
                        echo "Necesita comer comida especial:(si/no)";
                        $comidaEspecial = trim(fgets(STDIN));
                        $comidaEspecial = ($comidaEspecial === "si");
                        //$nroAsiento,$nroTicket ??????????
                        break;
                    case 3:
                        echo "ingrese su numero de viajero frecuente";
                        $nroViajeroFrecuente = trim(fgets(STDIN));

                        echo "volvera al menu \n";
                        break;
                }

                if ($tipoPasajero == 1) {
                    $objPasajero = new Pasajero($nombrePasajero, $apellidoPasajero, $numeroDocumentoPasajero, $telefonoPasajero, null, null);

                    if($contViaje != 0){
                        echo "El precio de su pasaje es de : {$objViaje->venderPasaje($objPasajero)}";
                    }else{
                        echo "No se cargo un viaje previamente , porfavor volver al menu y seleccione un viaje \n";
                    }  

                } elseif ($tipoPasajero == 2) {
                    $objPasajeroEspecial = new pasajeroNecesidadesEspeciales($nombrePasajero, $apellidoPasajero, $numeroDocumentoPasajero, $telefonoPasajero, $nroViajeroFrecuente, $sillaRuedas, $asistenciaParaEmbarque, $comidaEspecial, null, null);
                    if($contViaje != 0){
                        echo "El precio de su pasaje es de : {$objViaje->venderPasaje($objPasajeroEspecial)}";
                    }else{
                        echo "No se cargo un viaje previamente , porfavor volver al menu y seleccione un viaje \n";
                    }  

                } elseif ($tipoPasajero == 3) {
                    $objPasajeroVip = new PasajeroVip($nombrePasajero, $apellidoPasajero, $numeroDocumentoPasajero, $telefonoPasajero, $nroViajeroFrecuente, null, null,100
                );
                    if($contViaje != 0){
                        echo "El precio de su pasaje es de : {$objViaje->venderPasaje($objPasajeroVip)}";
                    }else{
                        echo "No se cargo un viaje previamente , porfavor volver al menu y seleccione un viaje \n";
                    }   
                    
                }

                menuCargarDatos();
                $menuCargarDatos = trim(fgets(STDIN));

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

                menuCargarDatos();
                $menuCargarDatos = trim(fgets(STDIN));
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

                if ($contViaje == 0) {
                    echo "El viaje no se pude realizar , ya que no cargo uno ";
                } else {
                    echo $objViaje;
                }


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

