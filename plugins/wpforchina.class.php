<?php
/**
 * 让wordpress更加适应中国
 */
class wpforchina{

	public function __construct(){
		//移除字体
		add_action( 'init', array(&$this,'removefont') );
		add_action( 'init', array(&$this,'reloadscript') );
		//移除emoji
	    remove_action( 'admin_print_scripts', 'print_emoji_detection_script');
		remove_action( 'admin_print_styles', 'print_emoji_styles');
		remove_action( 'wp_head', 'print_emoji_detection_script', 7);
		remove_action( 'wp_print_styles', 'print_emoji_styles');
		remove_filter( 'the_content_feed', 'wp_staticize_emoji');
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji');
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email');
		//恢复链接
		add_filter( 'pre_option_link_manager_enabled', '__return_true' );

	}

	/**
	 * 移除字体
	 * @return none
	 */
	public function removefont(){
	    wp_deregister_style( 'open-sans' );
	    wp_register_style( 'open-sans', false );
	    wp_enqueue_style('open-sans','');
	}

	public function reloadscript(){
		//移除wordpressjquery
    	wp_deregister_script('jquery');
    	wp_enqueue_script('jquery','http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js');
     	//wp_enqueue_script('jquerym','http://lib.sinaapp.com/js/jquery.migrate/1.2.1/jquery-migrate-1.2.1.min.js');
	}


}

new wpforchina();
