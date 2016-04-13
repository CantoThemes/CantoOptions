<?php

class CT_Opt_Panel{
    private $args = array();
    
    private $page_hook = false;
    
    private $js_cb_function = '';
    
    private $css_cb_function = '';
    
    private $options = '';
    
    private $default_values = '';
	
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
		
		$this->default_values = $this->set_default_values();
		
		
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
		$curent_saved_value = get_option($this->args['opt_name']);
		
		if(isset($_POST[$this->args['opt_name']])){
			var_dump($_POST[$this->args['opt_name']]);
		}
		
		if(!$curent_saved_value){
			update_option($this->args['opt_name'], $this->default_values);
			
			$curent_saved_value = get_option($this->args['opt_name']);
		}
		?>
		<div class="wrap">
			
			<div class="ctfop-wrap ctf-fc">
				<div class="ctfop-tabs clearfix">
					<form id="ctfop-main-form" method="post">
						<h1 class="ctfop-page-title"><?php echo esc_html($this->args['page_title']); ?></h1>
						<div class="ctfop-tabs-nav">
							<ul></ul>
						</div>
						<div class="ctfop-tab-panels">
							<div data-opt_id="<?php echo esc_attr($this->args['opt_name']); ?>" id="ctfop-form">
							</div>
							
						</div>
						<div class="ctfop-btn-container">
							<input type="submit" value="Save" class="ctf-btn"/>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			window.ctfopts = <?php echo wp_json_encode($this->options); ?>;
			
			window.ctfopts_value = <?php echo wp_json_encode($curent_saved_value); ?>
		</script>
		<?php
		
	}
	
	private function set_default_values(){
		$all_flds_default = array();
		if(!empty($this->options)){
			foreach ($this->options as $panel) {
				if(isset($panel['fields']) && !empty($panel['fields'])){
					foreach ($panel['fields'] as $field) {
						$all_flds_default[$field['id']] = $field['default'];
					}
				}
			}
		}
		
		return $all_flds_default;
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