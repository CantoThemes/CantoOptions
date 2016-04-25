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
                    'default' => 'Test Text',
                ),
                array(
                    'id' => 'ctfif_tst_email',
                    'label'    => __( 'Email Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'email',
                    'default' => 'example@gmail.com',
                ),
                array(
                    'id' => 'ctfif_tst_textarea',
                    'label'    => __( 'Textarea Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'textarea',
                    'default' => 'Test Text',
                ),
                array(
                    'id' => 'ctfif_tst_editor',
                    'label'    => __( 'Editor Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'editor',
                    'default' => 'Test Text',
                ),
                array(
                    'id' => 'ctfif_tst_select',
                    'label'    => __( 'Select Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'select',
                    'default' => 'test2',
                    'choices' => array(
                        'test1' => 'Test 1',
                        'test2' => 'Test 2',
                        'test3' => 'Test 3'
                    )
                ),
                array(
                    'id' => 'ctfif_tst_radio',
                    'label'    => __( 'Radio Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'radio',
                    'default' => 'test2',
                    'choices' => array(
                        'test1' => 'Test 1',
                        'test2' => 'Test 2',
                        'test3' => 'Test 3'
                    )
                ),
                array(
                    'id' => 'ctfif_tst_checkbox',
                    'label'    => __( 'Checkbox Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'checkbox',
                    'default' => array(
                        'test2'
                    ),
                    'choices' => array(
                        'test1' => 'Test 1',
                        'test2' => 'Test 2',
                        'test3' => 'Test 3'
                    )
                ),
                array(
                    'id' => 'ctfif_tst_radio_image',
                    'label'    => __( 'Radio Image Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'radio_image',
                    'default' => 'test2',
                    'choices' => array(
                        'test1' => get_home_url().'/wp-admin//images/align-left-2x.png',
                        'test2' => get_home_url().'/wp-admin//images/align-center-2x.png',
                        'test3' => get_home_url().'/wp-admin//images/align-right-2x.png',
                    )
                ),
                array(
                    'id' => 'ctfif_tst_checkbox_image',
                    'label'    => __( 'Checkbox Image Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'checkbox_image',
                    'default' => array(
                        'test2'
                    ),
                    'choices' => array(
                        'test1' => get_home_url().'/wp-admin//images/align-left-2x.png',
                        'test2' => get_home_url().'/wp-admin//images/align-center-2x.png',
                        'test3' => get_home_url().'/wp-admin//images/align-right-2x.png',
                    )
                ),
                array(
                    'id' => 'ctfif_tst_radio_button',
                    'label'    => __( 'Radio Button Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'radio_button',
                    'default' => 'test2',
                    'choices' => array(
                        'test1' => 'Test 1',
                        'test2' => 'Test 2',
                        'test3' => 'Test 3'
                    )
                ),
                array(
                    'id' => 'ctfif_tst_checkbox_button',
                    'label'    => __( 'Checkbox Button Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'checkbox_button',
                    'default' => array(
                        'test1',
                        'test3'
                    ),
                    'choices' => array(
                        'test1' => 'Test 1',
                        'test2' => 'Test 2',
                        'test3' => 'Test 3'
                    )
                ),
                array(
                    'id' => 'ctfif_tst_text_multi',
                    'label'    => __( 'Multi-Text Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'text_multi',
                    'default' => array(
                        'test 1',
                        'test 2'
                    )
                ),
                array(
                    'id' => 'ctfif_tst_number',
                    'label'    => __( 'Number Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'number',
                    'default' => '50',
                ),
                array(
                    'id' => 'ctfif_tst_range',
                    'label'    => __( 'Range Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'range',
                    'default' => '50',
                ),
                array(
                    'id' => 'ctfif_tst_dimension',
                    'label'    => __( 'Dimension Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'dimension',
                    'default' => '20px',
                ),
                array(
                    'id' => 'ctfif_tst_Icon',
                    'label'    => __( 'Icon Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'icon',
                    'default' => 'fa fa-cogs',
                ),
                array(
                    'id' => 'ctfif_tst_color',
                    'label'    => __( 'Color Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'color',
                    'default' => '#ff00ff',
                ),
                array(
                    'id' => 'ctfif_tst_rgba',
                    'label'    => __( 'RGBA Color Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'color_rgba',
                    'default' => 'rgba(25,56,58,0.65)',
                ),
                array(
                    'id' => 'ctfif_tst_font_style',
                    'label'    => __( 'Font Style Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'font_style',
                    'default' => array(
                        'bold' => 'on',
                        'italic' => 'off',
                        'underline' => 'off',
                        'strikethrough' => 'on',
                    ),
                ),
                array(
                    'id' => 'ctfif_tst_text_align',
                    'label'    => __( 'Text Align Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'text_align',
                    'default' => 'left',
                ),
                array(
                    'id' => 'ctfif_tst_image',
                    'label'    => __( 'Image Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'image',
                    'default' => array(),
                ),
                /*array(
                    'id' => 'ctfif_tst_image_multi',
                    'label'    => __( 'Gallery Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'image_multi',
                    // 'default' => array(),
                ),*/
                array(
                    'id' => 'ctfif_tst_font',
                    'label'    => __( 'Google Font Input', 'mytheme' ),
                    'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
                    'type'     => 'google_font',
                    'default' => array(),
                )
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