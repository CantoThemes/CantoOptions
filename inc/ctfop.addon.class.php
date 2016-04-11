<?php

if(!class_exists('CTF_Addon')){
    return;
}

class CTFOP_Addon extends CTF_Addon
{

    function __construct()
	{
		parent::__construct();
		

		$this->add_js_tmlp_to_admin_footer();
		
	}
	
	function load_admin_js(){
        parent::load_admin_js();
        wp_enqueue_script( 'ctf-options-panel', CTOP_URL . 'assets/js/ct-option-panel.js', array('jquery', 'underscore', 'ctf-core-script'), '1.0', true );
    }
    
    function load_admin_css(){
        parent::load_admin_css();
        
        wp_enqueue_style('ctf-options-panel', CTOP_URL . 'assets/css/ct-option-panel.css', array(), '1.0');
    }
}