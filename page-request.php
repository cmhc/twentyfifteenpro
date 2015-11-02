<?php
/**
 * Template Name:http请求页面
 * Description: http请求页面，在页面中使用pre包裹的json代码，达到调用api的效果
 * 一个get的例子
 * {
 *		"url":"http://domain.com",
 *		"method":"get"
 * }
 * 一个post的例子
 * {
 *		"url":"http://domain.com",
 *		"method":"post",
 *		"param":{"foo":"bar"}
 * }
 */
while( have_posts() ): the_post();

	$content = get_the_content();
	preg_match("|<pre>.*?</pre>|is",$content,$matches);
	if( empty($matches) ) die("没有可执行的代码");
	$pre = $matches[0];
	$code = json_decode( str_replace( array("<pre>","</pre>"), "", $pre ) );
	if( empty($code) || !isset( $code->url ) ) die("json文件解析错误");
	//解析json，发送请求
	$url = $code->url;
	$method = !isset($code->method) ? 'get' : $code->method;
	switch($method){
		//get方式调用
		case "get":
			$apicontent = file_get_contents($url);
		break;
		//post方式调用
		case "post":
			if( !is_array($code->param) ) die("post参数错误");
			$data = http_build_query($code->param);
			$context = stream_context_create(array(
				'http'=>array(
					'method'=>"POST",
            		'header'=> "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
            		'content' => $data
					)
				));
			$apicontent = file_get_contents($url,$context);
		break;
	}

endwhile;

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


			<header class="entry-header">
				<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
					endif;
				?>
			</header><!-- .entry-header -->
			

			<div class="entry-content">
				<?php echo str_replace($pre,$apicontent,$content);?>
			</div>


			<footer class="entry-footer">
				<?php twentyfifteen_entry_meta(); ?>
				<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-footer -->
		</article>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
