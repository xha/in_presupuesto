$(function() {
    titulo_detalle();
    chequeo();
    if (trae('nro_unico').value != "") {
        busca_detalle();
    }
});

function chequeo() {
    var tipocom = trae('compra-tipocom').value;
    var codubic = trae('compra-codubic');
    var codprov = trae('compra-codprov');
    var fechae = trae('compra-fechae');
    var iva = trae('compra-notas10');
    var b_servicio = trae('b_servicio');
    var d_cantidad = trae('d_cantidad');
    var d_precio = trae('d_precio');

    if (tipocom!='L') {
        codubic.disabled = true;
        fechae.disabled = true;
        codprov.disabled = true;
        b_servicio.disabled = true;
        d_cantidad.disabled = true;
        d_precio.disabled = true;
        iva.disabled = true;
    }
}
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
function buscar_proveedor() {
    var codprov = trae('compra-codprov').value.split(" - ");

    codprov = codprov[0];
    if (codprov!="") {
        $.get('../compra/buscar-proveedor',{prov : codprov},function(data){
            var data = $.parseJSON(data);
            if (data!="") {
                var nombre = trae('compra-descrip');
                var rif = trae('compra-id3');
                var direc1 = trae('compra-direc1');
                var direc2 = trae('compra-direc2');
                var telef = trae('compra-telef');
                
                direc1.value = data.Direc1;
                direc2.value = data.Direc2;
                rif.value = data.ID3;
                telef.value = data.Telef;
                nombre.value = data.Descrip;
                rif.value = data.ID3;
                trae('compra-codprov').value = codprov;
            } else {
                codprov.value = "";
            }
        });
    }
}

