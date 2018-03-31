$(function() {
    llenar_nivel();
});

/******************************************************** JSON *************************************************/
function llenar_nivel() {
    var nivel_clasificacion = JSON.parse(trae('nivel_clasificacion').innerHTML);
    var nivel_unidad = JSON.parse(trae('nivel_unidad').innerHTML);
    var nivel_c = trae('clasificacionunidad-nivel_clasificacion');
    var nivel_u = trae('clasificacionunidad-nivel_unidad');
    var i;

    for (i=0; i < nivel_clasificacion.length; i++) {
        nivel_c[i+1] = new Option(nivel_clasificacion[i].nivel,nivel_clasificacion[i].nivel,"","");
    }

    for (i=0; i < nivel_unidad.length; i++) {
        nivel_u[i+1] = new Option(nivel_unidad[i].nivel,nivel_unidad[i].nivel,"","");
    }
}

function b_clasificacion() {
    var id = trae('clasificacionunidad-id_clasificacion').value;
    var nivel = trae('clasificacionunidad-nivel_clasificacion').value;
    var padre = trae('clasificacionunidad-id_clasificacion');
    var i;

    if ((id=="prompt") || (id=="")) id=0;
    padre.length = 0;
    padre[0] = new Option("Seleccione","","","");
    if (nivel!="") {
        $.getJSON('../clasificacion/buscar-padre',{nivel : nivel, actual : id},function(data){
            if (data!="") {
                for (i=0; i < data.length; i++) {
                    padre[i+1] = new Option(data[i].codigo+" - "+data[i].descripcion,data[i].id_clasificacion,"","");
                }
            }
        });
    }
}

function b_unidad() {
    var id = trae('clasificacionunidad-id_unidad').value;
    var nivel = trae('clasificacionunidad-nivel_unidad').value;
    var padre = trae('clasificacionunidad-id_unidad');
    var i;

    if ((id=="prompt") || (id=="")) id=0;
    padre.length = 0;
    padre[0] = new Option("Seleccione","","","");
    if (nivel!="") {
        $.getJSON('../clasificacion-unidad/buscar-unidad',{nivel : nivel, actual : id},function(data){
            if (data!="") {
                for (i=0; i < data.length; i++) {
                    padre[i+1] = new Option(data[i].id_unidad+" - "+data[i].descripcion,data[i].id_unidad,"","");
                }
            }
        });
    }
}