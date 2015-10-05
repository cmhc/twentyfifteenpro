<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<div id="secondary" class="secondary">

	<?php $is_special = get_post_meta($post->ID,"tt_special",True) == "1" ? true : false;
		if( is_single() && $is_special){

			//展示专辑
			$tag = wp_get_post_tags($post->ID);
			//print_r($tag);
			//输出标签描述
			echo '<aside class="widget widget_archive special">';
			echo "<h2 class=\"widget-title\"><a href=\"".get_bloginfo('url')."/tag/{$tag[0]->slug}\">{$tag[0]->name}</a></h2>";
			echo "<p>{$tag[0]->description}</p>";

			$tag_query = new WP_Query("tag_id={$tag[0]->term_id}");
			$result = array();
			while( $tag_query->have_posts()){
				$tag_query->the_post();
				$ordermeta = get_post_meta($tag_query->post->ID,'tt_special_order',true);
				if( $ordermeta == '' ) $ordermeta = 0;
				$result['<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>'] = $ordermeta;
			}
			//降序排列
			arsort($result);
			//进行排序
			echo '<ol>';
			foreach( $result as $key=>$v ){
				echo $key;
			}
			echo '</ol>';
			echo '</aside>';

		}else{
	?>

	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php
				// Primary navigation menu.
				wp_nav_menu( array(
					'menu_class'     => 'nav-menu',
					'theme_location' => 'primary',
				) );
			?>
		</nav><!-- .main-navigation -->
	<?php endif; ?>

	<?php if ( has_nav_menu( 'social' ) ) : ?>
		<nav id="social-navigation" class="social-navigation" role="navigation">
			<?php
				// Social links navigation menu.
				wp_nav_menu( array(
					'theme_location' => 'social',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			?>
		</nav><!-- .social-navigation -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="widget-area" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- .widget-area -->
	<?php endif; }?>

</div><!-- .secondary -->



