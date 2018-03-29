$(function() {
});

/******************************************************** JSON *************************************************/
function compuesta() {
    var id_partida = trae('partida-id_partida');
    var partida = trae('partida-partida').value;
    var generica = trae('partida-generica').value;
    var especifica = trae('partida-especifica').value;
    var subespecifica = trae('partida-subespecifica').value;
    
    id_partida.value = "";
    if ((partida!="") && (generica!="") && (especifica!="") && (subespecifica!="")) {
        id_partida.value = partida + generica + especifica + subespecifica;
    }
}