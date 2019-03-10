<?php get_header(); ?>
<?php
	$loop = new WP_Query( array(
	'post_type' => 'Radical',
	'posts_per_page' => -1,
	'orderby'   => 'meta_value_num',
		'meta_key'  => 'radical_options_stroke_count',
	'order'     => 'ASC',
	)
	);

	$previous = " ";
?>
<body>
<div class="container">
	<div class="component">

		<div class="title">
			<img src="<?php echo get_stylesheet_directory_uri() . "/svg/001-bear.svg" ?>" width="50%" style="margin: 3rem auto 0 auto; display: block;">
			<h2 style="margin: 0;padding-top: 1rem;">Kanji Kuma</h2>
			<p>From <a class="title-link" href="http://joemalott.com">Joe Malott</a></p>
		</div>

		<ul class="grid">
			<?php

				// 'red', 'blue', 'green', 'yellow', 'purple', 'pink'

				if ( $loop->have_posts() ) :
				while ( $loop->have_posts() ) : $loop->the_post();
					$items = ['left', 'top', 'right', 'bottom'];
					$position = $items[array_rand($items)];

					$colors = ['red', 'blue', 'green', 'yellow', 'pink', 'salmon', 'fuschia', 'grey', 'aqua', 'coral'];
					$color = $colors[array_rand($colors)];
					
					if ($previous == $color) {
						$colors = ['red', 'blue', 'green', 'yellow', 'pink', 'salmon', 'fuschia', 'grey', 'aqua', 'coral'];
						$color = $colors[array_rand($colors)];

						if ($previous == $color) {
							$colors = ['red', 'blue', 'green', 'yellow', 'pink', 'salmon', 'fuschia', 'grey', 'aqua', 'coral'];
							$color = $colors[array_rand($colors)];

							if ($previous == $color) {
								$colors = ['red', 'blue', 'green', 'yellow', 'pink', 'salmon', 'fuschia', 'grey', 'aqua', 'coral'];
								$color = $colors[array_rand($colors)];
							} else {
								$previous = $color;
							}

						} else {
							$previous = $color;
						}

					} else {
						$previous = $color;
					}
			?>
			
			<li id="<?php echo esc_html( get_the_title() ); ?>" class=<?php echo "\"ot-letter-" . $position . " " . $color . "\"";?>>
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<span data-letter="<?php echo esc_html( get_the_title() ); ?>"><?php echo esc_html( get_the_title() ); ?></span>
				</a>
			</li>
			
			<?php endwhile; wp_reset_query(); endif; ?>
			
      <li class="blue hidden-one">&nbsp;</li>
      <li class="green hidden-two">&nbsp;</li>
      <li class="grey hidden-three">&nbsp;</li>
      <li class="salmon hidden-four">&nbsp;</li>
      
		</ul>
	</div>
</div>
</body>
<?php get_footer(); ?>