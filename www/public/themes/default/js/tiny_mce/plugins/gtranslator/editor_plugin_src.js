/**
 * $Id: editor_plugin_src.js 201 2010-01-05 17:56:56Z vifito $
 *
 * @author vifito
 * @copyright Copyright 2010, Openhost S.L., All rights reserved.
 */

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('gtranslator');

	tinymce.create('tinymce.plugins.GtranslatorPlugin', {
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
			ed.addCommand('mceGtranslator', function() {
				ed.windowManager.open({
					file : url + '/dialog.htm',
					width : 640 , //+ parseInt(ed.getLang('example.delta_width', 0)),
					height : 320 , //+ parseInt(ed.getLang('example.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('gtranslator', {
				title : 'gtranslator.desc',
				cmd : 'mceGtranslator',
				image : url + '/img/gtranslator.gif'
			});
			
			// If selected text enable gtranslator button
			ed.onNodeChange.add(function(ed, cm, n, co) {
				var selection = ed.selection.getContent({format : 'html'});				
				cm.setDisabled('gtranslator', selection.length <= 0);
			});
			
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'Google translator plugin for TinyMCE',
				author : 'vifito',
				authorurl : 'http://openhost.es',
				infourl : 'http://openhost.es/',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('gtranslator', tinymce.plugins.GtranslatorPlugin);
})();