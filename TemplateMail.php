<?php
    header("Content-type: text/html; encoding: UTF-8"); 
    include_once 'conexion/conexion.php';
    include_once 'clases/fpdf/fpdf.php';
    include_once 'clases/Personal.php';
    include_once 'clases/Banco.php';
    include_once 'clases/Enviarmail.php';
    
    $objPer = new Personal();
    $objBan = new Banco();

    class PDF extends FPDF{
        function Header() {
//            global $titulo;            
            $size = 50;
            $absx = (210 - $size) / 2;
            $this->Image('img/fondoplanilla.jpg', 0,0  , 210,297);
//            $this->Image('img/orientedeportivo.jpeg', $absx, 5, 50);
            $this->Ln(15);
            $this->SetFont('Arial','B', 25);
            $this->Cell(190, 10, html_entity_decode("XVI VUELTA AL GOLFO EN BICICLETA",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
            $this->SetFont('Arial','I', 18);
            $this->Cell(190, 8, html_entity_decode("En Homenaje a los 500 a&ntilde;os de Cuman&aacute;",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
            $this->Ln(15);
            $this->SetFont('Arial','B', 18);
            $this->Cell(190, 10, html_entity_decode("Planilla de Inscripci&oacute;n",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
            $this->Ln(18);
        }
        
        function Footer() {
            $this->SetY(-50);
            $this->SetFont('Arial', '', 8);
            $dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 7);
//            $this->SetTextColor(128);
            $this->Cell(60,4,  html_entity_decode($dias[date('w')],ENT_QUOTES,"ISO-8859-1").' '.date('j').' de '.$meses[date('n')-1].' de '.date('Y').' - '.date("H:i:s"),0,0,'L');
            $this->Cell(0,4, 'Generado por: Oriente Deportivo (http://www.orientedeportivo.com)', 0, 1, 'R',false,"http://www.orientedeportivo.com");
//            $this->Cell(0, 4, 'Pagina '.$this->PageNo().'/{nb}', 0, 1, 'R');
        }
        function contenido($res){
            
            $this->SetFont('Arial','',15);
            $this->Ln(1);
            if($res != 0){
                $this->SetFont('Arial','',13);
                $txt = html_entity_decode("Estimado(a) Sr. (a) ".ucwords(strtolower($res[0]['nombre'].' '.$res[0]['apellido'])).", portador(a) de la C&eacute;dula de Identidad Nro. ".
                        $res[0]['nac'].'-'.number_format($res[0]['cedula'],'0','','.').", su pago ha sido CONFIRMADO, por lo tanto queda usted registrado como participante de la \"XVI Vuelta al Golfo en Bicicleta\".",ENT_QUOTES,"ISO-8859-1");
                $this->MultiCell(0,7,$txt);
                $this->Ln(10);
                $this->SetFont('Arial','B',13);
                $this->Cell(10, 7,'', 0, 0, 'L');
                $this->Cell(48, 7,'Nro. de Participante: ', 0, 0, 'L');
                $this->SetFont('Arial','',13);
                $this->Cell(132, 7,$res[3], 0, 1, 'L');
                $this->SetFont('Arial','B',13);
                $this->Cell(10, 7,'', 0, 0, 'L');
                $this->Cell(42, 7,'Fecha del evento: ', 0, 0, 'L');
                $this->SetFont('Arial','',13);
                $this->Cell(138, 7,'17 de Octubre de 2015', 0, 1, 'L');
                $this->SetFont('Arial','B',13);
                $this->Cell(10, 7,'', 0, 0, 'L');
                $this->Cell(18, 7,'Salida: ', 0, 0, 'L');
                $this->SetFont('Arial','',13);
                $this->Cell(162, 7,'6:00 am', 0, 1, 'L');
                $this->SetFont('Arial','B',13);
                $this->Cell(10, 7,'', 0, 0, 'L');
                $this->Cell(26, 7,'Recorrido: ', 0, 0, 'L');
                $this->SetFont('Arial','',13);
                $this->Cell(154, 7,'190 Km', 0, 1, 'L');
                $this->SetFont('Arial','B',13);
                $this->Cell(10, 7,'', 0, 0, 'L');
                $this->Cell(38, 7,'Lugar de salida: ', 0, 0, 'L');
                $this->SetFont('Arial','',13);
                $this->Cell(142, 7,html_entity_decode('Terminal de Ferry (NAVIARCA), Cuman&aacute;. Edo. Sucre.',ENT_QUOTES,"ISO-8859-1"), 0, 1, 'L');
                $this->Ln(10);
                $this->SetFont('Arial','',13);
                $txt = html_entity_decode("Esta inscripci&oacute;n le da derecho a la atenci&oacute;n en el recorrido (hidrataci&oacute;n, refrigerios, transporte, cami&oacute;n para las bicicletas, ambulancia, motorizados de seguridad, traslado Araya-Cuman&aacute;)",ENT_QUOTES,"ISO-8859-1");
                $this->MultiCell(0,7,$txt);
                $this->Ln(15);
                $this->SetFont('Arial','B',13);
                $this->Cell(190, 7,'NOTA: EL USO DE CASCO Y GUANTES ES OBLIGATORIO', 0, 1, 'C');
            }else{
                $this->SetFont('Arial','B',20);
                $this->Cell(180, 5,'NO EXISTEN REGISTROS PARA MOSTRAR', 0, 1, 'C');
            }
        }
    }
    $cod = $_REQUEST['datos'];
    $datos = explode("=", $cod);
    $cant = count($datos);
    if($cant > 1){
        $check = 0;
        for($i = 0; $i < $cant; $i++){
            $sql = "SELECT * FROM participante WHERE id='".(int)$datos[$i]."'";
            if($objPer->buscarPer($sql, $conexion)){
                if($conexion->registros>0){
                    $dat[0] = $conexion->devolver_recordset();
                    if($dat[0]['confirmado'] == 'no'){
                        $dat[3] = $objPer->maxId($conexion);
                        $sql = "UPDATE participante SET numero = ".$dat[3].", confirmado = 'si' WHERE id = '".(int)$datos[$i]."'";
                        $objPer->modificarPer($sql, $conexion); 
                        $res = 1;
                    }else{
                        $dat[3] = $dat[0]['numero'];
                    }
                }else{
                    $res = 4;
                }
            }else{
                $res = 5;
            }
            if($res == 1){
                $pdf = new PDF();
                $pdf->AliasNbPages();
                $pdf->SetAutoPageBreak(true, 25);
                $pdf->AddPage();
                $pdf->contenido($dat);
                $nombre = 'planilla.pdf';
                $pdf->Output($nombre,'F');
                //####################### DATOS DEL CORREOA ENVIAR ##############################################################
                $objMail = new Enviarmail();
                $nomcompleto = strip_tags(ucwords(strtolower(html_entity_decode($dat[0]['nombre'].' '.$dat[0]['apellido'],ENT_QUOTES,"ISO-8859-1"))));
                $mailresponder = 'inscripciones@orientedeportivo.com';
                $destinatario = strip_tags(strtolower($dat[0]['correo']));
                $nomdestinatario = $nomcompleto;
                $nomresponder = 'Sistema de Registro';
                $remitente = 'inscripciones@orientedeportivo.com';
                $nomremitente = 'Sistema de Registro';
                $cuerpo = 'Se adjunta planilla de inscripción';
                $adjunto = 'planilla.pdf';
                $nomadjunto = 'Planilla de Inscripcion.pdf';
                $asunto = 'Inscripción XVI Vuelta al Golfo en Bicicleta';
                $res = $objMail->sendmail($remitente, $nomremitente, $destinatario, $nomdestinatario, $mailresponder, $nomresponder, $cuerpo, $asunto, $adjunto, $nomadjunto);
//                print_r($res);exit();
                if($res == 1){
                    $check++;
                }     
            }
        }
        if($check == $cant){
            $res = 1;
        }else{
            $res = 0;
        }
    }else{
        $sql = "SELECT * FROM participante WHERE id='".(int)$datos[0]."'";        
        if($objPer->buscarPer($sql, $conexion)){
            if($conexion->registros>0){
                $dat[0] = $conexion->devolver_recordset();
                if($dat[0]['confirmado'] == 'no'){
                    $dat[3] = $objPer->maxId($conexion);
                    $sql = "UPDATE participante SET numero = ".$dat[3].", confirmado = 'si' WHERE id = '".(int)$datos[0]."'";
                    $objPer->modificarPer($sql, $conexion); 
                    $res = 1;
                }else{
                    $dat[3] = $dat[0]['numero'];
                    $res = 1;
                }
            }else{
                $res = 0;
            }
        }else{
            $res = 0;
        }
//        var_dump($res);exit();
        if($res == 1){
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->SetAutoPageBreak(true, 25);
            $pdf->AddPage();
            $pdf->contenido($dat);
            $nombre = 'planilla.pdf';
            $pdf->Output($nombre,'F');
            //####################### DATOS DEL CORREOA ENVIAR ##############################################################
            $objMail = new Enviarmail();
            $nomcompleto = strip_tags(ucwords(strtolower(html_entity_decode($dat[0]['nombre'].' '.$dat[0]['apellido'],ENT_QUOTES,"ISO-8859-1"))));
            $mailresponder = 'inscripciones@orientedeportivo.com';
            $destinatario = strip_tags(strtolower($dat[0]['correo']));
            $nomdestinatario = $nomcompleto;
            $nomresponder = 'Sistema de Registro';
            $remitente = 'inscripciones@orientedeportivo.com';
            $nomremitente = 'Sistema de Registro';
            $cuerpo = 'Se adjunta planilla de inscripción';
            $adjunto = 'planilla.pdf';
            $nomadjunto = 'Planilla de Inscripcion.pdf';
            $asunto = 'Inscripción XVI Vuelta al Golfo en Bicicleta';
            $res = $objMail->sendmail($remitente, $nomremitente, $destinatario, $nomdestinatario, $mailresponder, $nomresponder, $cuerpo, $asunto, $adjunto, $nomadjunto);
//            echo $res;
            //####################### DATOS DEL CORREOA ENVIAR ##############################################################
        }else{
            $res = 0;
        }
    }
    echo $res;
?>
