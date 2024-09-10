<?php get_header(); ?>

<main id="blog">

<div class="container">

<?php if (is_search() || is_archive()) : ?>
<div id="search" class="textCenter">
	<h1>
		<?php if (is_search()) : echo 'showing '.$wp_query->found_posts.' results for "'.$s.'"'; ?>
		<?php elseif (is_year()) : echo 'showing '.$wp_query->found_posts.' posts from '.get_the_time('Y'); ?>
		<?php elseif (is_tag()) : echo 'showing '.$wp_query->found_posts.' posts for "'; single_tag_title(); echo '"'; ?>
		<?php elseif (is_category()) : echo 'showing '.$wp_query->found_posts.' posts for "'; single_cat_title(); echo '"'; ?>
		<?php endif; ?>
	</h1>
</div>
<?php endif; ?>

<?php if ( have_posts() ) : $i = 0;
			while ( have_posts() ) : the_post(); ?>

	<?php 
		//if (!in_category(3))
			if (has_post_thumbnail())
	      $thumb = get_the_post_thumbnail_url(get_the_ID(),'medium_large');
	    	//$thumbID = get_post_thumbnail_id(get_the_ID());
	    else
	      $thumb = first_image();
	    	$thumbID = first_image_ID();
    //else
	    //$thumb = get_template_directory_uri().'/images/omg.gif';

    $i++;
  ?>

	<article class="wow <?php if (($i % 2) != 0) echo 'bounceInRight'; else echo 'bounceInLeft'; ?><?php if (in_category(3)) echo ' nsfw'; ?>">
		<div class="row row-eq-height">
			<div class="col-md-4 thumb relative">
				<a class="block absolute centerCenter wow fadeIn" href="<?php the_permalink(); ?>"
					 style="width: <?php echo $thumbID[1]; ?>px; height: <?php echo $thumbID[2]; ?>px;">
					<?php if (in_category(3)) : $px = 5; ?>
						<svg class="relative lazyload" style="width: <?php echo $thumbID[1]; ?>px; height: <?php echo $thumbID[2]; ?>px;">
						  <filter id="pixelate-<?php echo $post->post_name; ?>" x="0" y="0" color-interpolation-filters="sRGB">
						    <feFlood x="4" y="4" height="2" width="2"/>
						    <feComposite width="<?php echo $px*2; ?>" height="<?php echo $px*2; ?>"/>
						    <feTile result="a"/>
						    <feComposite in="SourceGraphic" in2="a" operator="in"/>
						    <feMorphology operator="dilate" radius="<?php echo $px; ?>"/>
						  	<feColorMatrix type="matrix"
													     values="1 0 0 0 0.1 
												               1 0 0 0 0.1  
												               1 0 0 0 0.1 
												               0 0 0 1 0" />
						  </filter>
						  <image preserveAspectRatio="xMidYMid slice"
						  			 width="<?php echo $thumbID[1]; ?>" height="<?php echo $thumbID[2]; ?>"
						  			 filter="url(#pixelate-<?php echo $post->post_name; ?>"
						         xlink:href="<?php echo $thumb; ?>"/>
						</svg>
					<?php else : ?>
						<img src="<?php echo $thumb; ?>" class="block lazyload" />
					<?php endif; ?>
				</a>
			</div>
		  <div class="col-md-8 excerpt">
				<h1><a href="<?php the_permalink(); ?>"><?php if (in_category(3)) echo ' 🔞'; ?> <?php the_title(); ?></a></h1>
				<h6><?php the_time('F j, Y'); ?></h6>
				<?php echo '<p><span>'.wp_trim_words(wp_strip_all_tags(strip_shortcodes(get_the_content())), 100).'</span></p>'; ?>
				<div class="relative">
					<?php echo '<a href="'.get_permalink().'" class="more"><i class="fal fa-angle-right"></i> Read More!</a>'; ?>
					<?php if (get_comments_number() > 0) : ?>
						<a class="comments absolute vCenter block" href="<?php the_permalink(); ?>#comments">
							<span class="absolute centerCenter"><?php comments_number('','1','%'); ?></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</article>

<?php endwhile; ?>

<div id="pages" class="textCenter wow bounceInUp">
	<?php wp_pagenavi(); ?>
	<div class="spacer"></div>
	<a class="all" href="<?php bloginfo('home'); ?>/archive">View All Posts</a>	
</div>

<?php endif; ?>

</div>

</main>

<?php get_footer(); ?>