/******************************************************** JSON *************************************************/
function buscar_partida() {
    var id = trae('partidascuentas-id_partida');
    var descripcion = trae('partidascuentas-descripcion_partida');
    var valor = id.value.split(" - ");

    if (valor[0]!="") {
        $.get('../cnu/buscar-partida',{id : valor[0]},function(data){
            if (data=="0") {
                id.value = "";
                descripcion.value = "";
            } else {
                id.value = valor[0];
                descripcion.value = valor[1];
            }
        });
    } else {
        id.value = "";
        descripcion.value = "";
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