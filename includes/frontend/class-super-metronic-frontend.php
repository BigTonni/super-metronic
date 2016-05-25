<?php
/**
 * Super Metronic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Frontend class
 *
 * @since 1.0
 */
class Super_Metronic_Frontend {
        /**
	 * Setup admin class
	 *
	 * @since  1.0
	 */
	public function __construct() {
		// load styles/scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'load_styles_scripts' ) );
                add_shortcode('smf_portlets', array($this, 'show_portlets') );
	}

	/**
	 * Load admin styles and scripts
	 *
	 * @since 1.0
	 */
	public function load_styles_scripts() {
            $path_portlet = super_metronic()->plugin_url().'/assets/';
            
            wp_enqueue_style('smf-front-css', $path_portlet .'css/front.css');
            
            wp_enqueue_script( 'smf-front-js', $path_portlet . 'js/front.js', array( 'jquery' ) );
            wp_localize_script( 'smf-front-js', 'smfScriptParams', array(
                    'ajaxurl' => admin_url( 'admin-ajax.php' )
            ) );
	}
        
        function show_portlets(){
            global $wpdb;
            
            $sql = "SELECT * FROM {$wpdb->prefix}portlets WHERE status = 'activate'";
            $arr_portlets = $wpdb->get_results( $sql );
            if (empty($arr_portlets))       return;
            
            $path_portlet = super_metronic()->plugin_url().'/assets/';
            
            ob_start();        
            ?>
                <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

                <link href="<?php echo $path_portlet; ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
                <link href="<?php echo $path_portlet; ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
                <link href="<?php echo $path_portlet; ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
                <!-- END GLOBAL MANDATORY STYLES -->
                <!-- BEGIN THEME GLOBAL STYLES -->
                <link href="<?php echo $path_portlet; ?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
                <!-- END THEME GLOBAL STYLES -->
                
                <div class="page-container">
                            <!-- BEGIN CONTENT -->
                            <div class="page-content-wrapper">
                                <!-- BEGIN CONTENT BODY -->
                                <div class="page-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php                                            
                                            $view = '<div class="row">';
                                            foreach ($arr_portlets as $key => $portlet) {
                                                    $view .= '<div class="col-md-6" id="' . $portlet->id . '">' . wp_unslash($portlet->content) . '</div>';
                                            }
                                            $view .= '</div>';
                                            echo $view;                                           
                                            ?>   
                                        </div>
                                    </div>
                                </div>
                                <!-- END CONTENT BODY -->
                            </div>
                            <!-- END CONTENT -->
                </div>
            <?php
            return ob_get_clean();
        }
} // end \Super_Metronic_Frontend class