var Newsletter = {};

/**
 * SearchEngine, Class to manage
 * 
 * @namespace Newsletter
 * @param elem 
 * @param options 
 */
Newsletter.SearchEngine = Class.create({
    
    initialize: function(elem, options) {
        // items container
        this.elem    = $(elem);        
        this.options = options;
        
        // shortcuts        
        this.items   = options.items || [];
        this.manager = options.manager || null;
        this.form    = $(options.form) || null;        
        
        this.init();
    },
    
    init: function() {
        this.renderList();
        this.attachFormEvents();
    },
    
    attachFormEvents: function() {
        var btn = this.form.select('button')[0];
        btn.removeAttribute('type');
        
        btn.observe('click', this.searchServerSide.bind(this));
        this.form.observe('submit', this.searchServerSide.bind(this));
    },
    
    renderList: function() {
        this.elem.innerHTML = ''; 
        
        this.items.each(function(item, i) {
            newItem = this.renderItem(item);            
            this.elem.appendChild(newItem);
        }, this);
    },
    
    searchServerSide: function(evt) {
        Event.stop(evt); 
        
        var q = $F('q').strip();
        
        //if(q != '') {
            this.items = [];
            this.renderList();
            
            this.form.action.value = 'search';
            
            new Ajax.Request('?cacheBurst=' + (new Date()).getTime(), {
                method: 'post',
                parameters: this.form.serialize(),
                onSuccess: this.onSearchSuccess.bind(this)
            });
        /*} else {
            // TODO: utilizar MessageBox
            alert('Introduzca algún caracter para la búsqueda');
            $('q').focus();
        }*/
    },
    
    onSearchSuccess: function(transport) {        
        this.items = transport.responseJSON;
        this.renderList();
    },
    
    renderItem: function(item) {
        var detail = (item.category_name)? item.category_name: item.author;
        var content = '[<strong>' + detail + '</strong>] ' + item.title;
        
        var newItem = new Element('li', {
            'rel': item.pk_content
        }).update(content);
        
        newItem.observe('dblclick', this.onItemDblClick.bindAsEventListener(this));
        
        return newItem;
    },
    
    searchItem: function(itemId) {
        for(var i=0; i<this.items.length; i++) {
            if(this.items[i].pk_content == itemId) {
                return this.items[i];
            }
        }
        
        return null;
    },
    
    onItemDblClick: function(evt) {
        Event.stop(evt);
        
        var elt = Event.findElement(evt, 'li');
        itemId = elt.getAttribute('rel');
        
        item = this.searchItem(itemId);
        
        this.manager.addItem(item);
    },
    
    selectAll: function() {
        this.manager.items = this.items;
        this.manager.renderList();
    }
});

