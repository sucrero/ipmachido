<?php
    session_start();
    require 'clases/PDF_MC_Table.php';
    include_once 'clases/Personal.php';
    include_once 'clases/Banco.php';
    include_once 'clases/Pais.php';
    include_once 'clases/Estado.php';
    include_once 'clases/Estamundo.php';
    include_once 'clases/Municipio.php';
    include_once 'conexion/conexion.php';
    $objPer = new Personal();
    $objBan = new Banco();
    $objPai = new Pais();
    $objEst = new Estado();
    $objEstMun = new Estamundo();
    $objMun = new Municipio();
    
    $datos = explode('=', $_REQUEST['datos']);
//    print_r($datos);exit();
    $desde = $datos[0];
    $hasta = $datos[1];
    $radio = $datos[2];
    $opc = $datos[3];

        
        if($radio == "registro"){
             $cam = 'fechareg';
             $fecCam = "Registro";
         }else{
             $cam = 'fechatrans';
             $fecCam = "Transacci&oacute;n";
         }
//          print_r($datos);exit();
         if($opc == 'TODOS'){
             $op = "";
              $conf = "Confirmado: TODOS";
         }else if($opc == 'CONFIRMADO'){
             $op = " confirmado = 'si' AND";
              $conf = "Confirmado: Si";
         }else{
             $op = " confirmado = 'no' AND";
             $conf = "Confirmado: NO";
         }
         $fd = substr($desde,6,4).'-'.substr($desde,3,2).'-'.substr($desde,0,2);
         $fh = substr($hasta,6,4).'-'.substr($hasta,3,2).'-'.substr($hasta,0,2);
         $sql ="SELECT * FROM participante WHERE".$op." ".$cam." BETWEEN '".$fd."' AND '".$fh."' ORDER BY nombre,apellido ASC";
//         print_r($sql);exit();
         if($objPer->buscarPer($sql, $conexion)){
             if($conexion->registros > 0){                           
                 $i = 0;
                 do{
                     $res[$i][0] = $conexion->devolver_recordset();
                     $i++;
                 }while(($conexion->siguiente()) && ($i != $conexion->registros));
                 for($i = 0 ;$i < count($res);$i++){
                     $sql = "SELECT * FROM banco WHERE idbanco = '".$res[$i][0]['banco']."'";
                     $objBan->buscar($sql, $conexion);
                     $res[$i][1] = $conexion->devolver_recordset();
                     $sql = "SELECT * FROM banco WHERE idbanco = '".$res[$i][0]['bancodest']."'";
                     $objBan->buscar($sql, $conexion);
                     $res[$i][2]= $conexion->devolver_recordset();
                     $sql = "SELECT * FROM pais WHERE idpais = '".$res[$i][0]['pais']."'";
                    $objPai->buscar($sql, $conexion);
                    $res[$i][3]= $conexion->devolver_recordset() ;
                    if($res[$i][0]['pais'] == '189'){
                        $sql = "SELECT * FROM tbl_cne_estado WHERE id_estado = '".$res[$i][0]['estadodir']."'";
                        $objEst->buscar($sql, $conexion);
                        $res[$i][4]= $conexion->devolver_recordset() ;
                        $sql = "SELECT * FROM tbl_cne_municipio WHERE id_municipio = '".$res[$i][0]['municipiodir']."'";
                        $objMun->buscar($sql, $conexion);
                        $res[$i][5]= $conexion->devolver_recordset() ;
                    }else{
                        $sql = "SELECT * FROM estmundo WHERE idestmundo = '".$res[$i][0]['estadodir']."'";
                        $objEstMun->buscar($sql, $conexion);
                        $res[$i][4]= $conexion->devolver_recordset() ;
                        $res[$i][5]['nomb_municipio'] = "N/A";
                    }
                 }
             }else{
                 $res = 0;
             }
         }else{
             $res = 0;
         }
