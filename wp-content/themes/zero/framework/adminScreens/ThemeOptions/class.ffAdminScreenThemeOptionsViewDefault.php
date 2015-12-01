<?php

class ffAdminScreenThemeOptionsViewDefault extends ffAdminScreenView {

	public function actionSave( ffRequest $request ) {
		if( ! $request->postEmpty() ){
			flush_rewrite_rules( false );
		}
	}

	protected function _render() {

		global $wp_rewrite;
		$wp_rewrite->flush_rules(true);

		ffContainer::getInstance()->getModalWindowFactory()->printModalWindowManagerLibraryIcon();
		ffContainer::getInstance()->getModalWindowFactory()->printModalWindowSectionPicker();

		if( ! ffContainer::getInstance()->getRequest()->postEmpty() ){
			echo '<ifr'.'ame src="?page=ThemeOptions&flush-more=1" style="height:1px;width:1px;"></ifr'.'ame>';
		}

		echo '<div class="wrap">';
		echo '<form method="post">';

		echo '<h2>';
		echo __( 'Theme Options' , 'zero');
		echo '</h2>';

		echo '<h2 class="nav-tab-wrapper">';

		echo '<a href="#ff-theme-mix-admin-tab-header" class="nav-tab nav-tab-active" data-for="ff-theme-mix-admin-tab-header">';
		echo __( 'Header' , 'zero');
		echo '</a>';

		echo '<a href="#ff-theme-mix-admin-tab-side-menu" class="nav-tab" data-for="ff-theme-mix-admin-tab-side-menu">';
		echo __( 'Side Menu' , 'zero');
		echo '</a>';

		echo '<a href="#ff-theme-mix-admin-tab-footer" class="nav-tab" data-for="ff-theme-mix-admin-tab-footer">';
		echo __( 'Footer' , 'zero');
		echo '</a>';

		echo '<a href="#ff-theme-mix-admin-tab-loader" class="nav-tab" data-for="ff-theme-mix-admin-tab-loader">';
		echo __( 'Loader' , 'zero');
		echo '</a>';

		echo '<a href="#ff-theme-mix-admin-tab-fonts" class="nav-tab" data-for="ff-theme-mix-admin-tab-fonts">';
		echo __( 'Fonts' , 'zero');
		echo '</a>';

		echo '<a href="#ff-theme-mix-admin-tab-posts" class="nav-tab" data-for="ff-theme-mix-admin-tab-posts">';
		echo __( 'Posts' , 'zero');
		echo '</a>';

		echo '<a href="#ff-theme-mix-admin-tab-portfolio" class="nav-tab" data-for="ff-theme-mix-admin-tab-portfolio">';
		echo __( 'Portfolio' , 'zero');
		echo '</a>';

		echo '<a href="#ff-theme-mix-admin-tab-comments" class="nav-tab" data-for="ff-theme-mix-admin-tab-comments">';
		echo __( 'Comments' , 'zero');
		echo '</a>';

		echo '<a href="#ff-theme-mix-admin-tab-search" class="nav-tab" data-for="ff-theme-mix-admin-tab-search">';
		echo __( 'Search' , 'zero');
		echo '</a>';

		echo '<a href="#ff-theme-mix-admin-tab-404" class="nav-tab" data-for="ff-theme-mix-admin-tab-404">';
		echo __( '404' , 'zero');
		echo '</a>';

		echo '</h2>';

		$this->_renderOptions(
			  ffThemeContainer::OPTIONS_HOLDER
			, ffThemeContainer::OPTIONS_PREFIX
			, ffThemeContainer::OPTIONS_NAMESPACE
			, ffThemeContainer::OPTIONS_NAME
		);

		echo '</form>';
		echo '</div>';

		?>
			<style type="text/css">
				.ff-theme-mix-admin-tab-iconfonts i{
					font-size: 20px;
					margin-right: 20px;
					width: 20px;
				}
			</style>
			<script>
			(function($){
				$(document).ready(function(){
					$(".ff-theme-layout-changer label").click(function(){
						$( this ).parents('fieldset').find('label').removeClass('selected');
						$( this ).addClass('selected');
					});

					$(".ff-theme-layout-changer label input[checked=checked]").each(function(){
						$(this).parents('label').click();
					});

				});

				$(document).ready(function(){
					$(".nav-tab").click(function(){
						$(".ff-theme-mix-admin-tab-content").hide();
						$("." + $(this).attr("data-for")).show();
						$(".nav-tab-active").removeClass("nav-tab-active");
						$(this).addClass("nav-tab-active");
					});
				});

				$(document).ready(function(){

					if( -1 == document.URL.indexOf('#') ){
						$(".nav-tab-active").click();
						return;
					}

					var _id;
					_id = document.URL.split('#');
					_id = "" + _id[1];
					if( _id.length < 1 ) {
						return null;
					}

					if( $( 'a[href=#' + _id + ']' ).size() < 1 ){
						$(".nav-tab-active").click();
						return;
					}

					$( 'a[href=#' + _id + ']' ).click();
				});

				$(window).load(function(){
					$(".ff-default-wp-color-picker").each(function(){
						var $this_parent = $(this).parent();
						var this_text = $this_parent.text();
						$(this).wpColorPicker();
						$this_parent.find('a').attr('title', this_text);
						$this_parent.contents().filter(function() {
							return this.nodeType == 3; //Node.TEXT_NODE
						}).remove();
					});
				});
			})(jQuery);
			</script>
		<?php

	}

	protected function _requireAssets() {
		$styleEnqueuer = $this->_getStyleEnqueuer();
		$scriptEnqueuer = $this->_getScriptEnqueuer();

		if( ffContainer::getInstance()->getRequest()->get('flush-more') ){
			flush_rewrite_rules( false );
			exit;
		}

		$styleEnqueuer->addStyleTheme( 'wp-color-picker' );
		$scriptEnqueuer->addScript( 'wp-color-picker');
	}

	protected function _setDependencies() {

	}

	public function ajaxRequest( ffAdminScreenAjax $ajax ) {

	}
}