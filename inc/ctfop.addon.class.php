<?php

if(!class_exists('CTF_Addon')){
    return;
}

class CTFOP_Addon extends CTF_Addon
{
	private $args = array();
	
    function __construct()
	{
		parent::__construct();
		

		$this->add_js_tmlp_to_admin_footer();
		
	}
	
	
}