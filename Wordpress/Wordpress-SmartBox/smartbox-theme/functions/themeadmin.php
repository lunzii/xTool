<?php
if(!function_exists('themeidea_modify_dashboard_widgets')){

    add_action('wp_dashboard_setup', 'themeidea_modify_dashboard_widgets' );
    function themeidea_modify_dashboard_widgets() {
        global $wp_meta_boxes;

        wp_add_dashboard_widget('wpjam_dashboard_widget', 'themeidea', 'wpjam_dashboard_widget_function');
    }

    function wpjam_dashboard_widget_function() {?>
        <p>
            Themeidea聚合全球资源，助力Wordpress中文博客</p>
        <hr />
        <?php
        echo '<div class="rss-widget">';
        wp_widget_rss_output('http://themeidea.com/feed/', array( 'show_author' => 0, 'show_date' => 1, 'show_summary' => 0 ));
        echo "</div>";
    }
}

function disable_dashboard_widgets() {
    remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
}
//add_action('admin_menu', 'disable_dashboard_widgets');

	
add_action('admin_menu', 'themeidea_admin_menu');

function themeidea_admin_menu() {
	add_theme_page(__( '友情提示', 'themeidea' ), __( '友情提示', 'themeidea' ), 'edit_themes', basename(__FILE__), 'themeidea_settings_page');
	add_action( 'admin_init', 'register_themeidea_settings' );
}

function register_themeidea_settings() {
	register_setting( 'themeidea-settings-group', 'themeidea_options' );
}

