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


$arrayPasajeros = [];



//menu
$contViaje = 0;
$pasajeroExiste = false;
$cantPasajeros = 0;
do {
    
    $opcionesInternas = opcionesInternas();
    $opcionesInternas = trim(fgets(STDIN));

    //menu de carga de datos
    if ($opcionesInternas == 1) {

        $contViaje++;
        menuCargarDatos();
        $menuCargarDatos = trim(fgets(STDIN));

        while ($menuCargarDatos == 1 || $menuCargarDatos == 2 || $menuCargarDatos == 3) {

            //cargar el viaje
            if ($menuCargarDatos == 1) {

                echo "Ingrese el codigo del viaje:";
                $codigoViaje = trim(fgets(STDIN));
                echo "Ingrese el destino:";
                $destinoViaje = trim(fgets(STDIN));
                echo "Ingrese la cantidad maxima de pasajeros:";
                $cantidadMaximaPasajeros = trim(fgets(STDIN));
                echo "Ingrese el precio del viaje por pasajero :";
                $precioViaje = trim(fgets(STDIN));
                $objViaje = new Viaje($codigoViaje, $destinoViaje, $cantidadMaximaPasajeros, $arrayPasajeros, null, $precioViaje);
                echo "\e[42mSus datos se guardaron correctamente !!.\e[0m"."\n";

                menuCargarDatos();
                $menuCargarDatos = trim(fgets(STDIN));


                //cargar pasajero
            } elseif ($menuCargarDatos == 2) {
                    //controla la cantidad maxima de pasajeros que puede entrar
                    $cantPasajeros++;

                if ($contViaje != 0) {
                    if($cantPasajeros <= $objViaje->getCantidadMaximaPasajeros()){
                    //controla que el pasajero exista
                    $pasajeroExiste = true;

                    echo "Ingrese el nombre del pasajero:";
                    $nombrePasajero = trim(fgets(STDIN));
                    echo "Ingrese el apellido del pasajero:";
                    $apellidoPasajero = trim(fgets(STDIN));
                    echo "Ingrese el numero de documento del pasajero:";
                    $numeroDocumentoPasajero = trim(fgets(STDIN));
                    echo "Ingrese el telefono del pasajero:";
                    $telefonoPasajero = trim(fgets(STDIN));
                    echo "ingrese el numero de ticket:";
                    $nroTicket = trim(fgets(STDIN));
                    echo "ingrese el numero de asiento:";
                    $nroAsiento = trim(fgets(STDIN));

                    $tipoPasajero = menuTipoPasajero();

                    switch ($tipoPasajero) {
                        case 1:
                            echo "Hemos guardado sus datos con exito:\n";
                            break;
                        case 2:
                            echo "ingrese su numero de viajero frecuente:";
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

                            break;
                        case 3:
                            echo "Ingrese su numero de viajero frecuente:";
                            $nroViajeroFrecuente = trim(fgets(STDIN));
                            echo "Ingrese la cantidad de millas :";
                            $nroMillas = trim(fgets(STDIN));
                            break;
                    }
                    if ($tipoPasajero == 1) {
                        echo "El precio de su pasaje es de : {$objViaje->crearPasajero($nombrePasajero,$apellidoPasajero,$numeroDocumentoPasajero,$telefonoPasajero,$nroAsiento,$nroTicket)}";
                        echo "\e[42mSus datos se guardaron correctamente !!.\e[0m"."\n";


                    } elseif ($tipoPasajero == 2) {
                        echo "El precio de su pasaje es de : {$objViaje->crearPasajeroNecesidadesEspeciales($nombrePasajero,$apellidoPasajero,$numeroDocumentoPasajero,$telefonoPasajero,$nroViajeroFrecuente,$sillaRuedas,$asistenciaParaEmbarque,$comidaEspecial,$nroAsiento,$nroTicket)}";
                        echo "\e[42mSus datos se guardaron correctamente !!.\e[0m"."\n";

                        
                    } elseif ($tipoPasajero == 3) {
                        echo "El precio de su pasaje es de : {$objViaje->crearPasajeroVip($nombrePasajero,$apellidoPasajero,$numeroDocumentoPasajero,$telefonoPasajero,$nroViajeroFrecuente,$nroAsiento,$nroTicket,$nroMillas)}";
                        echo "\e[42mSus datos se guardaron correctamente !!.\e[0m"."\n";

                    }
                    }else{
                        echo "\e[41mDisculpe , nos hemos quedado sin espacio.\e[0m"."\n";
                    }
                //else de control de viaje
                } else {
                    echo "\e[41mNo se cargo un viaje previamente , porfavor volver al menu y seleccione un viaje.\e[0m"."\n";
                }

                menuCargarDatos();
                $menuCargarDatos = trim(fgets(STDIN));

            //carga el responsable
            } elseif ($menuCargarDatos == 3) {

                if($contViaje != 0){
                    echo "Ingrese el numero de licencia :";
                    $numeroLicenciaResponsable = trim(fgets(STDIN));
                    echo "Ingrese el numero del responsable:";
                    $numeroEmpleadoResponsable = trim(fgets(STDIN));
                    echo "Ingrese el nombre del responsable:";
                    $nombreResponsable = trim(fgets(STDIN));
                    echo "Ingrese el apellido del responsable:";
                    $apellidoResponsable = trim(fgets(STDIN));
    
                    $objResponsable = new Responsable($nombreResponsable, $apellidoResponsable,$numeroEmpleadoResponsable, $numeroLicenciaResponsable);
                    $objViaje->crearResponsable($objResponsable);
                    echo "\e[42mSus datos se guardaron correctamente !!.\e[0m"."\n";
                }else{
                    echo "\e[41mNo se cargo un viaje previamente , porfavor volver al menu y seleccione un viaje .\e[0m"."\n";
                }

                menuCargarDatos();
                $menuCargarDatos = trim(fgets(STDIN));
            }
            
        } // fin del while

    //menu modificar datos
    } elseif ($opcionesInternas == 2) {

        $menuModificarDatos = menuModificarDatos();

        while ($menuModificarDatos == 1 || $menuModificarDatos == 2 || $menuModificarDatos == 3) {

            //modificar el pasajero
            if ($menuModificarDatos == 1) {

                //chequea que exista almenos 1 pasajero
                if($pasajeroExiste){
                    //chequea que exista el pasajero con ese ticket en el array
                    echo "ingrese el numero de ticket para modificar su pasaje:";
                    $ticketAChequear = trim(fgets(STDIN));
    
                    $objAEncontrar = $objViaje->encontrarPorTicket($ticketAChequear);
    
                    if ($objAEncontrar instanceof PasajeroNecesidadesEspeciales) {

                        echo "\e[45mCAMBIAR INFORMACION : PASAJERO NECESIDADES ESPECIALES .\e[0m\n";

                        echo "Ingrese el nombre del pasajero a cambiar:";
                        $nombrePasajeroModD = trim(fgets(STDIN));
                        echo "Ingrese el apellido del pasajero a cambiar:";
                        $apellidoPasajeroModD = trim(fgets(STDIN));
                        echo "Ingrese el numero de documento del pasajero a cambiar:";
                        $numeroDocumentoPasajeroModD = trim(fgets(STDIN));
                        echo "Ingrese el telefono del pasajero a cambiar:";
                        $telefonoPasajeroModD = trim(fgets(STDIN));
                        echo "Ingrese su numero de viajero frecuente a cambiar:";
                        $nroViajeroFrecuenteModD = trim(fgets(STDIN));
    
                        //no deberia de poder modificar el $cantidadMillasPasajero
                        $objViaje->modificarPasajeroNecesidadesEspeciales($nombrePasajeroModD,$apellidoPasajeroModD,$numeroDocumentoPasajeroModD,$telefonoPasajeroModD,$nroViajeroFrecuenteModD,$nroAsiento,$ticketAChequear);
    
                    } elseif ($objAEncontrar instanceof PasajeroVip) {

                        echo "\e[45mCAMBIAR INFORMACION : PASAJERO VIP.\e[0m";

                        echo "ingrese el nombre a cambiar :";
                        $nombreModVip = trim(fgets(STDIN));
                        echo "ingrese el apellido a cambiar :";
                        $apellidoModVip = trim(fgets(STDIN));
                        echo "ingrese el numero de documento a cambiar:";
                        $numeroDocumentoModVip = trim(fgets(STDIN));
                        echo "ingrese el telefono a cambiar :";
                        $telefonoModVip = trim(fgets(STDIN));
                        echo "ingrese su numero de viajero frecuente a cambiar :";
                        $nroViajeroFrecuenteModVip = trim(fgets(STDIN));
                        echo "ingrese el numero de asiento a cambiar :";
                        $nroAsientoModVip = trim(fgets(STDIN));
    
                        $objViaje->modificarPasajeroVip($nombreModVip,$apellidoModVip,$numeroDocumentoModVip,$telefonoModVip,$nroViajeroFrecuenteModVip,$nroAsientoModVip,$ticketAChequear);
                        echo "\e[42mSus cambios se efectuaron correctamente !!.\e[0m"."\n";

                    } elseif ($objAEncontrar instanceof Pasajero) {
    
                        echo "\e[45mCAMBIAR INFORMACION : PASAJERO .\e[0m\n";

                        echo "Ingrese el nombre del pasajero a cambiar:";
                        $nombrePasajeroMod = trim(fgets(STDIN));
                        echo "Ingrese el apellido del pasajero a cambiar:";
                        $apellidoPasajeroMod = trim(fgets(STDIN));
                        echo "Ingrese el numero de documento del pasajero a cambiar:";
                        $numeroDocumentoPasajeroMod = trim(fgets(STDIN));
                        echo "Ingrese el telefono del pasajero a cambiar:";
                        $telefonoPasajeroMod = trim(fgets(STDIN));
                        echo "Ingrese su numero de viajero frecuente a cambiar:";
                        $nroViajeroFrecuenteMod = trim(fgets(STDIN));
                        $objViaje->modificarPasajero($nombrePasajeroMod, $apellidoPasajeroMod, $numeroDocumentoPasajeroMod, $telefonoPasajeroMod, $nroViajeroFrecuenteMod, $ticketAChequear);
                        echo "\e[42mSus cambios se efectuaron correctamente !!.\e[0m"."\n";

                    } else {
                        echo "\e[41mEl ticket que ingreso no es esta registrado en la base de datos\e[0m"."\n";  
                    }
                }else{
                    echo "\e[41mNo existe un pasajero en la base de datos .\e[0m"."\n";
                }
                
                $menuModificarDatos = menuModificarDatos();

            //modificar responsable
            } elseif ($menuModificarDatos == 2) {

                if($contViaje != 0){
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
                        echo "\e[42mSu cambio fue realizado con exito!!.\e[0m";
                    } else {
                        echo "no se pudo encontrar el responsable para modificar:";
                    }
                    
                }else{
                    echo "\e[41mEl viaje no se pude realizar , cargue uno previamente.\e[0m"."\n";
                }

                $menuModificarDatos = menuModificarDatos();

            //modificar viaje
            } elseif ($menuModificarDatos == 3) {

                if($contViaje != 0){
                    echo "Ingrese el nuevo codigo del viaje:";
                    $codigoViajeMod = trim(fgets(STDIN));
                    echo "Ingrese el nuevo destino:";
                    $destinoViajeMod = trim(fgets(STDIN));
                    echo "Ingrese la nuevo cantidad maxima de pasajeros:";
                    $cantidadMaximaPasajerosMod = trim(fgets(STDIN));
                    echo "Ingrese el nuevo precio del viaje:";
                    $precio = trim(fgets(STDIN));
                    $objViaje->reemplazarDatosViaje($codigoViajeMod, $destinoViajeMod, $cantidadMaximaPasajerosMod, $precio);
                    echo "\e[42mSu cambio fue realizado con exito!!.\e[0m";
                }else{
                    echo "\e[41mEl viaje no se pude realizar , cargue uno previamente.\e[0m"."\n";
                }
                $menuModificarDatos = menuModificarDatos();
            }
        }// fin del while

    //menu ver los datos    
    } elseif ($opcionesInternas == 3) {

        $menuVerDatos = menuVerDatos();

        while ($menuVerDatos == 1 || $menuVerDatos == 2 || $menuVerDatos == 3) {
            //ver viaje
            if ($menuVerDatos == 1) {
                if ($contViaje != 0) {
                    echo $objViaje;
                } else {
                    echo "\e[41mEl viaje no se pude realizar , cargue uno previamente.\e[0m"."\n";
                    
                }

                $menuVerDatos = menuVerDatos();
            //ver responsable
            } elseif ($menuVerDatos == 2) {

                if ($contViaje != 0) {
                    echo $objResponsable;
                } else {
                    echo "\e[41mEl viaje no se pude realizar , cargue uno previamente.\e[0m"."\n";
                }
                

                $menuVerDatos = menuVerDatos();
            //ver los pasajeros
            } elseif ($menuVerDatos == 3) {

                if ($contViaje != 0) {
                    echo $objViaje->mostrarObjPasajero();
                } else {
                    echo "\e[41mEl viaje no se pude realizar , cargue uno previamente.\e[0m"."\n";
                }
                
                $menuVerDatos = menuVerDatos();
            }
        }
    }
} while ($opcionesInternas != 4);

