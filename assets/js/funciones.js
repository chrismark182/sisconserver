//GLOBAL
var _row = null;
var _activeId = 0;
var _nextId = 1;
var _nextIdpre = 1;
var aprecio=0.0;
var dprecio =0.0;

$( document ).ready(function() {
	
	$('.collapsible').collapsible();

	//Global
	var fecha = moment().format("YYYY/MM/DD");
	$('#fecha').val(fecha);
	
	var fecha2 = moment().format("YYYY-MM");
	var fecha2 = fecha2 + "-001";
	var num =$('#num').val();

	$('#numero').val(num);
	
	$("#btnnuevo" ).click(function() {
		$('#btnnuevo').prop( "disabled", true );
    productAddToTable();
	});
	
	
	$("#btnaddprecio" ).click(function() {
	
	$('#btnaddprecio').prop( "disabled", true );
    priceAddToTable();
	});
	
	$("#btnaddpre" ).click(function() {
		alert("1");
	});
	
	

	$("input[name=empresa]").change(function () {	 
		$('#empresaid').val(($(this).val()));		
	});
	
	$("input[name=tipo]").change(function () {	 
		$('#tipoid').val(($(this).val()));		
	});
	
	
	$("input[name=tipo]").change(function () {
		
		if($(this).attr('id')=="tipo1"){
			$("#divdepartamento").hide();
		}
		else
		{
			$("#divdepartamento").show();
		}
	});
	
	
	//CHECKBOX
	$("#gg").click(function() {  
        if($("#gg").is(':checked')) {  
			$('#datogg').val("X");
        } else {  
            $('#datogg').val("");  
        }  
    });
	
	$("#administracion").click(function() {  
        if($("#administracion").is(':checked')) {  
			$('#datoadmi').val("X");
        } else {  
            $('#datoadmi').val("");  
        }  
    });
	
	$("#sistemas").click(function() {  
        if($("#sistemas").is(':checked')) {  
			$('#datosis').val("X");
        } else {  
            $('#datosis').val("");  
        }  
    });
	
	$("#monitoreo").click(function() {  
        if($("#monitoreo").is(':checked')) {  
			$('#datomon').val("X");
        } else {  
            $('#datomon').val("");  
        }  
    });
	
	$("#operarios").click(function() {  
        if($("#operarios").is(':checked')) {  
			$('#datooper').val("X");
        } else {  
            $('#datooper').val("");  
        }  
    });
	
	$("#galmacen").click(function() {  
        if($("#galmacen").is(':checked')) {  
			$('#datogal').val("X");
        } else {  
            $('#datogal').val("");  
        }  
    });
	
	$("#operaciones").click(function() {  
        if($("#operaciones").is(':checked')) {  
			$('#datoopera').val("X");
        } else {  
            $('#datoopera').val("");  
        }  
    });
	
	$("#seguridad").click(function() {  
        if($("#seguridad").is(':checked')) {  
			$('#datosegu').val("X");
        } else {  
            $('#datosegu').val("");  
        }  
    });
	
	$("#rrhh").click(function() {  
        if($("#rrhh").is(':checked')) {  
			$('#datorrhh').val("X");
        } else {  
            $('#datorrhh').val("");  
        }  
    });
	
	$("#otros").click(function() {  
        if($("#otros").is(':checked')) {  
			$('#datootr').val("X");
        } else {  
            $('#datootr').val("");  
        }  
    });  	
	//FIN CHECKBOX
		
	$("input[name=rfile]").change(function () {	 
		
		$('#rfileid').val(($(this).val()));
	});	
		

	$("#btnprocesar").click(function() {
			
	var filas = [];
	var tot=0;
    $('#tabledetalle tbody tr').each(function() {
		
	if($(this).find('input[class="col1"]').val()!==undefined){//Para que solo ingrese los campos completos
	
      var cant = $(this).find('input[class="col1"]').val();
      var un = $(this).find('input[class="col2"]').val();
      var stock = $(this).find('input[class="col3"]').val();
      var areas = $(this).find('input[class="col4"]').val();
      var vb = $(this).find('input[class="col5"]').val();
      var descrip = $(this).find('input[class="col6"]').val();
      var provee = $(this).find('input[class="col7"]').val();
      var precio = $(this).find('input[class="col8"]').val();

	  var fila =  {"cant" : cant,"un": un,"stock" : stock, "areas":areas, "vb" : vb,"descrip":descrip,"provee": provee,"precio":precio }
      ;
	  
      filas.push(fila);
	
	}
    });
	
	
	var desa =JSON.stringify(filas);

	$('#vararray').val(desa);
	
	});
	
	
	
	
	
  $("#btnadd" ).click(function() {
		$('#cant_1').prop('readonly', true);
		$('#un_1').prop('readonly', true);
		$('#stock_1').prop('readonly', true);
		$('#area_1').prop('readonly', true);
		$('#vb_1').prop('readonly', true);
		$('#descrip_1').prop('readonly', true);
		$('#provee_1').prop('readonly', true);
		$('#precio_1').prop('readonly', true);
		$("#btnadd").hide();
});

//
$('#tableenproceso').on('click', 'button[name="btnpreciog"]',function(){
		
	var idsolabas = $(this).attr('attr_idsoli_ver');
	var vprecio = $('#precio_'+idsolabas).val();
	var psoliabas;
	
	if(vprecio=== '' || vprecio === 0.00 || parseInt(vprecio) === 0  ){
		alert("Precio esta vacio, ingresar un valor");
		return false;
	}
	
	
	$.ajax({
		url:"http://siscon.aqp-group.com.pe/info/updateprecio",
         //url:"http://localhost/siscon/info/updateprecio",
          type:'POST',
          data: {
			  "vs_var1" : vprecio,
			  "vs_var2" : idsolabas,
		  },
		  dataType:"JSON",
		  async:false,
		  success:function(result){
			  
			    var len = result['result'].length;
			  
			  for(var i=0; i<len; i++){
                
				psoliabas = result['result'][i].SOLABAS_PRECIO;
				
				 $('#psoliabas').val(psoliabas); 
	
				
			  }
           },
		   erro:function(){
			   
		   },
        });
	
		var preciosolabas = $('#psoliabas').val(); 
		//console.log(preciosolabas);
		
		$('#precio_'+idsolabas).hide();
		$('#btnpreciog_'+idsolabas).hide();
		$('#tdprecio_'+idsolabas).text(preciosolabas);
		$('#vporcen_'+idsolabas).text("0 %");
		$('#btnedit_'+idsolabas).prop( "disabled", false );
		
});	
	

//
$('#tablalist').on('click', 'button[name="btnver"]',function(){	
	
	var soliabas_id = $(this).attr('attr_soliabas_id');
	//alert(soliabas_id);
	
	$('#fechav').val();
	$('#numerov').val();
	
	
	  $.ajax({
		  url:"http://siscon.aqp-group.com.pe/info/validate",
          //url:"http://localhost/siscon/info/validate",
          type:'POST',
          data: {
			  "vs_var1" : soliabas_id
		  },
		  dataType:"JSON",
		  success:function(result){
			  
			   var len = result['result'].length;
			  
			  for(var i=0; i<len; i++){
                var soliabas_id = result['result'][i].SOLABAS_N_ID;
				var soliabas_date = result['result'][i].SOLABAS_DATE;
                var soliabas_num = result['result'][i].SOLABAS_NUMERO;
                var soliabas_emp = result['result'][i].SOLABAS_EMPRESA;
                var soliabas_tip = result['result'][i].SOLABAS_TIPO;
                var soliabas_departgg = result['result'][i].SOLABAS_DEPARTGG.trim();
                var soliabas_departadmi = result['result'][i].SOLABAS_DEPARTADMI.trim();
                var soliabas_departsiste = result['result'][i].SOLABAS_DEPARTSISTE.trim();
                var soliabas_departmoni = result['result'][i].SOLABAS_DEPARTMONI.trim();
                var soliabas_departoper = result['result'][i].SOLABAS_DEPARTOPER.trim();
                var soliabas_departgalma = result['result'][i].SOLABAS_DEPARTGALMA.trim();
                var soliabas_departopera = result['result'][i].SOLABAS_DEPARTOPERA.trim();
                var soliabas_departsegu = result['result'][i].SOLABAS_DEPARTSEGU.trim();
                var soliabas_departrrhh = result['result'][i].SOLABAS_DEPARTRRHH.trim();
                var soliabas_departotros = result['result'][i].SOLABAS_DEPARTOTROS.trim();
                var soliabas_otrosobs = result['result'][i].SOLABAS_OTROSOBS;//SOLABAS_OTROSOBS
                var soliabas_descrip = result['result'][i].DESCRIPCION;
                var soliabas_file1 = result['result'][i].FILE1;
                var soliabas_file2 = result['result'][i].FILE2;
                var soliabas_file3 = result['result'][i].FILE3;
				
								
				$('#fechav').val(soliabas_date);
				$('#numerov').val(soliabas_num);
				
				console.log(soliabas_tip);
				
				if(soliabas_tip==1)
					$('#titulosolicitud').text("Solicitud Obras");
				else if(soliabas_tip==2)
				    $('#titulosolicitud').text("Solicitud Abastecimiento");
						
				$("#empresa"+soliabas_emp).attr('checked', 'checked');
				$("#tipo"+soliabas_tip).attr('checked', 'checked');
				$('#otrosin').val(soliabas_otrosobs);
				
				
				if(soliabas_departgg=="X"){
					$("#gg").attr('checked', 'checked');
				}	
				if(soliabas_departadmi=="X"){
					$("#administracion").attr('checked', 'checked');
				}	
				if(soliabas_departsiste=="X"){
					$("#sistemas").attr('checked', 'checked');
				}	
				if(soliabas_departmoni=="X"){
					$("#monitoreo").attr('checked', 'checked');
				}	
				if(soliabas_departoper=="X"){
					$("#operarios").attr('checked', 'checked');
				}	
				if(soliabas_departgalma=="X"){
					$("#galmacen").attr('checked', 'checked');
				}	
				if(soliabas_departopera=="X"){
					$("#operaciones").attr('checked', 'checked');
				}	
				if(soliabas_departsegu=="X"){
					$("#seguridad").attr('checked', 'checked');
				}	
				if(soliabas_departrrhh=="X"){
					$("#rrhh").attr('checked', 'checked');
				}	
				if(soliabas_departotros=="X"){
					$("#otros").attr('checked', 'checked');
				}
			
				
				if(soliabas_tip==1){
					
					$("#divdepartamento").hide();
					
				}
				
				$('#descrip').val(soliabas_descrip);
				$('#afile1').attr("href", "./uploads/"+ soliabas_file1);
				$('#file1').attr("src", "./uploads/"+ soliabas_file1);
				$('#afile2').attr("href", "./uploads/"+ soliabas_file2);
				$('#file2').attr("src", "./uploads/"+ soliabas_file2);
				$('#afile3').attr("href", "./uploads/"+ soliabas_file3);
				$('#file3').attr("src", "./uploads/"+ soliabas_file3);
				$('#idsolabas').val(soliabas_id);
							


            }
			  
           },
		   erro:function(){
			   
		   },
            });
	$('#modal1').modal('open');
				
});

$('#tableenproceso').on('click', 'button[name="btnedit"]',function(){	

var solabas_id = $(this).attr('attr_solabas_id');

$.ajax({	
		url:"http://siscon.aqp-group.com.pe/info/edit",
          //url:"http://localhost/siscon/info/edit",
          type:'POST',
          data: {
			  "vs_var1" : solabas_id
		  },
		  dataType:"JSON",
		  success:function(result){
			  
			   var len = result['result'].length;
			  
			  for(var i=0; i<len; i++){
                var soliabas_id = result['result'][i].SOLABAS_N_ID;
				var soliabas_date = result['result'][i].SOLABAS_DATE;
                var soliabas_num = result['result'][i].SOLABAS_NUMERO;
                var soliabas_emp = result['result'][i].SOLABAS_EMPRESA;
                var soliabas_tip = result['result'][i].SOLABAS_TIPO;
                var soliabas_descrip = result['result'][i].DESCRIPCION;
                var soliabas_precio = result['result'][i].SOLABAS_PRECIO;
				
				
				
				$('td[name="cnum"]').text(soliabas_num);
				$('td[name="cfecha"]').text(soliabas_date);
				$('td[name="cobab"]').text(soliabas_descrip);
				$('td[name="preci"]').text(soliabas_precio);
				$('#id_solabas').val(soliabas_id);
            }
			  
           },
		   erro:function(){
			   
		   },
            });		
			
			


var table = $('#tabledetprecio');

//INICIO
		$.ajax({
		  url:"http://siscon.aqp-group.com.pe/info/detpagolist",
          //url:"http://localhost/siscon/info/detpagolist",
          type:'POST',
          data: {
			  "vs_var1" : solabas_id
		  },
		  dataType:"JSON",
		  success:function(result){
			  
		var len = result['result'].length;
		
		table.append("<tbody>");

		for(var i=0; i<len; i++){
			 var descrip_pago = result['result'][i].DESCRIPCION;
			 var monto_pago = result['result'][i].PAGO;
			 var fecha_pago = result['result'][i].FECHA;
			
			table.append("<tr><td>"+ descrip_pago +"</td><td>" + monto_pago + "</td><td></td></tr>");
		}
		     table.append("</tbody>");
		  },
			erro:function(){
			   
		   },
        });			  
//FIN


});


$('#tableculminado').on('click', 'button[name="btndetcul"]',function(){	
 
var solabas_id = $(this).attr('attr_solabas_id');

//console.log(solabas_id);

var table = $('#tablehistorico');

//INICIO
		$.ajax({
		 url:"http://siscon.aqp-group.com.pe/info/detcullist",
          //url:"http://localhost/siscon/info/detcullist",
          type:'POST',
          data: {
			  "vs_var1" : solabas_id
		  },
		  dataType:"JSON",
		  success:function(result){
			  
		var len = result['result'].length;
		
		table.append("<tbody>");

		for(var i=0; i<len; i++){
			 var descrip_pago = result['result'][i].DESCRIPCION;
			 var monto_pago = result['result'][i].PAGO;
			 
			
			 
			 var fecha_pago = result['result'][i].FECHA;
			
			 var fechahisto = moment(fecha_pago).format("YYYY-MM-DD");
			
			
			table.append("<tr><td>" + fechahisto + "</td><td>"+ descrip_pago +"</td><td>" + monto_pago + "</td><td></td></tr>");
		}
		     table.append("</tbody>");
		  },
			erro:function(){
			   
		   },
        });			  
//FIN

});




 $('#modal2').modal({
   onCloseStart(){
	   //$("#tabledetprecio tbody").empty();
	   $("#tabledetprecio tbody").remove();
	   //$("#tabledetprecio").empty();
	   $('#btnaddprecio').prop( "disabled", false );
           // console.log("Close Start");
        },
   onCloseEnd(){
	   //$("#tabledetprecio > tr").empty();
           // console.log("Close End");
        },
  });
  
   $('#modal3').modal({
   onCloseStart(){
	   //$("#tabledetprecio tbody").empty();
	   $("#tablehistorico tbody").remove();
	   //$("#tabledetprecio").empty();
	   $('#tablehistorico').prop( "disabled", false );
           // console.log("Close Start");
        },
   onCloseEnd(){
	   //$("#tabledetprecio > tr").empty();
           // console.log("Close End");
        },
  });

//var instance = M.Modal.getInstance("#modal2");

//instance.destroy();
//var onModalHide = function() { alert("Modal closed!"); }; 

//$("#modal2").openModal({ complete : onModalHide }); 

//$('#modal2').openModal({ dismissible: false});
//$('#tabledetprecio').on('click', 'button[name="btnaddp"]',function(){	

//alert("AGREGADO");
//});



//$("#btnver").click(function() {
	
	//alert("1");
	
	//e.preventDefault();
	/*
	var soliabas_id = $(this).attr('attr_soliabas_id');
	alert(soliabas_id);
	
	$('#fechav').val();
	$('#numerov').val();
	
	  $.ajax({
          url:"http://localhost/siscon/info/validate",
          type:'POST',
          data: {
			  "vs_var1" : soliabas_id
		  },
		  dataType:"JSON",
		  success:function(result){
			  
			   var len = result['result'].length;
			  
			  for(var i=0; i<len; i++){
                var soliabas_date = result['result'][i].SOLABAS_DATE;
                var soliabas_num = result['result'][i].SOLABAS_NUMERO;
                var soliabas_emp = result['result'][i].SOLABAS_EMPRESA;
                var soliabas_tip = result['result'][i].SOLABAS_TIPO;
                var soliabas_descrip = result['result'][i].DESCRIPCION;
				
				$('#fechav').val(soliabas_date);
				$('#numerov').val(soliabas_num);
				
				$("#empresa"+soliabas_emp).attr('checked', 'checked');
				$("#tipo"+soliabas_tip).attr('checked', 'checked');
				
				
				if(soliabas_tip==1){
					
					$("#divdepartamento").hide();
					
				}
				
				$('#descrip').val(soliabas_descrip);


            }
			  
           },
		   erro:function(){
			   
		   },
            });	
			*/
			
			
			
			//result.preventDefault();
//});//btnver





});//document


