<?php
/**
 * Template Name: Portfolio Page
 *
 * @package WordPress
 * @subpackage Zero
 * @since Zero 1.0
 */


get_header(); ?>

<main class="main"><?php

	the_post();

	get_template_part('templates/sections/featured-area-1/featured-area-1');


	ob_start();
	the_content();
	$pagePortfolioContent = ob_get_clean();

	ob_start();
	the_title();
	$pagePortfolioTitle = ob_get_clean();

	ob_start();
	the_permalink();
	$pagePortfolioPermalink = ob_get_clean();

	/* GET PORTFOLIO DESCRIPTION */
	
	$fwc = ffContainer::getInstance();
	$postMeta = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( get_the_ID() );
	$pageTitle = $postMeta->getOptionCoded( 'page_portfolio_bottom' );
	$sectionQuery = ffContainer::getInstance()->getOptionsFactory()->createQuery( $pageTitle, 'ffComponent_Theme_MetaboxPage_PortfolioBottomView');

	$pagePortfolioDescription = $sectionQuery->get('general description');

	/* GET PORTFOLIO CATEGORY AND posts_per_page */

	$fwc = ffContainer::getInstance();
	$postMeta = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( get_the_ID() );
	$pageTitle = $postMeta->getOptionCoded( 'page_portfolio' );
	$sectionQuery = ffContainer::getInstance()->getOptionsFactory()->createQuery( $pageTitle, 'ffComponent_Theme_MetaboxPage_PortfolioView');

	$taxonomyIds = $sectionQuery->get('general loop-influence-portfolio-block')->getMultipleSelect('categories');
	$posts_per_page = absint($sectionQuery->get('general posts_per_page'));
	$pagePortfolioShowTitle = $sectionQuery->get('general show_title');
	$pagePortfolioShowSortableTags = $sectionQuery->get('general show_sortable_tags');
	$pagePortfolioSortableTags_AllTranslation = $sectionQuery->get('general all_translation');

	$column_count_xs = absint($sectionQuery->get('general column_count_xs'));
	if(  1 > $column_count_xs ) $column_count_xs =  1;
	if(  2 < $column_count_xs ) $column_count_xs =  2;
	$show_description_xs = absint($sectionQuery->get('general show_description_xs'));

	$column_count_sm = absint($sectionQuery->get('general column_count_sm'));
	if(  1 > $column_count_sm ) $column_count_sm =  1;
	if(  4 < $column_count_sm ) $column_count_sm =  4;
	$show_description_sm = absint($sectionQuery->get('general show_description_sm'));

	$column_count_md = absint($sectionQuery->get('general column_count_md'));
	if(  1 > $column_count_md ) $column_count_md =  1;
	if(  8 < $column_count_md ) $column_count_md =  8;
	$show_description_md = absint($sectionQuery->get('general show_description_md'));

	$column_count_lg = absint($sectionQuery->get('general column_count_lg'));
	if(  1 > $column_count_lg ) $column_count_lg =  1;
	if( 12 < $column_count_lg ) $column_count_lg = 12;
	$show_description_lg = absint($sectionQuery->get('general show_description_lg'));

	$is_square = absint($sectionQuery->get('general is_square'));

	if( 0 == $posts_per_page ){
		$posts_per_page = -1;
	}

	$args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $posts_per_page,
	);

	if (1 == count($taxonomyIds)) {
		if (isSet($taxonomyIds[0]) and empty($taxonomyIds[0])) {
			$taxonomyIds = null;
		}
	}

	if (!empty($taxonomyIds)) {

		$args['tax_query'] = array();
		if (1 < count($taxonomyIds)) {
			$args['tax_query']['relation'] = 'OR';
		}

		foreach ($taxonomyIds as $tax_ID) {
			$args['tax_query'][] = array(
				'taxonomy' => 'ff-portfolio-category',
				'field' => 'id',
				'terms' => absint($tax_ID),
			);
		}
	}

