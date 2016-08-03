<?php
//    header("Content-type: text/html; encoding: UTF-8");
//    require 'clases/PDF_MC_Table.php';
require_once './fpdf/fpdf.php';
//    include_once 'clases/Personal.php';
//    include_once 'clases/Banco.php';
//    include_once 'conexion/conexion.php';
//    $objPer = new Personal();
//    $objBan = new Banco();
    
//    $datos = explode('=', $_REQUEST['datos']);
//    $pais = $datos[0];
//    $estado = $datos[1];
//    $municipio = $datos[2];
//    if($datos[3] == 'TODOS'){
//        $partwhere = "";
//    }elseif($datos[3] == 'CONFIRMADO'){
//        $partwhere = " AND confirmado = 'si'";
//    }else{
//         $partwhere = " AND confirmado = 'no'";
//    }
//    if($pais != 0){
//        if($pais == 189){
//            if($estado != 0){
//                if($municipio != 0){
//                    $sql = "SELECT p.*,i.nompais,e.nomb_estado,m.nomb_municipio FROM participante as p
//                            INNER JOIN pais as i ON (p.pais = i.idpais) 
//                            INNER JOIN tbl_cne_estado as e ON (p.estadodir = e.id_estado)
//                            INNER JOIN tbl_cne_municipio as m ON (p.municipiodir = m.id_municipio)
//                            WHERE pais = '".$pais."' AND estadodir = '".$estado."' AND municipiodir = '".$municipio."'".$partwhere." ORDER BY nombre,apellido ASC";
//                }else{
//                    $sql = "SELECT p.*,i.nompais,e.nomb_estado FROM participante as p
//                            INNER JOIN pais as i ON (p.pais = i.idpais) 
//                            INNER JOIN tbl_cne_estado as e ON (p.estadodir = e.id_estado)
//                            WHERE pais = '".$pais."' AND estadodir = '".$estado."'".$partwhere." ORDER BY nombre,apellido ASC";
//                }
//            }else{
//                $sql = "SELECT p.*,i.nompais FROM participante as p
//                            INNER JOIN pais as i ON (p.pais = i.idpais)
//                            WHERE pais = '".$pais."'".$partwhere." ORDER BY nombre,apellido ASC";
//            }
//        }else{
//            if($estado != 0){
//                $sql = "SELECT p.*,i.nompais,e.nomestmundo FROM participante as p
//                            INNER JOIN pais as i ON (p.pais = i.idpais) 
//                            INNER JOIN estmundo as e ON (p.estadodir = e.idestmundo)
//                            WHERE pais = '".$pais."' AND estadodir = '".$estado."'".$partwhere." ORDER BY nombre,apellido ASC";
//            }else{
//                $sql = "SELECT p.*,i.nompais FROM participante as p
//                            INNER JOIN pais as i ON (p.pais = i.idpais) 
//                            WHERE pais = '".$pais."'".$partwhere." ORDER BY nombre,apellido ASC";
//            }
//
//        }
//    }else{
//        if($datos[0] == 'TODOS'){
//            $partwhere = "";
//        }elseif($datos[0] == 'CONFIRMADO'){
//            $partwhere = " WHERE confirmado = 'si'";
//        }else{
//            $partwhere = " WHERE confirmado = 'no'";
//        }
//        $sql = "SELECT * FROM participante".$partwhere."  ORDER BY nombre,apellido ASC";
//    }
//
//    if($objPer->buscarPer($sql, $conexion)){
//        if($conexion->registros > 0){                           
//            $i = 0;
//            do{
//                $res[$i][0] = $conexion->devolver_recordset();
//                $i++;
//            }while(($conexion->siguiente()) && ($i != $conexion->registros));
//            for($i = 0 ;$i < count($res);$i++){
//                $sql = "SELECT * FROM banco WHERE idbanco = '".$res[$i][0]['banco']."'";
//                $objBan->buscar($sql, $conexion);
//                $res[$i][1] = $conexion->devolver_recordset();
//                $sql = "SELECT * FROM banco WHERE idbanco = '".$res[$i][0]['bancodest']."'";
//                $objBan->buscar($sql, $conexion);
//                $res[$i][2]= $conexion->devolver_recordset();
//            }
//        }else{
//            $res = 0;
//        }
//    }else{
//        $res = 0;
//    }
//    $titulo = "aqui va el titulo";
//    class PDF extends PDF_MC_Table{
//        function Header() {
//            global $titulo;            
//            $size = 15;
////            $absx = (210 - $size) / 2;
//            $this->SetFont('Arial','', 7);
//            $this->Image('img/orientedeportivolineas.jpg', $absx, 5, $size);
//            $this->SetFont('Arial','B', 25);
//            $this->Cell(190, 10, "XVI VUELTA AL GOLFO EN BICICLETA", 0,1,C);
//            $this->SetFont('Arial','I', 18);
//            $this->Cell(190, 8, html_entity_decode("En Homenaje a los 500 a&ntilde;os de Cuman&aacute;",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
//            $this->Ln(15);
//            $this->SetFont('Arial','B', 18);
//            $this->Cell(190, 10, html_entity_decode("Listado de Participantes",ENT_QUOTES,"ISO-8859-1"), 0,1,C);
//            $this->Ln(18);
////            $this->SetFont('Arial', 'B', 12);
////            $this->Cell(190, 8, $titulo,0, 0, 'C');
////            $this->Ln(15);
//        }
//        
//        function Footer() {
//            $dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
//            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//            $this->SetY(-15);
//            $this->SetFont('Arial', 'I', 7);
//            $this->SetTextColor(128);
//            $this->Cell(40,4,  html_entity_decode($dias[date('w')]).' '.date('j').' de '.$meses[date('n')-1].' de '.date('Y').' - '.date("H:i:s"),0,0,'L');
//            $this->Cell(50,4, 'Impreso por: '.$_SESSION['nombre'], 0, 0, 'C');
//            $this->Cell(80,4, 'Generado por: Oriente Deportivo (http://www.orientedeportivo.com)', 0, 0, 'R',false,"http://www.orientedeportivo.com");
//            $this->Cell(0, 4, 'Pagina '.$this->PageNo().'/{nb}', 0, 1, 'R');
//        }
//        function contenido($res){
//            $this->SetFont('Arial','',8);
//            $this->Ln(2);           
//            $num = count($res);
//            $this->Cell(190, 5,'Cantidad de Participantes: '.$num,0, 1, 'C');
//            $this->Ln(1);
//            if($res != 0){
//                $this->SetFont('Arial','B',7);
//                $this->SetFillColor(173,216,230);
//                $this->Cell(8, 5,'Nro.',1, 0, 'C',true);
//                $this->Cell(19, 5,'Cedula',1, 0, 'C',true);
//                $this->Cell(53, 5,'Nombre y Apellido',1, 0, 'C',true);
//                $this->Cell(37, 5,'Telf. Movil',1, 0, 'C',true);
//                $this->Cell(37, 5,'Telf. Fijo',1, 0, 'C',true);
//                $this->Cell(18, 5,'Fecha Nac.',1, 0, 'C',true);
//                $this->Cell(18, 5,'Edad',1, 1, 'C',true);
//                $this->Cell(18, 5,'Correo',1, 1, 'C',true);
//                $this->Cell(18, 5,'Club',1, 1, 'C',true);
//                $this->Cell(18, 5,'Pais',1, 1, 'C',true);
//                $this->Cell(18, 5,'Estado',1, 1, 'C',true);
//                $this->Cell(18, 5,'Municipio',1, 1, 'C',true);
//                $this->Cell(18, 5,'Direccion',1, 1, 'C',true);
//                $this->Cell(18, 5,'Fecha y Hora Registro',1, 1, 'C',true);
//                $this->Cell(18, 5,'Tipo transaccion',1, 1, 'C',true);
//                $this->Cell(18, 5,'Nro. transaccion',1, 1, 'C',true);
//                $this->Cell(18, 5,'Tipo transaccion',1, 1, 'C',true);
//                $this->Cell(18, 5,'Fecha transaccion',1, 1, 'C',true);
//                $this->Cell(18, 5,'Banco destino',1, 1, 'C',true);
//                $this->Cell(18, 5,'Banco Origen',1, 1, 'C',true);
//                $this->Cell(18, 5,'Genero',1, 1, 'C',true);
//                $this->Cell(18, 5,'Talla',1, 1, 'C',true);
//                $this->Cell(18, 5,'Numero asignado',1, 1, 'C',true);
//                $this->Cell(18, 5,'Confirmado',1, 1, 'C',true);
////                $this->SetFont('Arial','',7);
////                $a = $e = $ne =0;
////                for($i = 0;$i < $num;$i++){
////                    if($i % 2 == 0){
////                        $this->SetFillColor(255,255,255);
////                    }else{
////                        $this->SetFillColor(0,191,255);
////                    }
////                    $cedPersona = number_format($res[$i]['p']['cedper'],'0','','.');
////                    $nomPersona = ucwords(strtolower(utf8_decode($res[$i]['p']['nomper'].' '.$res[$i]['p']['apeper'])));
////                                       
////                    $nume = ($i+1);
////                    
////                    $desc = ucwords(strtolower(utf8_decode($res[$i]['descripcionper'])));
////                    $tipo = ucwords(strtolower(utf8_decode(html_entity_decode($res[$i]['m']['descper']))));
////                    $desde = substr($res[$i]['desde'],8,2).'/'.substr($res[$i]['desde'],5,2).'/'.substr($res[$i]['desde'],0,4);
////                    $hasta = substr($res[$i]['hasta'],8,2).'/'.substr($res[$i]['hasta'],5,2).'/'.substr($res[$i]['hasta'],0,4);
////                    
////                    $this->SetWidths(array(8,19,53,37,37,18,18));
////                    $this->SetAligns(array('C','R','L','J','L','C','C'));
////                    $this->Row(array($nume,$cedPersona,$nomPersona,$desc,$tipo,$desde,$hasta));
////                                      
////                } 
//                $this->Ln(5);
////                $total = $a+$e+$ne;
////                
////                $porcA = ($a*100)/$total;
////                $porcE = ($e*100)/$total;
////                $porcNE = ($ne*100)/$total;
////                
////              
////                //GRAFICO
////                include '../jpgraph/src/jpgraph.php';
////                include '../jpgraph/src/jpgraph_pie.php';
////                include '../jpgraph/src/jpgraph_pie3d.php';
////                
////                
////                $data = array($porcA,$porcE,$porcNE);
////                
////                $grafico = new PieGraph(500, 300, "auto");
////                $grafico->SetShadow();
//////                $grafico->title->Set("Notificaciones Registradas");
////                $grafico->title->SetFont(FF_FONT1,FS_BOLD);
////                
////                $torta = new PiePlot3D($data);
////                $torta->SetShadow();
////                $torta->SetSize(0.3);
////                $torta->SetCenter(0.5);
////                $torta->SetLegends(array("Asignadas","Entregadas", "No Entregadas"));
////                
////                $grafico->Add($torta);
////      
////                $img = $grafico->Stroke( _IMG_HANDLER);
////                $filename = "chart.png";
////                $grafico->img->Stream($filename);
////                $this->Image($filename);
//                //FIN GRAFICO
//                
//            }else{
//                $this->SetFont('Arial','B',20);
//                $this->Cell(180, 5,'NO EXISTEN REGISTROS PARA MOSTRAR', 0, 1, 'C');
//            }
//        }
//    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
//    $this->Cell(180, 5,'NO EXISTEN REGISTROS PARA MOSTRAR', 0, 1, 'C');
//    $pdf->contenido($datos);
//    $nombre = 'listado.pdf';
    $pdf->Output();
?>