var cad = new Array();
$(function() {
    numregistro(); 
    $("#btnsavedpto").click(function(event){
        event.preventDefault();
        saveDpto();
    });
    document.getElementById('btnsavedpto').focus();
    
    $(document).keypress(function(e) {
        if(e.which == 13) {
            saveDpto();
        }
    });
    $("#btnlipdpto").click(function(event){
        limpiar();
    });
    $('#btnmoddpto').click(function(event){
        modificarDpto();
    });
});


var grid = $("#grid-data").bootgrid({
    ajax: true,
    post: function ()
    {
        /* To accumulate custom parameter with the request object */
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },
    url: "../vistas/datosdpto.php",
    formatters: {
        "commands": function(column, row)
        {
            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " + 
                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
        }
    }
}).on("loaded.rs.jquery.bootgrid", function()
{ 
    /* Executes after data is loaded and rendered */
    grid.find(".command-edit").on("click", function(e)
    {
        consultarDpto($(this).data("row-id"));
    }).end().find(".command-delete").on("click", function(e)
    {
        eliminarDpto($(this).data("row-id"));
    });
});

jQuery.fn.reset = function () {
  $(this).each (function() { this.reset(); });
}

function numregistro(){
    var num = document.getElementById('numregisdpto');
    $.ajax({
        url: "../Operaciones.php",
        type: "POST",
        data: {opcion: "buscarnumregisdpto"},
        dataType: 'json',
        complete: function (data) {
            var dt =  JSON.parse(data.responseText);
            num.value = dt;
        }
    })
}

function eliminarDpto(id){
    if(confirm("Desea eliminar este registro?")){
        $.ajax({
            url: "../"+$('#formdpto').attr("action"),
            type: $('#formdpto').attr("method"),
            data: {opcion: "eliminardpto",id: id},
            dataType: 'json',
            complete: function (data) {
                var dt =  JSON.parse(data.responseText);
                if(dt == 1){
                    $('#formdpto').reset();
                    numregistro();
                    $('#itxtnombredpto').focus();
                    $("#grid-data").bootgrid("reload");
                    alert("Registro eliminado");
                }else{
                    alert("FALLA AL ELIMINAR");
                }
            }
        })
    }
    
}

function limpiar(){
    $('#btnmoddpto').css({"display": "none"});
    $('#btnlipdpto').css({"display": "none"});
    $('#btnsavedpto').css({"display": "block"});
    $('#formdpto').reset();
    numregistro();
    $('#itxtnombredpto').focus();
}

function modificarDpto(){
    var nomdpto = document.getElementById('itxtnombredpto');
    var dptoabr = document.getElementById('itxtnombredptoabrv');
    
    if(nomdpto.value != ''){
            if(dptoabr.value != ''){
                if(confirm("Desea modificar este registro?")){
                    $.ajax({
                        url: "../"+$('#formdpto').attr("action"),
                        type: $('#formdpto').attr("method"),
                        data: $('#formdpto').serialize(),
                        dataType: 'json',
                        complete: function (data) {
                            var dt =  JSON.parse(data.responseText);
                            if(dt == 1){
                                limpiar();
                                $("#grid-data").bootgrid("reload");
                            }else{
                                alert("FALLA AL MODIFICAR");
                            }
                        }
                    })
                }
            }else{
                alert("Debe ingresar un nombre abreviado para el departamento");
                dptoabr.focus();
            }
    }else{
        alert("Debe ingresar un nombre de departamento");
        nomdpto.focus();
    }
}

