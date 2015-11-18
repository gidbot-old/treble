<?php

$query = ffThemeOptions::getQuery('footer')->get('secondary');

if( $query->get('show') ) {
	?>
	<div class="footer-2 ff-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="footer-2__text pull-left"><?php
						echo zero__wp_kses($query->get('description'));
						?></div>
					<div class="footer-2__social pull-right">
						<ul class="social-icons">
							<?php
							$socialLinks = $query->get('social-links');

							$linksTranslated = ffContainer::getInstance()
								->getThemeFrameworkFactory()
								->getSocialFeedCreator()
								->getFeedFromLinks($socialLinks);

							if (!empty($linksTranslated)) {
								foreach ($linksTranslated as $oneItem) {
									echo '<li class="social-icon">';
									echo '<a href="' . esc_url($oneItem->link) . '" target="_blank">';
									$icon = apply_filters('to_zocial', $oneItem->type);
									echo '<i class="ff-font-zocial icon-' . esc_attr($icon) . '"></i>';
									echo '</a>';
									echo '</li>';
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}