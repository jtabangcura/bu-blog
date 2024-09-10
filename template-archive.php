<?php
/* Template Name: Archive */
 get_header(); ?>

<main id="blog" class="page archives">

<div class="container">

<article class="theContent wow bounceInUp">

<h1>The Bu Blog Archives</h1>

<div class="row">
	<div class="col-md-6">

		<h3>Search the Bu-log</h3>
  	<?php get_search_form(); ?>
		<div class="spacer"></div>

		<h3>Browse by Year</h3>
		<ul>
		<?php wp_get_archives(array(
			'type' => 'yearly',
			'show_post_count' => true
		)); ?>
		</ul>
		<div class="spacer"></div>

	</div>
	<div class="col-md-6">

		<h3>Browse by Tags</h3>
		<div class="tag-cloud"><?php wp_tag_cloud(); ?></div>
		<div class="spacer"></div>

	</div>
</div>

<h3>All Posts (<?php echo wp_count_posts('post')->publish; ?>)</h3>
<?php 
$args = array(
	'posts_per_page' => '9999',
	'cat' => '-1',
);

$archive = new WP_Query( $args );

if ($archive->have_posts() ) : ?>

<ul id="archives">

<?php while ( $archive->have_posts() ) : $archive->the_post(); ?>

	<li><a href="<?php the_permalink(); ?>"><strong><?php the_date('F j, Y'); ?></strong>: <?php the_title(); ?></a><?php if (in_category(3)) echo ' 🔞'; ?><?php if (get_comments_number() > 0) echo '<i class="fas fa-comment"></i>'; ?></li>

<?php endwhile; ?>

</ul>

<?php endif; ?>

</article>

</div>

</main>

<?php get_footer(); ?>