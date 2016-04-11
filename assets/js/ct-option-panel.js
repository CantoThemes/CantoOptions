(function( exports, $, CTF ){

    CTF_Core.CTF_Option_Panel = CTF_Core.Opts.extend({
        initialize: function ( args ){
	    	this.inputArgs = args.fields;
	    	this.container = args.id;
	   // 	this.containerObj = $('#ctf-metabox-'+container);
	    	
	    	var panelContainer = $('#ctfop-form'),
	    	    tabNav = $('.ctfop-tabs-nav > ul'),
	    	    panelObj = $('<div class="ctfop-tab-panel" id="'+args.id+'"></div>');
	    	    
	        tabNav.append('<li><a href="#'+args.id+'">'+args.title+'</a></li>');
	    	
	    	panelContainer.append(panelObj);
	    	
	    	this.containerObj = panelObj;

	    	this.renderContent();
	    },
        getNameAttr: function ( type, id ){
            var nameAttrValue = this.container+'['+id+']';

            if ( 
                (type == 'checkbox') ||
                (type == 'checkbox_image') ||
                (type == 'checkbox_button') ||
                (type == 'font_style') ||
                (type == 'dimension')
                ) {
                nameAttrValue  = this.container+'['+id+'][]';
            } else if ( type == 'text_multi' ) {
                nameAttrValue  = this.container+'['+id+'][]';
                // this.inputArgs.btnext  = 'data-name="'+this.container+'['+id+'][]"';
            }

            return nameAttrValue;
        },
        getInputValue: function ( type, id, defValue ){
            var value = defValue;

                if ( ! _.isUndefined(ctfopts_value[id]) ) {
                    if ( ! _.isNull(ctfopts_value[id]) ) {
                        value = ctfopts_value[id];
                    }
                }
            

            return value;
        }
    });
    
    function ctf_opts_init() {
        if ( typeof ctfopts == 'undefined' ) {
            return;
        }


        if( ! _.isEmpty(ctfopts) ){
            _.each(ctfopts, function ( panel ) {
                if ( typeof CTF_Core != 'undefined' && typeof CTF_Core.CTF_Option_Panel != 'undefined' ) {
                    var field_obj = new CTF_Core.CTF_Option_Panel( panel );
                }
            });
        }
    }

    ctf_opts_init();
    
})( wp, jQuery, CTF_Core );

(function( $ ){
    
    if($('.ctfop-tab-panel.active').length == 0){
        $('.ctfop-tab-panel').first().addClass('active');
    }
    
    $('.ctfop-tabs .ctfop-tabs-nav').on('click', 'a', function(e){
        e.preventDefault();
        
        $('.ctfop-tab-panel.active').removeClass('active');
        
        $($(this).attr('href')).addClass('active');
    });
})(jQuery);