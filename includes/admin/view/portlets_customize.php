<?php
// Page for Customize

$path_portlet = super_metronic()->plugin_url().'/assets/';

$portlet_color = $style = $title = $body = '';
$btn_main_txt = $btn_sec_txt = '';

if( !empty($portlet) ){
        $portlet_color = $portlet->color;
        $style = 'style="border: 2px solid red;"';
        
        $content = wp_unslash($portlet->content);
        
        require_once (super_metronic()->plugin_path().'/includes/phpQuery/phpQuery.php');
        $document = phpQuery::newDocumentHTML($content);

        $hentries = $document->find('div.portlet');
        
        foreach ($hentries as $hentry) {
                $pq = pq($hentry);
                
                $tag_title = $pq->find('span.view_portlet_title');
                $portlet->title = $tag_title->text();
                
                $tag_body = $pq->find('div.view_portlet_body');
                $portlet->body = $tag_body->html();
                
                $tag_buttons = $pq->find('div.caption_button');                
                $portlet->btns = $tag_buttons->html();

                $button = $tag_buttons->find('button.portlet_button1');
                $portlet->btn_main_txt = $button->text();

                $button = $tag_buttons->find('button.portlet_button2');
                $portlet->btn_sec_txt = $button->text();         
        }
}

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
<!-- END THEME LAYOUT STYLES -->

<link rel="stylesheet" href="<?php echo $path_portlet; ?>global/plugins/trumbowyg/ui/trumbowyg.min.css">
<link rel="stylesheet" href="<?php echo $path_portlet; ?>global/plugins/trumbowyg/plugins/colors/ui/trumbowyg.colors.css">
<link rel="stylesheet" href="<?php echo $path_portlet; ?>global/plugins/trumbowyg/plugins/preformatted/ui/trumbowyg.preformatted.min.css">

<style>
body{ background-color: inherit; }
.modal{ width: 100%; margin-left: 0px; background-color: inherit; }
.modal.fade{ top: 0; }
.modal.fade.in { top: 0; }
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
.view_portlet_body{
    min-height:200px;
    min-width:271px;          
}
/*Format text*/
.tab-content .trumbowyg-box{
    width: 100%;
    margin:0px;
}
.bdImageUploadSection .uploadifive-queue{
    display: none;
}
</style>

<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <div class="note note-info">
                        <h4 class="block"><?php _e('UI Collor Collection', Super_Metronic::TEXT_DOMAIN); ?></h4>
                    </div>
                        
                        <?php for($i = 0; $i < count($arr_colors); $i++){
                            
                            if( $i%6 == 0 ){ ?>
                                <div class="row">
                            <?php } ?>
                                    
                                    <div class="col-md-2 col-sm-2 col-xs-6">                            

                                        <!--<input type="checkbox" class="make-switch" checked data-on="success" data-on-color="success" data-off-color="warning" data-size="small">-->

                                        <div class="color-demo tooltips" data-original-title="<?php _e('Click to view demos for this color', Super_Metronic::TEXT_DOMAIN); ?>" data-toggle="modal" data-target="#demo_modal_<?php echo $arr_colors[$i][0]; ?>" <?php if($arr_colors[$i][0] == $portlet_color) echo $style; ?>>
                                            <div class="color-view bg-<?php echo $arr_colors[$i][0]; ?> bg-font-<?php echo $arr_colors[$i][0]; ?> bold uppercase"> #<?php echo $arr_colors[$i][1]; ?> </div>
                                            <div class="color-info bg-white c-font-14 sbold"> <?php echo $arr_colors[$i][0]; ?> </div>
                                        </div>

                                        <?php Super_Metronic_Admin::portlet_modal( $arr_colors[$i][0], $portlet, $images ); ?>

                                    </div>
                                    
                            <?php if( $i%6 == 5 || $i == 56 ){ ?>
                                </div>
                            <?php } 
                            
                        } ?>                 
                   
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo $path_portlet; ?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $path_portlet; ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $path_portlet; ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo $path_portlet; ?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo $path_portlet; ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo $path_portlet; ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $path_portlet; ?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo $path_portlet; ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo $path_portlet; ?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo $path_portlet; ?>layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--For editor-->
<script src="<?php echo $path_portlet; ?>global/plugins/trumbowyg/trumbowyg.js"></script>
<script src="<?php echo $path_portlet; ?>global/plugins/trumbowyg/langs/fr.min.js"></script>
<script>
    $('textarea.portlet_body').trumbowyg({ lang: 'da' });
</script>

<!--For uploading image-->
<script src="<?php echo $path_portlet; ?>js/jquery.uploadifive.js"></script>

<?php 
$dir_upload = wp_upload_dir();
$url_uploads = $dir_upload['baseurl'].'/smf_portlets/';
?>
<script>
    jQuery(function($) { 
        $("#bg_white,#bg_default,#bg_dark,#bg_blue,#bg_blue-madison,#bg_blue-chambray,#bg_blue-ebonyclay,#bg_blue-hoki,#bg_blue-steel,#bg_blue-soft,#bg_blue-dark,#bg_blue-sharp,#bg_green,#bg_green-meadow,#bg_green-seagreen,#bg_green-turquoise,#bg_green-haze,#bg_green-jungle,#bg_green-soft,#bg_green-dark,#bg_green-sharp,#bg_grey,#bg_grey-steel,#bg_grey-cararra,#bg_grey-gallery,#bg_grey-cascade,#bg_grey-silver,#bg_grey-salsa,#bg_grey-salt,#bg_grey-mint,#bg_red,#bg_red-pink,#bg_red-sunglo,#bg_red-intense,#bg_red-thunderbird,#bg_red-flamingo,#bg_red-soft,#bg_red-haze,#bg_red-mint,#bg_yellow,#bg_yellow-gold,#bg_yellow-casablanca,#bg_yellow-crusta,#bg_yellow-lemon,#bg_yellow-saffron,#bg_yellow-soft,#bg_yellow-haze,#bg_yellow-mint,#bg_purple,#bg_purple-plum,#bg_purple-medium,#bg_purple-studio,#bg_purple-wisteria,#bg_purple-seance,#bg_purple-intense,#bg_purple-sharp,#bg_purple-soft").uploadifive({
            "uploadScript": "<?php echo super_metronic()->plugin_url(); ?>/includes/uploadifive/uploadifive_smf.php",
            "auto": true,
            "multi": false,
            "buttonClass" : "btn-success",
            "buttonText" : "<?php _e('Upload Image', Super_Metronic::TEXT_DOMAIN); ?>",  
            "fileType"     : 'image/*',
            "onUploadComplete": function(file, data) {
                if(file){
                    var urlImg = '<?php echo $url_uploads; ?>' + file.name;
                    
                    $('.bg_priview_img').attr('src', urlImg);
                    $('<div class="col-md-6" style="margin-top: 10px;"><img height="170" style="width: 100%;" class="bgImgThumb" src="'+urlImg+'" /></div>').prependTo($(".bdImgList"));
                }
            }
        });
    });
</script>