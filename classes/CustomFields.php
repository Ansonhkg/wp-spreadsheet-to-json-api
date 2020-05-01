<?php
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', plugin_dir_path(__FILE__) . 'acf/' );
define( 'MY_ACF_URL', plugin_dir_url(__FILE__) . 'acf/' );
include_once( MY_ACF_PATH . 'acf.php' );


class CustomFields{
    
    /**
     * Constructor
     * @return Void
     */
    public function __construct(){
        $this->init_options();
        // add_filter('acf/settings/show_admin', array($this, 'ACF_hide_admin'));
        $this->fields_spreadsheet();
    }

    /**
     * 
     */
    public function ACF_hide_admin($show_admin){
        return false;
    }

    /**
     * Add options to backend
     * @return Void
     */
    public function init_options(){
        if( function_exists('acf_add_options_page') ) {
            
            // add post settings
            $post_settings = acf_add_options_page(array(
                'page_title' => __('Spreadsheet API'),
                'menu_title'  => __('Spreadsheet API'),
                'icon_url' => 'dashicons-format-aside'
                // 'parent_slug' => 'options-general.php',
            ));
        }
    }


    /**
     * Fields:: Spreadsheet Option Page
     */
    public function fields_spreadsheet(){
        
        if( !function_exists('acf_add_local_field_group') ) return;
        acf_add_local_field_group(array(
            'key' => 'group_5ea0c2410ac54',
            'title' => 'Spreadsheet',
            'fields' => array(
                array(
                    'key' => 'field_5ea0c250f7078',
                    'label' => '',
                    'name' => 'spreadsheet',
                    'type' => 'file',
                    'instructions' => 'API: ' . get_home_url() . '/wp-json/sheet2json/YOUR_SHEET_NAME',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-spreadsheet-api',
                    ),
                ),
                // array(
                //     array(
                //         'param' => 'current_user_role',
                //         'operator' => '==',
                //         'value' => 'administrator',
                //     ),
                // ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
            
    }
}