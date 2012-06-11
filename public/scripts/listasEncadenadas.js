//funcion que carga las regiones de un pais realizando una llamada ajax
function cargarRegionesPais(obj)
{
    var idPais = $("#lstPaises").val(); //Usando JQUERY, obtengo el value del option seleccionado de la lista paises. 	
    $.ajax( 
    {
        dataType: "html",
        type: "POST",
        url: "/app/default/index/ajax/", // ruta donde se encuentra nuestro action que procesa la peticion XmlHttpRequest
        data: "pais=" + idPais, //El id del pais seleccionado en la lista paises (si enviarás mas de un parametro los separas con &.
        beforeSend: function(data){ 
            $("#lstRegiones").html('<option>Cargando...</option>');//Usando JQUERY, Mostramos el mensaje cargando en la lista regiones. (un efecto visual)
            //También puedes poner aqui el gif que indica cargando...
        },
        success: function(requestData){ 	//Llamada exitosa
            $("#lstRegiones").html(requestData);//Usando JQUERY, Cargamos las regiones del pais
        },
        error: function(requestData, strError, strTipoError){
            alert("Error " + strTipoError +': ' + strError); //En caso de error mostraremos un alert
        }
//        ,
//        complete: function(requestData, exito){&nbsp; //fin de la llamada ajax.
//            // En caso de usar una gif (cargando...) aqui quitas la imagen
//        }
    });
}
//Solo si agregaste el jQuery.noConflict(); 
(function($) { 
    $(function() {
        // El codigo de la funcion cargarRegionesPais()
    });
})(jQuery);
