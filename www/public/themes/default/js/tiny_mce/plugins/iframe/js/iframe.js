var IframeDialog = {
    node: null,
    editor: null,

    init: function() {
        tinyMCEPopup.resizeToInnerSize();

        this.editor = tinyMCEPopup.editor;
        this.node   = this.editor.selection.getNode();
        if(this.node.nodeName == 'IFRAME') {
            this.editor.dom.removeClass(this.node, 'mceItemVisualAid');
            
            this.loadForm();
        }
    },

    injectIframe: function() {
        var iframeAttrs = '';

        var iframeUrl = document.getElementById('iframeUrl').value;        

        if(iframeUrl == '') {
            alert( tinyMCEPopup.getLang('iframe.error') );
        } else {
            // src
            iframeAttrs += ' src="' + iframeUrl + '"';

            // width
            var attrTmp = document.getElementById('iframeWidth').value;
            if(attrTmp == '') {
                iframeAttrs += ' width="100%"';
            } else {
                iframeAttrs += ' width="' + attrTmp + '"';
            }

            // height
            attrTmp = document.getElementById('iframeHeight').value;
            if(attrTmp == '') {
                iframeAttrs += ' height="300"';
            } else {
                iframeAttrs += ' height="' + attrTmp + '"';
            }

            // name
            iframeAttrs += this.createAttr('iframeName', 'name');

            // align
            iframeAttrs += this.createAttr('iframeAlign', 'align');

            // frameborder
            iframeAttrs += this.createAttr('iframeFrameborder', 'frameborder');

            // scrolling
            iframeAttrs += this.createAttr('iframeScrolling', 'scrolling');

            // marginheight
            iframeAttrs += this.createAttr('iframeMarginheight', 'marginheight');

            // marginwidth
            iframeAttrs += this.createAttr('iframeMarginwidth', 'marginwidth');

            // style
            iframeAttrs += this.createAttr('iframeStyle', 'style');

            // class
            iframeAttrs += this.createAttr('iframeClass', 'class');

            // title
            iframeAttrs += this.createAttr('iframeTitle', 'title');

            var iframetext = '<iframe ' + iframeAttrs + '>' + 
                tinyMCEPopup.getLang('iframe.noframe') + '</iframe>';

            if(window.tinyMCE) {
                if(this.node.nodeName == 'IFRAME') {
                    this.editor.dom.remove(this.node);
                }

                tinyMCEPopup.editor.execCommand('mceInsertContent', false, iframetext);
                tinyMCEPopup.editor.execCommand('mceRepaint');
                tinyMCEPopup.close();
            }
        }

        return;
    },

    loadForm: function() {
        // src
        this.setValue('iframeUrl', 'src');
        
        // width
        this.setValue('iframeWidth', 'width');

        // height
        this.setValue('iframeHeight', 'height');

        // name
        this.setValue('iframeName', 'name');

        // align
        this.setValue('iframeAlign', 'align');

        // frameborder
        this.setValue('iframeFrameborder', 'frameborder');

        // scrolling
        this.setValue('iframeScrolling', 'scrolling');

        // marginheight
        this.setValue('iframeMarginheight', 'marginheight');

        // marginwidth
        this.setValue('iframeMarginwidth', 'marginwidth');

        // style
        this.setValue('iframeStyle', 'style');

        // class
        this.setValue('iframeClass', 'class');

        // title
        this.setValue('iframeTitle', 'title');
    },

    setValue: function(idElement, attr) {
        document.getElementById(idElement).value = this.node.getAttribute(attr) || '';
    },

    createAttr: function(idElement, paramName) {
        var value = document.getElementById(idElement).value;
        var attr  = '';

        if(value != '') {
            attr = ' ' + paramName + '="' + value;
            if(paramName=='class') {
                attr += ' mceItemVisualAid';
            }
            attr += '"';
        } else {
            if(paramName=='class') {
                attr = 'class="mceItemVisualAid"';
            }
        }

        return attr;
    },

    preview: function() {
        var url = document.getElementById('iframeUrl').value;
        if(url != '') {
            document.getElementById('iframePreview').src = url;
        }
    },

    close: function() {
        // Reset class to visual aid
        if(this.node.nodeName == 'IFRAME') {
            this.editor.dom.addClass(this.node, 'mceItemVisualAid');
        }

        tinyMCEPopup.close();
    }
};

tinyMCEPopup.onInit.add(IframeDialog.init, IframeDialog);