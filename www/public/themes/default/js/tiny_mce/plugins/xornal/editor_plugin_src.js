/**
 * $Id: editor_plugin_src.js 201 2007-02-12 15:56:56Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('xornal');

	tinymce.create('tinymce.plugins.XornalPlugin', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('mceXornalAutoLink', function() {
				var html = tinyMCE.activeEditor.getContent();
				
				tinymce.util.XHR.send({
					url: '/admin/pclave.php?action=autolink',
					type : "POST",
					data : tinymce.util.JSON.serialize({
						'content': html
					}),
					success : function(text) {
						tinyMCE.activeEditor.setContent(text);
					}
				});
			});

			// Register example button
			ed.addButton('xornalautolink', {
				title : 'xornal.tooltip',
				cmd : 'mceXornalAutoLink',
				image : url + '/img/database_link.png'
			});
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'Xornal.com plugin',
				author : 'Openhost S.L.',
				authorurl : 'http://openhost.es',
				infourl : 'http://redmine.openhost.es',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('xornal', tinymce.plugins.XornalPlugin);
})();