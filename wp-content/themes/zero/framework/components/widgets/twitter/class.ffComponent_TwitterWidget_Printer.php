<?php

class ffComponent_TwitterWidget_Printer extends ffBasicObject {
	public function printComponent( $args, ffOptionsQuery $query) {
		extract( $args );

		echo  $before_widget;

		$title = trim( $query->get('twitter title') );
		if( !empty($title) ){
			echo  $before_title . zero__wp_kses( $title ) .  $after_title;
		}

		$twitterFeeder = ffContainer::getInstance()->getLibManager()->createTwitterFeeder();
		ffContainer::getInstance()->getClassLoader()->loadClass('ffOptionsHolder_Twitter');

		$tweetsCollection = ($twitterFeeder->getTwitterFeed( $query->get('twitter fw_twitter')  ));

		if( ! $tweetsCollection->valid() ){
			echo '<p class="twitter-oops">Oops!</p>';
			echo '<p>Bad Twitter account data!</p>';
		}else{
			wp_enqueue_script( 'zero-twitter-widget-1-js' );
			?>
			<div class="twitter-widget-1 ff-block">
				<div class="tweets">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php foreach( $tweetsCollection as $oneTweet ) { ?>
								<div class="tweet swiper-slide">
									<div class="tweet-inner">
										<div class="tweet-content">
											<?php echo zero__wp_kses( $oneTweet->textWithLinks ); ?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="tweets-footer clearfix">
					<div class="pull-left">
						<?php
							echo '<a href="'.esc_url( 'http://twitter.com/'.esc_attr( $query->get('twitter fw_twitter username') )).'" class="tweet-author">';
							echo '<i class="fa fa-twitter"></i> ';
							echo esc_attr( $query->get('twitter fw_twitter username') );
							echo '</a>';
						?>
					</div>
					<div class="pull-right">
						<div class="twitter-pagination"></div>
					</div>
				</div>
			</div>
		<?php
		}

		echo  $after_widget;


	}
}