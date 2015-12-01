<?php

// Don't print empty markup if there's only one page.
if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
	?>

<div class="pagination-1 ff-section">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<?php

					$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
					$pagenum_link = html_entity_decode( get_pagenum_link() );
					$query_args   = array();
					$url_parts    = explode( '?', $pagenum_link );

					if ( isset( $url_parts[1] ) ) {
						wp_parse_str( $url_parts[1], $query_args );
					}

					$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
					$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

					$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
					$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

					// Set up paginated links.
					$links = paginate_links( array(
						'base'     => $pagenum_link,
						'format'   => $format,
						'total'    => $GLOBALS['wp_query']->max_num_pages,
						'current'  => $paged,
						'mid_size' => 1,
						'add_args' => array_map( 'urlencode', $query_args ),
						'prev_text' => '<i class="fa fa-angle-left"></i><span class="pagination-left-text">Newer Posts</span>',
						'next_text' => '<span class="pagination-right-text">Older Posts</span><i class="fa fa-angle-right"></i>',
						'type'     => 'array',
					) );

					if ( $links ) {
						?>
							<div class="pagination clearfix">
								<?php

									$thereWasFirstArrow = false;
									$thereWasLastArrow = false;
									foreach ($links as $key => $value) {

										if ( !$thereWasFirstArrow ){
											if ( false === strpos($value, 'prev') ){
												$thereWasFirstArrow = true;
												echo '<div class="pagination-numbers-wrapper">';
											}
										}

										if ( !$thereWasLastArrow ){
											if ( false !== strpos($value, 'next') ){
												$thereWasLastArrow = true;
												echo '</div>';
											}
										}

										if( FALSE !== strpos($value, 'current') ){
											echo '<a href="#" class="active">' . strip_tags( $value ) . '</a> ';
										} else {
											echo zero__wp_kses( $value ) . ' ';
										}

										if ( !$thereWasFirstArrow ){
											if ( false !== strpos($value, 'prev') ){
												$thereWasFirstArrow = true;
												echo '<div class="pagination-numbers-wrapper">';
											}
										}

									}

									if ( !$thereWasLastArrow ){
										$thereWasLastArrow = true;
										echo '</div>';
									}

								?>
							</div>
						<?php
					}

				?>

			</div>
		</div>
	</div>

</div>

<?php } ?>