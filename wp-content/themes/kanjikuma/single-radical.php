<?php get_header(); ?>
<?php
// Start the loop.
while ( have_posts() ) : the_post();
?>
<div class="container margin-top">

	<h4 class="back-button"><a href="/">&#8592; Back</a></h4>
	
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
					<h4><?php echo radical_options_get_meta( 'radical_options_examples' ); ?></h4>
				</div>
				<?php    }
				?>
				
			</div>
		</div>
	</div>
</div>

<?php
// End the loop.
endwhile;
?>
<?php get_footer(); ?>