//$("#des_1").on("keyup", function() {
  //  	alert("1");
		//$("#parrafo").text("Tecla soltada");
//});		
	


function productDelete(ctl) {
  _row = $(ctl).parents("tr");
  var cols = _row.children("td");
 //obtengo la variable
 //console.log($($(cols[7]).children("input")[0]).val());
 var monto = $($(cols[7]).children("input")[0]).val();
 var total = $("#total").text();
 
dprecio = total - monto ;

$("#total").text(dprecio); 
	//limpiar
	aprecio=0.0;
	
$(ctl).parents("tr").remove();
  
}


function productDisplay(id) {
 //$(ctl).parents("tr").css({"color": "red", "border": "2px solid red"});
 //alert(ctl);
 //$('#btndelete_'+id).show();
 $('#btndelete_'+id ).prop( "disabled", false );
 $('#btndelete_'+id ).removeClass("disabled");
 $('#cant_'+id).prop('readonly', true);
 $('#un_'+id).prop('readonly', true);
 $('#stock_'+id).prop('readonly', true);
 $('#area_'+id).prop('readonly', true);
 $('#vb_'+id).prop('readonly', true);
 $('#descrip_'+id).prop('readonly', true);
 $('#provee_'+id).prop('readonly', true);
 $('#precio_'+id).prop('readonly', true);
 //$( "#x" ).prop( "disabled", true );
 $('#btnadd_'+id).hide();
 
 
if(parseInt($('#precio_'+id).val()) > 0){	
aprecio= aprecio + parseInt($('#precio_'+id).val());

dprecio = aprecio.toFixed(2);

$("#total").text(dprecio); 

}
else{
$("#total").text("0.0"); 	
}

}