//    print_r($res);exit();
   

    $titulo = html_entity_decode("Desde: ".$desde."  Hasta: ".$hasta."   Fecha de: ".$fecCam,ENT_QUOTES,"ISO-8859-1")."  ".$conf;
    class PDF extends PDF_MC_Table{
        var $header = 0;
        function Header() {
           
            global $titulo;            
            if($this->header == 0){
                    $size = 50;
                    $absx = (320 - $size) / 2;
        //            $this->Image('img/fondoplanilla.jpg', 0,0  , 210,297);
                    $this->Image('img/orientedeportivo.jpeg', $absx, 5, 80);
                    $this->Ln(17);
                    $this->SetFont('Arial','B', 18);
                    $this->Cell(337, 10, html_entity_decode("XVI VUELTA AL GOLFO EN BICICLETA",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
                    $this->SetFont('Arial','I', 16);
                    $this->Cell(337, 8, html_entity_decode("En Homenaje a los 500 a&ntilde;os de Cuman&aacute;",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
                    $this->Ln(2);
                    $this->SetFont('Arial','B', 15);
                    $this->Cell(337, 10, html_entity_decode("Listado de Participantes",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
                    $this->Ln(2);
                    $this->Cell(337, 10, html_entity_decode($titulo,ENT_QUOTES,"ISO-8859-1"), 0,1,C);
            }else{
                    $size = 50;
                    $absx = (200 - $size) / 2;
                    $this->Image('img/orientedeportivo.jpeg', $absx, 5, 50);
                    $this->Ln(9);
                    $this->SetFont('Arial','B', 15);
                    $this->Cell(180, 5, html_entity_decode("XVI VUELTA AL GOLFO EN BICICLETA",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
                    $this->SetFont('Arial','I', 13);
                    $this->Cell(180, 5, html_entity_decode("En Homenaje a los 500 a&ntilde;os de Cuman&aacute;",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
                    $this->SetFont('Arial','B', 13);
                    $this->Cell(180, 5, html_entity_decode("Listado de Participantes Detallado",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
                    $this->Ln(2);
                    $this->Cell(180, 5, html_entity_decode($titulo,ENT_QUOTES,"ISO-8859-1"), 0,1,C);
                    $this->Ln(5);
            }
            
            $this->Ln(1);
        }
        
        function Footer() {
            $dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 7);
            $this->SetTextColor(128);
            $this->Cell(70,4,  html_entity_decode($dias[date('w')]).' '.date('j').' de '.$meses[date('n')-1].' de '.date('Y').' - '.date("H:i:s"),0,0,'L');
            $this->Cell(100,4, 'Generado por: Oriente Deportivo (http://www.orientedeportivo.com)', 0, 0, 'L',false,"http://www.orientedeportivo.com");
            $this->Cell(0, 4, 'Pagina '.$this->PageNo().'/{nb}', 0, 1, 'R');
        }
        function contenido($res){
            $this->SetFont('Arial','',8);
            $this->Ln(2);           
            $num = count($res);
            $this->Cell(190, 5,'Cantidad de Participantes Registrados: '.$num,0, 1, 'C');
            $this->Ln(1);
            if($num != 0){
                $this->SetFont('Arial','B',9);
                $this->SetFillColor(173,216,230);
                $this->Cell(8, 5,'Item',1, 0, 'C',true);
                $this->Cell(23, 5,html_entity_decode('C&eacute;dula',ENT_QUOTES,"ISO-8859-1"),1, 0, 'C',true);
                $this->Cell(60, 5,'Nombre y Apellido',1, 0, 'C',true);
                $this->Cell(50, 5,'Correo',1, 0, 'C',true);
                $this->Cell(25, 5,'Tipo trans.',1, 0, 'C',true);
                $this->Cell(25, 5,'Nro. trans.',1, 0, 'C',true);
                $this->Cell(21, 5,'Fecha trans.',1, 0, 'C',true);
                $this->Cell(60, 5,'Banco. Origen',1, 0, 'C',true);
                $this->Cell(50, 5,'Banco. Dstino',1, 0, 'C',true);
                $this->Cell(15, 5,'Nro.',1, 1, 'C',true);
                 $this->SetFont('Arial','',9);
                $this->header = 0;
                for($i = 0;$i < $num;$i++){
//                    if($i % 2 == 0){
//                        $this->SetFillColor(255,255,255);
//                    }else{
//                        $this->SetFillColor(0,191,255);
//                    }
                    $cedPersona = $res[$i][0]['nac'].' - '.number_format($res[$i][0]['cedula'],'0','','.');
                    $nomPersona = ucwords(strtolower(utf8_decode($res[$i][0]['nombre'].' '.$res[$i][0]['apellido'])));
                    $telMovil = $res[$i][0]['celular'];
                    $telFijo = $res[$i][0]['telefonofijo'];
                    $fechaNac = substr($res[$i][0]['fechanac'],8,2).'/'.substr($res[$i][0]['fechanac'],5,2).'/'.substr($res[$i][0]['fechanac'],0,4);
                    $edad = 'calcular';
                    $coreo = $res[$i][0]['correo'];
                    $club = $res[$i][0]['club'];
                    
                    $tipTrans = ucwords(strtolower($res[$i][0]['tipotrans']));             
                    $nroTrans = $res[$i][0]['nrotrans'];
                    $fecTrans = substr($res[$i][0]['fechatrans'],8,2).'/'.substr($res[$i][0]['fechatrans'],5,2).'/'.substr($res[$i][0]['fechatrans'],0,4);
                    $bcoDest = utf8_decode($res[$i][2]['nombanco']);
                    if($res[$i][1]['nombanco'] != ''){
                        $bcoOrig = utf8_decode($res[$i][1]['nombanco']);
                    }else{
                        $bcoOrig = "N/A";
                    }
                    
                    $genero = $res[$i][0]['genero'];
//                    $talla = $res[$i][0]['talla'];
                    $numero = $res[$i][0]['numero'];
                    $nume = ($i+1);
                    $this->tam = 'Legal';
                    $this->SetWidths(array(8,23,60,50,25,25,21,60,50,15)); 
                    $this->SetAligns(array('C','R','L','C','C','C','C','C','C','C'));
                    $this->Row(array($nume,$cedPersona,$nomPersona,$coreo,$tipTrans,$nroTrans,$fecTrans,$bcoOrig,$bcoDest,$numero));    
                    
                } 
                
                /*********************************************************/
                $this->header = 1;
                $this->AddPage();
                $this->Ln();
                for($i = 0;$i < $num;$i++){                 
                    
                    $this->SetFillColor(173,216,230);
                    $numero = $res[$i][0]['numero'];
                    $confirmado = $res[$i][0]['confirmado']; 
                    $this->SetFont('Arial','',9);
                    $this->SetFont('Arial','B',15);
                    $this->Cell(50, 5,html_entity_decode('N&uacute;mero Asignado: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',15);
                    $this->Cell(95, 5,$numero,1, 0, 'L');
                    $this->SetFont('Arial','B',10);
                    $this->Cell(35, 5,'Pago confirmado: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                     $this->Cell(10, 5,  strtoupper($confirmado),1, 1, 'C');
                    $cedPersona = $res[$i][0]['nac'].' - '.number_format($res[$i][0]['cedula'],'0','','.');
                    $this->SetFont('Arial','B',10);
                    $this->Cell(40, 5,html_entity_decode('N&uacute;mero de C&eacute;dula: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(35, 5,$cedPersona,1, 0, 'L');
                    $nomPersona = ucwords(strtolower(utf8_decode($res[$i][0]['nombre'].' '.$res[$i][0]['apellido'])));
                    $this->SetFont('Arial','B',10);
                    $this->Cell(35, 5,'Nombre y Apellido: ',1,0, 'L');
                     $this->SetFont('Arial','',10);
                    $this->Cell(0, 5,$nomPersona,1, 1, 'L');
                    $this->SetFont('Arial','B',10);
                    $telMovil = $res[$i][0]['celular'];
                    $this->Cell(40, 5,html_entity_decode('Tel&eacute;fono Movil: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(35, 5,$telMovil,1, 0, 'L');
                    $this->SetFont('Arial','B',10);
                    $telFijo = $res[$i][0]['telefonofijo'];
                    $this->Cell(35, 5,html_entity_decode('Tel&eacute;fono Fijo: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(0, 5,$telFijo,1, 1, 'L');
                    $this->SetFont('Arial','B',10);
                    $fechaNac = substr($res[$i][0]['fechanac'],8,2).'/'.substr($res[$i][0]['fechanac'],5,2).'/'.substr($res[$i][0]['fechanac'],0,4);
                    $this->Cell(40, 5,'Fecha de Nacimiento: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(35, 5,$fechaNac,1, 0, 'L');
                    $this->SetFont('Arial','B',10);
                    $correo = $res[$i][0]['correo'];
                    $this->Cell(35, 5,'Correo: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(0, 5,$correo,1, 1, 'L');
                    $this->SetFont('Arial','B',10);
                    $genero = $res[$i][0]['genero'];
                    $this->Cell(40, 5,html_entity_decode('G&eacute;nero: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(35, 5,$genero,1,0 , 'L');
                    $this->SetFont('Arial','B',10);
                    $talla = $res[$i][0]['talla'];
                    $this->Cell(35, 5,'Talla: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(0, 5,$talla,1, 1, 'L');
                    
                    $this->SetFont('Arial','B',10);
                    $club = $res[$i][0]['club'];
                    $this->Cell(40, 5,'Club: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(0, 5,$club,1, 1, 'L');
                    
                     if($res[$i][1]['nombanco'] != ''){
                        $bcoOrig = $res[$i][1]['nombanco'];
                    }else{
                        $bcoOrig = "N/A";
                    }
                    $this->SetFont('Arial','B',10);
                    $this->Cell(40, 5,'Banco Origen: ',1,0, 'L');
                    $bcoDest = $res[$i][2]['nombanco'];
                    $this->SetFont('Arial','',10);
                    $this->Cell(0, 5,  utf8_decode($bcoOrig),1, 1, 'L');
                    $this->SetFont('Arial','B',10);
                    $this->Cell(40, 5,'Banco Destino: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                     $this->Cell(0, 5,utf8_decode($bcoDest),1, 1, 'L');
                     $this->SetFont('Arial','B',10);
                    $tipTrans = ucwords(strtolower($res[$i][0]['tipotrans']));
                    $this->Cell(40, 5,html_entity_decode('Tipo de Transacci&oacute;n: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',10);
                     $this->Cell(28, 5,$tipTrans,1, 0, 'L');
                    $nroTrans = $res[$i][0]['nrotrans'];
                    $this->SetFont('Arial','B',10);
                    $this->Cell(38, 5,html_entity_decode('Nro. de Transacci&oacute;n: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',10);
                     $this->Cell(25, 5,$nroTrans,1, 0, 'L');
                     $this->SetFont('Arial','B',10);
                    $fecTrans = substr($res[$i][0]['fechatrans'],8,2).'/'.substr($res[$i][0]['fechatrans'],5,2).'/'.substr($res[$i][0]['fechatrans'],0,4);
                    $this->Cell(40, 5,html_entity_decode('Fecha de Transacci&oacute;n: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(0, 5,$fecTrans,1, 1, 'L');
                    $this->SetFont('Arial','B',10);
                    $nomPais = ucwords(strtolower($res[$i][3]['nompais']));
                    $this->Cell(12, 5,html_entity_decode('Pa&iacute;s: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(43, 5,  utf8_decode($nomPais),1, 0, 'L');
                    
                    $this->SetFont('Arial','B',10);
                    if($res[$i][0]['pais'] == '189'){
                        $nomEst = ucwords(strtolower($res[$i][4]['nomb_estado']));
                    }else{
                        $nomEst = ucwords(strtolower($res[$i][4]['nomestmundo']));
                    }
                    $this->Cell(15, 5,'Estado: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(50, 5,  utf8_decode($nomEst),1, 0, 'L');                  
                    $this->SetFont('Arial','B',10);
                    $nomMun = ucwords(strtolower($res[$i][5]['nomb_municipio']));
                    $this->Cell(20, 5,'Municipio: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(50, 5,  utf8_decode($nomMun),1, 1, 'L');
                     $this->SetFont('Arial','B',10);
                    $direccion = ucwords(strtolower($res[$i][0]['direccion']));
                     $this->Cell(35, 5,html_entity_decode('Direcci&oacute;n: ',ENT_QUOTES,"ISO-8859-1"),1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(0, 5,  utf8_decode($direccion),1, 1, 'L');
                    $this->SetFont('Arial','B',10);
                    $fecReg = substr($res[$i][0]['fechareg'],8,2).'/'.substr($res[$i][0]['fechareg'],5,2).'/'.substr($res[$i][0]['fechareg'],0,4);;
                    $this->Cell(35, 5,'Fecha de Registro: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(50, 5,  $fecReg,1, 0, 'L');
                     $this->SetFont('Arial','B',10);
                    $horReg = $res[$i][0]['horareg'];
                    $this->Cell(35, 5,'Hora de Registro: ',1, 0, 'L');
                    $this->SetFont('Arial','',10);
                    $this->Cell(0, 5,  $horReg,1, 1, 'L');
                    $this->Ln(17);
                } 
            }else{
                $this->SetFont('Arial','B',20);
                $this->Cell(180, 5,'NO EXISTEN REGISTROS PARA MOSTRAR', 0, 1, 'C');
            }
        }
    }
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage('L','Legal');
    $pdf->contenido($res);
    $nombre = "permisos.pdf";
    $pdf->Output($nombre,"I");
?>