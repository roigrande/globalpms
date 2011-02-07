/*jslint debug: true, eqeqeq: false, browser: true, on: true, indent: 4, plusplus: false, white: false */

/**
 * GeoipHelper
 * http://www.maxmind.com/app/javascript_city
 */
GeoipHelper = Class.create({
    initialize: function(elem, editor) {
        this.elem = $(elem);
        this.editor = $(editor);
        this.selector = null;
        
        this.snippets = [
            {
                code: 'if(geoip_country_code() == "ES") { \n\t//...\n} else { \n\t//...\n}',
                description: ' condición IF código de país'
            },
            {
                code: 'if(geoip_country_name() == "Spain") { \n\t//...\n} else { \n\t//...\n}',
                description: ' condición IF nombre de país'
            },
            {
                code: 'if(geoip_region_name() == "Galicia") { \n\t//...\n} else { \n\t//...\n}',
                description: ' condición IF región'
            },
            {
                code: 'if(geoip_city() == "A Coruña") { \n\t//...\n} else { \n\t//...\n}',
                description: ' condición IF ciudad'
            },
            {
                code: 'if(geoip_latitude() == "43.3667" && geoip_longitude()=="-8.3833") { \n\t//...\n} else { \n\t//...\n}',
                description: ' condición IF latitud/longitud'
            }
        ];
        
        this.paintHtmlSelect();
    },
    
    paintHtmlSelect: function() {
        this.selector = new Element('select', {});        
        
        option = new Element('option', {});
        option.setAttribute('value', -1);
        option.update('-- Seleccione una plantilla de código --');        
        this.selector.appendChild(option);
        
        this.snippets.each(function(item, i){
            option = new Element('option', {});
            option.setAttribute('value', i);
            option.update(' &rArr; ' + item.description);
            
            this.selector.appendChild(option);            
        }, this);
        
        this.elem.update( this.selector );
        this.selector.observe('change', this.onChangeSnippet.bindAsEventListener(this));
    },
    
    onChangeSnippet: function(evt) {
        var element = Event.element(evt);        
        var i = element.value;
        
        //confirm
        if(i > -1) {
            if(confirm('Desea insertar el recorte de código: \n' + this.snippets[i].code)) {
                this.insertCode(i);
            }
        }
    },

    insertCode: function(i) {
        var content = this.editor.value.strip();
        
        if(!/<script type=\"text\/javascript\" src=\"http:\/\/j\.maxmind\.com\/app\/geoip\.js\"/.test(content)) {
            this.editor.value = '<script type="text/javascript" src="http://j.maxmind.com/app/geoip.js" charset="utf-8"></scr' +
                                'ipt>\n' + this.editor.value;
        }
        
        if(!/\n$/.test(this.editor.value)) {
            this.editor.value += '\n';
        }
        
        this.editor.value += '<script type="text/javascript">\n' + this.snippets[i].code + '\n</sc' + 'ript>\n';        
        this.editor.focus(); // set focus to force validation
    }
});