Newsletter.Manager = Class.create({
    initialize: function(elem, options) {
        this.elem = $(elem);
        this.options = options;
                
        // hidden field
        this.postmaster = $(options.postmaster) || $('postmaster');
        this.form = this.postmaster.form;
        
        // for stopObserving
        this.handlerOnInlineEdit = this.onInlineEdit.bindAsEventListener(this);
        
        // shortcuts
        this.items = options.items || [];
        
        this.itemTemplate = '<strong>[#{extra}]</strong><span title="#{permalink}">#{title}</span> \
                             <div class="actions"></div>';
        this.renderList();
    },
    
    clearList: function() {
        this.items = new Array();
        this.renderList();
    },
    
    renderList: function() {
        this.elem.innerHTML = '';
        // Destroy sortables
        Sortable.destroy(this.elem);
        
        this.items.each(function(item, i) {
            this.renderItem(item);            
        }, this);
        
        Position.includeScrollOffsets = true; 
        
        // Create sortables
        Sortable.create(this.elem, {scroll: this.elem.up('div')});
    },
    
    addItem: function(item) {
        if(this.searchItem(item.pk_content) == null) {
            // Destroy sortable
            Sortable.destroy( this.elem );
            
            var total = this.items.push(item);
            this.renderItem(item);
            
            //Sortable.create( this.elem, {onUpdate: this.reorderItems.bind(this)} );
            Sortable.create( this.elem );
        }
    },
    
    reorderItems: function() {
        var orderedItems = new Array();
        var list = this.elem.select('li[rel]');
        
        list.each(function(itm, idx) {
            orderedItems.push( this.searchItem(itm.getAttribute('rel')) );
        }, this);
        
        this.items = orderedItems;
    },
    
    updateItem: function(itemId, data) {
        var item = this.searchItem(itemId);
        for(var i in data) {
            item[i] = data[i];
        };
    },
    
    deleteItem: function(itemId) {        
        var item = this.searchItem(itemId);
        if(item!=null && confirm('¿Está seguro de quere eliminar: ' + item.title + '?')) {
            this.items = this.items.without(item);
            
            var nodeItem = this.elem.select('li[rel="'+itemId+'"]')[0];
            if(nodeItem) {
                this.elem.removeChild(nodeItem);
            }
        }                
    },
    
    renderItem: function(item) {        
        var newItem = new Element('li', {
            'rel': item.pk_content
        });
        
        item.extra = (item.category_name)? item.category_name: item.author;
        newItem.update( this.itemTemplate.interpolate(item) );
        
        this.elem.appendChild(newItem);
        
        this.attachItemEvents(newItem);
    },
    
    attachItemEvents: function(item) {
        item.select('span')[0].observe('dblclick', this.handlerOnInlineEdit);
        item.select('div')[0].observe('click', this.onDeleteItem.bindAsEventListener(this));
    },
    
    onInlineEdit: function(evt) {
        Event.stop(evt);                
        
        var itemDomNode = Event.findElement(evt, 'span');
        
        if(!/<input /i.test(itemDomNode.innerHTML)) {
            // Prevent dblclick twice on fieldtext
            itemDomNode.stopObserving('dblclick', this.handlerOnInlineEdit);
            
            var textBox = new Element('input', {type: 'text', size: '90', value: itemDomNode.innerHTML});         
            
            textBox.observe('blur', this.onUpdateItem.bindAsEventListener(this));
            textBox.observe('keypress', this.onKeyPress.bindAsEventListener(this));
            
            itemDomNode.update(textBox);
            textBox.focus();
        }
    },
    
    onKeyPress: function(evt) {
        if(evt.keyCode == Event.KEY_RETURN) {
            this.onUpdateItem(evt);
        }        
    },
    
    onUpdateItem: function(evt) {
        Event.stop(evt);
        
        var textBoxNode = Event.findElement(evt, 'input');
        var text = textBoxNode.value;
        var itemNode = textBoxNode.up('li');
        
        this.updateItem(itemNode.getAttribute('rel'), {title: text});
        
        var spanTag = textBoxNode.up('span');
        spanTag.update(text);
        
        
        spanTag.observe('dblclick', this.onInlineEdit.bindAsEventListener(this));        
    },
    
    onDeleteItem: function(evt) {
        Event.stop(evt);
        
        var itemDomNode = Event.findElement(evt, 'li');        
        
        this.deleteItem( itemDomNode.getAttribute('rel') );
    },
    
    searchItem: function(itemId) {
        for(var i=0; i<this.items.length; i++) {
            if(this.items[i].pk_content == itemId) {
                return this.items[i];
            }
        }
        
        return null;
    },
    
    serialize: function(source) {
        var data = this.postmaster.value.evalJSON();
        if(data == null) {
            data = {};
        }
        
        this.reorderItems(); // Reorder items before send
        data[source] = this.items;
        
        this.postmaster.value = Object.toJSON(data);
    }
});


