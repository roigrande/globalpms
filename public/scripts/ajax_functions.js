/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function getAjaxResponse(strurl, strcontainer) {

    dojo.xhrGet({

        url: strurl,

        handleAs: "text",

sync: true,

        load: function(data) {

          dojo.byId(strcontainer).innerHTML = data;

        }

    });

}


function getAjaxResponsePost(form, strurl, strcontainer) {

dojo.xhrPost({

    url: strurl,

    form: dojo.byId(form),

    handleAs: "text",

        sync:true,

    load: function(data) {

      dojo.byId(strcontainer).innerHTML = data;

    }

});


}

