<?php get_header(); ?>

<main id="blog" class="page single">

<div class="container">

<?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article class="theContent textCenter wow bounceInUp">
	<h1><?php the_title(); ?></h1>
	<div class="post-content"><?php the_content(); ?></div>
</article>
<?php endwhile; endif; ?>

</div>

</main>

<?php get_footer(); ?>