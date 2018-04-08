/******************************************************** JSON *************************************************/
function buscar_partida() {
    var partida = trae('cnu-id_partida');
    var cuenta = trae('cnu-id_cuenta');
    var valor = partida.value.split(" - ");
    var i;

    if (valor[0]!="") {
        $.getJSON('../cnu/buscar-partida',{id : valor[0]},function(data){
            if (data.length>0) {
                for (i=0; i < data.length; i++) {
                    cuenta[i+1] = new Option(data[i].id_cuenta+" - "+data[i].descripcion_cuenta,data[i].id_cuenta,"","");
                }
            } else {
                partida.value = "";
                cuenta.value = "";
            }
        });
    } else {
        partida.value = "";
        cuenta.value = "";
    }
}

function buscar_item() {
    var item = trae('cnu-coditem').value;
    var servicio = trae('cnu-esservicio');

    if (item!="") {
        $.get('../cnu/buscar-item',{id : item},function(data){
            if (data!="") {
                if (data==1) {
                    servicio.value = 0;
                } else {
                    servicio.value = 1;
                }
            } else {
                item.value = "";
            }
        });
    } else {
        item.value = "";
    }
}