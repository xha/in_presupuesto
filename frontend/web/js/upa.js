$(function() {
    
});
/******************************************** VISTA******************************************************/
function titulo_detalle() {
    var arreglo = new Array();
        arreglo[0] = 'Nro';
        arreglo[1] = 'Código';
        arreglo[2] = 'Descripción';
        arreglo[3] = 'Cantidad';
        arreglo[4] = 'Precio';
        arreglo[5] = 'Impuesto';
        arreglo[6] = 'Total';
        arreglo[7] = 'Serv';
        arreglo[8] = 'Opt';

    var tabla = document.getElementById('listado_detalle');
        tabla.innerHTML = "";

    tabla.appendChild(add_filas(arreglo, 'th','','',8));
}

function titulo_producto() {
    var arreglo = new Array();
        arreglo[0] = 'Código';
        arreglo[1] = 'Descripción';
        arreglo[2] = 'Exento';
        arreglo[3] = 'Servicio';
        arreglo[4] = 'Cantidad';
        arreglo[5] = 'Costo';
        arreglo[6] = 'Add';

    var tabla = document.getElementById('resultado_producto');
        tabla.innerHTML = "";

    tabla.appendChild(add_filas(arreglo, 'th','','',6));
}
/******************************************************** JSON *************************************************/
function buscar_clasificacion() {
    var asignacion = trae('upa-asignacion').value;
    var img = trae('load');
    var clasificacion = trae('upa-id_clasificacion');
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
    var clasificacion = trae('transaccion-id_clasificacion').value;
    var img = trae('load');
    var partida = trae('transaccion-id_partida');
    var i;

    partida.length = 0;
    partida[0] = new Option("Seleccione","","","");
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
    var m_producto = trae('m_producto').value;
    var servicio = trae('m_esprod').value;
    var partida = trae('transaccion-id_partida').value;
    var clasificacion = trae('transaccion-id_clasificacion').value;
    var tabla = trae('resultado_producto');
    var img = trae('img_producto');
    var bloqueo = trae('h_bloqueo');
    var i;
    var y;
    var texto = "";

    bloqueo.innerHTML = "";
    if ((clasificacion!="") && (partida!="")) {
        img.style.visibility = "visible";
        titulo_producto();
        $.getJSON('../transaccion/buscar-producto',{codigo : m_producto, servicio : servicio},function(data){
            var campos = Array();
            var td = new Array();
            var node = new Array();
            var otro = "";
            if (data!="") {
                for (i = 0; i < data.length; i++) {
                    otro = "";
                    var tr = document.createElement('tr');
                    var valor = i + 1;
                    campos.length = 0;
                    campos.push(data[i].Codigo);
                    otro+=data[i].Codigo+"#";
                    campos.push(data[i].Descrip);
                    otro+=data[i].Descrip+"#";
                    campos.push(data[i].EsExento);
                    otro+=data[i].EsExento+"#";
                    campos.push(data[i].EsServ);
                    otro+=data[i].EsServ+"#";
                    otro+=valor+"#";

                    for (y = 0; y < campos.length; y++) {
                        td[y] = document.createElement('td');
                        texto = campos[y];
                        td[y].align="center"; 
                        td[y].style.maxWidth="200px"; 
                        node[y] = document.createTextNode(texto);
                        td[y].appendChild(node[y]);
                        tr.appendChild(td[y]);
                    }

                    y++;
                    td[y] = document.createElement('td');
                    var input = document.createElement('input');
                    input.className = 'texto texto-xc';
                    input.id = 'c_'+valor;
                    input.addEventListener("keydown", soloEnteros, true);
                    td[y].appendChild(input);
                    tr.appendChild(td[y]);

                    y++;
                    td[y] = document.createElement('td');
                    var input = document.createElement('input');
                    input.className = 'texto texto-xc';
                    input.id = 'i_'+valor;
                    input.addEventListener("keydown", soloNumeros, true);
                    eval("input.onkeyup = function(){Solo_Cantidad('i_"+valor+"');}");
                    td[y].appendChild(input);
                    tr.appendChild(td[y]);

                    y++;
                    td[y] = document.createElement('td');
                    var imagen = document.createElement('img');
                    imagen.width = "24";
                    imagen.style.padding = "3px";
                    imagen.style.cursor = "pointer";
                    imagen.src = "../../../img/mas.png";
                    eval("imagen.onclick = function(){agregar_fila("+valor+",'"+otro+"');}");
                    td[y].appendChild(imagen);
                    tr.appendChild(td[y]);

                    tabla.appendChild(tr);
                }
            }
            img.style.visibility = "hidden";
        });
    } else {
        bloqueo.innerHTML = "Falta Clasificación y/o Partida Presupuestaria";
    }
}