function themeidea_settings_page() {
if ( isset($_REQUEST['updated']) ) echo '<div id="message" class="updated fade"><p><strong> settings saved.</strong></p></div>';
if( 'reset' == isset($_REQUEST['reset']) ) {
	delete_option('themeidea_options');
	echo '<div id="message" class="updated fade"><p><strong> settings reset.</strong></p></div>';
}
?>
<style type="text/css">
@charset "utf-8";
.clearfix{clear:both}
.themeidea_nodisplay{display:none}
.wrap{margin:0 0 50px 10px}
.themeidea_option_wrap{margin:0; width:1920px; font-size:13px; font-family: "Century Gothic", "Lucida Grande", Helvetica, Arial, 微软雅黑; border-left:1px solid #eee; border-bottom:1px solid #eee; border-right:1px solid #eee; background:#fff; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;overflow:hidden;float:left;}
.themeidea_option_section{width:850px; height:50px; background:#eee}
.themeidea_option_section h2{margin:0 0 0 30px; font-size:15px; font-family:"Century Gothic", "Lucida Grande", Helvetica, Arial, 微软雅黑; color:#777; font-style:normal}
.themeidea_option{width:850px; display:block; border-top:1px solid #eee}
.themeidea_option .cbbox_checked{}
.themeidea_option_l{float:left; width:150px}
.themeidea_option_l label{margin:20px 0 20px 20px; width:150px; display:block; font-size:13px}
.themeidea_option_m{float:left; width:450px; margin:20px 0 20px 0}
.themeidea_option_m input{font-size:13px; font-family: "Century Gothic", "Lucida Grande", Helvetica, Arial, 微软雅黑; color:#777}
.themeidea_option_m .radio_options{margin:0 20px 0 5px; position:relative}
.themeidea_option_m input[type="text"], .themeidea_option_m select{width:430px; font-size:13px; font-family: "Century Gothic", "Lucida Grande", Helvetica, Arial, 微软雅黑; padding:4px; color:#333; line-height:1em; background:#f3f3f3}
.themeidea_option_m input:focus, .themeidea_option_m textarea:focus{background:#fff}
.themeidea_option_m textarea{width:430px; height:60px; font-size:12px; padding:4px; color:#333; line-height:1.5em; background:#f3f3f3}
.themeidea_option_r{float:left; width:220px}
.themeidea_option_r small{margin:20px 0 20px 20px; width:200px; display:block; font-size:12px; color:#777}
#themeidea_nav_list{margin:30px 0 0 0;}
#themeidea_nav_list ul.themeidea_tabs_js{margin:0 0 0 10px; padding:0; width:850px; list-style:none}
#themeidea_nav_list ul.themeidea_tabs_js li{float:left; margin:0 4px 0 20px; padding:5px; border-left:1px solid #EEEEEE; border-top:1px solid #EEEEEE; border-right:1px solid #EEEEEE; cursor:pointer;border-top-left-radius:5px 5px;border-top-right-radius:5px 5px;}
#themeidea_nav_list ul.themeidea_tabs_js li.selected{background:#EEE; border-left:1px solid #f9f9f9; border-top:1px solid #f9f9f9; border-right:1px solid #f9f9f9;border-top-left-radius:5px 5px;border-top-right-radius:5px 5px;}
#themeidea_nav_list .themeidea_inside{margin:0}
#themeidea_nav_list .themeidea_inside ul{padding:0; list-style:none}
.themeidea_helppage{padding:20px 25px 20px 25px; width:800px; display:block; border-top:1px solid #eee}
.themeidea_helppage p{font-size:13px}
.themeidea_submit_form{float:left; margin:20px 0 0 0; display:block}
.themeidea_reset_form{float:left; margin:20px 0 0 20px; display:block}
#themeidea_admin_ie_warning_disable{float:right; color:#777; cursor:pointer}
#themeidea_admin_ie_warning_disable:hover{color:#333}
.none{display:none}
fieldset{width:80%; margin:15px 0 10px 74px; padding:10px 0 20px 20px; border:1px solid #EEE}
fieldset legend{ cursor:pointer;  font-size:13px;  color:#FFF; background:#2683AE; border-color:#EEE; -moz-box-shadow:0 0 5px #EEE; -webkit-box-shadow:0 0 5px #EEE; box-shadow:0 0 5px #EEE; padding:2px 15px 4px 15px; -webkit-border-radius:30px; -moz-border-radius:30px; border-radius:30px; -webkit-box-shadow:1px 1px 1px rgba(0,0,0,.29),inset 1px 1px 1px rgba(255,255,255,.44); -moz-box-shadow:1px 1px 1px rgba(0,0,0,.29),inset 1px 1px 1px rgba(255,255,255,.44); box-shadow:1px 1px 1px rgba(0,0,0,.29),inset 1px 1px 1px rgba(255,255,255,.44)}
.ads a{text-decoration: none;color:#268bb8;}
.ads a:hover{color:#d62d00;}
.ads {color:#9a9a9a}
</style>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div><h2>Themeidea</h2><br>	
	<div id="themeidea_admin_ie_warning" class="themeidea_nodisplay updated fade"><p><strong> <?php _e('建议: 为了获得更好的体验，请不要使用IE浏览器.','themeidea') ?><span id="themeidea_admin_ie_warning_disable">Close [X]</span></strong></p></div>
	<div class="ads">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font>Themeidea全球经典Wordpress主题聚合官方网站：【</font> <a href="http://themeidea.com" target="_blank">点击查看</a> 】|Themeidea旗下Wordpress教程网：【 <a href="http://iwilling.org" target="_blank">点击学习</a>】(如果您不想看到这些推荐内容,请联系我们为您关闭)</div>
		<form method="post" action="options.php">
		<?php settings_fields( 'themeidea-settings-group' ); ?>
		<?php $options = get_option('themeidea_options'); ?>
		<div id="themeidea_nav_list">
			<div class="themeidea_inside">
				<ul id="lu-tab-readme" class="list lu-tab-list">
					<div class="themeidea_option_wrap">
						<div class="themeidea_option_section">
							<h2><?php _e('主题声明：','themeidea') ?></h2>
						</div>
						<div class="themeidea_helppage">
							<p>友情提示：您正在使用的主题由Themeidea<a href="http://themeidea.com">全球经典Wordpress主题聚合</a>免费分享！</p>
							<p>主题版权归原作者所有，如需商业用途，请联系作者购买正版，本主题仅供参考学习，请在下载24小时内自行删除</p><br/>
							<p>Themeidea承接业务如下：</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.Wordpress主题定制</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.Wordpress主题二次开发</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.Wordpress主题修改调试</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.Wordpress主题汉化</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.网站托管</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.平面海报，界面，名片UI设计</p><br/>
                            <p>价格主要看工作量以及困难程度，具体价格与站长沟通以后为准</p><br/>
                            <p>联系站长：</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在线留言：【<a href="http://themeidea.com" target="_blank">点击查看</a>】</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新浪微博：【<a href="http://weibo.com/ronghuanweb" target="_blank">点击查看</a>】</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;腾讯微博：【<a href="http://t.qq.com/marvelstudio" target="_blank">点击查看</a>】</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;邮箱：liuronghuanwen@gmail.com</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QQ：276181228</p>

						</div>
					</div><!-- .themeidea_option_wrap -->
				</ul><!-- #lu-tab-readme -->
			</div><!-- .themeidea_inside -->
		</div><!-- #themeidea_nav_list -->
	</form>
<div class="clearfix"></div>
</div><!-- .wrap -->

<?php } ?>