<?php 
// * Page for Actions
$path_portlet = super_metronic()->plugin_url().'/assets/';

global $wpdb;
$notice = '';

$table_name = $wpdb->prefix .'portlets';
// Delete portlet
if( !empty($_POST) && wp_verify_nonce($_POST['action_delete'],'form_portlet_data') ){    
        $wpdb->delete( $table_name, array( 'id' => (int)$_POST['pid'] ) );
        $notice = __('Portlet was successfully removed.', Super_Metronic::TEXT_DOMAIN);
}
// Get all portlets
$sql = "SELECT * FROM {$table_name} WHERE 1=1";
$arr_portlets = $wpdb->get_results( $sql );
?>

<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

<link href="<?php echo $path_portlet; ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $path_portlet; ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $path_portlet; ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $path_portlet; ?>global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $path_portlet; ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo $path_portlet; ?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo $path_portlet; ?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo $path_portlet; ?>layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $path_portlet; ?>layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo $path_portlet; ?>layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
<style>
    body{ background-color: inherit; }
    #adminmenu .update-plugins{
        webkit-border-radius: 10px!important;
        -moz-border-radius: 10px !important;
        border-radius: 10px !important;
    } 
    .tabbable-line>.tab-content{
        padding-bottom: 0px;
    }
    .caption_button{
        float: right;
        margin-top: 3px;
    }
    .caption_button > .btn.uppercase.portlet_button1,
    .caption_button > .btn.uppercase.portlet_button2{
        border-color: #fff;    
    }
    .portlet-notice{
        float: left;
        font-size: 16px;
    }
    @media (min-width: 992px){
        .page-content-wrapper .page-content {
            margin-left: 0px;
        }
    }
    .portlet_button_wp{
        margin-bottom: 20px;
    }
    .portlet_button_wp#bt_switch_def span.bootstrap-switch-handle-on.bootstrap-switch-primary{
        background-color: #fff;
        color: #000;
    }
    .portlet_button_wp#bt_switch_def span.bootstrap-switch-handle-off.bootstrap-switch-default{
        color: #000;
    }        
    .portlet_button2{
        display: none;
    }
    .portlet_button1, .portlet_button2{
        min-width: 57px;
    }
    @media (min-width: 992px){
        .page-content-wrapper .page-content {
            margin-left: 0px;
        }
    }
    .portlet_button_wp{
        margin-bottom: 20px;
    }
    .portlet_button_wp#bt_switch_def span.bootstrap-switch-handle-on.bootstrap-switch-primary{
        background-color: #fff;
        color: #000;
    }
    .portlet_button_wp#bt_switch_def span.bootstrap-switch-handle-off.bootstrap-switch-default{
        color: #000;
    }        
    .portlet_button2{
        display: none;
    }
    .portlet_button1, .portlet_button2{
        min-width: 57px;
    }
    .view_portlet_body{
        min-height:200px;
        min-width:271px;          
    }
    form[name="portlet_delete"]{
        display: inline;
    }
</style>

<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="note note-info">
                        <h4 class="block"><?php _e('Portlets', Super_Metronic::TEXT_DOMAIN); ?></h4>
                        <?php echo $notice; ?>
                    </div>
                    <?php
                    if (!empty($arr_portlets)) {
                        $view = '';
                        $url = admin_url( 'admin.php?page=portlets-customize' );
                        foreach ($arr_portlets as $key => $portlet) {
                                if( $key%4 == 0 ) $view .= '<div class="row">';

                                $view .= '<div class="col-md-3" id="' . $portlet->id . '">' . wp_unslash($portlet->content);
                                if($portlet->status == 'activate'){
                                    $color = 'grey-cascade';
                                    $text = __('Deactivate', Super_Metronic::TEXT_DOMAIN);
                                }else{
                                    $color = 'green-meadow';
                                    $text = __('Activate', Super_Metronic::TEXT_DOMAIN);
                                }
                                $text_delete = __('Delete', Super_Metronic::TEXT_DOMAIN);
                                $link_portlet = add_query_arg( array('portlet' => $portlet->id), $url );
                                $view .= '<div style="margin-bottom: 10px;"><a href="'.$link_portlet.'" class="btn blue-madison">Edit</a>';
                                $view .= '<button type="button" class="btn portlet_action '. $color .'" data-id="'. $portlet->id .'" data-action_p="'. $portlet->status .'">'. $text .'</button>';
                                $view .= '<form action="" name="portlet_delete" method="post"><input type="hidden" name="pid" value="'. $portlet->id .'" />';
                                $view .= wp_nonce_field('form_portlet_data', 'action_delete', true, false);
                                $view .= '<button type="submit" class="btn red-sunglo">'. $text_delete .'</button></form></div>';
                                $view .= '</div>';

                                if( $key%4 == 3 ) $view .= '</div>';
                        }
                        
                        echo $view;
                    }
                    ?>   
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->