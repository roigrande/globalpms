{extends file="base/admin.tpl"}

{block name="header-css" append}
      <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}estilo.css"/>
{/block}

{block name="header-js" append}

<script type="text/javascript" src="/public/admin/themes/default/js/jqueryforms/jquery.form.js"></script>

{/block}

{block name="body-main" append}


<form id="myForm" action="contacto.php" method="post">
    <label>{$action}</label> <input type="text" name="name" />
    <label>Mensaje:</label> <textarea name="mensaje"></textarea>
    <input type="submit" value="Enviar" /> <div id="ajax_loader"><img id="loader_gif" src="loader.gif" style=" display:none;"/></div>
</form>
{/block}

{block name="footer-js" append}
        <script type="text/javascript">
        {literal}
        // esperamos que el DOM cargue
        $(document).ready(function() {
            // definimos las opciones del plugin AJAX FORM
            var opciones= {
                               beforeSubmit: mostrarLoader, //funcion que se ejecuta antes de enviar el form
                               success: mostrarRespuesta, //funcion que se ejecuta una vez enviado el formulario

            };
             //asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
            $('#myForm').ajaxForm(opciones) ;

             //lugar donde defino las funciones que utilizo dentro de "opciones"
             function mostrarLoader(){
                      $("#loader_gif").fadeIn("slow");
             };
             function mostrarRespuesta (responseText){
				           alert("Mensaje enviado: "+responseText);
                          $("#loader_gif").fadeOut("slow");
                          $("#ajax_loader").append("<br>Mensaje: "+responseText);
             };

        });

    </script>
    {/literal}
{/block}
</html>