Newsletter.AccountManager = Class.create({
    initialize: function(itemsElem, accountsElem, options) {
        this.itemsElem = $(itemsElem);
        this.accountsElem = $(accountsElem);
        
        this.options = options;
        
        // hidden field
        this.postmaster = $(options.postmaster) || $('postmaster');
        this.form = this.postmaster.form;
        
        // shortcuts
        this.items = options.items || [];
        this.accounts = options.accounts || [];
        
        this.accountTemplate = '<span title="#{email}">#{name} &lt;#{email}&gt;</span> \
                             <div class="actions"></div>';
        this.initLists();
    }, 
    
    initLists: function() {
        /* Render items */
        this.renderItems();
        
        /* Render Accounts */
        this.renderAccounts();
    },
    
    renderItems: function() {
        this.itemsElem.innerHTML = '';        
        
        this.items.each(function(item, i) {
            this.renderItem(item);            
        }, this);
    },
    
    renderAccounts: function() {
        this.accountsElem.innerHTML = '';
        
        this.accounts.each(function(item, i) {
            this.renderAccount(item);
        }, this);
    },
    
    selectAll: function() {
        this.accounts = this.items;
        this.renderAccounts();
    },
    
    clearList: function() {
        this.accounts = new Array();
        this.renderAccounts();
    },
    
    addAccount: function(account) {
        if(this.searchAccount(account.email) == null) {            
            var total = this.accounts.push(account);
            this.renderAccount(account);
        }
    },    
    
    updateItem: function(itemId, data) {
        var item = this.searchAccount(itemId);
        for(var i in data) {
            item[i] = data[i];
        };
    },
        
    renderItem: function(item) {
        var newItem = new Element('li', {
            'rel': item.email
        }).update(item.name);
        
        newItem.observe('dblclick', this.onItemDblClick.bindAsEventListener(this));
        
        this.itemsElem.appendChild(newItem);
        
        return newItem;
    },
    
    onItemDblClick: function(evt) {
        Event.stop(evt);
        
        var elt = Event.findElement(evt, 'li');
        itemId = elt.getAttribute('rel');
        
        item = this.searchItem(itemId);
        
        this.addAccount(item);
    },    
    
    renderAccount: function(account) {        
        var newAccount = new Element('li', {
            'rel': account.email,
            'class': 'account'
        });
        
        newAccount.update( this.accountTemplate.interpolate(account) );
        
        this.accountsElem.appendChild(newAccount);
        // Attach event
        newAccount.select('div')[0].observe('click', this.onDeleteAccount.bindAsEventListener(this));
    },
    
    onDeleteAccount: function(evt) {
        Event.stop(evt);
        
        var itemDomNode = Event.findElement(evt, 'li');                
        this.deleteAccount( itemDomNode.getAttribute('rel') );
    },
    
    deleteAccount: function(accountId) {        
        var item = this.searchAccount(accountId);
        if(item!=null && confirm('¿Está seguro de retirar de la lista: ' + item.name + '?')) {
            this.accounts = this.accounts.without(item);
            
            var nodeItem = this.accountsElem.select('li[rel="'+accountId+'"]')[0];
            if(nodeItem) {
                this.accountsElem.removeChild(nodeItem);
            }
        }                
    },
    
    searchAccount: function(accountId) {
        for(var i=0; i<this.accounts.length; i++) {
            if(this.accounts[i].email == accountId) {
                return this.accounts[i];
            }
        }
        
        return null;
    },
    
    searchItem: function(itemId) {
        for(var i=0; i<this.items.length; i++) {
            if(this.items[i].email == itemId) {
                return this.items[i];
            }
        }
        
        return null;
    },
    
    serialize: function(source) {
        var data = this.postmaster.value.evalJSON();
        if(data == null) {
            data = {};
        }
        
        data[source] = this.accounts;
        
        this.postmaster.value = Object.toJSON(data);
    }
});

Newsletter.UISplitPane = Class.create({
    initialize: function(parent, box1, box2, separator) {
        this.parent = $(parent);
        this.box1   = $(box1);
        this.box2   = $(box2);
        this.separator = $(separator);
        
        this.createDraggable();
    },
    
    createDraggable: function() {
        new Draggable(this.separator, {
            constraint: 'vertical',
            
            onEnd: this.onChange.bindAsEventListener(this),
            scroll: this.parent
        });
    },
    
    onChange: function(e) {
        var y = parseInt(e.element.positionedOffset()[1]);
        this.calculatePosition(y, e);
    },
    
    calculatePosition: function(y, e) {
        this.scaleBox1(y);            
        e.element.setStyle({top: '0px'});                        
        this.scaleBox2(y);
    },
    
    scaleBox1: function(y) {
        var h = y;
        this.box1.setStyle({height: h + 'px'});
    },
    
    scaleBox2: function(y) {                        
        var hSep = this.separator.getHeight();            
        var hBox1  = this.box1.getHeight();            
        var hParent = this.parent.getHeight();
        
        h = hParent - (parseInt(hSep) + parseInt(hBox1));
        
        this.box2.setStyle({height: h + 'px'});
    }
});
