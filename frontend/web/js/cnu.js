/******************************************************** JSON *************************************************/
function buscar_unidad() {
    var id = trae('cnu-id_unidad');
    var valor = id.value.split(" - ");

    if (valor[0]!="") {
        $.get('../cnu/buscar-unidad',{id : valor[0]},function(data){
            if (data==0) {
                id.value = "";
            }
        });
    } else {
        id.value = "";
    }
}

function buscar_clasificacion() {
    var id = trae('cnu-id_clasificacion')
    var valor = id.value.split(" - ");

    if (valor[0]!="") {
        $.get('../cnu/buscar-clasificacion',{id : valor[0]},function(data){
            if (data==0) {
                id.value = "";
            }
        });
    } else {
        id.value = "";
    }
}
function buscar_partida() {
    var id = trae('cnu-id_partida');
    var valor = id.value.split(" - ");

    if (valor[0]!="") {
        $.get('../cnu/buscar-partida',{id : valor[0]},function(data){
            if (data=="0") {
                id.value = "";
            }
        });
    } else {
        id.value = "";
    }
}
function buscar_cuenta() {
    var id = trae('cnu-cuentac');
    var valor = id.value.split(" - ");

    if (valor[0]!="") {
        $.get('../cnu/buscar-cuenta',{id : valor[0]},function(data){
            if (data==0) {
                id.value = "";
            }
        });
    } else {
        id.value = "";
    }
}