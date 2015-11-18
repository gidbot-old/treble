<?php

$query404 = ffThemeOptions::getQuery('404');

?>

<div class="blog-post-1 ff-section">
	<div class="content-area__container container-fluid">
		<div class="row">
			<div class="content-area__column col-sm-8 col-sm-offset-2">
				<div class="post-block">
					<div class="post-header">
						<h3 class="post-title post-expand-toggle">
							<a href="">
								<?php printf( $query404->get('title'), get_search_query() ); ?>
							</a>
						</h3>
					</div>
					<div>
						<div class="post-content">
							<?php echo zero__wp_kses( $query404->get('description') ); ?>
							<p>
								<?php get_search_form(); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>