<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
	<div class="notice">
		<p class="bottom"><?php _e('Sorry, no results were found.', 'reverie'); ?></p>
	</div>
	<?php get_search_form(); ?>	
<?php endif; ?>
<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); 
	$post_terms=wp_get_post_terms($post->ID,"nation");
	$termIDs = array();
	foreach($post_terms as $postterm) {
		$termIDs[]=$postterm->name;
	}
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php if(count($termIDs)>0) {?><span class="nations">(<?php echo implode($termIDs, ", ")?>)</span><?php }?></h2>
			<span class="start_date"><?php echo date("M, Y",get_post_meta($post->ID, 'wpcf-end-date', true));?></span>
		</header>
	</article>	
<?php endwhile; // End the loop ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( function_exists('reverie_pagination') ) { reverie_pagination(); } else if ( is_paged() ) { ?>
<nav id="post-nav">
	<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'reverie' ) ); ?></div>
	<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'reverie' ) ); ?></div>
</nav>
<?php } ?>