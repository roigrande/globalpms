var FeedReader = Class.create({
    initialize: function(elem, url, options) {
        // elem: HTML Div element to embed news list
        this.elem = $(elem);    
        
        this.url  = url;

        this.request  = null;
        this.interval = null;
        this.timeout  = options.timeout || 8000;

        this.proxyUrl = options.proxyUrl || 'proxy.php?url=';
        this.title = options.title || null;                
        
        this.parser = 'parseRss20';
        this.items  = new Array();
        this.output = null;
        
        this.theme = options.theme || 'xornal';
        
        this.themes = new Array();
        this.themes['correo'] = '<li><span class="category">[#{category}]</span> \
                                 <a href="#{link}" target="_blank" class="title"\
                                 onmouseover="Tip(decodeURI(\'#{description}\'), SHADOW, true, ABOVE, true, WIDTH, 300)" onmouseout="UnTip()">\
                                 #{title}</a><br /> \
                                 <span class="author">#{author}</span> <span class="pubDate">#{pubDate}</span> \
                                 </li>';
        this.themes['xornal'] = '<li><a href="#{link}" target="_blank" class="title" \
                                 onmouseover="Tip(decodeURI(\'#{description}\'), SHADOW, true, ABOVE, true, WIDTH, 300)" onmouseout="UnTip()">\
                                 #{title}</a><br /> \
                                 <span class="author">#{author}</span> <span class="pubDate">#{pubDate}</span> \
                                 </li>';
        this.themes['voz']    = '<li><span class="category">[#{category}]</span> \
                                 <a href="#{link}" target="_blank" class="title"\
                                 onmouseover="Tip(decodeURI(\'#{description}\'), SHADOW, true, ABOVE, true, WIDTH, 300)" onmouseout="UnTip()">\
                                 #{title}</a><br /> \
                                 <span class="author">#{author}</span> <span class="pubDate">#{pubDate}</span> \
                                 </li>';        
        
        this.getRss();
    },
    
    getRss: function() {
        this.elem.update('<img src="themes/default/images/loading.gif" border="0" />');
        
        this.request = new Ajax.Request(this.proxyUrl + encodeURIComponent(this.url), {
            method: 'get',

            onSuccess: this.onSuccess.bind(this),

            onException: this.showNotice.bind(this),
            onFailure:   this.showNotice.bind(this)            
        });

        this.interval = window.setInterval(this.onTimeout.bind(this), this.timeout);
    },

    onTimeout: function() {
        window.clearInterval(this.interval);

        this.request.transport.abort();
        this.showNotice();
    },

    hideRssBox: function() {
        Effect.Fade(this.elem.up());
    },

    showNotice: function() {
        this.elem.update('<strong>Error al cargar noticias desde el servidor.</strong>');
        new Effect.Highlight(this.elem, {});
        
        window.setTimeout(this.hideRssBox.bind(this), 8000);
    },
    
    onSuccess: function(transport) {
        window.clearInterval(this.interval);

        try {
            this[this.parser]( transport.responseXML );
            this.render();
        } catch(e) {
            console.log(e);
        }
    },
    
    render: function() {
        this.output = '<ul>';
        
        this.items.each(function(item, i) {
            this.output += this.themes[this.theme].interpolate(item);
        }, this);
        
        this.output += '<ul>';
        
        this.elem.update( this.output );
    },
    
    /**
     * Parse a date "Tue, 10 Nov 2009 00:12:49 +0100" and
     * convert to Javascript Date Object
     *
     * @param rssDate {string} Date with pubDate format
     * @returns {object} Return a Javascript Date Object
     */
    formatDate: function(rssDate) {
        var monthInt = {'Jan': 0, 'Feb': 1, 'Mar': 2,
                      'Apr': 3, 'May': 4, 'Jun': 5,
                      'Jul': 6, 'Aug': 7, 'Sep': 8,
                      'Oct': 9, 'Nov':10, 'Dec': 11 };
        var months = ['Enero', 'Febrero', 'Marzo',
                      'Abril', 'Mayo', 'Junio',
                      'Julio', 'Agosto', 'Septiembre',
                      'Octubre', 'Noviembre', 'Diciembre'];
        var days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        var formattedDate = '';
        var date = null;
        
        // Tue, 10 Nov 2009 00:12:49 +0100
        if(/^[a-z]{3}\,[ ]?([0-9]{1,2}) ([a-z]{3}) ([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2}) /i.test(rssDate)) {
            var matches = /^[a-z]{3}\,[ ]?([0-9]{1,2}) ([a-z]{3}) ([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2}) /i.exec(rssDate);
            date = new Date(matches[3], monthInt[matches[2]], matches[1], matches[4], matches[5], matches[6]);
        } else {            
            // 2009-11-10T14:35:41Z
            if(/^([0-9]{4})\-([0-9]{2})\-([0-9]{2})[T]([0-9]{2}):([0-9]{2}):([0-9]{2})[Z]$/i.test(rssDate)) {            
                var matches = /^([0-9]{4})\-([0-9]{2})\-([0-9]{2})[T]([0-9]{2}):([0-9]{2}):([0-9]{2})[Z]$/i.exec(rssDate);
                date = new Date(matches[1], matches[2], matches[3], matches[4], matches[5], matches[6]);
            }
        }
        
        formattedDate = days[date.getUTCDay()] + ', ' + date.getDate() + ' de ' + months[date.getUTCMonth()] + ' de ' + date.getFullYear();
        
        return formattedDate;
    },
    
    parseRss20: function(xml) {
        var items = xml.getElementsByTagName('item');
        var elem  = null;
        
        for(var i=0; i<items.length; i++) {
            elem = {};
            
            for(var j=0; j<items[i].childNodes.length; j++) {
                var cur = items[i].childNodes[j];                
                switch(cur.nodeName) {
                    case 'title':
                        elem.title = cur.firstChild.nodeValue.strip();
                    break;
                    
                    case 'link':
                        elem.link = cur.firstChild.nodeValue.strip();
                    break;
                    
                    case 'description':
                        elem.description = encodeURI(cur.firstChild.nodeValue.strip());
                    break;
                    
                    case 'author':
                        if(cur.childNodes.length > 0) {
                            elem.author = '(' + cur.firstChild.nodeValue.strip() + ')';
                        } else {
                            elem.author = '';
                        }
                    break;
                    
                    case 'pubDate':
                        elem.pubDate = this.formatDate(cur.firstChild.nodeValue.strip());
                    break;
                    
                    case 'tema':
                    case 'category':
                        if(cur.childNodes.length > 0) {
                            elem.category = cur.firstChild.nodeValue.strip();                        
                            
                            if(/El Correo Gallego \- Diario de la capital de Galicia \-/.test(elem.category)) {
                                elem.category = elem.category.gsub(/El Correo Gallego \- Diario de la capital de Galicia \-[ ]?/, '');
                            }
                        }
                    break;
                }
            }
            
            this.items.push(elem);
        }                
    }
});