function buscar_items() {
    var m_producto = document.getElementById('m_producto').value;
    var servicio = document.getElementById('m_esprod').value;
    var tabla = trae('resultado_producto');
    var img = trae('img_producto');
    var i;
    var y;
    var texto = "";

    if (m_producto!="") {
        img.style.visibility = "visible";
        titulo_producto();
        $.getJSON('../venta/buscar-producto',{codigo : m_producto, servicio : servicio},function(data){
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
    }
}

function busca_detalle() {
    var tipocom = trae('compra-tipocom').value;
    var numerod = trae('compra-numerod').value;
    var codprov = trae('compra-codprov').value;
    
    $.getJSON('../compra/buscar-detalle-compra',{numerod : numerod, tipocom : tipocom, codprov : codprov},function(data){
        if (data!="") {
            var tabla = trae('listado_detalle');
            var campos = new Array();
            var i;

            for (i = 0; i < data.length; i++) {
                campos.length = 0;
                campos.push(data[i].NroLinea);
                campos.push(data[i].CodItem);
                campos.push(data[i].Descrip1+data[i].Descrip2+data[i].Descrip3);
                campos.push(parseFloat(data[i].Cantidad));
                campos.push(parseFloat(data[i].Costo));
                campos.push(parseFloat(data[i].MtoTax));
                campos.push(parseFloat(data[i].TotalItem));
                campos.push(data[i].EsServ);
                
                tabla.appendChild(add_filas(campos, 'td','editar_detalle####cancela_detalle','',8));
            }
        }
    });
}

function agregar_fila(valor,otro) {
    var tabla = trae('listado_detalle');
    var cantidad = trae('c_'+valor);
    var costo = trae('i_'+valor);
    var iva = trae('compra-notas10');
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
        recorre_tabla(); 
    }
}

function editar_detalle(response) {
    var arreglo = response.split("#");
    var d_fila = trae('d_fila');
    var d_nombre = trae('d_nombre');
    var d_cantidad = trae('d_cantidad');
    var d_precio = trae('d_precio');
    var d_total = trae('d_total');
    var exento = trae('es_exento');
    var iva = trae('compra-notas10');
    iva = parseFloat(iva.options[iva.selectedIndex].text);

    arreglo[2] = trae("listado_detalle").rows[arreglo[0]].cells[2].innerHTML;
    arreglo[3] = trae("listado_detalle").rows[arreglo[0]].cells[3].innerHTML;
    arreglo[4] = trae("listado_detalle").rows[arreglo[0]].cells[4].innerHTML;
    d_fila.value = arreglo[0];
    d_nombre.value = arreglo[2];
    d_cantidad.value = arreglo[3];
    d_precio.value = arreglo[4];
    if (arreglo[5]>0) {
        exento.value = 0;
        d_total.value = (parseFloat(arreglo[3]) * parseFloat(arreglo[4])) + ((parseFloat(arreglo[3]) * parseFloat(arreglo[4])) * iva) / 100;
    } else {
        exento.value = 1;
        d_total.value = parseFloat(arreglo[3]) * parseFloat(arreglo[4]);
    }
    
    d_total.value = Math.round(d_total.value * 100) / 100;
}

function cancela_detalle(response) {
    var arreglo = response.split("#");

    rebaja_linea(arreglo[0]);
}

function rebaja_linea(valor) {
    trae("listado_detalle").rows[valor].cells[3].innerHTML = "0";  
    trae("listado_detalle").rows[valor].cells[4].innerHTML = "0";  
    trae("listado_detalle").rows[valor].cells[5].innerHTML = "0";  
    trae("listado_detalle").rows[valor].cells[6].innerHTML = "0";  
}

function recorre_tabla() {
    var descuento = trae('compra-desctop');
    var sub_total = trae('compra-monto');
    var impuesto = trae('compra-mtotax');
    var total = trae('compra-mtototal');

    descuento.value = 0;
    sub_total.value = 0;
    impuesto.value = 0;
    total.value = 0;
    $("#listado_detalle tr").each(function (index) {
        var td = $(this).children("td");
        if (td.eq(0).text()!="") {
            sub_total.value = parseFloat(sub_total.value) + (parseFloat(td.eq(3).text()) * parseFloat(td.eq(4).text()));
            impuesto.value = parseFloat(impuesto.value) + parseFloat(td.eq(5).text());
            total.value = parseFloat(sub_total.value) + parseFloat(impuesto.value);
        }
    });
    
    sub_total.value = Math.round(sub_total.value * 100) / 100;
    impuesto.value = Math.round(impuesto.value * 100) / 100;
    total.value = Math.round(total.value * 100) / 100;
}

function valida_detalle() {
    var fila = trae('d_fila');
    var nombre = trae('d_nombre');
    var cantidad = trae('d_cantidad');
    var precio = trae('d_precio');
    var exento = trae('es_exento');
    var d_total = trae('d_total');
    var total = 0;
    var impuesto = 0;
    var subtotal = 0;
    var iva = trae('compra-notas10');
    iva = parseFloat(iva.options[iva.selectedIndex].text);
    
    subtotal = parseFloat(cantidad.value) * parseFloat(precio.value);
    if (exento.value==0) impuesto = Math.round(((subtotal * iva) / 100) * 100) / 100;
    total = Math.round((subtotal + impuesto) * 100) / 100;
    trae("listado_detalle").rows[fila.value].cells[2].innerHTML = nombre.value;  
    trae("listado_detalle").rows[fila.value].cells[3].innerHTML = cantidad.value;  
    trae("listado_detalle").rows[fila.value].cells[4].innerHTML = precio.value;  
    trae("listado_detalle").rows[fila.value].cells[5].innerHTML = impuesto;
    trae("listado_detalle").rows[fila.value].cells[6].innerHTML = total;  
    
    fila.value = "";
    nombre.value = "";
    cantidad.value = "";
    precio.value = "";
    exento.value = "";
    d_total.value = "";
    recorre_tabla();
}

function enviar_data() {
    var i_items = document.getElementById('i_items');
    var fecha = trae('compra-fechae').value;
    var codprov = trae('compra-codprov').value;
    var descrip = trae('compra-descrip').value;
    var codubic = trae('compra-codubic').value;
    var totalprd = trae('compra-totalprd');
    var totalsrv = trae('compra-totalsrv');
    var costoprd = trae('compra-costoprd');
    var costosrv = trae('compra-costosrv');
    var img = trae('img_load');
    var msj_principal = trae('msj_principal');
    var fila;
    var arreglo;
    i_items.value = "";
    costoprd.value = 0;
    costosrv.value = 0;
    totalprd.value = 0;
    totalsrv.value = 0;
    
    if ((descrip!="") && (fecha!="") && (codprov!="") && (codubic!="")) {
        $("#listado_detalle tr").each(function (index) {
            var td = $(this).children("td");
            if (parseInt(td.eq(6).text())>0) {
                arreglo="";
                arreglo+=td.eq(0).text()+"#";
                arreglo+=td.eq(1).text()+"#";
                arreglo+=td.eq(2).text()+"#";
                arreglo+=td.eq(3).text()+"#";
                arreglo+=td.eq(4).text()+"#";
                arreglo+=td.eq(5).text()+"#";
                arreglo+=td.eq(6).text()+"#";
                arreglo+=td.eq(7).text()+"¬";
                i_items.value+= arreglo;
                if (td.eq(7).text()=='0') {
                    totalprd+=parseFloat(td.eq(3).text()) * parseFloat(td.eq(4).text());
                    costoprd+=parseFloat(td.eq(4).text());
                } else {
                    totalsrv+=parseFloat(td.eq(3).text()) * parseFloat(td.eq(4).text());
                    costosrv+=parseFloat(td.eq(4).text());
                }
            }
        });
        
        if (i_items.value!="") {
            img.style.visibility = "visible";
            trae('btn_enviar').disabled = true;
            document.forms['w0'].submit();
        } else {
            oculta_mensaje('msj_principal','Faltan datos');
        }
    } else {
        oculta_mensaje('msj_principal','Faltan datos');
    }
}

