<form class="well form-horizontal" id="formUsuario">
                <fieldset>
                  <legend>Registro de Participante
<!--                  <div class="pull-right">
                    <a class="btn btn-primary" href="index.php">
                        <i class="icon-home icon-white"></i>
                            Inicio
                    </a>
                  </div>-->
                <!-- Nav tabs -->
                  <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#personales" aria-controls="personales" role="tab" data-toggle="tab">Datos Personales</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
      <!-- INICIO TAB REGISTRO DATOS PERSONALES -->
        <div role="tabpanel" class="tab-pane active" id="personales">
            <div class="control-group">
                <label class="control-label" for="itxtcedula">C&eacute;dula</label>
                <div class="controls">
                    <div class="input-append">
                        <select class="form-control span4">
                        <option>V</option>
                        <option>E</option>
                      </select>
                    <input type="text" class="span12" placeholder="Ingrese una c&eacute;dula" id="itxtcedula" name="C&eacute;dula" onkeyup="accionUsu(event);"   maxlength="8" onKeyPress="return numeros(event);" autofocus>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="itxtnombre">Nombres</label>
                <div class="controls">
                    <input type="text" class="span7" placeholder="Ingrese un nombre" id="itxtnombre" name="Nombre" onKeyPress="return letras(event);">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="itxtapellido">Apellidos</label>
                <div class="controls">
                    <input type="text" class="span7" placeholder="Ingrese un apellido" id="itxtapellido" name="Apellido" onKeyPress="return letras(event);">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="dp1">Fecha de Nacimiento</label>
                <div class="controls">
<!--                    <div class="input-prepend span12">-->
                        <input type="text" class="span7" value="<?php echo date('d/m/Y'); ?>" data-date-format="dd/mm/yyyy" id="fecharg1"/>
                    <!--</div>-->
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txttelefijo">Tel&eacute;fono Fijo</label>
                <div class="controls">
                    <!--<div class="input-prepend span11">-->
                        <input type="text" class="span7" maxlength="11" placeholder="Ingrese un n&uacute;mero de tel&eacute;fono fijo" id="txttelefono" name="Tel&eacute;fono" onKeyPress="return numeros(event);">
                    <!--</div>-->
                </div>

            </div>
            <div class="control-group">
                <label class="control-label" for="txttelemovil">Tel&eacute;fono M&oacute;vil</label>
                <div class="controls">
                    <!--<div class="input-prepend span11">-->
                        <input type="text" class="span7" maxlength="11" placeholder="Ingrese un n&uacute;mero de tel&eacute;fono m&oacute;vil" id="txttelefono" name="Tel&eacute;fono" onKeyPress="return numeros(event);">
                    <!--</div>-->
                </div>

            </div>
            <div class="control-group">
                <label class="control-label" for="txtemail">Correo Electr&oacute;nico</label>
                <div class="controls">
                    <!--<div class="input-prepend span11">-->
                        <input type="text" class="span7" placeholder="Ingrese un correo electr&oacute;nico" id="txtemail" name="Correo Electr&oacute;nico">
                    <!--</div>-->
                  <!--<p class="help-block">Ejem.: correo@dominio.com</p>-->
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="retxtemail">Correo Electr&oacute;nico</label>
                <div class="controls">
                    <!--<div class="input-prepend span11">-->
                        <input type="text" class="span7" placeholder="Confirme su correo electr&oacute;nico" id="txtemail" name="Correo Electr&oacute;nico">
                    <!--</div>-->
                  <!--<p class="help-block">Ejem.: correo@dominio.com</p>-->
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="itxtclub">Club Deportivo</label>
                <div class="controls">
                    <input type="text" class="span7" placeholder="Ingrese el nombre del club" id="itxtclub" name="Club">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="ilstestado">Estado</label>
                <div class="controls">
                    <?php
                        include_once '../conexion/conexion.php';
                        include_once '../clases/Estado.php';
                        $objEst = new Estado();
                        $consulta =  $objEst->mostrar("select * from tbl_cne_estado ORDER BY nomb_estado ASC", $conexion);
                        if($conexion)
                        {
                            if($consulta){
                               if($conexion->registros > 0){
                                  echo'<select id="ilstestado" name="Estado" class="span7" onchange="cargarMun();">';
                                  echo '<option value="-1">Seleccione...</option>';
                                  do{
                                     $fila = $conexion->devolver_recordset();
                                     echo '<option value="'.$fila['cod_estado'].'" '.$sel.'>'.htmlentities(strtoupper($fila['nomb_estado']),ENT_QUOTES,'UTF-8').'</option>';
                                     $i++;
                                  }while(($conexion->siguiente())&&($i!=$conexion->registros));

                               }else{
                                   echo'<select id="ilstestado" disabled class="span7">';
                                   echo '<option value="-1">No se encontraron registros...</option>';
                               }
                            }else{
                                echo'<select id="ilstestado" disabled class="span7">';
                                echo '<option value="-1">No se encontraron registros...</option>';
                            }
                            echo'</select>';
                        }
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="ilstmunicipio">Municipio</label>
                <div class="controls">
                    <select id="ilstmunicipio" onchange="cargarPar();" name="Municipio" class="span7">
                        <option value="-1">Seleccione...</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="ilstparroquia">Parroquia</label>
                <div class="controls">
                    <select id="ilstparroquia"  name="Parroquia" class="span7">
                        <option value="-1">Seleccione...</option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label for="txtDir" class="control-label">Direcci&oacute;n</label>
                <div class="controls">
                    <textarea name="InputDir" id="txtDir" class="span7" rows="3" required></textarea>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                </div>
            </div>
        </div>
      <!-- FIN TAB REGISTRO DATOS PERSONALES -->
    <div role="tabpanel" class="tab-pane" id="profile">..eeeeeeee.</div>
    <div role="tabpanel" class="tab-pane" id="messages">.ggggggggg..</div>
    <div role="tabpanel" class="tab-pane" id="settings">.666666..</div>
  </div>

