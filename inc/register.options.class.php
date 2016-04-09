<?php

class CT_Opt_Panel{
    private $args = array();
    
    private $page_hook = false;
    
    private $js_cb_function = '';
    
    private $css_cb_function = '';
    
    private $options = '';
	
    function __construct( $args = array(), $options = array() )
	{
	    $defaults = array(
				'page_title' => '',
				'menu_title' => '',
				'capability' => 'manage_options',
				'menu_slug' => '',
				'page_type' => 'main', // main or submenu
				'parent_slug' => 'options-general.php',
			);
		
		$args = wp_parse_args( $args, $defaults );
		
		
		$this->args = $args;
		
		$this->options = $options;
		
		
	}
	
	public function addon_hooks (){
		if(isset($this->args['page_type']) && $this->args['page_type'] == 'submenu' ){
			add_action( 'admin_menu', array( &$this, 'ctfop_add_submenu_page' ) );
		} else {
			add_action( 'admin_menu', array( &$this, 'ctfop_add_options_page' ) );
		}
	}
	
	public function ctfop_add_options_page (){
		$this->page_hook = add_menu_page( $this->args['page_title'], $this->args['menu_title'], $this->args['capability'], $this->args['menu_slug'], array(&$this, 'option_panel_callback') );
		
		if( $this->page_hook && $this->js_cb_function ){
			add_action('admin_print_scripts-'.$this->page_hook, $this->js_cb_function);
			add_action('admin_print_styles-'.$this->page_hook, $this->css_cb_function);
		}
	}
	
	public function ctfop_add_submenu_page (){
		$this->page_hook = add_submenu_page( $this->args['parent_slug'], $this->args['page_title'], $this->args['menu_title'], $this->args['capability'], $this->args['menu_slug'], array(&$this, 'option_panel_callback') );
		
		if( $this->page_hook && $this->js_cb_function ){
			add_action('admin_print_scripts-'.$this->page_hook, $this->js_cb_function);
			add_action('admin_print_styles-'.$this->page_hook, $this->css_cb_function);
		}
	}
	
	public function option_panel_callback (){
		?>
		<div class="wrap">
			<h1><?php echo esc_html($this->args['page_title']); ?></h1>
			<div class="ctfop-wrap">
				<div class="ctfop-tabs">
					<div class="ctfop-tabs-nav">
						<ul></ul>
					</div>
					<div class="ctfop-tab-panels">
						
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			window.ctfopt = <?php echo wp_json_encode($this->options); ?>;
		</script>
		<?php
		
	}
	
	public function enqueue_page_js( $callback_fun ){
		if (empty($callback_fun)) return;
		
		$this->js_cb_function = $callback_fun;
	}
	
	public function enqueue_page_css( $callback_fun ){
		if (empty($callback_fun)) return;
		
		$this->css_cb_function = $callback_fun;
	}
	
	public function run(){
		$this->addon_hooks();
		
		
	}
}