function consultarDpto(id){
    $.ajax({
        url: "../"+$('#formdpto').attr("action"),
        type: $('#formdpto').attr("method"),
        data: {opcion: "consultardpto",id: id},
        dataType: 'json',
        complete: function (data) {
            var dt =  JSON.parse(data.responseText);
            $('#numregisdpto').val(dt[0][0]);
            $('#itxtnombredpto').val(dt[0][1]);
            $('#itxtnombredptoabrv').val(dt[0][2]);
            $('#opcion').val('modificardpto');
            $('#btnmoddpto').css({"display": "block"});
            $('#btnlipdpto').css({"display": "block"});
            $('#btnsavedpto').css({"display": "none"});
        }
    })
}
function saveDpto(){
    var nomdpto = document.getElementById('itxtnombredpto');
    var abrvdpto = document.getElementById('itxtnombredptoabrv');
    
    if(nomdpto.value != ''){
        if(abrvdpto.value != ''){
            $.ajax({
                url: "../"+$('#formdpto').attr("action"),
                type: $('#formdpto').attr("method"),
                data: $('#formdpto').serialize(),
                dataType: 'json',
                complete: function (data) {
                    var dt =  JSON.parse(data.responseText);
                    if(dt == 1){
                        $('#formdpto').reset();
                        numregistro();
                        $('#itxtnombredpto').focus();
                        $("#grid-data").bootgrid("reload");
                    }else{
                        alert("FALLA AL REGISTRAR");
                    }
                }
            })
        }else{
            alert("Debe ingresar un nombre");
            abrvdpto.focus();
        }
    }else{
        alert("Debe ingresar un nombre abreviado");
        nomdpto.focus();
    }
                
}



