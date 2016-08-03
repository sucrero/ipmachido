<?php
    session_start();
    include_once 'clases/Conexion.php';
    include_once 'clases/Pc.class.php';
    include_once 'clases/Departamento.class.php';
   
    $objPc = new Pc();
    $objDpto = new Departamento();

//    function cambiarFormatoFecha($f,$op){
//        $fecha='';
//        if($op != 'bdd'){
//            $dia=substr($f,8,2);//1982/12/05
//            $mes=substr($f,5,2);
//            $anio=substr($f,0,4);
//            $fecha = $dia."/".$mes."/".$anio;
//        }else{
//            $dia=substr($f,0,2); //05/05/1982
//            $mes=substr($f,3,2);
//            $anio=substr($f,6,4);
//            $fecha = $anio."-".$mes."-".$dia;
//        }
//        return $fecha;
//    }
    

    switch ($_REQUEST['opcion']){

        case 'setPc':
//            print_r($_REQUEST);            die();            
            $res = $objPc->ingresarPc($_REQUEST['nombrepc'], $_REQUEST['nombreusu'], $_REQUEST['mac'], "10.10.12.".$_REQUEST['ip'], $_REQUEST['ubicacion'], $_REQUEST['departamento'], $_REQUEST['observacion']);
            break;
        case 'buscarnumregis':
            $res = $objPc->numregistro();
            break;
        case 'eliminarpc':
            $res = $objPc->eliminarpc($_REQUEST['id']);
            break;
        case 'consultarpc':
            $res = $objPc->consultarpc($_REQUEST['id']);
            break;        
        case 'modificarpc':
            $res = $objPc->modificarPc($_REQUEST['numregis'],$_REQUEST['nombrepc'], $_REQUEST['nombreusu'], $_REQUEST['mac'], "10.10.12.".$_REQUEST['ip'], $_REQUEST['ubicacion'], $_REQUEST['departamento'], $_REQUEST['observacion']);
            break;
        case 'buscarnumregisdpto':
            $res = $objDpto->numregistrodpto();
            break;
        case 'setDpto':
//            print_r($_REQUEST); exit();
            $res = $objDpto->ingresarDpto($_REQUEST['nombredpto'], $_REQUEST['nombredptoabrv'], $_REQUEST['nacionalidad'], $_REQUEST['cedula'], $_REQUEST['nombre'], $_REQUEST['apellido'], $_REQUEST['genero'], $_REQUEST['titulo'], $_REQUEST['tipo']);
            break;
        case 'consultardpto':
            $res = $objDpto->consultarDpto($_REQUEST['id']);
            break;
        case 'modificardpto':
            $res = $objDpto->modificarDpto($_REQUEST['numregisdpto'],$_REQUEST['nombredpto'], $_REQUEST['nombredptoabrv']);
            break;
        case 'eliminardpto':
            $res = $objDpto->eliminarDpto($_REQUEST['id']);
            break;
            
        
    }
//    print_r($res2);exit();
    $resp = json_encode($res);
    echo html_entity_decode($resp,ENT_QUOTES,'UTF-8');