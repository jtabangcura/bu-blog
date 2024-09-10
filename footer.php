<footer id="footer" class="wow bounceInUp">
	<div class="container">

		<div id="blogroll" class="row">
			<div class="col-md-8 left">

				<div class="row">
					<div class="col-sm-6 padding-right">
						<h6>@Busiris on Twitter!</h6>
						<?php echo do_shortcode('[custom-twitter-feeds]'); ?>
						<ul class="sm tweets"><li><a href="http://twitter.com/busiris" target="_blank">See more tweets <i class="fal fa-angle-right"></i></a></li></ul>
			      <div class="spacer"></div>
					</div>
		      <div class="col-sm-6 padding-right">

		      	<h6>Find the Bu!</h6>
						<ul class="sm">
			        <?php
		          $bookmarks = array();
		          $bookmarks = get_bookmarks('category=221');
			        if ($bookmarks[0] != '')
			        	foreach ( $bookmarks as $bookmark )
			            echo '<li><a href="'.clean_url($bookmark->link_url).'" target="_blank">'.$bookmark->link_name.'</a></li>';
			        ?>
			      </ul>

		      	<div class="spacer"></div>

		      	<h6>Search the Bu-log</h6>
		      	<?php get_search_form(); ?>

		      	<div class="spacer"></div>

						<h6>The Blog Buddies</h6>
						<select onchange="window.open(this.options[this.selectedIndex].value);" class="select2">
							<option></option>
			        <?php
		          $bookmarks = array();
		          $bookmarks = get_bookmarks('category=219');
			        if ($bookmarks[0] != '')
			        	foreach ( $bookmarks as $bookmark )
			            echo '<option value="'.clean_url($bookmark->link_url).'">'.$bookmark->link_name.'</option>';
			        ?>
						</select>

						<div class="spacer"></div>

					</div>
				</div>

			</div>
			<div class="col-md-4 right textRight">

				<ul class="banners">
	        <?php
	        $args = array(
	        	'category' => '220',
	        	'title_li' => '',
	        	'title_before' => '<h6>',
	        	'title_after' => '</h6>',
	        );
	        wp_list_bookmarks($args);
	        ?>
	      </ul>

			</div>
		</div>

		<p class="copyright">
			Outside links may contain adult material intended for viewers aged 18 and up; please browse <strong><em>responsibly</em></strong>.<br /><br />
			Dragon-Bu &copy;<?php echo date('Y'); ?> his <a href="http://twitter.com/busiris" target="_blank">creator</a>. Art &copy;<?php echo date('Y'); ?> their respected artists.<br />
			Website designed & coded by <a href="https://jtfrontend.com" target="_blank">jtFrontEnd</a>. Original Pizza Bu art by <a href="https://twitter.com/buttcheekwizard/" target="_blank">Lychgate</a>.
		</p>

	</div>
</footer>

</div>

</div>

<?php wp_footer(); ?>

<script>
	new WOW().init();

	jQuery(document).ready(function($) {

		jQuery('#footer select.select2').select2({
			placeholder: 'Choose your fighter!',
		  width: '100%',
		});

		jQuery('img.lazyload').lazyload();

		jQuery('.colorbox, .wp-caption > a').colorbox({
			maxWidth: '90%',
		});

		jQuery('.wp-caption').wrap('<div class="wow flipInY">');

		jQuery('#wrapper').fadeIn();

		var headerHeight = jQuery('#header').height();
		jQuery('#wrapper_inner').css('padding-top',headerHeight + 60);

		jQuery(document).scroll(function() {
		  var y = $(this).scrollTop();
		  if (y > 500) {
		    jQuery('#header').addClass('scrolled');
		  } else {
		    jQuery('#header').removeClass('scrolled')
		  }
		});

	});
</script>

</body>
</html>