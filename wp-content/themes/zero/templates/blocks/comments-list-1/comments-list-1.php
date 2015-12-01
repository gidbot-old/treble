<div class="comments-list-1 ff-block">

<?php
	$queryTranslation = ffThemeOptions::getQuery('comments');
	$query = $queryTranslation->get('comments-list');
?>

<?php
/**********************************************************************************************************************/
/* HEADING
/**********************************************************************************************************************/
	if( $query->get('heading show') ) {
		$postMetaGetter = ffContainer()->getThemeFrameworkFactory()->getPostMetaGetter();
		$headingQuery = $query->get('heading');
		$heading = $postMetaGetter->getPostCommentsText( $headingQuery->get('trans-zero'),$headingQuery->get('trans-one'),$headingQuery->get('trans-more') );
?>
	<h3 class="comments__title"><?php echo zero__wp_kses( $heading ); ?></h3>
<?php
	}
?>
	<ul class="comments" id="comments">
<?php
/**********************************************************************************************************************/
/* PRINTING COMMENT
/**********************************************************************************************************************/
		function ff_comments_list_callback($comment, $args, $depth) {
			global $ff_global_comment_depth;
			$ff_global_comment_depth++;

			$queryTranslation = ffThemeOptions::getQuery('comments');
			$query = $queryTranslation->get('comments-list');
			$postMetaGetter = ffContainer()->getThemeFrameworkFactory()->getPostMetaGetter();

?>
						<li id="<?php echo esc_attr( $postMetaGetter->getPostCommentsId() );?>" class="comment even thread-even depth-1">
							<div class="comment-body clearfix">

								<div class="comment__right clearfix">

									<div class="comment-meta clearfix">
										<div class="comment-meta__author-name">
											<a href="<?php echo  $postMetaGetter->getCommentAuthorUrl(); ?>"><?php echo zero__wp_kses( $postMetaGetter->getCommentAuthorName() ); ?></a>
										</div>
										<?php if( $query->get('one-comment show-date') ) { ?>
											<div class="comment-meta__date">
												<?php
													printf(
														$query->get('one-comment how-much-ago')
														, human_time_diff( get_comment_time('U'), current_time('timestamp') )
													);
												?>
											</div>
										<?php } ?>
									</div>

									<div class="comment-content">

										<?php
											if ( '0' == $comment->comment_approved ) {
												echo '<em class="comment-awaiting-moderation">';
												echo zero__wp_kses( $query->get('one-comment trans-moderation') );
												echo '</em>';
												echo '</br>';
												echo '</br>';
											}
												comment_text();
										?>

									</div>

									<?php echo  ( $postMetaGetter->getCommentReplyLink( $query->get('one-comment trans-reply'), $args, $depth ) ); ?>

								</div>

								<div class="comment__left">
									<a class="avatar-link" href="<?php echo  $postMetaGetter->getCommentAuthorUrl(); ?>">
										<?php echo zero__wp_kses( $postMetaGetter->getCommentAuthorImage(90) ); ?>
									</a>
								</div>

							</div>
<?php
						}
/**********************************************************************************************************************/
/* ACTUAL COMMENT CALLACK
/**********************************************************************************************************************/
			wp_list_comments(
				array(
					'style' => 'ul',
					'callback' => 'ff_comments_list_callback',
					'end-callback' => 'ff_comments_list_callback_end',
				)
			);
?>


	</ul>
<?php
/**********************************************************************************************************************/
/* END LI CALLBACK
/**********************************************************************************************************************/
function ff_comments_list_callback_end(){
	global $ff_global_comment_depth;
	echo '</li>';

	$ff_global_comment_depth--;
} ?>

</div>