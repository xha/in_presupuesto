$(function() {
    titulo_detalle();
    buscar_detalle();
});

/******************************************** VISTA******************************************************/
function titulo_detalle() {
    var arreglo = new Array();
        arreglo[0] = 'Fila';
        arreglo[1] = 'Item';
        arreglo[2] = 'Partida';
        arreglo[3] = 'Clasificación';
        arreglo[4] = 'UM';
        arreglo[5] = 'Naturaleza';
        arreglo[6] = 'Mes';
        arreglo[7] = 'Cantidad';
        arreglo[8] = 'Precio';
        arreglo[9] = 'Total';
        arreglo[10] = 'Indice';
        arreglo[11] = 'Observación';
        arreglo[12] = 'Opt';

    var tabla = document.getElementById('listado_detalle');
        tabla.innerHTML = "";

    tabla.appendChild(add_filas(arreglo, 'th','','',12));
}


function agregar_fila(valor,otro) {
    var tabla = trae('listado_detalle');
    var cantidad = trae('c_'+valor);
    var costo = trae('i_'+valor);
    var iva = trae('venta-notas10');
    iva = parseFloat(iva.options[iva.selectedIndex].text);
    var campos = new Array();
    var total = 0;
    var imp = 0;
    
    if ((cantidad.value>0) && (costo.value>0)) {
        var cadena = otro.split("#");

        tabla.rows.length;
        campos.push(tabla.rows.length);
        campos.push(cadena[0]);
        campos.push(cadena[1]);
        campos.push(cantidad.value);
        campos.push(costo.value);
        total =  Math.round((parseFloat(cantidad.value)*parseFloat(costo.value)) * 100) / 100;
        if (cadena[2]=="0") {
            imp = Math.round(((parseFloat(total)*iva) / 100) * 100) / 100;
        } else {
            imp = 0;
        }
        campos.push(imp);        
        campos.push(imp+total);
        campos.push(cadena[3]);
        tabla.appendChild(add_filas(campos, 'td','editar_detalle####cancela_detalle','',8));
        cantidad.value = ""; 
        costo.value = "";
    }
}

function calcula_total() {
    var cantidad = trae('d_cantidad');
    var precio = trae('d_precio');
    var total = trae('d_total');
    
    total.value = "";
    if ((cantidad.value>0) && (precio.value>0)) {
         total.value = Math.round((parseFloat(cantidad.value) * parseFloat(precio.value)) * 100) / 100;
    }
}

function valida_detalle() {
    var fila = trae('d_fila').value;
    var asignacion = trae('levantamiento-asignacion').value;
    var clasificacion = trae('levantamiento-id_clasificacion').value;
    var cantidad = trae('d_cantidad').value;
    var precio = trae('d_precio').value;
    var total = trae('d_total').value;
    var indice = trae('d_indice').value;
    var nombre = trae('d_nombre').value;
    var observacion = trae('d_observacion').value;
    var partida = trae('levantamiento-id_partida').value;
    var um = trae('levantamiento-id_unidad_medida').value;
    var naturaleza = trae('levantamiento-id_naturaleza').value;
    var mes = trae('levantamiento-mes').value;
    var tabla = trae('listado_detalle');
    var msj_principal = trae('msj_principal');
    var campos = new Array();

    msj_principal.innerHTML = "";
    if ((asignacion!="") && (clasificacion!="") && (cantidad!="") && (precio!="") && (indice!="") && (nombre!="") && (partida!="") && (um!="") && (naturaleza!="") && (mes!="") && (total!="")) {
        if (fila>0) {
            if (tabla.rows[fila]!=undefined) {
                tabla.rows[fila].cells[1].innerHTML = nombre;  
                tabla.rows[fila].cells[2].innerHTML = partida;  
                tabla.rows[fila].cells[3].innerHTML = clasificacion;  
                tabla.rows[fila].cells[4].innerHTML = um;  
                tabla.rows[fila].cells[5].innerHTML = naturaleza;  
                tabla.rows[fila].cells[6].innerHTML = mes;  
                tabla.rows[fila].cells[7].innerHTML = cantidad;  
                tabla.rows[fila].cells[8].innerHTML = precio;  
                tabla.rows[fila].cells[9].innerHTML = total;  
                tabla.rows[fila].cells[10].innerHTML = indice;  
                tabla.rows[fila].cells[11].innerHTML = observacion; 
                limpiar_detalle();
                return false;
            }
        }
        
        tabla.rows.length;
        campos.push(tabla.rows.length);
        campos.push(nombre);
        campos.push(partida);
        campos.push(clasificacion);
        campos.push(um);
        campos.push(naturaleza);
        campos.push(mes);
        campos.push(cantidad);
        campos.push(precio);
        campos.push(total);
        campos.push(indice);
        campos.push(observacion);
        tabla.appendChild(add_filas(campos, 'td','editar_detalle####cancela_detalle','',11));
        limpiar_detalle();
    } else {
        oculta_mensaje('msj_principal','Faltan datos');
    }
}