//function buscarced(){
//    var ced = xGetElementById('itxtcedulab');
//    var nac = xGetElementById('ilstnacb');
//    $("#contmsjbc").empty();
//    if(ced.value != ''){
//        $("#msjced").alert('close')
//        AjaxRequest.post(
//            {
//                'parameters':{'opcion':'buscarced','nac':nac.value,'ced':ced.value},
//                'url':'../Operaciones.php',
//                'onLoading':function(){
//                    waitingDialog.show('Buscando...', {dialogSize: 'sm', progressType: 'info'});
//                },
//                'onSuccess':function(req){
//                    var resp = eval("(" + req.responseText + ")");
//                    if(resp != 0){                       
//                        crearTablaPerCed(req.responseText);
//                    }else{
//                        clase = "error";
//                        cad[0] = "La persona con cedula "+nac.value+"-"+formato_numero(ced.value,0,'','.') +" no se encuentra registrado";
//                        claseError('#contmsjbc',cad,clase,'msjced');
//                    }
//                },
//                'onComplete':function(){
//                    waitingDialog.hide();
//                }
//            }
//        )
//    }else{
//        clase = "error";
//        cad[0] = "Debe ingresar un Número de Cédula";
//        claseError('#contmsjbc',cad,clase,'msjced');
//    }
//}
//function crearTablaPerCed(req){
//    resp = eval("(" + req + ")");
//    $("#contPer").empty();
//    $("#restabbusced").attr("style", "display: block;");
//    if(resp != 0){
//            clase = "info";
//            
//            if(resp[1] == 0){
//                banco = "No Aplica";
//            }else{
//                banco = resp[1]['nombanco'];
//            }
//            if(resp[0]['confirmado'] == "si"){
//                atributo = "onclick";
//                value = "enviarMail()";
//                texto = "Confirmado";
//                clases = "btn btn-success btn-sm";
//                title = "Volver a enviar email";
//            }else{
//                atributo = "onclick";
//                value = "enviarMail()";
//                texto = "No confirmado"
//                clases = "btn btn-danger btn-sm";
//                title = "Enviar email";
//            }
//            var fecha = resp[0]['fechatrans'].split('-');
//            $("#contPer").append($("<tr>")
//                     .css("cursor", "pointer")
//                     .addClass(clase)
//                    .append($("<td>")
//                        .attr("style", "text-align: center; font-weight: bold;  vertical-align: middle;")
//                        .text(1)
//                    )
//                     .append($("<td>")
//                         .text(resp[0]['nac']+"-"+formato_numero(resp[0]['cedula'],0,'','.'))
//                         .attr("style", "text-align: center; vertical-align: middle;")
//                     )
//                     .append($("<td>")
//                         .attr("valign", "middle")
//                         .text(capitalizar(resp[0]['nombre']+' '+resp[0]['apellido']))
//                         .attr("style", "text-align: rigth; vertical-align: middle;")
//                     )
//                    .append($("<td>")
//                         .text(capitalizar(resp[0]['tipotrans']))
//                         .attr("style", "text-align: center; vertical-align: middle;")
//                     )
//                    .append($("<td>")
//                         .text(resp[0]['nrotrans'])
//                         .attr("style", "text-align: center; vertical-align: middle;")
//                     )
//                     .append($("<td>")
//                         .text(fecha[2]+'-'+fecha[1]+'-'+fecha[0])
//                         .attr("style", "text-align: center; vertical-align: middle;")
//                     )                     
//                     .append($("<td>")
//                         .text(capitalizar(banco))
//                         .attr("style", "text-align: center; vertical-align: middle;")
//                     )
//                     .append($("<td>")
//                         .text(capitalizar(resp[2]['nombanco']))
//                         .attr("style", "text-align: center; vertical-align: middle;")
//                     )
//                    .append($("<td>")
//                        .attr("style", "text-align: center; vertical-align: middle;")
//                        .append($("<button>")
//                            .addClass(clases)
//                            .attr("onclick","enviarMail('"+resp[0]['id']+"')")
//                            .text(texto)
//                            .attr("id","btn"+resp[0]['id'])
//                            .attr("title",title)
//                        )
//                    )
//                    .attr("title","Personal")
//                    .attr("id","personal")
//                    
//                 );
//             $("#allced").attr("onclick","enviarMail('"+resp[0]['id']+"');");
//    }else{
//        $("#contCon").append($("<tr>")
//                      .addClass("error alert-error")
//                      .append($("<td>")
//                         .attr("colspan","10")
//                         .append($("<h5>")
//                             .text("No existen registros para mostrar")
//                         )
//                      )
//                      .attr("title","No existen registros para mostrar")
//                      .attr("id","personal")
//         );
//    }
//}
//
//
//
//function buscarLoc(){
//    var r1 = xGetElementById('todos');
//    var r2 = xGetElementById('conf');
//    var r3 = xGetElementById('noconf');
//    var pai = xGetElementById('ilstpaisbus');
//    var est = xGetElementById('ilstestadobus');
//    var mun = xGetElementById('ilstmunicipiobus');
//    var radio = '';
//    if(r1.checked){
//        radio = 'TODOS';
//    }else if(r2.checked){
//        radio = 'CONFIRMADO';
//    }else if(r3.checked){
//        radio = 'NOCONFIRMADO';
//    }
////    alert(radio);
//    var param = pai.value+'='+est.value+'='+mun.value+'='+radio;
//    $("#msjloc").alert('close')
//    AjaxRequest.post(
//        {
//            'parameters':{'opcion':'buscarLoc','pai':pai.value,'est':est.value,'mun':mun.value,'radio':radio},
//            'url':'../Operaciones.php',
//            'onLoading':function(){
//                waitingDialog.show('Buscando...', {dialogSize: 'sm', progressType: 'info'});
//            },
//            'onSuccess':function(req){
//                var resp = eval("(" + req.responseText + ")");
//                if(resp != 0){                       
//                    crearTablaPerLoc(req.responseText,param);
//                }else{
//                    $("#contPerLoc").empty();
//                    $("#restabbusloc").attr("style", "display: none;");
//                    clase = "error";
//                    cad[0] = "No existen participantes que concuerden a los criterios de busqueda";
//                    claseError('#contmsjbloc',cad,clase,"msjloc");
//                }
//            },
//            'onComplete':function(){
//                waitingDialog.hide();
//            }
//        }
//    )
//}
//
//
//
//
//function crearTablaPerLoc(req,param){
//    resp = eval("(" + req + ")");
//    $("#contPerLoc").empty();
//    $("#restabbusloc").attr("style", "display: block;");
//    var banco;
//    var clase;
//    var cod = '';
//    if(resp != 0){
//        for(var i = 0;i < resp['datos'].length; i++){
//            
//            if(i % 2 == 0){
//                clase = "info";
//            }else{
//                clase = "";
//            }
//            if(resp['datos'][i][0]['banco'] == 0){
//                banco = "No Aplica";
//            }else{
//                banco = resp['datos'][i][1]['nombanco'];
//            }
//            if(resp['datos'][i][0]['confirmado'] == "si"){
//                atributo = "onclick";
//                value = "enviarMail()";
//                texto = "Confirmado";
//                clases = "btn btn-success btn-sm";
//                title = "Volver a enviar email";
//            }else{
//                atributo = "onclick";
//                value = "enviarMail()";
//                texto = "No confirmado"
//                clases = "btn btn-danger btn-sm";
//                title = "Enviar email";
//            }
//            var fecha = resp['datos'][i][0]['fechatrans'].split('-');
//            $("#contPerLoc").append($("<tr>")
//                .css("cursor", "pointer")
//                .addClass(clase)
//                .append($("<td>")
//                    .attr("style", "text-align: center; font-weight: bold; vertical-align: middle;")
//                    .text(i+1)
//                 )
//                .append($("<td>")
//                    .text(resp['datos'][i][0]['nac']+"-"+formato_numero(resp['datos'][i][0]['cedula'],0,'','.'))
//                    .attr("style", "text-align: left; vertical-align: middle;")
//                )
//                .append($("<td>")
//                    .attr("valign", "middle")
//                    .text(capitalizar(resp['datos'][i][0]['nombre']+' '+resp['datos'][i][0]['apellido']))
//                    .attr("style", "text-align: rigth; vertical-align: middle;")
//                )
//               .append($("<td>")
//                    .text(capitalizar(resp['datos'][i][0]['tipotrans']))
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )
//               .append($("<td>")
//                    .text(resp['datos'][i][0]['nrotrans'])
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )
//                .append($("<td>")
//                    .text(fecha[2]+"-"+fecha[1]+"-"+fecha[0])
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )     
//                .append($("<td>")
//                    .text(capitalizar(banco))
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )
//                .append($("<td>")
//                    .text(capitalizar(resp['datos'][i][2]['nombanco']))
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )
//                .append($("<td>")
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                    .append($("<button>")
//                        .addClass(clases)
//                        .attr("onclick","enviarMail('"+resp['datos'][i][0]['id']+"')")
//                        .text(texto)
//                        .attr("id","btn"+resp['datos'][i][0]['id'])
//                        .attr("title",title)
//                    )
//                )
//                .attr("title","Participantes")
//                .attr("id","participantes")
//            );
//            if(cod == ''){
//                cod = resp['datos'][i][0]['id'];
//            }else{
//                cod = cod+'='+resp['datos'][i][0]['id'];
//            }
//        }
//        $("#allloc").attr("onclick","enviarMail('"+cod+"');");
//        $("#pdfLoc").attr("onclick","listadoPDF('"+param+"');");
//    }else{
//        $("#contPerLoc").append($("<tr>")
//                      .addClass("error alert-error")
//                      .append($("<td>")
//                         .attr("colspan","10")
//                         .append($("<h5>")
//                             .text("No existen registros para mostrar")
//                         )
//                      )
//                      .attr("title","No existen registros para mostrar")
//                      .attr("id","personal")
//         );
//    }
//}
//
//function buscFec(){
//    var r1 = xGetElementById('radio1');
//    var r2 = xGetElementById('radio2');
//    var r3 = xGetElementById('todosFec');
//    var r4 = xGetElementById('confFec');
//    var r5 = xGetElementById('noconfFec');
//    var fecdesde = xGetElementById('ifechadesde');
//    var fechasta = xGetElementById('ifechahasta');
//    var radio;
//    var op;
//    if(fecdesde.value != ''){
//        if(fechasta.value != ''){
//            if(r1.checked){
//                radio = 'registro'; 
//            }else if(r2.checked){
//                radio = 'transaccion';
//            }
//            
//            if(r3.checked){
//                op = 'TODOS';
//            }else if(r4.checked){
//                op = 'CONFIRMADO';
//            }else if(r5.checked){
//                op = 'NOCONFIRMADO';
//            }
//             var param = fecdesde.value+'='+fechasta.value+'='+radio+'='+op;
//            $("#msjfec").alert('close')
//            AjaxRequest.post(
//                {
//                    'parameters':{'opcion':'buscarFec','radio':radio,'desde':fecdesde.value,'hasta':fechasta.value,'op':op},
//                    'url':'../Operaciones.php',
//                    'onLoading':function(){
//                        waitingDialog.show('Buscando...', {dialogSize: 'sm', progressType: 'info'});
//                    },
//                    'onSuccess':function(req){
//                        var resp = eval("(" + req.responseText + ")");
//                        if(resp != 0){ 
//                            crearTablaPerFec(req.responseText,param);
//                        }else{
//                            $("#contPerFec").empty();
//                            $("#restabbusfec").attr("style", "display: none;");
//                            clase = "error";
//                            cad[0] = "No existen participantes dentro d el afecha";
//                            claseError('#contmsjbfec',cad,clase,"msjfec");
//                        }
//                    },
//                    'onComplete':function(){
//                        waitingDialog.hide();
//                    }
//                }
//            )
//        }else{
//            clase = "error";
//            cad[0] = "Debe ingresar una fecha hasta";
//            claseError('#contmsjbfec',cad,clase,"msjfec");
//        }
//    }else{
//        clase = "error";
//        cad[0] = "Debe ingresar una Fecha desde";
//        claseError('#contmsjbfec',cad,clase,"msjfec");
//    }
//}
//function crearTablaPerFec(req,param){
//    resp = eval("(" + req + ")");
//    $("#contPerFec").empty();
//    $("#restabbusfec").attr("style", "display: block;");
//    var banco;
//    var clase;
//    var cod = '';
//    if(resp != 0){
//        
//        for(var i = 0;i < resp.length; i++){
//            if(i % 2 == 0){
//                clase = "info";
//            }else{
//                clase = "";
//            }
//            if(resp[i][0]['banco'] == 0){
//                banco = "No Aplica";
//            }else{
//                banco = resp[i][1]['nombanco'];
//            }
//            if(resp[i][0]['confirmado'] == "si"){
//                atributo = "onclick";
//                value = "enviarMail()";
//                texto = "Confirmado";
//                clases = "btn btn-success btn-sm";
//                title = "Volver a enviar email";
//            }else{
//                atributo = "onclick";
//                value = "enviarMail()";
//                texto = "No confirmado"
//                clases = "btn btn-danger btn-sm";
//                title = "Enviar email";
//            }
//            var fecha = resp[i][0]['fechatrans'].split('-');
//            $("#contPerFec").append($("<tr>")
//                .css("cursor", "pointer")
//                .addClass(clase)
//                .append($("<td>")
//                    .attr("style", "text-align: center; font-weight: bold;  vertical-align: middle;")
//                    .text(i+1)
//                 )
//                .append($("<td>")
//                    .text(resp[i][0]['nac']+"-"+formato_numero(resp[i][0]['cedula'],0,'','.'))
//                    .attr("style", "text-align: left; vertical-align: middle;")
//                )
//                .append($("<td>")
//                    .attr("valign", "middle")
//                    .text(capitalizar(resp[i][0]['nombre']+' '+resp[i][0]['apellido']))
//                    .attr("style", "text-align: rigth; vertical-align: middle;")
//                )
//               .append($("<td>")
//                    .text(capitalizar(resp[i][0]['tipotrans']))
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )
//               .append($("<td>")
//                    .text(resp[i][0]['nrotrans'])
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )
//                .append($("<td>")
//                    .text(fecha[2]+"-"+fecha[1]+"-"+fecha[0])
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )     
//                .append($("<td>")
//                    .text(capitalizar(banco))
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )
//                .append($("<td>")
//                    .text(capitalizar(resp[i][2]['nombanco']))
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                )
//                .append($("<td>")
//                    .attr("style", "text-align: center; vertical-align: middle;")
//                    .append($("<button>")
//                        .addClass(clases)
//                        .attr("onclick","enviarMail('"+resp[i][0]['id']+"')")
//                        .text(texto)
//                        .attr("id","btn"+resp[i][0]['id'])
//                        .attr("title",title)
//                    )
//                )
//                .attr("title","Participantes")
//                .attr("id","participantes")
//            );
//            if(cod == ''){
//                cod = resp[i][0]['id'];
//            }else{
//                cod = cod+'='+resp[i][0]['id'];
//            }
//        }
//        $("#allfec").attr("onclick","enviarMail('"+cod+"');");
//        $("#pdfFec").attr("onclick","listadofecPDF('"+param+"');");
//    }else{
//        $("#contPerFec").append($("<tr>")
//                      .addClass("error alert-error")
//                      .append($("<td>")
//                         .attr("colspan","10")
//                         .append($("<h5>")
//                             .text("No existen registros para mostrar")
//                         )
//                      )
//                      .attr("title","No existen registros para mostrar")
//                      .attr("id","personal")
//         );
//    }
//}
//
//function enviarMail(datos){
//    var i = 0;
//    var cant = 0;
//    if(datos != ""){
//        AjaxRequest.post(
//            {
//                'parameters':{'opcion':'enviarMail','datos':datos},
//                'url':'../TemplateMail.php',
//                'onLoading':function(){
//                    waitingDialog.show('Enviando...', {dialogSize: 'sm', progressType: 'info'});
//                },
//                'onSuccess':function(req){
//                    var resp = eval("(" + req.responseText + ")");
//                    if(resp != 0){ 
//                        var res = datos.split('=');
//                        cant = res.length;
//                        for(i = 0;i < cant; i++){
//                            $("#btn"+res[i]).removeClass("btn-danger")
//                                            .addClass("btn-success")
//                                            .text("Confirmado")
//                                            .attr("title","Volver a enviar email")
//                        }
//                        alert("Correo(s) enviado(s)");
//                    }else{
//                        alert("Correos no enviados");
//                    }
//                },
//                'onComplete':function(){
//                    waitingDialog.hide();
//                }
//            }
//        )
//    }else{
//        alert("No existen datos para eviar");
//    }
//}
//
//function enviarMen(){
//    var nom = xGetElementById('itxtnombmen');
//    var ema = xGetElementById('itxtcormen');
//    var men = xGetElementById('itxtmensmen');
//    if(nom.value != ''){
//        if(ema.value != ''){
//            if(val_Email('itxtcormen')){
//                if(men.value != ''){
//                    if (men.value.length <= 500){
//                        AjaxRequest.post(
//                            {
//                                'parameters':{'opcion':'envMen','nombre':nom.value,'email':ema.value,'mensaje':men.value},
//                                'url':'../Operaciones.php',
//                                'onLoading':function(){
//                                    waitingDialog.show('Enviando mensaje...', {dialogSize: 'sm', progressType: 'info'});
//                                },
//                                'onSuccess':function(req){
//                                    var resp = eval("(" + req.responseText + ")");
//                                    if(resp == 1){ 
//                                        limpiarForm('formmen','itxtnombmen');
//                                        alert('Su mensaje ha sido enviado');
//                                    }else{
//                                        clase = "error";
//                                        cad[0] = "Su mensaje no pudo enviarse";
//                                        claseError('#contmsjmen',cad,clase,"msjmen");
//                                    }
//                                },
//                                'onComplete':function(){
//                                    waitingDialog.hide();
//                                }
//                            }
//                        )
//                    }else{
//                        clase = "error";
//                        cad[0] = "El mensaje no puede sobrepasar los 500 caracteres";
//                        claseError('#contmsjmen',cad,clase,"msjmen");
//                    }
//                }else{
//                    clase = "error";
//                    cad[0] = "Debe escribir un mensaje";
//                    claseError('#contmsjmen',cad,clase,"msjmen");
//                }
//            }else{
//                clase = "error";
//                cad[0] = "Formato de Correo Electronico invalido";
//                claseError('#contmsjmen',cad,clase,"msjmen");
//            }
//            
//        }else{
//            clase = "error";
//            cad[0] = "Debe ingresar un Correo Electronico";
//            claseError('#contmsjmen',cad,clase,"msjmen");
//        }
//    }else{
////        $('#itxtnombmen').closest('.form-group').addClass('has-error');
//        clase = "error";
//        cad[0] = "Debe ingresar un Nombre";
//        claseError('#contmsjmen',cad,clase,"msjmen");
//    }
//    
//}
//
//function regUsu(){
//    var log = xGetElementById('itxtlogin');
//    var cla = xGetElementById('itxtclave');
//    var recla = xGetElementById('itxtreclave');
//    var nac = xGetElementById('ilstnacusu');
//    var ced = xGetElementById('itxtcedusu');
//    var nom = xGetElementById('itxtnomusu');
//    var ape = xGetElementById('itxtapeusu');
//    var tip = xGetElementById('ilsttipousu');
//    if(log.value != ''){
//        if(cla.value != ''){
//            if(recla.value != ''){
//                if(cla.value == recla.value){
//                    if(nac.value != 0){
//                        if(ced.value != ''){
//                            if(nom.value != ''){
//                                if(ape.value != ''){
//                                    if(tip.value != 0){
//                                        AjaxRequest.post(
//                                            {
//                                                'parameters':{'opcion':'regUsu','login':log.value,'clave':cla.value,'nac':nac.value,'ced':ced.value,'nom':nom.value,'ape':ape.value,'tip':tip.value},
//                                                'url':'../Operaciones.php',
//                                                'onSuccess':function(req){
//                                                    var resp = eval("(" + req.responseText + ")");
//                                                    if(resp == 1){ 
//                                                        limpiarForm('formusu','itxtlogin');
//                                                        $("#msjusu").alert('close');
//                                                        alert('Usuario registrado');
//                                                    }else if(resp == 2){
//                                                        clase = "error";
//                                                        cad[0] = "Nombre de usuario registrado";
//                                                        claseError('#contmsjusu',cad,clase,"msjusu");
//                                                    }else if(resp == 3){
//                                                        clase = "error";
//                                                        cad[0] = "Cédula registrada";
//                                                        claseError('#contmsjusu',cad,clase,"msjusu");
//                                                    }else{
//                                                        clase = "error";
//                                                        cad[0] = "No se pudo guardar el registro";
//                                                        claseError('#contmsjusu',cad,clase,"msjusu");
//                                                    }
//                                                }
//                                            }
//                                        )
//                                    }else{
//                                        clase = "error";
//                                        cad[0] = "Debe seleccionar un tipo de usuario";
//                                        claseError('#contmsjusu',cad,clase,"msjusu");
//                                    }
//                                }else{
//                                    clase = "error";
//                                    cad[0] = "Debe ingresar un apellido";
//                                    claseError('#contmsjusu',cad,clase,"msjusu");
//                                } 
//                            }else{
//                                clase = "error";
//                                cad[0] = "Debe ingresar un nombre";
//                                claseError('#contmsjusu',cad,clase,"msjusu");
//                            }  
//                        }else{
//                            clase = "error";
//                            cad[0] = "Debe ingresar una cedula";
//                            claseError('#contmsjusu',cad,clase,"msjusu");
//                        }  
//                    }else{
//                        clase = "error";
//                        cad[0] = "Debe seleccionar una nacionalidad";
//                        claseError('#contmsjusu',cad,clase,"msjusu");
//                    }
//                }else{
//                    clase = "error";
//                    cad[0] = "Las claves no coinciden";
//                    claseError('#contmsjusu',cad,clase,"msjusu");
//                }
//            }else{
//                clase = "error";
//                cad[0] = "Debe confirmar su contraseña";
//                claseError('#contmsjusu',cad,clase,"msjusu");
//            }
//        }else{
//            clase = "error";
//            cad[0] = "Debe ingresar una contraseña";
//            claseError('#contmsjusu',cad,clase,"msjusu");
//        } 
//    }else{
//        clase = "error";
//        cad[0] = "Debe ingresar una nombre de usuario";
//        claseError('#contmsjusu',cad,clase,"msjusu");
//    }
//    
//}
//
//function valogin(){
//    var usu = xGetElementById('user');
//    var cla = xGetElementById('pass');
//    if(usu.value != ''){
//        if(cla.value != ''){
//            AjaxRequest.post(
//                {
//                    'parameters':{'opcion':'valog','usu':usu.value,'cla':cla.value},
//                    'url':'../Operaciones.php',
//                    'onSuccess':function(req){
//                        var resp = eval("(" + req.responseText + ")");
//                        if(resp == 1){ 
//                            ir('index.php');
//                        }else{
//                            alert('Login o Clave incorrecta');
//                        }
//                    }
//                }
//            )
//        }else{
//            alert("Debe ingresar su clave");
//        }
//    }else{
//        alert("Debe ingresar su usuario");
//    }
//}
//
//function listadoPDF(param){
//     window.open('../reporte.php?datos='+param,'reporte','_blank');
//}
//function listadofecPDF(param){
//     window.open('../reporteFec.php?datos='+param,'reporte','_blank');
//}