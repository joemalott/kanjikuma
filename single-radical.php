<?php get_header(); ?>
<?php

$colors = ['#5BC0EB', '#E55934', '#d05bac', '#f84257', '#695190', '#384343', '#4f9f94' ];
$color = $colors[array_rand($colors)];

// Start the loop.
while ( have_posts() ) : the_post();
?>
<body style="background: <?php echo $color; ?>; color: white;">
<div class="container margin-top">
 
	
	<div class="row">
		
		<div class="col-4">
			
			<h1 class="radical" id="radical"><?php echo esc_html( get_the_title() ); ?></h1>
		</div>
		<div class="col-12">
			
			<div class="row">
				
				
				<?php $meta = radical_options_get_meta( 'radical_options_stroke_count' );
				if ($meta == '') {
				echo '';
				} else { ?>
				<div class="col">
					<h4><strong>Strokes</strong></h4>
					<h4><?php echo radical_options_get_meta( 'radical_options_stroke_count' ); ?></h4>
				</div>
				<?php    }
				?>
				
				<?php $meta = radical_options_get_meta( 'radical_options_hiragana_and_romaji_if_applicable_' );
				if ($meta == '') {
				echo '';
				} else { ?>
				<div class="col">
					<h4><strong>Hiragana and Romaji <br> (if applicable)</strong></h4>
					<h4><?php echo radical_options_get_meta( 'radical_options_hiragana_and_romaji_if_applicable_' ); ?></h4>
				</div>
				<?php    }
				?>
				
				<?php $meta = radical_options_get_meta( 'radical_options_meaning' );
				if ($meta == '') {
				echo '';
				} else { ?>
				<div class="col">
					<h4><strong>Meaning</strong></h4>
					<h4><?php echo radical_options_get_meta( 'radical_options_meaning' ); ?></h4>
				</div>
				<?php    }
				?>
				
				<?php $meta = radical_options_get_meta( 'radical_options_position' );
				if ($meta == '') {
				echo '';
				} else { ?>
				<div class="col">
					<h4><strong>Position</strong></h4>
					<h4><?php echo radical_options_get_meta( 'radical_options_position' ); ?></h4>
				</div>
				<?php    }
				?>
				
				<?php $meta = radical_options_get_meta( 'radical_options_examples' );
				if ($meta == '') {
				echo '';
				} else { ?>
				<div class="col">
					<h4><strong>Examples</strong></h4>
					<h4 style="font-weight: 100;"><?php echo radical_options_get_meta( 'radical_options_examples' ); ?></h4>
				</div>
				<?php    }
				?>
				
			</div>
		</div>
	</div>
  
   <div class="back-button">
    <h4><a href="/#<?php echo esc_html( get_the_title() ); ?>">&#8593; Back</a></h4>
    <?php 
    
      // get_posts in same custom taxonomy
      $postlist_args = array(
         'post_type' => 'Radical',
         'posts_per_page' => -1,
	       'orderby'   => 'meta_value_num',
		      'meta_key' => 'radical_options_stroke_count',
	       'order'     => 'ASC',
      ); 
      $postlist = get_posts( $postlist_args );

      // get ids of posts retrieved from get_posts
      $ids = array();
      foreach ($postlist as $thepost) {
         $ids[] = $thepost->ID;
      }

      // get and echo previous and next post in the same taxonomy        
      $thisindex = array_search($post->ID, $ids);
      $previd = $ids[$thisindex-1];
      $nextid = $ids[$thisindex+1];
      if ( !empty($previd) ) {
         echo '<h4><a href="' . get_permalink($previd). '">&#8592; Prev</a></h4>';
      }
      if ( !empty($nextid) ) {
         echo '<h4><a href="' . get_permalink($nextid). '">&#8594; Next</a></h4>';
      }
     
    ?>
  </div>
	
  
</div>

<?php
// End the loop.
endwhile;
?>
</body>
<?php get_footer(); ?>