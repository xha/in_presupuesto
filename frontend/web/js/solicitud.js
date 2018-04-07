$(function() {
    
});

/******************************************************** JSON *************************************************/
function buscar_clasificacion() {
    var asignacion = trae('transaccion-asignacion').value;
    var img = trae('load');
    var clasificacion = trae('d_clasificacion');
    var i;

    if (asignacion!="") {
        clasificacion.length = 0;
        clasificacion[0] = new Option("Seleccione","","","");
        img.style.visibility = "visible";
        $.getJSON('../transaccion/buscar-clasificacion',{asignacion : asignacion},function(data){
            if (data!="") {
                for (i=0; i < data.length; i++) {
                    clasificacion[i+1] = new Option(data[i].id_clasificacion+" - "+data[i].descripcion_clasificacion,data[i].id_clasificacion,"","");
                }
            }
            img.style.visibility = "hidden";
        });
    }
}

function buscar_partida() {
    var asignacion = trae('transaccion-asignacion').value;
    var clasificacion = trae('d_clasificacion').value;
    var img = trae('load');
    var partida = trae('d_partida');
    var item = trae('d_item');
    var i;

    partida.length = 0;
    //item.length = 0;
    partida[0] = new Option("Seleccione","","","");
    //item[0] = new Option("Seleccione","","","");
    if (clasificacion!="") {
        img.style.visibility = "visible";
        $.getJSON('../transaccion/buscar-partida',{asignacion : asignacion, clasificacion : clasificacion},function(data){
            if (data!="") {
                for (i=0; i < data.length; i++) {
                    partida[i+1] = new Option(data[i].id_partida,data[i].id_partida,"","");
                }
            }
            img.style.visibility = "hidden";
        });
    }
}

function buscar_items() {
    var clasificacion = trae('d_clasificacion').value;
    var img = trae('load');
    var partida = trae('d_partida');
    var item = trae('d_item');
    var i;

    partida.length = 0;
    item.length = 0;
    partida[0] = new Option("Seleccione","","","");
    item[0] = new Option("Seleccione","","","");
    if (clasificacion!="") {
        img.style.visibility = "visible";
        $.getJSON('../transaccion/buscar-partida',{clasificacion : clasificacion},function(data){
            if (data!="") {
                for (i=0; i < data.length; i++) {
                    partida[i+1] = new Option(data[i].id_partida,data[i].id_partida,"","");
                }
            }
            img.style.visibility = "hidden";
        });
    }
}