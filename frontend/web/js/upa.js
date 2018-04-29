$(function() {
    buscar_detalle();
});
/******************************************** VISTA******************************************************/
function titulo_detalle() {
    var arreglo = new Array();
        arreglo[0] = 'Unidad';
        arreglo[1] = 'Partida';
        arreglo[2] = 'Clasificación';
        arreglo[3] = 'Monto';
        arreglo[4] = 'Opt';

    var tabla = document.getElementById('listado_detalle');
        tabla.innerHTML = "";

    tabla.appendChild(add_filas(arreglo, 'th','','',4));
}
/******************************************************** JSON *************************************************/
function buscar_clasificacion() {
    var id = trae('upa-id_clasificacion');
    var img = trae('load');
    var descripcion = trae('upa-descripcion_clasificacion');
    var valor = id.value.split(" - ");

    if (valor[0]!="") {
        img.style.visibility = "visible";
        $.getJSON('../upa/buscar-clasificaciones',{id : valor[0]},function(data){
            if (data=="") {
                id.value = "";
                descripcion.value = "";
            } else {
                id.value = valor[0];
                descripcion.value = data.descripcion;
            }
            img.style.visibility = "hidden";
        });
    } else {
        id.value = "";
        descripcion.value = "";
    }
}

function buscar_partida() {
    var id = trae('upa-id_partida');
    var descripcion = trae('upa-denominacion_partida');
    var img = trae('load');
    var valor = id.value.split(" - ");

    if (valor[0]!="") {
        img.style.visibility = "visible";
        $.getJSON('../upa/buscar-partidas',{id : valor[0]},function(data){
            if (data=="") {
                id.value = "";
                descripcion.value = "";
            } else {
                id.value = valor[0];
                descripcion.value = data.denominacion;
            }
            img.style.visibility = "hidden";
        });
    } else {
        id.value = "";
        descripcion.value = "";
    }
}

function buscar_unidad() {
    var id = trae('upa-id_unidad');
    var descripcion = trae('ubic');
    var img = trae('load');
    var valor = id.value.split(" - ");

    if (id.value!="") {
        img.style.visibility = "visible";
        $.getJSON('../upa/buscar-unidades',{id : valor[0]},function(data){
            if (data=="") {
                id.value = "";
                descripcion.value = "";
            } else {
                id.value = valor[0];
                descripcion.value = data.descripcion;
            }
            img.style.visibility = "hidden";
        });
    }
}

function buscar_detalle() {
    var asignacion = trae('upa-asignacion');
    var tipo_operacion = trae('upa-tipo_operacion');
    var img = trae('load');
    var campos = Array();
    var i;
    var signo;
    var tabla = trae('listado_detalle');
    
    if (asignacion.value!="") {
        img.style.visibility = "visible";
        $.getJSON('../upa/buscar-detalle',{asignacion : asignacion.value, tipo_operacion : tipo_operacion.value},function(data){
            if (data!="") {
                titulo_detalle();
                for (i = 0; i < data.length; i++) {
                    signo="";
                    campos.length = 0;
                    campos.push(data[i].unidad);
                    campos.push(data[i].id_partida);
                    campos.push(data[i].descripcion_clasificacion);
                    if (data[i].signo==1) signo="-";
                    campos.push(signo+parseFloat(data[i].monto));
                    campos.push(data[i].id_upa);
                    campos.push(data[i].signo);
                    tabla.appendChild(add_filas(campos, 'td','####borrar_upa','4',3));
                }
            }
            img.style.visibility = "hidden";
        });
    }
}

function borrar_upa(datos) {
    var arreglo = datos.split("#");

    var opcion = confirm("CONFIRMAR BORRADO");
    if (opcion) {
        $.get('../upa/borrar',{id : arreglo[4]},function(data){
            window.location=window.location;
        });
    }
}