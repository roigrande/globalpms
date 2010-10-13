if(!OpenNeMas) {
    var OpenNeMas = {};
}

OpenNeMas.tinyMceConfig = {    
    'tinyMCE_GZ': {
        mode : "exact",
        theme : "simple,advanced",
        language: "es",
        plugins : "safari,style,advlink,inlinepopups,paste,noneditable,media,xornal,searchreplace,spellchecker,tabfocus",
        disk_cache : true,
        debug : false
    },
    
    'advanced': {        
        mode : "exact",
        theme : "advanced",                
        language: "es",
        plugins : "safari,style,advlink,inlinepopups,paste,noneditable,media,searchreplace,xornal,spellchecker,tabfocus,iframe,gtranslator",

        /* css */
        content_css: '/admin/themes/default/js/tiny_mce/opennemas-config.css?' + new Date().getTime(),
        
        theme_advanced_buttons1_add : "fontselect,fontsizeselect",
        theme_advanced_buttons2_add : "styleprops,|,media,iframe,spellchecker,gtranslator,xornalautolink",
        theme_advanced_buttons2_add_before: "visualaid,charmap,sub,sup,|,cut,copy,pastetext,|,removeformat,cleanup,code,|,search,replace,|",
        theme_advanced_buttons3 : "",  
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        
        /* theme_advanced_styles : "Título 1=header1;Título 2=header2;Título 3=header3;",*/
        theme_advanced_disable : "help",

        /* Use absolute URIs */
        relative_urls: false,
        document_base_url: '/',
        
        /* Tabfocus plugin */
        tabfocus_elements : ":prev,:next",
        tab_focus: ":prev,:next",

        /* Flash settings */
        flash_wmode : "transparent",
        flash_quality : "high",
        flash_menu : "false",
        
        //external_image_list_url : "/admin/themes/default/js/tiny_mce/imagesexternallist.js",
        // Mirar o if de abaixo if(document.getElementById('category'))
        external_image_list_url: (document.getElementById('category'))? "/admin/images_tiny_external_list.php?category=" + document.getElementById('category').value : '',
        media_external_list_url: (document.getElementById('category'))? "/admin/images_tiny_external_list.php?category=" + document.getElementById('category').value: '',
        
        /* Iframe */
        /*extended_valid_elements: "iframe[src|width|height|name|align|frameborder|scrolling|marginheight|marginwidth],object[data|type|classid|codebase|width|height|align],param[name|value],embed[quality|type|pluginspage|width|height|src|align],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|obj|param|embed]",*/
        extended_valid_elements: "iframe[src|width|height|name|align|frameborder|scrolling|marginheight|marginwidth]",
        
        theme_advanced_resize_horizontal : false,
        theme_advanced_resizing : true,
        
        spellchecker_languages : "+Castellano=es,Galego=gl,English=en",
        
        setup : function(ed) {
            ed.onKeyUp.add(function(ed, e) {              
                if(counttiny) {
                    counttiny(document.getElementById('counter_body'), ed);
                }
            });
            
            ed.onChange.add(function(ed, e) {
                if(counttiny) {
                    counttiny(document.getElementById('counter_body'), ed);
                }
            });				
        }        
    },
    
    'simple': {
        mode : "exact",
        theme : "advanced",                
        language: "es",
        plugins : "safari,style,advlink,noneditable,inlinepopups,paste,media,noneditable,xornal,searchreplace,spellchecker,tabfocus,iframe,gtranslator",

        /* css */
        content_css: '/admin/themes/default/js/tiny_mce/opennemas-config.css?' + new Date().getTime(),
                
        theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,|,copy,pastetext,|,undo,redo,|,removeformat,cleanup,code,|,link,unlink,|,image,media,iframe,spellchecker,gtranslator,xornalautolink",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",                

        /* Force don't use <p> element for new line */
        force_br_newlines : true,
        forced_root_block : '',
        force_p_newlines : false,

        /* Use absolute URIs */
        relative_urls: false,
        document_base_url: '/',
        /* external_image_list_url : "/admin/external_images.js",        
        media_external_list_url : "/admin/external_media.js", */
        
        /* Tabfocus plugin */
        tabfocus_elements : ":prev,:next",
        tab_focus: ":prev,:next",

        /* Iframe */
        extended_valid_elements: "iframe[src|width|height|name|align|frameborder|scrolling|marginheight|marginwidth]",
        
        
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",        
        
        flash_wmode : "transparent",
        flash_quality : "high",
        flash_menu : "false",
        
        theme_advanced_resize_horizontal : false,
        theme_advanced_resizing : true,
        
        spellchecker_languages : "+Castellano=es,Galego=gl,English=en",
        
        setup : function(ed) {
            ed.onKeyUp.add(function(ed, e) {
                if(counttiny) {
                    counttiny(document.getElementById('counter_summary'), ed);
                }
            });
            
            ed.onChange.add(function(ed, e) {
                if(counttiny) {
                    counttiny(document.getElementById('counter_summary'), ed);
                }
            });				
        }   
    },
    
    'widget': {        
        mode : "exact",
        theme : "advanced",                
        language: "es",
        encoding: '', // Disable entities
        cleanup : false,
        
        plugins : "safari,style,advlink,inlinepopups,paste,noneditable,media,searchreplace,xornal,spellchecker,tabfocus,iframe,template,table,xhtmlxtras,layer,fullscreen",

        /* css */
        content_css: '/admin/themes/default/js/tiny_mce/opennemas-config.css?' + new Date().getTime(),
        
        template_templates : [
            {
                title : "Caja columna 1",
                src : "/admin/themes/default/js/tiny_mce/templates/box_col_1.html",
                description : "Contenedor para columna 1."
            },
            {
                title : "Caja columna 2",
                src : "/admin/themes/default/js/tiny_mce/templates/box_col_2.html",
                description : "Contenedor para columna 2."
            },
            {
                title : "Caja titulares",
                src : "/admin/themes/default/js/tiny_mce/templates/box_titulares.html",
                description : "Contenedor para titulares del día."
            }
        ],
        
        theme_advanced_buttons1_add : "fontselect,fontsizeselect",
        theme_advanced_buttons2_add : "styleprops,|,spellchecker,xornalautolink",
        theme_advanced_buttons2_add_before: "visualaid,charmap,sub,sup,|,cut,copy,pastetext,|,removeformat,cleanup,code,|,search,replace,|",
        theme_advanced_buttons3 : "cite,ins,del,abbr,acronym,|,tablecontrols,|,fullscreen,|,insertlayer,moveforward,movebackward,absolute,|,iframe,media,template",  
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        
        /* theme_advanced_styles : "Título 1=header1;Título 2=header2;Título 3=header3;",*/
        theme_advanced_disable : "help",

        /* Use absolute URIs */
        relative_urls: false,
        document_base_url: '/',
        
        /* Tabfocus plugin */
        tabfocus_elements : ":prev,:next",
        tab_focus: ":prev,:next",

        /* Flash settings */
        flash_wmode : "transparent",
        flash_quality : "high",
        flash_menu : "false",

        /* Iframe */
        extended_valid_elements: "iframe[src|width|height|name|align|frameborder|scrolling|marginheight|marginwidth]",
        
        theme_advanced_resize_horizontal : false,
        theme_advanced_resizing : true,
        
        spellchecker_languages : "+Castellano=es,Galego=gl,English=en",
        
        table_cell_limit : 100,
        table_row_limit : 5,
        table_col_limit : 5

    }
};

// No es necesaria esta configuración para todos los casos
//if(document.getElementById('category')) {
//    OpenNeMas.tinyMceConfig.external_image_list_url = "/admin/images_tiny_external_list.php?category=" + document.getElementById('category').value;
//    OpenNeMas.tinyMceConfig.media_external_list_url = "/admin/images_tiny_external_list.php?category=" + document.getElementById('category').value;
//}

OpenNeMas.tinyMceFunctions = { 
    toggle: function(refId) {
        var ed = tinyMCE.get(refId);
        if(ed.isHidden()) {
            ed.show();
        } else {
            ed.hide();
        }
    },
    
    destroy: function(refId) {
        var ed = tinyMCE.get(refId);
        if(!ed.isHidden()) {            
            ed.hide();
            ed.destroy();
        }
    }
};
