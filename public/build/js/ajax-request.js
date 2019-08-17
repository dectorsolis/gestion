var jq = jQuery.noConflict();

jq(document).ready( init );

function init(){
    
    /*Para botones, enlaces, etc.*/
    jq(".link-ajax").click( function( event ){
    	var data = jq(this).data();
    	
        jq.ajax({
    		url: data.href,
    		beforeSend: function(){
    		    jq(data.idLoader).html('<div class="loader"></div>');
    		},
    		success: function( response ){
    		   
    		   try{
    		       response = jq.parseJSON( response );
    		       
    		       switch( response.type ){
    		           case 'remove':
    		                jq( response.selector ).remove();    
    		           break;
    		           
    		           case 'redirect':
    		                console.log( response.href );
    		           break;
    		       }
    		   }
    		   catch(e){
    		      jq("#" + data.idResponse )[data.responseMethod]( response );
    		   }
    		}
    	});
    	
    	event.preventDefault();
    });   
    
    //for keywords
    
    jq(".ajax-request").on('click', '.key', function(){
        var i = jq(this).data('li-id');
        jq('#list-key-' + i).remove();
        jq('.input-key-' + i).remove();
        //jq('.hidden-keywords').submit();
        jq('.hidden-keywords button').fadeIn(500);
        return false;
    }); 

    /*Para request ajax con formularios*/
	jq(".ajax-request").on('submit', '.form-ajax', function(e){
        jq(".btn-submit").prop('disabled', true);
		var data = jq(this).data();
		var id_response = data.idResponse;
		var method = data.responseMethod;
        var id = data.id;

		jq.ajax({
			url: jq(this).attr('action'),
			type: 'POST',
			data: jq(this).serialize(),
			beforeSend: function(){
				jq(data.idLoader).html('<div class="loader"></div>');
			},
			success: function (response){

                if( typeof id != "undefined" )
                    jq(id).get(0).reset();

				try{
					response = jq.parseJSON(response);
					switch( response.type ){
						case "redirect": 
							window.location.href = response.href;	
						break;
                        case "html": 
                            jq(data.idLoader)[response.type](response.msg);
                        break;
					}
				}
				catch(e){
					jq("#" + id_response )[method](response);
				}
                jq(".btn-submit").prop('disabled', false);
			}
		})
		e.preventDefault();
	});	    
	
	/*TO DO LIST*/
	
	/*
	 *Para agregar actividad a la lista
	 */
	jq("#add-actividad").click(function(){
		jq("#save-todo-list").fadeIn(500);
		var actividad = jq("#actividad").val().split(',');
		jq("#actividad").val("");

		for( var i = 0; i < actividad.length; i++){
			if( actividad[i].length != 0 ){
				jq("#todo-list").append(
					'<div class="row actividad">' + 
						'<div class="item-actividad col-md-11" data-actividad="' + actividad[i] + '" data-estado="0">' + 
							'<input class="estado-actividad" type="checkbox" value="0"> ' + actividad[i] + 
						'</div>' +
						'<a href="#" class="col-md-1 remove-item-agenda"><span class="fa fa-trash trash-agenda"></span></a>' +				
					'</div>'
				);
			}
		}
	});	
	
	/*
	 * Para guardar las actividades agregadas a la lista
	 */
	jq("#save-todo-list").click(function(){
		
		if( confirm("¿Guardar ajustes de la agenda?")){
			var data = jq(this).data();
			var todo_list = [];
			
			jq(".actividad").each(function(index){
			
				var tmp = {
					estado: jq(this).find("input").is(":checked") ? 1:0,
					actividad: jq(this, ".item-actividad").text().trim()
				};
				console.log(tmp);
				todo_list[index] = tmp;
			
			});
				
			jq.ajax({
				url: data.action,
				method: "POST",
				data: {
						"actividades": JSON.stringify(todo_list),
						"url_redirect" : data.redirect
				},
				beforeSend: function(){
					jq(data.idLoader).html('<div class="loader"></div>');				
				},
				success: function( response ){
					
					response = jq.parseJSON(response);
					if(response.type == "redirect")
						window.location.href = response.href
					else if( response.type == "html")
						jq(data.idLoader).html( response.msg );
				}
			});
		}
	});	
	
	/*
	 *Para cambiar el estado de una actividad
	 */
	 
	jq(".estado-actividad").click(function(){
		var estado = jq(this).data("estado");
		
		if(estado == 1){
			jq(this).removeClass("actividad-terminada");
			jq(this).data("estado", 0);
		}
		else{
			jq(this).addClass("actividad-terminada");
			jq(this).data("estado", 1);
		}
		
		jq("#save-todo-list").fadeIn(500);
		
	});	
	
	
	/*
	 *Para eliminar un item del TODO list
	 */
	jq(document).on("click",".remove-item-agenda",function(event){
		jq(this).parent().remove();
		jq("#save-todo-list").fadeIn(500);
		event.preventDefault();
	});	 
	/*FIN TODO LIST*/
	
}
