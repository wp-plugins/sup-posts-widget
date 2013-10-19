<?php

/*
Plugin Name: Sup Posts Widget
Plugin URI: http://theusup.com
Description: Is a plugin where you can display the number of <strong>popular posts, latest and random post</strong> with thumbnail image on your sidebar or page/post. This plugin support for 3rdparty source image. 
Version: 1.0
Author: Usupdotnet
Author URI: http://u-sup.blogspot.com/
License: GPLv2 or later
*/

require_once dirname( __FILE__ ) . '/widget.php';

function spw_plugin_scripts(){

    wp_register_script('spw_main_plugin_script', plugin_dir_url( __FILE__ ).'js/main.js', array('jquery') );
    wp_enqueue_script('spw_main_plugin_script');

    wp_register_style('spw_plugin_style', plugin_dir_url( __FILE__ ).'style.css');
    wp_enqueue_style('spw_plugin_style');
}
add_action('wp_enqueue_scripts','spw_plugin_scripts');


# GET First Image
function sup_post_image($num) {
	global $more;
		$more = 1; 
		$link = get_permalink();
		$content = get_the_content();
		$count = substr_count($content, '<img');
		$start = 0;
	for($i=1;$i<=$count;$i++) {
		$imgBeg = strpos($content, '<img', $start);
		$post = substr($content, $imgBeg);
		$imgEnd = strpos($post, '>');
		$postOutput = substr($post, 0, $imgEnd+1);
		$postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$postOutput);;
		$image[$i] = $postOutput;
		$start=$imgEnd+1;
	}
	if(stristr($image[$num],'<img')) { echo ''.$image[$num].""; }
		$more = 0;
}


function spw_display() {
 
    echo '<form action="tabview.html" method="get">';
       echo '<div class="TabView" id="TabView">';
	  echo '<div class="spw_tabs">';
           	echo '<a>Popular</a>';
		echo '<a>Latest</a>';
		echo '<a>Random</a>';
          echo '</div>';

echo '<div class="spw_widget"  style="width:100%;height:300px">';
// Popular section
echo '<div class="spw_content" style="width:100%;height:300px">';
	echo '<ul id="popular">';
		$tmp_query = $wp_query; 
		$count = 0;
		query_posts('posts_per_page=5&orderby=comment_count');
			if (have_posts()) :
 		while (have_posts()) : the_post(); ?>
			  <li><?php sup_post_image('1'); ?>
 			    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			  </li> 

 		<?php endwhile;
			endif;
			$wp_query = $tmp_query; 
 	echo '</ul>';
echo '</div>';

// Latest section
echo '<div class="spw_content" style="width:100%;height:300px">';
	echo '<ul id="latest">';
		$tmp_query = $wp_query; 
		$count = 0;
		query_posts('posts_per_page=5&orderby=latest');
			if (have_posts()) :
 		while (have_posts()) : the_post(); ?>
			  <li><?php sup_post_image('1'); ?>
 			    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			  </li> 

 		<?php endwhile;
			endif;
			$wp_query = $tmp_query; 
 	echo '</ul>';
echo '</div>'; 

// Random section
echo '<div class="spw_content"  style="width:100%;height:300px">';
	echo '<ul id="random">';
		$tmp_query = $wp_query; 
		$count = 0;
		query_posts('posts_per_page=5&orderby=rand');
			if (have_posts()) :
 		while (have_posts()) : the_post(); ?>
			  <li><?php sup_post_image('1'); ?>
 			    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			  </li> 

 		<?php endwhile;
			endif;
			$wp_query = $tmp_query; 
 	echo '</ul>';
echo '</div>';

   echo '</div>';
  echo '</div>';
echo '</form>'; 
}

 
// Short Code
// shortcode for popular

function sup_popular_posts() {
   echo '<div class="spw_content">';
	echo '<ul id="popular">';
			$tmp_query = $wp_query; 
			$count = 0;
		query_posts('posts_per_page=10&orderby=comment_count');
			if (have_posts()) :
 		while (have_posts()) : the_post(); ?>
			  <li style="width:49%"><?php sup_post_image('1'); ?>
 			    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			  </li> 

 		<?php endwhile;
			endif;
			$wp_query = $tmp_query; 
 	echo '</ul>';

   echo '</div>';
}

// shortcode for latest
function sup_latest_posts() {
   echo '<div class="spw_content">';
	echo '<ul id="latest">';
			$tmp_query = $wp_query; 
			$count = 0;
		query_posts('posts_per_page=10&orderby=date');
			if (have_posts()) :
 		while (have_posts()) : the_post(); ?>
			  <li style="width:49%"><?php sup_post_image('1'); ?>
 			    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			  </li> 

 		<?php endwhile;
			endif;
			$wp_query = $tmp_query; 
 	echo '</ul>';

   echo '</div>';
}

// shortcode for random
function sup_random_posts() {
   echo '<div class="spw_content">';
	echo '<ul id="random">';
			$tmp_query = $wp_query; 
			$count = 0;
		query_posts('posts_per_page=5&orderby=rand');
			if (have_posts()) :
 		while (have_posts()) : the_post(); ?>
			  <li style="width:49%"><?php sup_post_image('1'); ?>
 			    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			  </li> 

 		<?php endwhile;
			endif;
			$wp_query = $tmp_query; 
 	echo '</ul>';

   echo '</div>';
}
add_shortcode ('sup_popular', 'sup_popular_posts');
add_shortcode ('sup_latest', 'sup_latest_posts');
add_shortcode ('sup_random', 'sup_random_posts');
 
?>