</div>
                  </legend>
                    
                    
                    
                    
                    <hr class="btn-primary">
                    
                    <div id="contmsj"></div>
            
                    <div class="form-actions">
                        <a class="btn btn-primary" id="guardar" onclick="valForm('formUsuario','guardarUsu(\'g\')');">
                            <i class="icon-ok-sign icon-white"></i>
                                Guardar
                        </a>
                        <a id="openBtn" class="btn btn-primary"  onclick="cargarTodosUsu();">
                            <i class="icon-eye-open icon-white"></i>
                                Mostrar
                        </a>
                        <a class="btn btn-primary" id="limpiar" onclick="limpiarFormUsu();">
                            <i class="icon-trash icon-white"></i>
                                Limpiar
                        </a>
                    </div>
                </fieldset>
              </form>
               <!--COMIENZO MENSAJE MODAL-->
       <div id="myModal" class="modal hide fade" style="display: none; width: 70%; left: 40%">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Usuarios Registrados</h3>
            </div>
            <div class="modal-body">
                <ul id="tab" class="nav nav-tabs">
                    <li class="">
                        <a>B&uacute;squeda por: </a>
                    </li>
                    <li class="active">
                        <a href="#cedula" data-toggle="tab">C&eacute;dula</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="cedula">
                        <form class="form-inline" id="formBusUsu">
                            <fieldset>
                                <div class="control-group">
                                    <div class="row">
                                        <div class="offset1 span7">
                                            <label class="control-label" for="itxtcedbus">C&eacute;dula de Identidad:</label>
                                            <!--<div class="controls">-->
                                                <input id="itxtcedbus" name="C&eacute;dula a buscar" placeholder="Ingrese una c&eacute;dula"  size="50px" type="text" maxlength="8" autofocus>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    
                    <div class="form-actions">
                        <div id="contmsjmodal1"></div>
                        <a class="btn btn-primary" id="buscarPer" onclick="buscarRepUsu();">
                            <i class="icon-search icon-white"></i>
                                Buscar
                        </a>
                        <a class="btn btn-primary" id="limpiar" onclick="limpiarRepUsu();">
                            <i class="icon-trash icon-white"></i>
                                Limpiar
                        </a>
                    </div>
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center">Item</th>
                            <th style="text-align: center">Usuario</th>
                            <th style="text-align: center">C&eacute;dula</th>
                            <th style="text-align: center">Nombre Completo</th>
                            <th style="text-align: center">Editar</th>
                            <th style="text-align: center;">Eliminar <input type="checkbox" id="elico" title="Seleccionar todos" onclick="verSel('all');"></th>
                        </tr>
                    </thead>
                    <tbody id="contUsu"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" id="eliminarUsu" data-toggle="confirmation" data-title="Seguro desea eliminar los registros seleccionados?">
                    <i class="icon-remove icon-white"></i>
                        Eliminar
                </a>
                <a class="btn btn-primary" id="imprimirUsu">
                    <i class="icon-print icon-white"></i>
                        Imprimir
                </a>
                <a href="#" id="cerrar" class="btn" data-dismiss="modal">Cerrar</a>
            </div>
            </div>
        <!--FIN MENSAJE MODAL-->
        <script>
            document.getElementById('itxtcedula').focus();
            $('[data-toggle="confirmation"]').confirmation(
                {
                    "placement" : "top",
                    "btnOkLabel" : '<i class="icon-ok-sign icon-white"></i> Si',
                    "btnOkClass" : "btn-primary",
                    "onConfirm" : function(){eliminarUsu();}
                }
            );
            $(function(){
                $('#fecharg1').datepicker();
                //$('#fecharg2').datepicker();
                $('#dp1').datepicker();
                //$('#dp2').datepicker();
            });
            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        </script>
        
          