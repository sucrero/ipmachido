<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>::: Inicio :::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
    <meta name="author" content="franco.oswaldo@gmail.com" />

    <!-- Le styles -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../jquery.bootgrid-1.3.1/jquery.bootgrid.min.css">
    <link rel="stylesheet" href="../icons/font-awesome/css/font-awesome.min.css">
    <link href="../css/estilos.css" rel="stylesheet">       
    <script async src="../js/principal.js"></script>
    <script async src="../js/AjaxRequest.js"></script>
    <script async src="../js/ajax.js"></script>
    <script async src="../js/ajax-dynamic-content.js"></script>
    <script async src="../js/x.js"></script>
    <script async src="../js/manipularDom.js"></script>
    
    <style type="text/css">
      body {
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
      
    </style>
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    </head>

    <body>
                
       
        <div class="container-fluid" id="contendor"><!-- INICIO CONTAINER -->
                <!-- INICIO -->                                
                    <!-- INICIO TAB REGISTRO DATOS PERSONALES -->
                        <!--<div class="panel panel-info">-->
<!--                            <div class="panel-heading">
                                <h3 class="panel-title">Registro de Datos de Equipos</h3>
                            </div>-->
                            <p class="bg-primary">Registro de Datos de Equipos</p>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <form class="form-horizontal" id="formpc" name="formpc" action="Operaciones.php" method="POST">
                                        <input type="hidden" name="opcion" id="opcion" value="setPc">
                                        <div class="form-group">
                                            <div class="col-xs-1"><label>Registro</label><input class="form-control" type="text" readonly id="numregis" name="numregis"></div>
                                            <div class="col-xs-3"><label>Nombre Usuario</label><input type="text" class="form-control requerido" placeholder="Ej. ugsou01" id="itxtnombreusu" name="nombreusu" maxlength="30"></div>
                                            <div class="col-xs-3"><label>Nombre PC</label><input type="text" class="form-control requerido" placeholder="Ej. ugsopc01" id="itxtnombrepc" name="nombrepc" maxlength="30"></div>
                                            <div class="col-xs-3"><label>Direci&oacute;n MAC</label><input type="text" class="form-control requerido" placeholder="Ej. 0014D11E089D" id="itxtmac" name="mac" maxlength="12"></div>
                                            <div class="col-xs-2"><label>Direci&oacute;n IP</label><div class="input-group"><span class="input-group-addon" id="basic-addon1">10.10.12.</span><input type="text" class="form-control requerido" placeholder="Ej. 1" id="itxtip" name="ip" maxlength="3" onkeypress="return numeros(event)"></div></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-4"><label>Departamento</label><input type="text" class="form-control requerido" placeholder="Ingrese el nombre del departamento" id="itxtdepartamento" name="departamento"></div>
                                            <div class="col-xs-4"><label>Ubicaci&oacute;n</label><input type="text" class="form-control requerido" placeholder="Ingrese la ubicaci&oacute;n del equipo" id="itxtubicacion" name="ubicacion"></div>                                      
                                            <div class="col-xs-4"><label>Observaci&oacute;n</label><input type="text" name="observacion" id="itxtobservacion" class="form-control requerido" placeholder="Ingrese una observaci&oacute;n"></div> 
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-4"> </div>
                                            <div class="col-sm-4">                                                    
                                                <div class="input-group center-block"  id="boton">
                                                    <button type="button" id="btnsiguiente" name="btnguardar" class="btn btn-primary btn-lg center-block" style="display: inline;" ><i class="fa fa-floppy-o fa-lg"></i>&nbsp;&nbsp;Registrar Datos</button>
                                                    <button type="button" id="btnmodificar" name="btnmodificar" class="btn btn-primary btn-lg center-block" style="display: none;"><i class="fa fa-pencil fa-lg"></i>&nbsp;&nbsp;Modificar</button>
                                                    <button type="button" id="btnlimpiar" name="btnlimpiar" class="btn btn-primary btn-lg center-block" style="display: none;"><i class="fa fa-eraser fa-lg"></i>&nbsp;&nbsp;Limpiar</button>
                                                </div>
                                            </div>
                                            <div class="col-sm-4"></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-1"></div>
                            </div>
                            <hr>
                            <table id="grid-data" class="table table-condensed table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th data-column-id="num" data-header-align="center" data-align="center" data-type="numeric" data-width="4%">Nro.</th>
                                        <th data-column-id="usu" data-header-align="center">Usuario</th>
                                        <th data-column-id="pc" data-header-align="center">Equipo</th>
                                        <th data-column-id="mac" data-header-align="center" data-align="center" data-width="12%">MAC</th>
                                        <th data-column-id="ip" data-header-align="center" data-align="center" data-width="10%">IP</th>
                                        <th data-column-id="dpto" data-header-align="center">Departamento</th>
                                        <th data-column-id="ubi" data-header-align="center">Ubicaci&oacute;n</th>
                                        <th data-column-id="commands" data-formatter="commands" data-sortable="false" data-header-align="center" data-align="center" data-width="10%">Ac</th>
                                    </tr>
                                </thead>
                            </table>
                        <!--</div>-->     
                <!-- FIN -->
                
            </div><!-- FIN CONTAINER -->
    
      <hr>
        <footer class="footer">
            <div class="container">
                <p class="text-muted" style="text-align: center;">Sistema para el control de computadoras</p>
            </div>
        </footer>
      <script src="../js/jquery/1.11.3/jquery.min.js"></script>
      <script src="../js/loading.js" async></script>
      <script src="../bootstrap/js/bootstrap.min.js"></script>
      <script src="../jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
      <script src="../jquery.bootgrid-1.3.1/jquery.bootgrid.fa.min.js"></script>
      <script async src="../js/jsGlobal.js"></script>
      
  </body>
</html>

                            