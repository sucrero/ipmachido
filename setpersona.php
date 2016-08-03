<?php

////////////////
//                        $nomcompleto = strip_tags(ucwords(strtolower($_REQUEST['nombre'])).' '.ucwords(strtolower($_REQUEST['apellido'])));
////            $destinatario = strip_tags(strtolower($_REQUEST['email']));
//                        $destinatario = 'franco.oswaldo@gmail.com';
//                        $nomdetinatario = $nomcompleto;
//                        $remitente = 'inscripcion@orientedeportivo.com';
//                        $nomremitente = 'Sistema de Registro';
//                        $nomresponder = $nomremitente;
//                        $mailresponder = $remitente;
//    //            $mensaje = strip_tags($_REQUEST['mensaje']);
//                        $adjunto = '';
//                        $nomadjunto = '';
//                        $asunto = 'Registro XVI Vuelta al Golfo';
//                        $cuerpo = '<table border="0px" width="700px" cellpadding="10" cellspacing="0" align="center" style="font-family: Arial; font-size: 20px;">
//                           <tr>
//                               <td colspan="2" align="center">
//                                   <img src="http://www.orientedeportivo.com/registro/img/orientedeportivolineas.png" width="300px" alt="logo_orientedeportivo" galleryimg="no">
//                               </td>
//                           </tr>
//                         <tr>
//                             <td colspan="2" align="center" style="font-size: 30px;"><strong>Confirmaci&oacute;n de Registro</strong></td>
//                         </tr>
//                         <tr>
//                             <td colspan="2" align="center"></td>
//                         </tr>
//                         <tr>
//                             <td colspan="2" align="left">Estimado Sr(a). <strong>'.$nomcompleto.'</strong></td>
//                         </tr>
//                         <tr>
//                             <td colspan="2" style="text-align: justify;">Su inscripci&oacute;n al evento <strong>"XVI Vuelta al Golfo en Bicicleta en Homenaje a los 500 a&ntilde;os de Cuman&aacute;"</strong> est&aacute; siendo procesada, en lo que se verifique el pago se le notificar&aacute; la aprobaci&oacute;n de la misma con su respectivo n&uacute;mero de participante.</td>
//                         </tr>
//                         <tr>
//                             <td colspan="2" style="text-align: justify;"></td>
//                         </tr>
//                         <tr>
//                             <td colspan="2" align="center" style="font-size: 15px;">Gracias por registrarse con nosotros</td>
//                         </tr>
//                         <tr>
//                             <td colspan="2" style="text-align: justify;"></td>
//                         </tr>
//                         <tr>
//                             <td colspan="2" align="center" style="font-size: 10px;"><strong>Por favor no responder este mensaje, esta es una cuenta de correo no monitoreada</strong></td>
//                         </tr>
//                     </table>';
//    //
//                        $res = $objMail->sendmail($remitente, $nomremitente, $destinatario, $nomdetinatario,$mailresponder,$nomresponder, $cuerpo, $asunto, $adjunto, $nomadjunto);
//                        $cuerpo2 = '<table border="0px" width="700px" cellpadding="10" cellspacing="0" align="center" style="font-family: Arial; font-size: 20px;">
//                               <tr>
//                                   <td colspan="2" align="center">
//                                       <img src="http://www.orientedeportivo.com/registro/img/orientedeportivolineas.png" width="300px" alt="logo_orientedeportivo" galleryimg="no">
//                                   </td>
//                               </tr>
//                             <tr>
//                                 <td colspan="2" align="center" style="font-size: 30px;"><strong>Aviso de Registro</strong></td>
//                             </tr>
//                             <tr>
//                                 <td colspan="2" align="center"></td>
//                             </tr>
//                             <tr>
//                                 <td colspan="2" align="left"></td>
//                             </tr>
//                             <tr>
//                                 <td colspan="2" style="text-align: justify;">El Sr(a). '.$nomcompleto.', portador(a) de la C&eacute;dule de Identidad Nro. '.$_REQUEST['nacionalidad'].' - '.number_format($_REQUEST['cedula'],'0','','.').', se ha inscrito desde el estado '. ucwords(strtolower( utf8_decode($estado[2]))).' al evento <strong>"XVI Vuelta al Golfo en Bicicleta en Homenaje a los 500 a&ntilde;os de Cuman&aacute;"</strong>.</td>
//                             </tr>
//                             <tr>
//                                 <td colspan="2" style="text-align: justify;"></td>
//                             </tr>
//                             <tr>
//                                 <td colspan="2" align="center" style="font-size: 15px;"></td>
//                             </tr>
//                             <tr>
//                                 <td colspan="2" style="text-align: justify;"></td>
//                             </tr>
//                             <tr>
//                                 <td colspan="2" align="center" style="font-size: 10px;"><strong>Por favor no responder este mensaje, esta es una cuenta de correo no monitoreada</strong></td>
//                             </tr>
//                         </table>';
//                        $asunto = 'Aviso de Registro XVI Vuelta al Golfo';
//                        $res = $objMail->sendmail($remitente, $nomremitente, $remitente, $nomremitente,$mailresponder,$nomresponder, $cuerpo2, $asunto, $adjunto, $nomadjunto);

                    //////////////