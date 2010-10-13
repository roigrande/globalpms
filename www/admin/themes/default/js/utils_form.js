

    var objForm = null;
    var dialogo = null;
    var editores = null;

    function enviar(elto, trg, acc, id) {
        var parentEl = elto.parentNode;
        while(parentEl.nodeName != "FORM") {
            parentEl = parentEl.parentNode;
        }

        parentEl.target = trg;
        parentEl.action.value = acc;
        parentEl.id.value = id;

        if(objForm != null) {
            objForm.submit();
        } else {
            parentEl.submit();
        }
    }

    function validateForm(formID)
    {
        var checkForm = new Validation(formID, {immediate:true, onSubmit:true});
        if(!checkForm.validate()) {
            if($$('.validation-advice')) {
                if($('warnings-validation')) {
                    $('warnings-validation').update('Existen campos sin cumplimentar o errores en el formulario. Por favor, revise todas las pestañas.');
                    new Effect.Highlight('warnings-validation');
                }
            }
            return false;
        } else {
            if($$('.validation-advice') && $('warnings-validation')) {
                $('warnings-validation').setStyle({display: 'none'});
            }
        }
        return true;
    }

    function sendFormValidate(elto, trg, acc, id, formID)
    {
        if(!validateForm(formID))
            return;

        enviar(elto, trg, acc, id);
    }

    function onSearchKeyEnter(e, elto, trg, acc, id)
    {
        ekey = (document.all) ? e.keyCode : e.which;
        if (ekey==13)
        {
            return enviar(elto, trg, acc, id);
        }
    }


    function confirmar(elto, id) {
        if(confirm('¿Está seguro de querer eliminar este elemento?')) {
            enviar(elto, '_self', 'delete', id);
        }
    }

    function vaciar(elto, id) {
        if(confirm('¿Está seguro de quitar este elemento de la papelera?')) {
            enviar(elto, '_self', 'remove', id);
        }
    }

    //Operaciones multiples.
    function enviar2(elto, trg, acc, id) {
        var Lista=document.getElementsByClassName('minput');
        var arreglo = $A(Lista);
        var alguno=0;
        arreglo.each(function(el, indice) {
            if(document.getElementById(el.id).checked!=false){
              alguno=1;
            }
        });

        if ((alguno != 1) && (id != 6)){
            alert("No hay ninguna noticia seleccionada");
        }else{
          if((acc=='mdelete')){
             if(confirm('¿Está seguro de eliminar esos elementos?'))
             {
                var parentEl = elto.parentNode;
                while(parentEl.nodeName != "FORM") {
                    parentEl = parentEl.parentNode;
                }

                parentEl.target = trg;
                parentEl.action.value = acc;
                parentEl.id.value = id;

                if(objForm != null) {
                    objForm.submit();
                } else {
                    parentEl.submit();
                }
             }
          }else{
               var parentEl = elto.parentNode;
                while(parentEl.nodeName != "FORM") {
                    parentEl = parentEl.parentNode;
                }

                parentEl.target = trg;
                parentEl.action.value = acc;
                parentEl.id.value = id;

                if(objForm != null) {
                    objForm.submit();
                } else {
                    parentEl.submit();
                }
          }
        }
    }

    //Desde papelera litter
    function enviar3(elto, trg, acc, id) {
        var Lista=document.getElementsByClassName('minput');
        var arreglo = $A(Lista);
        var alguno=0;
        arreglo.each(function(el, indice) {
            if(document.getElementById(el.id).checked!=false){
              alguno=1;
            }
        });
        if (alguno != 1){
            alert("No hay ninguna elemento seleccionada");
        }else{
          if(acc=='mremove'){
            if(confirm('¿Está seguro de eliminar definitivamente esos elementos?'))
            {
                var parentEl = elto.parentNode;
                while(parentEl.nodeName != "FORM") {
                    parentEl = parentEl.parentNode;
                }

                parentEl.target = trg;
                parentEl.action.value = acc;
                parentEl.id.value = id;

                if(objForm != null) {
                    objForm.submit();
                } else {
                    parentEl.submit();
                }
            }
          }else{
               var parentEl = elto.parentNode;
                while(parentEl.nodeName != "FORM") {
                    parentEl = parentEl.parentNode;
                }

                parentEl.target = trg;
                parentEl.action.value = acc;
                parentEl.id.value = id;

                if(objForm != null) {
                    objForm.submit();
                } else {
                    parentEl.submit();
                }
          }
        }
    }

    function cancel(action,category,page) {
        if(/index_portada/.test(action)) {
            location.href ='index.php';
        }else if(/opinion/.test(action)) {
            location.href ='opinion.php';
        }else if(/advertisement/.test(action)) {
            location.href ='advertisement.php';
        }else{
            location.href= 'article.php?action='+action+'&category='+category+'&page='+page;
        }
    }

   function saveTracking(elto, trg, acc, id, formID){
 
       var frm = $('formulario');
      

       frm.id.value = id;
       frm.action.value = 'save_tracking';


       new Ajax.Updater('div-trackings','customers.php?action=save_tracking',{
            method: 'post',
            parameters: frm.serialize(),

            onLoading: function() {

               $('warnings').update('Guardando trackings...');
                new Effect.Highlight( $('warnings') );
            },
            onComplete: function() {
               $('warnings').update( 'Guardado correctamente' );
               $('info').update('');

               frm.info.value  ='';

               new Effect.Highlight( $('warnings') );

            },

            onFailure: function() {
                    $('warnings').update( 'Hubo errores al guardar. Inténtelo de nuevo.' );
                    new Effect.Highlight( $('warnings') );
            }


        })
   }

   function deleteTracking(id, customer){


    new Ajax.Updater('div-trackings','customers.php?action=delete_tracking&id='+id+'&pk_customer='+customer,{
        method: 'get',

        onLoading: function() {

        $('warnings').update('Eliminando trackings...');
            new Effect.Highlight( $('warnings') );
        },
        onComplete: function() {
           $('warnings').update( 'Eliminado correctamente' );
           new Effect.Highlight( $('warnings') );
        },

        onFailure: function() {
                $('warnings').update( 'Hubo errores al eliminar. Inténtelo de nuevo.' );
                new Effect.Highlight( $('warnings') );
        }


    })
   }

   function get_unique(){

        var tfno= $('telf1').value;
      
        new Ajax.Updater('check_tfno','customers.php?action=check_tfno&tfno='+tfno,{

            onLoading: function() {

            $('check_tfno').update('Comprobando telefono...');
                new Effect.Highlight( $('check_tfno') );
            },
            onSuccess: function(transport){
              var response = transport.responseText;
               $('check_tfno').update("!!! " + response);
            },

            onFailure: function() {
                    $('check_tfno').update( 'Hubo errores al comprobar si el telefono ya existe.' );
                    new Effect.Highlight( $('check_tfno') );
            }


        })
   }