<?php

$query = ffThemeOptions::getQuery('footer')->get('primary');

if( $query->get('show') ) {

	wp_enqueue_script( 'zero-footer-1-js' );

	?>
	<div class="footer-1 ff-section">

		<div class="container-fluid">
			<div class="row">
				<?php
				$widgets = $query->get('widgets');
				$index = 0;
				foreach ($widgets as $oneWidget) {
					$index++;
					$classes = '';
					if( $oneWidget->get('xs') ) { $classes .= 'col-xs-' . absint( $oneWidget->get('xs') ) . ' '; }
					if( $oneWidget->get('sm') ) { $classes .= 'col-sm-' . absint( $oneWidget->get('sm') ) . ' '; }
					if( $oneWidget->get('md') ) { $classes .= 'col-md-' . absint( $oneWidget->get('md') ) . ' '; }
					if( $oneWidget->get('lg') ) { $classes .= 'col-lg-' . absint( $oneWidget->get('lg') ) . ' '; }

					echo '<div class="' . esc_attr( $classes ) . '">';
					dynamic_sidebar( 'footer-' . absint( $index ) );
					echo '</div>';

				}
				?>
			</div>
		</div>
	</div>
	<?php
}