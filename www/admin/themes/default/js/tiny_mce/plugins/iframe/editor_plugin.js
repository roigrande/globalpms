(function() {
	tinymce.PluginManager.requireLangPack('iframe');
	tinymce.create('tinymce.plugins.iframe', {
		init : function(ed, url) {
            var t = this;

			t.editor = ed;

			ed.addCommand('mce_iframe', function() {
				ed.windowManager.open({
					file : url + '/window.html',
					width : 400 + ed.getLang('iframe.delta_width', 0),
					height : 380 + ed.getLang('iframe.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			ed.addButton('iframe', {
				title : 'iframe.desc',
				cmd : 'mce_iframe',
				image : url + '/iframe.gif'
			});

            ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('iframe', n.nodeName == 'IFRAME');
			});

            ed.onVisualAid.add(t._visualAid, t);
		},
		
		getInfo : function() {
			return {
					longname  : 'iframe',
					author 	  : 'Openhost S.L.',
					authorurl : 'http://www.openhost.es',
					infourl   : 'http://www.openhost.es',
					version   : "1.0"
			};
		},

        // Private methods
        _visualAid : function(ed, e, s) {
			var dom = ed.dom;

			tinymce.each(dom.select('iframe', e), function(e) {
                if (s) {
                    dom.addClass(e, 'mceItemVisualAid');
                } else {
                    dom.removeClass(e, 'mceItemVisualAid');
                }

			});
		}

	});

	tinymce.PluginManager.add('iframe', tinymce.plugins.iframe);
})();