function editar_detalle(response) {
    var filas = trae('d_fila');
    var clasificacion = trae('levantamiento-id_clasificacion');
    var cantidad = trae('d_cantidad');
    var precio = trae('d_precio');
    var total = trae('d_total');
    var indice = trae('d_indice');
    var nombre = trae('d_nombre');
    var observacion = trae('d_observacion');
    var partida = trae('levantamiento-id_partida');
    var um = trae('levantamiento-id_unidad_medida');
    var naturaleza = trae('levantamiento-id_naturaleza');
    var mes = trae('levantamiento-mes');
    var tabla = trae('listado_detalle');
    var arreglo = response.split("#");
    var fila = arreglo[0];
    
    filas.value = tabla.rows[fila].cells[0].innerHTML;
    nombre.value = tabla.rows[fila].cells[1].innerHTML;
    partida.value = tabla.rows[fila].cells[2].innerHTML;
    clasificacion.value = tabla.rows[fila].cells[3].innerHTML;
    um.value = tabla.rows[fila].cells[4].innerHTML;
    naturaleza.value = tabla.rows[fila].cells[5].innerHTML;
    mes.value = tabla.rows[fila].cells[6].innerHTML;
    cantidad.value = tabla.rows[fila].cells[7].innerHTML;
    precio.value = tabla.rows[fila].cells[8].innerHTML;
    total.value = tabla.rows[fila].cells[9].innerHTML;
    indice.value = tabla.rows[fila].cells[10].innerHTML;
    observacion.value = tabla.rows[fila].cells[11].innerHTML;
}

function limpiar_detalle() {
    trae('d_fila').value="";
    trae('levantamiento-id_clasificacion').value="";
    trae('d_cantidad').value="";
    trae('d_precio').value="";
    trae('d_total').value="";
    trae('d_indice').value="1";
    trae('d_nombre').value="";
    trae('d_observacion').value="";
    trae('levantamiento-id_partida').value="";
    trae('levantamiento-id_unidad_medida').value="";
    trae('levantamiento-id_naturaleza').value="";
    trae('levantamiento-mes').value="";
}

function cancela_detalle(response) {
    var arreglo = response.split("#");

    rebaja_linea(arreglo[0]);
}

function rebaja_linea(valor) {
    trae("listado_detalle").rows[valor].cells[7].innerHTML = "0";  
    trae("listado_detalle").rows[valor].cells[8].innerHTML = "0";  
    trae("listado_detalle").rows[valor].cells[9].innerHTML = "0";  
}

function recorre_tabla() {
    var total = trae('levantamiento-total');
    var i_items = trae('i_items');
    var valor = 0;
    var arreglo;
    total.value = 0;
    i_items.value = "";
    
    $("#listado_detalle tr").each(function (index) {
        var td = $(this).children("td");
        if ((td.eq(0).text()!="") && (parseFloat(td.eq(9).text())>0)) {
            valor+= parseFloat(td.eq(9).text());
            arreglo="";
            arreglo+=td.eq(0).text()+"#";
            arreglo+=td.eq(1).text()+"#";
            arreglo+=td.eq(2).text()+"#";
            arreglo+=td.eq(3).text()+"#";
            arreglo+=td.eq(4).text()+"#";
            arreglo+=td.eq(5).text()+"#";
            arreglo+=td.eq(6).text()+"#";
            arreglo+=td.eq(7).text()+"#";
            arreglo+=td.eq(8).text()+"#";
            arreglo+=td.eq(9).text()+"#";
            arreglo+=td.eq(10).text()+"#";
            arreglo+=td.eq(11).text()+"¬";
            i_items.value+= arreglo;
        }
    });
    total.value = valor;
    
    if (i_items.value!="") document.forms['w0'].submit();
}

/******************************************************** JSON *************************************************/
function buscar_partida() {
    var id_partida = trae('levantamiento-id_partida');

    if (id_partida.value!="") {
        $.getJSON('../levantamiento/buscar-partida',{partida : id_partida.value},function(data){
            if (data!="") {
                if (data.conteo==0) {
                    id_partida.value = "";
                } 
            }
        });
    }
}

function buscar_detalle() {
    var id_levantamiento = trae('id');
    var tabla = trae('listado_detalle');
    var campos = new Array();
    var i;

    if (id_levantamiento.value!="") {
        $.getJSON('../levantamiento/buscar-detalle',{id_levantamiento : id_levantamiento.value},function(data){
            if (data!="") {
                for (i=0; i < data.length; i++) {
                    campos.push(i+1);
                    campos.push(data[i].rubro);
                    campos.push(data[i].id_partida);
                    campos.push(data[i].id_clasificacion);
                    campos.push(data[i].id_unidad_medida);
                    campos.push(data[i].id_naturaleza);
                    campos.push(data[i].mes);
                    campos.push(data[i].cantidad);
                    campos.push(data[i].precio);
                    campos.push(data[i].total);
                    campos.push(data[i].indice);
                    campos.push(data[i].observacion);
                    tabla.appendChild(add_filas(campos, 'td','editar_detalle####cancela_detalle','',11));
                }
            }
        });
    }
}