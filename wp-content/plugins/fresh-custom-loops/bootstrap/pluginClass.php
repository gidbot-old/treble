<?php
 
class ffPluginFreshCustomLoop extends ffPluginAbstract {
	
	const OPTIONS_NAMESPACE = 'custom-loop';
	const OPTIONS_DATA_NAME = 'custom-loop-data';
	
	/**
	 *
	 * @var ffPluginFreshCustomLoopContainer
	 */
	protected $_container = null;
	
	private $_currentCustomLoop = null;
	
	private $_conditionalLogicTested = false;

	protected function _registerAssets() {
		$fwc = $this->_getContainer()->getFrameworkContainer();
		$fwc->getAdminScreenManager()->addAdminScreenClassName('ffAdminScreenCustomLoop');
	}

	protected function _run() {
		$fwc = $this->_getContainer()->getFrameworkContainer();
		
		$fwc->getWPLayer()->add_action('pre_get_posts', array($this, 'actionPreGetPosts' ) );
		$fwc->getWPLayer()->add_action('posts_where', array($this, 'actionPostsWhere' ) );
	}
	
	private function _explodeIds( $value ) {
		return explode('--||--', $value );
	}

	
	public function actionPostsWhere( $where = '' ) {
		
		$fwc = ffContainer::getInstance();
		if( $fwc->getWPLayer()->is_admin() || !$fwc->getWPLayer()->is_main_query() )
			return $where;
		
		
		$conditionalLogic = $this->_testConditionalLogic();
		
		if( !empty( $conditionalLogic ) ) {
			
################################################################################
# DATE ABSOLUTE
################################################################################			
			if( !empty( $conditionalLogic['date_old_max_absolute'] ) ) {
				$dateForSQL = date('Y-m-d', strtotime($conditionalLogic['date_old_max_absolute']) );
				$where .= " AND post_date >= '" . $dateForSQL . "'";
			}
			
			
			if( !empty( $conditionalLogic['date_old_min_absolute'] ) ) {
				$dateForSQL = date('Y-m-d', strtotime($conditionalLogic['date_old_min_absolute']) );
				$where .= " AND post_date <= '" . $dateForSQL . "'";
			}
			
################################################################################
# DATE RELATIVE
################################################################################			
			
			if( !empty( $conditionalLogic['date_older_max_relative'] ) ) {
				$dateForSQL = date('Y-m-d', strtotime($conditionalLogic['date_older_max_relative']) );
				$where .= " AND post_date >= '" . $dateForSQL . "'";
			}
				
				
			if( !empty( $conditionalLogic['date_older_min_relative'] ) ) {
				$dateForSQL = date('Y-m-d', strtotime($conditionalLogic['date_older_min_relative']) );
				$where .= " AND post_date <= '" . $dateForSQL . "'";
			}
			
################################################################################
# COMMENT COUNT
################################################################################

			if( !empty( $conditionalLogic['comment_count_greater'] ) ) {
				$where .= " AND comment_count >= '-" . $conditionalLogic['comment_count_greater'] . "'";
			}
			
			
			if( !empty( $conditionalLogic['comment_count_lower'] ) ) {
				$where .= " AND comment_count <= '-" . $conditionalLogic['comment_count_lower'] . "'";
			}
			//die();
		}
		
		return $where;
	}
	
	public function actionPreGetPosts( $wpQuery ) {
		$fwc = ffContainer::getInstance();
		if( $fwc->getWPLayer()->is_admin() || !$wpQuery->is_main_query() )
			return $wpQuery;
		
		$conditionalLogic = $this->_testConditionalLogic();
		
		if( !empty( $conditionalLogic ) ) {

################################################################################
# LOOP SETTINGS
################################################################################

			$wpQuery->set('posts_per_page', $conditionalLogic['posts_per_page'] );
			$wpQuery->set('order', $conditionalLogic['order'] );
			$wpQuery->set('orderby', $conditionalLogic['order_by'] );
			$wpQuery->set('offset', $conditionalLogic['offset']);
			
			if( $conditionalLogic['must_have_featured_image'] == 1 ) {
				$wpQuery->set('meta_key', '_thumbnail_id');
			} 
			
			
################################################################################
# CATEGORY
################################################################################
			// IN
			if( !empty( $conditionalLogic['category_include'] ) ) {
				$arrayOfIds = $this->_explodeIds( $conditionalLogic['category_include'] );
				
				$wpQuery->set('category__in', $arrayOfIds);
			}
			
			// NOT IN
			if( !empty( $conditionalLogic['category_exclude'] ) ) {
				$arrayOfIds = $this->_explodeIds( $conditionalLogic['category_exclude'] );
			
				$wpQuery->set('category__not_in', $arrayOfIds);
			}
			
			
################################################################################
# TAGS
################################################################################
			// IN
			if( !empty( $conditionalLogic['tag_include'] ) ) {
				$arrayOfIds = $this->_explodeIds( $conditionalLogic['tag_include'] );
			
				$wpQuery->set('tag__in', $arrayOfIds);
			}
				
			// NOT IN
			if( !empty( $conditionalLogic['tag_exclude'] ) ) {
				$arrayOfIds = $this->_explodeIds( $conditionalLogic['tag_exclude'] );
					
				$wpQuery->set('tag__not_in', $arrayOfIds);
			}			
			
			
################################################################################
# AUTHOR
################################################################################
			// IN
			if( !empty( $conditionalLogic['user_include'] ) ) {
				$arrayOfIds = $this->_explodeIds( $conditionalLogic['user_include'] );
					
				$wpQuery->set('author__in', $arrayOfIds);
			}
			
			// NOT IN
			if( !empty( $conditionalLogic['user_exclude'] ) ) {
				$arrayOfIds = $this->_explodeIds( $conditionalLogic['user_exclude'] );
					
				$wpQuery->set('author__not_in', $arrayOfIds);
			}
		}

		
		
		return $wpQuery;
	}
	
	
	private function _testConditionalLogic() {
	
		if( $this->_conditionalLogicTested == true ) {
			return $this->_currentCustomLoop;
		}
		
		
		$this->_conditionalLogicTested = true;
	
		$fwc = ffContainer::getInstance();
		$data = $fwc->getDataStorageFactory()->createDataStorageWPOptionsNamespace( ffPluginFreshCustomLoop::OPTIONS_NAMESPACE )->getOption( ffPluginFreshCustomLoop::OPTIONS_DATA_NAME );
	
	
		if( empty($data) ) {
			$this->_currentCustomLoop = null;
			return $this->_currentCustomLoop;
		}
	
	
		$data = $data['custom-loop'];
		$evaluator = $fwc->getLibManager()->createConditionalLogicEvaluator();
	
		foreach( $data as $oneLoopChange ) {
	
			$oneLoopChange = $oneLoopChange['custom-loop-item'];
			$conditionalLogic = $oneLoopChange['conditional_logic'];
	
			$query = $fwc->getOptionsFactory()->createQuery( $conditionalLogic );
	
			if( !$evaluator->evaluate($query) ) {
				continue;
			}
	
			$this->_currentCustomLoop = $oneLoopChange;
				
			
			return $this->_currentCustomLoop;
			break;
		}
		

	
	}

	protected function _registerActions() {

	}

	protected function _setDependencies() {

	}


	/**
	 * @return ffPluginFreshCustomLoopContainer
	 */
	protected function _getContainer() {
		return $this->_container;
	}
}