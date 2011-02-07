tinyMCEPopup.requireLangPack();

var GtranslatorDialog = {
	_content: null, // Initial content
	
	init : function() {
	    // Check if jquery is loaded, otherwise load via CDN
		if((window['jQuery'] == null)||(window['jQuery'] == undefined)) {
		    throw new Exception('Gtranslator tinyMCE plugin must be used with jQuery loaded.');
		}
		
		// TODO: check if there is a selected text
		this._content = tinyMCEPopup.editor.selection.getContent({format : 'html'});
		
		this.sourceLanguage = null;
		this.targetLanguage = null;
		
		jQuery('#content').val(this._content);
		
		this.detect();
	},
	
	detect: function() {
		var url = 'http://ajax.googleapis.com/ajax/services/language/';            
        url = url + 'detect?v=1.0&callback=?&format=html&q=' + encodeURIComponent( this._content );
        
        jQuery.getJSON(url, function(json){
            if((json.responseStatus == 200) && (json.responseData.isReliable)) {
                GtranslatorDialog.sourceLanguage = json.responseData.language;
                GtranslatorDialog.selectDetectedLanguage();                
            }
        });
	},
	
	selectDetectedLanguage : function() {
	    jQuery('#source option').each(function() {
	        if(this.value == GtranslatorDialog.sourceLanguage) {
	            jQuery(this).attr("selected", "selected");
	        }
	    });
	},
	
	translate : function() {
		// Message
		jQuery('#msg').html('<img src="img/progress.gif" border="0" />');
		
	    var url = 'http://ajax.googleapis.com/ajax/services/language/';            
        url += 'translate?v=1.0&callback=?&format=html&langpair=' + this.getLangPair();
        url += '&q=' + encodeURIComponent( jQuery('#content').val() );
        
        jQuery.getJSON(url, function(json){			
            if(json.responseStatus == 200) {
				jQuery('#msg').html('');
                jQuery('#content').val(json.responseData.translatedText);
            } else {
				jQuery('#msg').html('Translation server error');
				jQuery('#content').val(this._content); // Restart original text
			}
        });
	},
	
	getLangPair : function() {
	    GtranslatorDialog.sourceLanguage = jQuery('#source').get(0).value;
	    GtranslatorDialog.targetLanguage = jQuery('#target').get(0).value;
	    
	    return GtranslatorDialog.sourceLanguage + '%7C' + GtranslatorDialog.targetLanguage;
	},

	insert : function() {		
		tinyMCEPopup.editor.selection.setContent( jQuery('#content').val() );
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(GtranslatorDialog.init, GtranslatorDialog);
