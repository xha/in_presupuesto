$(function() {
    buscar_padre();
});

/******************************************************** JSON *************************************************/
function buscar_padre() {
    var id = trae('id').value;
    var nivel = trae('unidad-nivel').value;
    var padre = trae('unidad-padre');
    var i;

    padre.length = 0;
    padre[0] = new Option("Seleccione","","","");
    if (nivel!="") {
        $.getJSON('../unidad/buscar-padre',{nivel : (nivel-1), actual : id},function(data){
            if (data!="") {
                for (i=0; i < data.length; i++) {
                    padre[i+1] = new Option(data[i].descripcion,data[i].id_unidad,"","");
                }
            }
        });
    }
}