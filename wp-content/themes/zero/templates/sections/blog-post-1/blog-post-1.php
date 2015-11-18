<?php

wp_enqueue_script( 'zero-blog-post-1-js' );

$postMetaGetter = ffContainer()->getThemeFrameworkFactory()->getPostMetaGetter();
global $wp_query;
$query = ffThemeOptions::getQuery('post');
$queryPortfolio = ffThemeOptions::getQuery('portfolio');

$container_class = 'container-fluid';
$container_inner_class='col-sm-8 col-sm-offset-2';
if( is_page() ){
	if( 'page-template-fullwidth.php' == get_page_template_slug( get_the_ID() ) ) {
		$container_class = '';
		$container_inner_class='col-xs-12';
	}
}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class("blog-post-1 ff-section"); ?>>
	<div class="content-area__container <?php echo $container_class; ?>">
		<div class="row">
			<div class="content-area__column <?php echo $container_inner_class; ?>">
				<div class="post-block">
					<div class="post-header">
						<?php if( 'post' == get_post_type( get_the_ID() )){ ?>
							<?php if( $query->get('show-date') ){ ?>
								<div class="post-expander">
									<div class="post-date">
										<a href="<?php the_permalink(); ?>"><?php
											echo get_the_date( $query->get('date-format') );
										?></a>
									</div>
								</div>
							<?php } ?>
						<?php } else if( 'portfolio' == get_post_type( get_the_ID() )){ ?>

						<?php } ?>
						<h3 class="post-title post-expand-toggle">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<?php if( $query->get('show-read-more') ){ ?>
						<div class="post-collapser">
							<a class="read-more-button post-expand-toggle" href="<?php the_permalink(); ?>">
								<?php
									echo zero__wp_kses( $query->get('read-more') );
								?><i class="fa fa-angle-right"></i>
							</a>
						</div>
						<?php } ?>
						<?php if( 'post' == get_post_type( get_the_ID() )){ ?>
							<div class="post-expander">
								<div class="post-meta">

									<?php if( $query->get('show-author') ){ ?>
										<div class="post-meta__block">
											<div class="post-meta__author">
												<i class="icon-user"></i>
												<?php
													echo '<a href="'.esc_url( $postMetaGetter->getPostAuthorUrl() ).'">';
													echo zero__wp_kses( $postMetaGetter->getPostAuthorName() );
													echo '</a>';
												?>
											</div>
										</div>
									<?php } ?>
									<?php if( $query->get('show-categories') ){ ?>
										<?php $cats = $postMetaGetter->getPostCategoriesHtml(); ?>
										<?php if( ! empty( $cats ) ){ ?>
											<div class="post-meta__block">
												<i class="icon-folder-alt"></i>
												<?php
													echo zero__wp_kses( $postMetaGetter->getPostCategoriesHtml() );
												?>
											</div>
										<?php } ?>
									<?php } ?>
									<?php if( $query->get('show-tags') ){ ?>
										<?php $tags = $postMetaGetter->getPostTagsHtml(); ?>
										<?php if( ! empty( $tags ) ){ ?>
											<div class="post-meta__block">
												<i class="icon-tag"></i>
												<?php
													echo zero__wp_kses( $tags );
												?>
											</div>
										<?php } ?>
									<?php } ?>
									<?php if ( comments_open() or ( get_comments_number() > 0 ) ) { ?>
										<?php if( $query->get('show-comment-count') ){ ?>
											<?php wp_enqueue_script( 'zero-comments-form-1-js' ); ?>
											<?php if ( comments_open() and ( get_comments_number() > 0 ) ) { wp_enqueue_script( 'comment-reply' ); } ?>
											<div class="post-meta__block">
												<i class="icon-bubble"></i>
												<a class="comments-popup-link" data-post-id="<?php echo absint( $post->ID ); ?>" href="<?php the_permalink(); ?>#comments">
													<?php
														echo zero__wp_kses( $postMetaGetter->getPostCommentsText(
															$query->get('comment-zero'),
															$query->get('comment-one'),
															$query->get('comment-more')
														) );
													?>
												</a>
											</div>
										<?php } ?>
									<?php } ?>

								</div>
							</div>
						<?php } ?>
					</div>
					<div class="post-expander">

						<div class="post-content"><?php
							the_content( $query->get('read-more') );
							wp_link_pages();
                            if( is_page() && ( 'page-template-contact.php' == get_page_template_slug( get_the_ID() ) ) ){
								get_template_part('templates/blocks/contact-form-1/contact-form-1');
							}
						?></div>


						<?php if ( 'portfolio' == get_post_type( get_the_ID() ) AND !$queryPortfolio->get('single_portfolio_post_footer') ) { ?>

						<?php } else { ?>

							<div class="post-footer clearfix">

								<?php if( 'post' == get_post_type( get_the_ID() ) OR 'portfolio' == get_post_type( get_the_ID() ) ){ ?>
									<div class="post-footer__left">
										<?php if( $query->get('show-permalink') ){ ?>
											<a class="post-footer__button" href="<?php the_permalink(); ?>">
												<i class="icon-link"></i>
												<span class="post-footer__button-text"><?php
													echo zero__wp_kses( $query->get('permalink') );
												?></span>
											</a>
										<?php } ?>
										<?php if( $query->get('show-share') ){ ?>
											<a class="post-footer__button post-share__open-popup" href="">
												<i class="icon-share"></i>
												<span class="post-footer__button-text"><?php
													echo zero__wp_kses( $query->get('share') );
												?></span>
											</a>
											<div class="post-share__popup">
												<div class="vcenter-wrapper">
													<div class="vcenter">
														<a class="post-share__overlay post-share__close-popup" href=""></a>
														<div class="post-share__inner">

															<?php
																$sharer = ffContainer::getInstance()->getThemeFrameworkFactory()->getSocialSharerFeedCreator();
																$sharer->setLink( get_the_permalink() );
																$networks = $query->get('social-networks');
																foreach ($networks as $netValue) {

																	$type = $netValue->get('type');
																	$icon = $sharer->getSocialIcon( $type );
																	$link = $sharer->getSocialLink( $type );

																	echo '<a';
																	echo ' href="' . esc_url( $link ) . '"';
																	echo ' class="post-share__network-link"';
																	echo ' target="_blank">';
																	echo '<i class="'.esc_attr( apply_filters( 'to_zocial', $icon ) ).'"></i>';
																	echo '</a>';
																}
															?>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								<?php } ?>
								<div class="post-footer__right">
									<?php if( ! post_password_required() ) { ?>
										<?php if ( comments_open() or ( get_comments_number() > 0 ) ) { ?>
											<?php if( $query->get('show-discussion') ){ ?>
												<?php wp_enqueue_script( 'zero-comments-form-1-js' ); ?>
												<?php if ( comments_open() and ( get_comments_number() > 0 ) ) { wp_enqueue_script( 'comment-reply' ); } ?>
												<a class="post-footer__button comments-popup-link" data-post-id="<?php echo absint( $post->ID); ?>" href="<?php the_permalink(); ?>#comments">
													<i class="icon-bubble"></i>
												<span class="post-footer__button-text"><?php
													echo zero__wp_kses( $postMetaGetter->getPostCommentsText(
														$query->get('discussion-zero'),
														$query->get('discussion-one'),
														$query->get('discussion-more')
													) );
													?></span>
												</a>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>