function AgregarPrecio(ctl){
	//Variables de proceso anterior
	var vsoliabas = $('#id_solabas').val();
	 
	
	var sum = 0;
	var porcen=0;
	var sumtotal=0;
	
	_row = $(ctl).parents("tr");
  var cols = _row.children("td");
  
  var total=$('td[name="preci"]').text();
  
  //console.log(total);
  //return false;

 $($(cols[0]).children("input")[0]).attr("disabled", true);//attr('disabled','disabled');
 $($(cols[1]).children("input")[0]).prop("disabled", true );
 $($(cols[2]).children("button")[0]).prop("disabled", true );
  var vdes = $($(cols[0]).children("input")[0]).val();
  var vpago = parseFloat($($(cols[1]).children("input")[0]).val());
  
 
  
//console.log(n);
// return false;
 
//return false;


	if(vpago > total){
		alert("Pago Mayor al Total de Precio");
		$($(cols[0]).children("input")[0]).attr("disabled", false);//attr('disabled','disabled');
		$($(cols[1]).children("input")[0]).prop("disabled", false );
		$($(cols[2]).children("button")[0]).prop("disabled", false );
		return false;
	}


var r = confirm("Desea grabar Pago");
 
 if (r == true) {
	
	$.ajax({
		 url:"http://siscon.aqp-group.com.pe/info/conprecio",
          //url:"http://localhost/siscon/info/conprecio",
          type:'POST',
          data: {
			  "vs_var1" : vsoliabas
		  },
		  dataType:"JSON",
		  success:function(result){
			  

			
			   var len = result['result'].length;
			   
			   if(len==0)
			   {
				   		   
				   $.ajax({
					   url:"http://siscon.aqp-group.com.pe/info/pagoins",
						//url:"http://localhost/siscon/info/pagoins",
						type:'POST',
						data: {
						"vs_var1" : vpago,
						"vs_var2" : vdes,
						"vs_var3" : vsoliabas,
						"vs_var4" : total
						},
						dataType:"JSON",
						success:function(result){
											
						porcen = (vpago/total)*100;
						
						porcen=porcen.toFixed(2);
						porcen=Math.round(porcen);
													
						//$('td[name="vcompletado"]').text("% " + porcen);
						$('#vporcen_'+vsoliabas).text(porcen + " % " );
						
						
						$('#tdprecio_'+vsoliabas).text(vpagO + "/" + total );

						},
						erro:function(){
						},
					});
					
				   
			   }
			   else
			   {
				    
				//console.log("entra aqui");

			  var solabas_pago = 0;
			 
			  
			  for(var i=0; i<len; i++){
				  
				solabas_pago = result['result'][i].PAGO;
				
				sum = parseInt(sum) + parseInt(solabas_pago);
				
				//console.log(sum);//OBTENTO LA SUMA

            }				
			
					
			
			sumtotal = parseInt(sum) + parseInt(vpago);
			
			if((sumtotal)>total){
				alert("Sobrepasa el monto total");
				$($(cols[0]).children("input")[0]).attr("disabled", false);//attr('disabled','disabled');
				$($(cols[1]).children("input")[0]).prop("disabled", false );
				$($(cols[2]).children("button")[0]).prop("disabled", false );
				return false;
			}
			
			
			
			
			$.ajax({
					url:"http://siscon.aqp-group.com.pe/info/pagoins",
						//url:"http://localhost/siscon/info/pagoins",
						type:'POST',
						data: {
						"vs_var1" : vpago,
						"vs_var2" : vdes,
						"vs_var3" : vsoliabas,
						"vs_var4" : total,
						"vs_var5" : sumtotal
						},
						dataType:"JSON",
						success:function(result){
											
						porcen = (sumtotal/total)*100;
						
						porcen=porcen.toFixed(2);
						porcen=Math.round(porcen);
													
						//$('td[name="vcompletado"]').text("% " + porcen);
						$('#vporcen_'+vsoliabas).text(porcen + " % " );
						
						if(porcen==100){
							
						$('button[attr_solabas_id="'+vsoliabas+'"]').prop('disabled', true);
						//window.location.reload();
						//Cargar pagina web
						location.reload();
						}
						},
						erro:function(){
						},
					});		
			 }
			  
           },
		   erro:function(){
			   
		   },
         });
		 
	} else {
	alert("Cancelar");
  }
  
  
  
  //$("#btnedit").attr('attr_solabas_id')
 
 //vsoliabas
 
//$('button[attr_solabas_id="'+vsoliabas+'"]').prop('disabled', true);

 //$($(cols[0]).children("input")[0]).attr("disabled", true);//attr('disabled','disabled');
 //$($(cols[1]).children("input")[0]).prop("disabled", true );
 //$($(cols[2]).children("button")[0]).prop("disabled", true );
//$($(cols[2]).children("button")[0]).prop("disabled", false );

}//aqui termina






