<?php
/* Template Name: Gallery (NSFW) */
 get_header(); ?>

<main id="blog" class="gallery">

<div class="container">

<?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article class="theContent textCenter wow bounceInUp">
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
</article>
<?php endwhile; endif; ?>

<div class="row row-eq-height gallery wow bounceInUp">

<?php 
$args = array(
	'posts_per_page' => '9999',
	'cat' => '-1',
);

$gallery = new WP_Query( $args );

if ($gallery->have_posts() ) : while ( $gallery->have_posts() ) : $gallery->the_post(); ?>

	<?php if (in_category(3)) : ?>

		<?php 
		$images =& get_children( array (
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'post_mime_type' => 'image'
		));

		if ($images) :
			foreach ($images as $attachment_id => $attachment) :
	  ?>

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

		<?php endforeach; endif; ?>

	<?php endif; ?>

<?php endwhile; endif; ?>

</div>

</div>

</main>

<?php get_footer(); ?>