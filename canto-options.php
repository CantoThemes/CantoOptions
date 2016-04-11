<?php
/**
 * Plugin Name: Canto Option Panel
 * Plugin URI: https://www.cantothemes.com
 * Description: A option panel addon for CantoFramework
 * Version: 1.0-alpha
 * Author: CantoThemes
 * Author URI: https://www.cantothemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'CTOP_PATH' ) ) define('CTOP_PATH', plugin_dir_path( __FILE__ ));
if ( ! defined( 'CTOP_URL' ) ) define('CTOP_URL', plugin_dir_url( __FILE__ ));

require_once CTOP_PATH .'/inc/register.options.class.php';

if ( ! class_exists('CT_Option_Panel') ) {

    class CT_Option_Panel
    {
    	private static $sc_array = array();

        /**
         * @var         CTFMB $instance The one true CTFMB
         * @since       1.0.0
         */
        private static $instance;


        /**
         * Get active instance
         *
         * @access      public
         * @since       1.0.0
         * @return      object self::$instance The one true CTFMB
         */
        public static function instance() {
            if( !self::$instance ) {
                self::$instance = new CT_Option_Panel();
                self::$instance->includes();
                self::$instance->hooks();
                
                if(class_exists('CTFOP_Addon')){
                    $opt_addon = new CTFOP_Addon();
                }
                
                do_action( 'ctf_add_option' );

            }

            return self::$instance;
        }

        private function includes() {
            require_once CTOP_PATH .'/inc/ctfop.addon.class.php';
        }

        private function hooks() {
        }


    }

}

function CTF_Option_Panel_Addon_Register() {
    if( class_exists( 'CTF_Init' ) ) {
        return CT_Option_Panel::instance();
    }
}
add_action( 'plugins_loaded', 'CTF_Option_Panel_Addon_Register' );



// Lets show some example
//add_action( 'ctf_add_option', 'test_opts' );
function test_opts()
{
    if( class_exists('CT_Opt_Panel') ){
        $args = array(
            'page_title' => 'Page Title',
            'menu_title' => 'Menu Title',
            'menu_slug' => 'ctfop_main_menu',
            'opt_name' => 'ctf_tst'
            );
            
        $options = array();
        
        $options[] = array(
            'id' => 'hello',
            'title' => 'Hello',
            'fields' => array(
                array(
                    'id' => 'ctfif_tst_text',
                    'label'    => __( 'Text Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'text',
                    'default' => 'Test Text new',
                ),
                array(
                    'id' => 'ctfif_tst_email',
                    'label'    => __( 'Email Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'email',
                    'default' => 'example@gmail.com',
                ),
            )
        );
        
        $options[] = array(
            'id' => 'world',
            'title' => 'World',
            'fields' => array(
                array(
                    'id' => 'ctfif_tst_text2',
                    'label'    => __( 'Text Input 2', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'text',
                    'default' => 'Test Text',
                ),
                array(
                    'id' => 'ctfif_tst_email2',
                    'label'    => __( 'Email Input 2', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'email',
                    'default' => 'example@gmail.com',
                ),
            )
        );
        $menu = new CT_Opt_Panel($args, $options);
        
        /*$menu->enqueue_page_js(function (){
            wp_enqueue_script( 'ctf-options-panel', CTOP_URL . 'assets/js/ct-option-panel.js', array('jquery', 'underscore', 'ctf-core-script'), '1.0', true );
        });*/
        
        $menu->run();
        
        $args2 = array(
            'page_title' => 'Page Title',
            'menu_title' => 'Sub-Menu Title',
            'menu_slug' => 'ctfop_sub_menu',
            'page_type' => 'submenu',
            //'parent_slug' => 'themes.php'
            );
        $submenu = new CT_Opt_Panel($args2, array());
    }
}

test_opts();