function priceAdd(id) {
	
// var vsoliabas = $('#id_solabas').val();
 //var sum = 0;
 //var porcen=0;
 //var sumtotal=0;
 
 
  //var vardes = "#des_1"+id.toString();
  //var varpago = "#pago_1"+id.toString();
  
  //console.log($("#des_1").val());
  //console.log($("#pago_1").val());
	
	//document.getElementById("des_1").getAttribute("value");
	
	
	//console.log();
	
	
	//var age = $('#des_1').val(); 
	//console.log(age);
	//var vdes = $(vardes).val();
	//var vdes = $("#des_1").val();
	//console.log(vdes);
	//var vpago = $(varpago).val();
	//var vpago = $("#pago_1").val();
	//console.log(vpago);
	//var vbtnadd=$("#btnaddp_" + id);
	//var total=$('td[name="preci"]').text();
  
  
 /*
 var r = confirm("Desea grabar Pago");
 
 if (r == true) {
	
	console.log(id);
		
	
	if(vpago > total){
		
		alert("Pago Mayor al Total de Precio")
		return false;
	}
	
	$("#des_" + id).prop('readonly', true);
	$("#pago_" + id).prop('readonly', true);
	$("#btnaddp_" + id).prop( "disabled", true );
	
	
	$.ajax({
          url:"http://localhost/siscon/info/conprecio",
          type:'POST',
          data: {
			  "vs_var1" : vsoliabas
		  },
		  dataType:"JSON",
		  success:function(result){
			  

			
			   var len = result['result'].length;
			   
			   if(len==0)
			   {
				   		   
				   $.ajax({
						url:"http://localhost/siscon/info/pagoins",
						type:'POST',
						data: {
						"vs_var1" : vpago,
						"vs_var2" : vdes,
						"vs_var3" : vsoliabas,
						"vs_var4" : total
						},
						dataType:"JSON",
						success:function(result){
											
						porcen = (vpago/total)*100;
						
						porcen=porcen.toFixed(2);
						porcen=Math.round(porcen);
													
						$('td[name="vcompletado"]').text("% " + porcen);

						},
						erro:function(){
						},
					});
					
				   
			   }
			   else
			   {

			  var solabas_pago = 0;
			 
			  
			  for(var i=0; i<len; i++){
				  
				solabas_pago = result['result'][i].PAGO;
				
				sum = parseInt(sum) + parseInt(solabas_pago);

            }				
			
			
			sumtotal = parseInt(sum) + parseInt(vpago);
			$.ajax({
						url:"http://localhost/siscon/info/pagoins",
						type:'POST',
						data: {
						"vs_var1" : vpago,
						"vs_var2" : vdes,
						"vs_var3" : vsoliabas,
						"vs_var4" : total,
						"vs_var5" : sumtotal
						},
						dataType:"JSON",
						success:function(result){
											
						porcen = (sumtotal/total)*100;
						
						porcen=porcen.toFixed(2);
						porcen=Math.round(porcen);
													
						$('td[name="vcompletado"]').text("% " + porcen);

						},
						erro:function(){
						},
					});		
			 }
			  
           },
		   erro:function(){
			   
		   },
         });
		 
 } else {
	alert("Cancelar");
  }
 */
 

}

