<?php if ( is_single() AND ( in_array( get_post_type(), array('post', 'portfolio') ) ) ) { ?>

<div class="pagination-1 ff-section">

	<div class="container-fluid">
		<div class="row">
			<div class="pagination clearfix">
				<div class="col-xs-6">

					<?php

					$next_post = get_adjacent_post(false, '', false);
					if(!empty($next_post)) {
						echo '<a href="' . get_permalink($next_post->ID) . '" class="prev" title="' . esc_attr( $next_post->post_title ) . '"><i class="fa fa-angle-left"></i><span class="pagination-left-text">' . zero__wp_kses( $next_post->post_title ) . '</span></a>';
					}

					?>

				</div>
				<div class="col-xs-6">

					<?php

					$prev_post = get_adjacent_post(false, '', true);
					if(!empty($prev_post)) {
						echo '<a href="' . get_permalink($prev_post->ID) . '" class="next" title="' . esc_attr( $prev_post->post_title ) . '"><span class="pagination-right-text">' . zero__wp_kses( $prev_post->post_title ) . '</span><i class="fa fa-angle-right"></i></a>';
					}

					?>
					
				</div>
				<?php if ( 'post' == get_post_type() ){ ?>
					<?php if( get_option( 'show_on_front' ) == 'posts' ){ ?>
						<div class="grid-button">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-th"></i></a>
						</div>
					<?php } else if ( 0 != get_option('page_for_posts') ){ ?>
						<div class="grid-button">
							<a href="<?php echo esc_url( get_permalink( get_option('page_for_posts') ) ); ?>"><i class="fa fa-th"></i></a>
						</div>
					<?php } ?>
				<?php } else { ?>
					<div class="grid-button">
						<a href="<?php echo esc_url( ffThemeOptions::getQuery('portfolio back_to_portfolio_url') ); ?>"><i class="fa fa-th"></i></a>
					</div>					
				<?php } ?>
			</div>
		</div>
	</div>

</div>

<?php } ?>