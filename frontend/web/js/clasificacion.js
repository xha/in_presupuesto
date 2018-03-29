$(function() {
});

/******************************************************** JSON *************************************************/
function buscar_padre() {
    var nivel = trae('clasificacion-nivel').value;
    var padre = trae('clasificacion-padre');
    var i;

    padre.length = 0;
    padre[0] = new Option("Seleccione","","","");
    if (nivel!="") {
        $.get('../clasificacion/buscar-padre',{nivel : nivel},function(data){
            var data = $.parseJSON(data);
            if (data!="") {
                for (i=0; i < data.length; i++) {
                    padre[i+1] = new Option(data[i].descripcion,data[i].id_clasificacion,"","");
                }
            }
        });
    }
}