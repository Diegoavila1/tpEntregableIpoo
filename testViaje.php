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
        1 => "cargar los datos del pasajero:",
        2 => "cargar 1 responsable del viaje:",
        3 => "cargar los datos del viaje:"
        ];

    $respuesta = "";
    foreach ($opciones as $indice => $opcion) {
        $respuesta .=  $indice . " ) $opcion" . "\n";
    }
    do{
       echo $respuesta; 
       $respuesta = trim(fgets(STDIN));
    }while (!in_array($respuesta, array_keys($opciones)));

    return $respuesta;
}





$menu = menuPrincipal();
echo $menu;
$menu = trim(fgets(STDIN));
echo "\n";

$restriccionResponsable = 0;
$cantidadMaximaPasajeros = 1;
$countPasajero  = 0;
$viaje = true;

switch ($menu) {
        // carga el viaje
    case 1:

        echo "ingrese el destino:";
        $destino = trim(fgets(STDIN));
        echo "ingrese el codigo de destino:";
        $CodigoDestino = trim(fgets(STDIN));
        echo "\n";

        //repite hasta que ingrese opcion correcta

        //menu de las opciones internas, solo funciona con opciones correctas
        $opcion = opcionesInternas();


        //bucle de las opciones internas
        while ($opcion == 1 || $opcion == 2 || $opcion == 3 || $opcion == 4) {

            if ($opcion == 1) {

                echo "\n";
                echo "informacion pasajero :" . "\n";
                echo "-----------------------------------------". "\n";
                echo "ingrese el nombre:";
                $nombre = trim(fgets(STDIN));
                echo "ingrese el apellido:";
                $apellido = trim(fgets(STDIN));
                echo "ingrese el dni:";
                $dni = trim(fgets(STDIN));
                echo "ingrese telefono:";
                $telefono = trim(fgets(STDIN));

                $objPasajero = new Pasajeros($nombre, $apellido, $dni, $telefono);
    
                foreach($arrayPasajero as $pasajero){
                    if($objPasajero == $pasajero){
                        echo "El pasajero esta repetido \n";
                    }else{
                        $arrayPasajero[] = $objPasajero;
                        $cantidadMaximaPasajeros++;
                        $countPasajero++;
                    }
                }

                //menu
                $opcion = opcionesInternas();

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
                    echo "\n";

                    $objResponsable = new Responsable($numEmpleado, $nroLicencia, $nombre, $apellido);

                    //menu
                    $opcion = opcionesInternas();

                }else{
                    echo "no puede ingresar mas responsables";
                    echo "\n";

                    //menu
                    $opcion = opcionesInternas();
                }

            }

            if($opcion == 3){
                //chequea si hay un responsable cargado

                if($restriccionResponsable > 0){

                    echo "-------------------------------------- \n";
                    echo "Los datos del viaje son :";
                    echo "\n";
                    echo "-------------------------------------- \n";
                    $viaje = new Viaje($CodigoDestino,$destino,$cantidadMaximaPasajeros,$arrayPasajero,$objResponsable); 
                    echo $viaje."\n";

                    do{
                        echo "desea modificar los datos:? \n";
                        $respuesta = trim(fgets(STDIN));
                    }
                    while($respuesta != "si" && $respuesta != "no");

                    if($respuesta == "si"){

                        echo "puede modificar los siguientes datos: 
                            1- pasajero :
                            2- responsable :
                            3- viaje: \n";
                        echo "ingrese la opcion:";
                            
                        $modificacionViaje = trim(fgets(STDIN));
    
                        if($modificacionViaje == 1){
                            echo "ingresar dni del  pasajero que le gustaria modificar:";
                            $pasajeroPedidoModificar = trim(fgets(STDIN));
                            echo "Informacion del pasajero a modificar:";
                            echo "\n";
                            echo $viaje->MostrarObjPasajero();
                            echo "\n";

                            echo "nombre a modificar:";
                            $nombreMod = trim(fgets(STDIN));
                            echo "apellido a modficar:";
                            $apellidoMod = trim(fgets(STDIN));
                            echo "numero de documento a modificar:";
                            $numeroDocumentoMod = trim(fgets(STDIN));
                            echo "telefono a modificar:";
                            $telefonoMod = trim(fgets(STDIN));
    
                            $viaje->modificarArrayPasajeros($pasajeroPedidoModificar,$nombreMod,$apellidoMod,$numeroDocumentoMod,$telefonoMod);
                            echo "Cambios realizado \n";

                            echo "Desea que le muestre los datos del viaje modificados?";
                            $respuesta = trim(fgets(STDIN));

                            if($respuesta == "si"){
                                $viaje->modificarArrayPasajeros($pasajeroPedidoModificar,$nombreMod,$apellidoMod,$numeroDocumentoMod,$telefonoMod);
                            }else{
                                //menu
                                $opcion = opcionesInternas();
                            
                            }


                        }elseif($modificacionViaje == 2){
                            echo "ingresar el numero de empleado:";
                            $numResponsable = trim(fgets(STDIN));

                            if($objResponsable->getNumeroLicencia() == $numResponsable){
                                echo "ingrese los nuevos datos ";
                                echo "numero de empleado : ";
                                $numEmpleadoMod = trim(fgets(STDIN));
                                echo "numero licencia:";
                                $numLicenciaoMod = trim(fgets(STDIN));
                                echo "nombre:";
                                $nombreMod = trim(fgets(STDIN));
                                echo "apellido:";
                                $apellidoMod = trim(fgets(STDIN));

                                //modificacion de valores
                                $objResponsable->setNumeroEmpleado($numEmpleadoMod);
                                $objResponsable->setNumeroLicencia($numLicenciaMod);
                                $objResponsable->setNombre($nombreMod);
                                $objResponsable->setApellido($apellidoMod);
                                echo "Cambios realizado \n";

                            }else{
                                echo "El numero de empleado no coincide:";
                            }

                            echo "Desea que le muestre los datos del viaje modificados?";
                            $respuesta = trim(fgets(STDIN));

                            if($respuesta == "si"){
                                $viaje->modificarArrayPasajeros($pasajeroPedidoModificar,$nombreMod,$apellidoMod,$numeroDocumentoMod,$telefonoMod);
                            }else{
                                $opcion = 0;
                            }

                        }elseif($modificacionViaje == 3){
                            $salir = true;
                            while($salir){
                                echo "que cambios desea realizar:?
                                1-Codigo del mismo destino :
                                2-El destino :
                                3-cantidad de pasajeros maxima :";
                                $cambiosViaje = trim(fgets(STDIN));
                                if($cambiosViaje == 1){
                                    echo "ingrese el codigo nuevo que desea cambiar:";
                                    $codigoMismoDestino = trim(fgets(STDIN));
                                    echo "cambio realizado:"."\n";
                                    echo $viaje;
                                }elseif($cambiosViaje == 2){
                                    echo "ingrese el nuevo destino:";
                                    $destino = trim(fgets(STDIN));
                                    echo "cambio realizado:"."\n";
                                    echo $viaje;
                                }elseif($cambiosViaje == 3){
                                    echo "ingrese la nueva cantidad maxima de pasajeros:";
                                    $cantidadMaximaPasajeros = trim(fgets(STDIN));
                                    echo "cambio realizado:"."\n";
                                    echo $viaje;
                                }else{
                                    $salir = false;
                                }
                            }
                        }
                            
                    }

                }else{
                    echo "desea volver al menu?";
                    $pregunta = trim(fgets(STDIN));
                    if($pregunta == "si"){
                        //menu
                        echo "\n";
                        $opcion = opcionesInternas();
                    }else{
                        $opcion = 0;
                    }
                }

            }

            else{
              echo "no se puede realizar el viaje aun \n";
              //menu
              $opcion = opcionesInternas();
            }
            
            if($opcion == 4){

                if($restriccionResponsable > 0 ){

                    echo "puede modificar los siguientes datos: 
                        1- pasajero :
                        2- responsable :
                        3- viaje: \n";
                    $modificacionViaje = trim(fgets(STDIN));

                    if($modificacionViaje == 1){
                        echo "ingresar dni del  pasajero que le gustaria modificar: \n";
                        $pasajeroPedidoModificar = trim(fgets(STDIN));
                        echo $viaje->MostrarObjPasajero();
                        echo "nombre a modificar:";
                        $nombreMod = trim(fgets(STDIN));
                        echo "apellido a modficar:";
                        $apellidoMod = trim(fgets(STDIN));
                        echo "numero de documento a modificar:";
                        $numeroDocumentoMod = trim(fgets(STDIN));
                        echo "telefono a modificar:";
                        $telefonoMod = trim(fgets(STDIN));

                        $viaje->modificarArrayPasajeros($pasajeroPedidoModificar,$nombreMod,$apellidoMod,$numeroDocumentoMod,$telefonoMod);
                        echo "cambio realizado";
                    }

                }else{
                    echo "No se puede modificar informacion que no existe";
                    $opcion = opcionesInternas();
                }

            }

        }// fin del while
        break;

    case 2 :

        echo "salio del menu";
        break;

    default:

        echo "salio del menu";

}