//	global $wp_query;
//	$backuped_main_query = clone $wp_query;

	$portfolio_query = new WP_Query($args);

	if ( $portfolio_query->have_posts() ) {

		wp_enqueue_script( 'zero-portfolio-cat-1-js' );

		$portfolioTagsArray = array();
		while ($portfolio_query->have_posts()) {
			$portfolio_query->the_post();

			$t = wp_get_post_terms( get_the_ID(), 'ff-portfolio-tag');
			if (!empty($t)) foreach ($t as $onePortfolioTag) {
				$portfolioTagsArray[$onePortfolioTag->slug] = $onePortfolioTag;
			}
		}
		$portfolio_query->rewind_posts();

		$pagePortfolioShowContent = strip_tags( $pagePortfolioContent );
		$pagePortfolioShowContent = str_replace( '&nbsp;', '', $pagePortfolioShowContent );
		$pagePortfolioShowContent = trim( $pagePortfolioShowContent );
		$pagePortfolioShowContent = ! empty( $pagePortfolioShowContent );

		?>
		<div class="portfolio-cat-1
			portfolio-cat-1--cols--xs--<?php echo absint($column_count_xs); ?>
			portfolio-cat-1--show-description--xs--<?php echo absint($show_description_xs); ?>

			portfolio-cat-1--cols--sm--<?php echo absint($column_count_sm); ?>
			portfolio-cat-1--show-description--sm--<?php echo absint($show_description_sm); ?>

			portfolio-cat-1--cols--md--<?php echo absint($column_count_md); ?>
			portfolio-cat-1--show-description--md--<?php echo absint($show_description_md); ?>

			portfolio-cat-1--cols--lg--<?php echo absint($column_count_lg); ?>
			portfolio-cat-1--show-description--lg--<?php echo absint($show_description_lg); ?>

			ff-section">

			<?php if( $pagePortfolioShowTitle or $pagePortfolioShowContent ) { ?>
				<div class="blog-post-1 ff-section">
					<div class="content-area__container container-fluid">
						<div class="row">
							<div class="content-area__column col-sm-8 col-sm-offset-2">
								<div class="post-block">
									<?php if( $pagePortfolioShowTitle ){ ?>
										<div class="post-header">
											<h3 class="post-title">
												<a href="<?php echo esc_url( $pagePortfolioPermalink ); ?>">
													<?php echo zero__wp_kses( $pagePortfolioTitle ); ?>
												</a>
											</h3>
										</div>
									<?php } ?>
									<?php if( $pagePortfolioShowContent ){ ?>
										<div class="post-content">
											<?php echo zero__wp_kses( $pagePortfolioContent ); ?>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if( !empty($pagePortfolioShowSortableTags) and ! empty( $portfolioTagsArray ) ){ ?>
				<div class="content-area__container container-fluid">
					<div class="row">
						<div class="content-area__column col-xs-12">
							<div class="portfolio-cat-1__filters isotope-filters">
								<div class="portfolio-cat-1__vcenter-wrapper">
									<div class="portfolio-cat-1__vcenter">
										<a href="" class="portfolio-cat-1__filter isotope-filter isotope-filter--active button--active" data-filter=".isotope-item">
											<?php echo zero__wp_kses( $pagePortfolioSortableTags_AllTranslation ) ?>
										</a>
										<?php foreach($portfolioTagsArray as $slug => $oneTag) { ?>
											<a href="" class="portfolio-cat-1__filter isotope-filter" data-filter=".isotope-tag-<?php echo esc_attr( $slug ); ?>"><?php echo zero__wp_kses( $oneTag->name ); ?></a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

			<div class="portfolio-cat-1__items-wrapper">
				<div class="portfolio-cat-1__items isotope">
					<?php $portfolio_query->rewind_posts(); ?>
					<?php while ($portfolio_query->have_posts()) { ?>
						<?php

						$portfolio_query->the_post();
						$imageUrlNonresized = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
						$tagstmp = wp_get_post_terms( $post->ID, 'ff-portfolio-tag');
						$tags_title = array();
						$tags_slugs = array();
						if( !empty($tagstmp) ){
							foreach($tagstmp as $t ){
								$tags_title[] = $t->name;
								$tags_slugs[] = 'isotope-tag-'.  $t->slug;
							}
						}
						$tags_title = implode(', ', $tags_title);
						$tags_slugs = implode(' ', $tags_slugs);

						?>
						<a class="portfolio-cat-1__item isotope-item <?php echo esc_attr( $tags_slugs ); ?>" href="<?php echo get_the_permalink( $post->ID ) ?>">
							<div class="portfolio-cat-1__box">
								<div class="portfolio-cat-1__box-inner">
									<div class="portfolio-cat-1__hover-wrapper">
										<div class="portfolio-cat-1__hover">
											<div class="portfolio-cat-1__hover-inner">
												<div class="portfolio-cat-1__vcenter-wrapper">
													<div class="portfolio-cat-1__vcenter">
														<h3><?php echo zero__wp_kses($post->post_title); ?></h3>
														<?php if( !empty($tags_title) ){ ?>
															<div class="portfolio-cat-1__tags">
																<?php echo zero__wp_kses( $tags_title ); ?>
															</div>
														<?php } ?>
													</div>
												</div>
											</div>
											<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP4/x8AAwAB/2+Bq7YAAAAASUVORK5CYII=" alt="" class="white-bg">
										</div>
										<?php
										$responsive_img = $imageUrlNonresized;
										require locate_template('templates/blocks/responsive-image-2/responsive-image-2.php');
										?>
									</div>
								</div>
							</div>
						</a>
					<?php } ?>
				</div>
			</div>
			<div class="portfolio-cat-1__portfolio-bottom-content"><?php echo do_shortcode($pagePortfolioDescription); ?></div>
		</div>

	<?php
	} else{
		echo 'NO PORTFOLIO POST FOUND';
	}

?></main>

<?php get_footer(); ?>