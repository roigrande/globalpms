// tipos de mensajes tipo inline(en el body, como redmine), tipo grow ( desplaza resto de codigo), tipo lock (bloqueante).
// inline lanzado desde el servidor.
// grow desde el cliente.
// lock - desde el cliente.
//new MessageBoard({'error':['probando','probando 2']},{container:'mesgBox',type:'inline'});


/**
 * showMsg({'error':['probando','probando 2']},'growl');
 */
function showMsg(msgs,mtype) {
    var mb = new MessageBoard(msgs,{container:'msgBox',type:mtype});
    mb.render();
    return false;
}

function showMsgContainer(msgs,mtype,container) {
    var mb = new MessageBoard(msgs,{container:container,type:mtype});
    mb.render();
    return false;
}

function hideMsgContainer(container){
    var mb = new MessageBoard(null,{container:container});
    mb.clear();
}

var MessageBoard = Class.create({

    initialize: function(messages, options){
        //contenedor donde se printan los mssg
        this.output = null;
        this.container = $(options.container) || document.body;
        this.messages = messages;
        this.type = options.type || 'growl';
    },
    
    parse: function(){
        var html_code = '<ul class="messageboard">';
        for(var t in this.messages) {
            html_code += '<li><ul class="menssage-'+t+'">';
            this.messages[t].each(function(text){
                html_code += '<li>'+text+'</li>';
            });
            html_code += '</ul></li>';
        }

        html_code += '</ul>';
        this.output = html_code;
    },
    
    //Dependiendo del tipo hace un render distinto
    insert: function(){
        if (this.container==document.body) {
            var newElement = new Element('div', {'class':'messageboard'}).update(this.output)
            document.body.insertBefore(newElement, document.body.childNodes[0]);
        } else {
            this.container.update(new Element('div', {'class':'messageboard'}).update(this.output));
        }
    },
    
    render_inline: function(){
        this.container.setStyle({display: 'none'});
        this.insert();
        this.container.appear();
    },

    render_growl: function(){
        this.container.setStyle({display: 'none'});
        this.insert();
        Effect.SlideDown(this.container);
    },

    render_lock: function(){       
        //TODO: bloquear resto events.
    },

    render: function(){
        this.container.setAttribute('class', this.type);
        this.parse();
        this['render_' + this.type]();
    },

    clear: function(){
        this.container.setStyle({display: 'none'});
    },
    
    push :function(){
        //TODO: posibilidad añadir mensajes.
    }


})


/*
 * Ejemplo resultado function render:
 *
 *
 * <ul class="messageboard">
 *     <li>
 *         <ul class="menssage-error">
 *            <li>Error 1</li>
 *            <li>Error 2</li>
 *            ...
 *         </ul>
 *     </li>
 *     .
 *     .
 *     .
 *     .
 *     <li>
 *         <ul class="menssage-info">
 *            <li>Info 1</li>
 *            <li>Info 2</li>
 *            ...
 *         </ul>
 *     </li>
 * </ul>
 */