function AprobarSolicitud(data){
var r = confirm("Desea Aprobar");	
		if (r == true) {
		//console.log(data);
						//ajax -->ejecucion
						$.ajax({
							//http://siscon.aqp-group.com.pe/info/pagoins
						url:"http://siscon.aqp-group.com.pe/info/aprobarsolicitud",
						type:'POST',
						data: {
						"vs_var1" : data
						},
						dataType:"JSON",
						success:function(result){

						location.reload();
						},
						erro:function(){
						},
						});
		}	
}




function productAddToTable() {
  // Does tbody tag exist ? add one if not
  if ($("#tabledetalle tbody").length == 0) {
    $("#tabledetalle")
      .append("<tbody></tbody>");
  }
  // Append product to table
  $("#tabledetalle tbody").append(
    productBuildTableRow(_nextId));
  // Increment next ID to use
  _nextId += 1;
}

function priceAddToTable() {
  // Does tbody tag exist ? add one if not
  if ($("#tabledetprecio tbody").length == 0) {
    $("#tabledetprecio").append("<tbody></tbody>");
  }
  // Append product to table
  $("#tabledetprecio tbody").append(
    priceBuildTableRow(_nextIdpre));
  // Increment next ID to use
  _nextIdpre += 1;
}


function productBuildTableRow(id) {

  var ret =
  "<tr>" +
    "<td style='width: 40px;' class='numero'>" + "<input type='number' class='col1' id='cant_"+ id +"' name='cant_"+ id +"'>" + "</td>" +
    "<td>" + "<input type='text' class='col6' id='descrip_"+ id +"' name='descrip_"+ id +"'>" + "</td>" +
    "<td>" + "<div class = 'file-field input-field'><div class = 'btn btn-small' style='background-color: #CDCDCD'><i class='material-icons'>attach_file</i><input type = 'file' name='userfile1_"+ id +"' /></div><div class = 'file-path-wrapper'><input class = 'file-path validate' type ='text' placeholder = 'Upload file' /></div></div>" + "<div class = 'file-field input-field'><div class = 'btn btn-small' style='background-color: #CDCDCD'><i class='material-icons'>attach_file</i><input type = 'file' name='userfile2_"+ id +"' /></div><div class = 'file-path-wrapper'><input class = 'file-path validate' type ='text' placeholder = 'Upload file' /></div></div>" +  "<div class = 'file-field input-field'><div class = 'btn btn-small' style='background-color: #CDCDCD'><i class='material-icons'>attach_file</i><input type = 'file' name='userfile3_"+ id +"' /></div><div class = 'file-path-wrapper'><input class = 'file-path validate' type ='text' placeholder = 'Upload file' /></div></div>" + "</td>" +
    "<td style='width:150px;' >" + 
	"<button type='button' onclick='productDelete(this);' class='btn-floating red' id='btndelete_"+ id +"' " +
              "data-id='" + id + "' >" +
              "<i class='material-icons'>close</i></button>"
	  +
    "</td>" +
  "</tr>"
      
  return ret;
}


function priceBuildTableRow(id) {

  var ret =
  "<tr>" +
    "<td  class='descripcion'>" + "<input type='text' class='col1' id='des_"+ id +"' name='des_"+ id +"' autocomplete='off'   >" + "</td>" +
    "<td>" + "<input type='text' class='col6' id='pago_"+ id +"' name='pago_"+ id +"' autocomplete='off'>" + "</td>" +
    "<td style='width:150px;' >" + 
	"<button type='button' class='btn-floating' style='right:0px!important;bottom:0px!important;' id='btnaddpre' onclick='AgregarPrecio(this);' name='btnaddpre_"+ id +"' data-id='" + id + "' >" + "<i class='material-icons small'>check</i></button>" +
    "</td>" + "</tr>";
  
  //onclick='priceAdd("+ id +");'
  // <i class='material-icons small'>check</i>   
	  
	  
  return ret;
}