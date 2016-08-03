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
                            <p class="bg-primary">Registro de Datos de Departamentos</p>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <form class="form-horizontal" id="formdpto" name="formdpto" action="Operaciones.php" method="POST">
                                        <input type="hidden" name="opcion" id="opcion" value="setDpto">
                                        <div class="form-group">
                                            <div class="col-xs-1"><label>Registro</label><input class="form-control" type="text" readonly id="numregisdpto" name="numregisdpto"></div>
                                            <div class="col-xs-6"><label>Nombre Completo</label><input type="text" class="form-control requerido" placeholder="Ej. Jefatura de Procura" id="itxtnombredpto" name="nombredpto" maxlength="99"></div>
                                            <div class="col-xs-5"><label>Nombre Abreviado</label><input type="text" class="form-control requerido" placeholder="Ej. Jef. de Procura" id="itxtnombredptoabrv" name="nombredptoabrv" maxlength="80"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-4"> </div>
                                            <div class="col-sm-4">                                                    
                                                <div class="input-group center-block btn-group"  id="boton">
                                                    <button type="button" id="btnsavedpto" name="btnsavedpto" class="btn btn-primary btn-lg center-block" style="display: block;" >
                                                        <i class="fa fa-floppy-o fa-lg"></i>&nbsp;&nbsp;Registrar Datos
                                                    </button>
                                                    <button type="button" id="btnmoddpto" name="btnmoddpto" class="btn btn-primary btn-lg center-block" style="display: none;">
                                                        <i class="fa fa-pencil fa-lg"></i>&nbsp;&nbsp;Modificar
                                                    </button>
                                                    <button type="button" id="btnlipdpto" name="btnlipdpto" class="btn btn-primary btn-lg center-block" style="display: none;">
                                                        <i class="fa fa-eraser fa-lg"></i>&nbsp;&nbsp;Limpiar
                                                    </button>
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
                                        <th data-column-id="id" data-header-align="center" data-align="center" data-type="numeric" data-width="4%">ID</th>
                                        <th data-column-id="nomcomp" data-header-align="center">Nombre completo</th>
                                        <th data-column-id="nomabrv" data-header-align="center">Nombre abreviado</th>
                                        <th data-column-id="fechareg" data-header-align="center" data-align="center" data-width="15%">Fecha registro</th>
<!--                                        <th data-column-id="mac" data-header-align="center" data-align="center" data-width="12%">MAC</th>
                                        <th data-column-id="ip" data-header-align="center" data-align="center" data-width="10%">IP</th>
                                        <th data-column-id="dpto" data-header-align="center">Departamento</th>
                                        <th data-column-id="ubi" data-header-align="center">Ubicaci&oacute;n</th-->
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
      <script async src="../js/jsDpto.js"></script>
      
  </body>
</html>

                            