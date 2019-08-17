var jq = jQuery.noConflict();

jq(document).ready(init);

function init(){

	/*Cambiar status del empleado o eliminarlo*/
	jq(".cambiar-status").submit(function(){
		var msg = jq(this).data('submitMsg');
		if( !confirm( msg ))
			event.preventDefault();
	});

	jq(".action-form").submit(function(){
		if( !confirm( jq(this).data('submit-form')) )
			event.preventDefault();
	});

	/*Para agregar un integrante al proyecto de un cliente*/
	jq(".agregar-integrante").click(function(){
		var id = jq(this).attr("id");
		jq.ajax({
	   		url: jq(this).attr("href"),
	   		success: function(response){
	   			jq("#response-"+id).html(response);
	   			jq("#"+id).hide();
	   		}
	   });
	   event.preventDefault();
	});	


	jq(".fecha").datepicker(getConfigDatepIcker( jq(".fecha").attr("id") ));
	
	jq("#agregar-integrante").click(function(){
		jq("#filtro-deptos").show();
	});
	
	jq(".op-form").submit( function(){
		jq(".btn-submit").prop('disabled', true);
	});

	jq('.table-pointer').click( function(){
	   window.location =  jq(this).attr('data-href');
	});	
	
	jq('#estado-ticket').change( function(){
		jq('#cambiar-estado-ticket').submit();
	});

	jq(".busqueda-select-form").submit( function(){
		window.location = window.location + jq(".selectpicker").val();
		return false;		
	});

	jq.ajax({
	  	'url': '/gestion/public/tickets/get-total-tickets-asociados',
	    'success': function(response){
	    	jq('.badge').html(response);
	 	}
	});	
	
	jq.ajax({
		'url': '/gestion/public/tickets/get-last-tickets',
		'success': function(response){
			jq('.ticket-alerts').html(response);
		}
	});

	//CUENTA

	jq(".opciones").click( function(){
		var data = jq(this).data();
		jq.ajax({
			url: jq(this).data('href'),
	        type: 'POST',
	        data: {opcion: data.opcion},
			success: function( response ){
				jq(".response").html(response);
			}
		});
	});

	//roles
	jq(".rol").click( function(){
		var id = jq(this).attr('id');
		var url = jq(this).data('href');
		var id_rol = jq(this).data('id-rol');
		var id_user = jq(this).data('id-user');

		jq.ajax({
			url: url,
			method: 'POST',
			data: { 
				id_rol: id_rol,
				tipo: 'get_roles'
			},
			beforeSend: function(){
				jq('#user-' + id_user).html('<div class="loader"></div>');
			},
			success: function(response){
				jq("#" + id).hide();
				jq("#user-" + id_user).html( response );
			}
		});
	});	

	jq(".clickable-row").click(function() {
	        window.location = jq(this).data("href");
	});

	jq(".fase").click(function(){
		var id_fase = jq(this).data("id-fase");
		console.log(id_fase);
		jq("#id_fase").val(id_fase);
		jq(".form-pipeline-status").submit();
	});

	jq(".delete-empleados").click(function(){ jq(".acciones").fadeIn(); });
	jq("#baja-empleados").click(function(){
		var idEmpleados = [];
		jQuery('[name="delete_empleados[]"]:checked').each(function(i){
		    idEmpleados[i] = jQuery(this).val();
		    jQuery(this).closest('tr').remove();
		});	

		jq.ajax({
			url: jq(this).data('urlAction'),
			method: 'POST',
			data: {idEmpleados: idEmpleados},
			success: function(response){
				response  = JSON.parse(response);
				if(response.status){
					window.location = response.href;
				}
			}
		});
	});

	jq(".filtrar-tarea").click(function( event ){
		event.preventDefault();
		var data = jq(this).data();
		var fecha = jq('#fecha-tarea').val();

		if( fecha.length != 0 ){
			window.location.href = data.href + '/' + (fecha).split('/').join('');
		}
		else if( jq("#historial-tarea").change() ){
			window.location.href = data.href + '/' + jq("#historial-tarea").val();
		}
		
	});

	//Escapar campos con https/http
	jq("#dominio").change(function(){
		var txt = jq(this).val();
		var search = ['http://', 'https://'];
		
		for( var i = 0; i < search.length; i++){
			txt = txt.replace( search[i], '');	
		}
		
		jq(this).val(txt);
	});	
}



/*Retorna la configuracion del datepicker*/
function getConfigDatepIcker( id ){
	console.log(id);
	var config = {
		altField: jq("#" + id),
		altFormat: "yy/mm/dd",
		changeYear: true,
		changeMonth: true,
		dayNamesMin: ["Dom","Lun", "Mar", "Mier", "Jue", "Vie","Sab"],
		monthNamesShort: ["Enero","Febrero","Marzo","Abril","Mayo","Junio", "Julio", "Agosto","Septiembre", "Octubre","Noviembre","Diciembre"],
		
		yearRange: '1950:2019'
	};	

	return config;
}


