<?php get_header(); ?>

<main id="blog" class="page single">

<div class="container">

<?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article class="wow bounceInUp">

	<?php 
		if (has_post_thumbnail())
      $thumb = get_the_post_thumbnail_url(); 
    else
      $thumb = first_image();
  ?>

	<div class="banner theContent relative" style="background-image:url('<?php echo $thumb; ?>')">
		<div class="absolute title">
			<h1><?php the_title(); ?></h1>
			<h6><?php the_time('F j, Y'); ?></h6>
		</div>
		<div class="absolute nav">
			<?php previous_post_link( '%link', '<i class="fal fa-angle-left"></i>', true, '' ); ?><?php next_post_link( '%link', '<i class="fal fa-angle-right"></i>', true, '' ); ?>
		</div>
	</div>

	<div class="theContent">

		<div class="post-content">
			<?php the_content(); ?>
		</div>

		<div class="spacer"></div>

		
		<?php 
		$images =& get_children( array (
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => 'asc'
		));

		if ($images) : ?>
			<div class="featured-art">
				<h6>Featured Artwork</h6>
				<?php foreach ($images as $attachment_id => $attachment) : ?>

					<a class="image colorbox wow flipInY" rel="gallery"
					 href="<?php echo wp_get_attachment_image_url($attachment_id,'full'); ?>"
					 title="<?php echo wp_get_attachment_caption($attachment_id); ?>"
					 >
						<img class="animate lazyload"
								 src="<?php echo get_template_directory_uri().'/images/blank-square.png'; ?>"
								 data-src="<?php echo wp_get_attachment_image_url($attachment_id,'thumbnail'); ?>"
								 title="<?php echo wp_get_attachment_caption($attachment_id); ?>"
								 alt="<?php echo wp_get_attachment_caption($attachment_id); ?>"
								 width="200" height="200" />
					</a>

				<?php endforeach; ?>
			</div>

			<div class="spacer"></div>
		<?php endif; ?>

		<div class="row tags">
			<div class="col-md-6">
				<?php the_tags('Tagged under '); ?>
			</div>
			<div class="col-md-6 textRight">
				See all posts from <a href="<?php echo get_year_link(get_the_time('Y')); ?>"><?php the_time('Y'); ?></a>
			</div>
		</div>

		<div class="spacer"></div>

		<div id="post-comments">
			<?php comments_template(); ?>
		</div>

	</div>

</article>
<?php endwhile; ?>

<div id="pages" class="textCenter prevNext wow bounceInUp">
	<?php previous_post_link( '%link', '<i class="fal fa-angle-left"></i> Previous Post', true, '' ); ?> <a class="all" href="<?php bloginfo('home'); ?>/archive">View All Posts</a>	<?php next_post_link( '%link', 'Next Post <i class="fal fa-angle-right"></i>', true, '' ); ?>
</div>

<?php endif; ?>

</div>

</main>

<?php get_footer(); ?>