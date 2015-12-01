<?php
/**
 * Basically options for the whole minificator plugin. They could be
 * accessed via the admin screen. They will also be accessed across
 * the whole plugin.
 * 
 * @author boobs.lover
 */
class ffScrollbarAdminOptionsHolder extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure('minificator');
		
$s->startSection('options', ffOneSection::TYPE_NORMAL );

// Thumb



$s->addElement(ffOneElement::TYPE_HTML, '', '

	<h2>
	<div class="ff-scrollbar-preview ff-scrollbar-preview-thumb">
		<div class="ff-scrollbar-preview-scrollbar">
			<div class="ff-scrollbar-preview-track">
				<div class="ff-scrollbar-preview-thumb">
				</div>
			</div>
		</div>
	</div>Thumb</h2>

');





$s->addElement(ffOneElement::TYPE_PARAGRAPH, '', 'Thumb is the foremost part of the Scrollbar that you can drag.');


/*		<div class="ff-tabs">
			<div class="ff-tabs-header">
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab nav-tab-active" href="">Normal</a>
					<a class="nav-tab" href="">Hover</a>
					<a class="nav-tab" href="">Active</a>
				</h2>
			</div>
			<div class="ff-tabs-contents">
				<div class="ff-tabs-content" id="ff-tab-normal">
					aaaaaaaaaa
				</div>
				<div class="ff-tabs-content" id="ff-tab-hover">
					bbbbbbbbbb
				</div>
				<div class="ff-tabs-content" id="ff-tab-active">
					cccccccccc
				</div>
			</div>
		</div>*/

$s->addElement(ffOneElement::TYPE_HTML, '', '

	<div class="ff-tabs">
			<div class="ff-tabs-header">
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab nav-tab-active" href="">Normal</a>
					<a class="nav-tab" href="">Hover</a>
					<a class="nav-tab" href="">Active</a>
				</h2>
			</div>
			<div class="ff-tabs-contents">

');



$s->addElement(ffOneElement::TYPE_HTML, '', '
	<div class="ff-tabs-content" id="ff-tab-normal">
');



$s->addElement( ffOneElement::TYPE_TABLE_START );
$s->addElement(ffOneElement::TYPE_NEW_LINE);

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Dimensions');

$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-border-radius', 'Border radius', '99')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Background');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-thumb-background', 'Background color', '#bbbbbb')
->addParam('less-variable-name', '@scrollbar-thumb-background');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Border');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-thumb-border-color', 'Border color', 'transparent')
->addParam('less-variable-name', '@scrollbar-thumb-border-color');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Inner Shadow');

$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-x', 'Horizontal shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-y', 'Vertical shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-blur', 'Blur', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-spread', 'Spread', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-thumb-inner-shadow-color', 'Color', 'transparent')
->addParam('less-variable-name', '@scrollbar-thumb-inner-shadow-color');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_END );

$s->addElement(ffOneElement::TYPE_HTML, '', '
	</div>
	
	<div class="ff-tabs-content" id="ff-tab-hover">
');




$s->addElement( ffOneElement::TYPE_TABLE_START );
$s->addElement(ffOneElement::TYPE_NEW_LINE);

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Background');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-thumb-background-hover', 'Background color', '0')
->addParam('less-variable-name', '@scrollbar-thumb-background-hover');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Border');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-thumb-border-color-hover', 'Border color', '0')
->addParam('less-variable-name', '@scrollbar-thumb-border-color-hover');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Inner Shadow');

$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-x-hover', 'Horizontal shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-y-hover', 'Vertical shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-blur-hover', 'Blur', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-spread-hover', 'Spread', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-thumb-inner-shadow-color-hover', 'Color', '0')
->addParam('less-variable-name', '@scrollbar-thumb-inner-shadow-color-hover');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_END );


$s->addElement(ffOneElement::TYPE_HTML, '', '
	</div>
	
	<div class="ff-tabs-content" id="ff-tab-active">
');





$s->addElement( ffOneElement::TYPE_TABLE_START );
$s->addElement(ffOneElement::TYPE_NEW_LINE);

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Background');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-thumb-background-active', 'Background color', '0')
->addParam('less-variable-name', '@scrollbar-thumb-background-active');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Border');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-thumb-border-color-active', 'Border color', '0')
->addParam('less-variable-name', '@scrollbar-thumb-border-color-active');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Inner Shadow');

$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-x-active', 'Horizontal shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-y-active', 'Vertical shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-blur-active', 'Blur', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-thumb-inner-shadow-spread-active', 'Spread', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-thumb-inner-shadow-color-active', 'Color', '0')
->addParam('less-variable-name', '@scrollbar-thumb-inner-shadow-color-active');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement(ffOneElement::TYPE_TABLE_END);


$s->addElement(ffOneElement::TYPE_HTML, '', '
	</div>
');

$s->addElement(ffOneElement::TYPE_HTML, '', '
		</div>
	</div>
');







// Track

$s->addElement(ffOneElement::TYPE_HTML, '', '

	<h2>
	<div class="ff-scrollbar-preview ff-scrollbar-preview-track">
		<div class="ff-scrollbar-preview-scrollbar">
			<div class="ff-scrollbar-preview-track">
				<div class="ff-scrollbar-preview-thumb">
				</div>
			</div>
		</div>
	</div>Track</h2>

');
$s->addElement(ffOneElement::TYPE_PARAGRAPH, '', 'Track is the inner part of the Scrollbar and is behind the Thumb.');

$s->addElement( ffOneElement::TYPE_TABLE_START );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Dimensions');

$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-track-size', 'Width', '8')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-track-border-radius', 'Border radius', '99')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Background');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-track-background', 'Background color', '')
->addParam('less-variable-name', '@scrollbar-track-background');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Border');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-track-border-color', 'Border color', '' )
->addParam('less-variable-name', '@scrollbar-track-border-color');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Inner Shadow');

$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-track-inner-shadow-x', 'Horizontal shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-track-inner-shadow-y', 'Vertical shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-track-inner-shadow-blur', 'Blur', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-track-inner-shadow-spread', 'Spread', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-track-inner-shadow-color', 'Color', '')
->addParam('less-variable-name', '@scrollbar-track-inner-shadow-color');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement(ffOneElement::TYPE_TABLE_END);

// Scrollbar

$s->addElement(ffOneElement::TYPE_HTML, '', '
	
	<h2>
	<div class="ff-scrollbar-preview ff-scrollbar-preview-scrollbar">
		<div class="ff-scrollbar-preview-scrollbar">
			<div class="ff-scrollbar-preview-track">
				<div class="ff-scrollbar-preview-thumb">
				</div>
			</div>
		</div>
	</div>Scrollbar</h2>

');
$s->addElement(ffOneElement::TYPE_PARAGRAPH, '', 'This is the Scrollbar itself, it is wrapped around the Track and Thumb.');

$s->addElement( ffOneElement::TYPE_TABLE_START );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Dimensions');

$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-size', 'Width', '20')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Background');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-background', 'Background color', '')
->addParam('less-variable-name', '@scrollbar-background');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Border');

$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-border-color', 'Border color', '')
->addParam('less-variable-name', '@scrollbar-border-color');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Inner Shadow');

$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-inner-shadow-x', 'Horizontal shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-inner-shadow-y', 'Vertical shadow', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-inner-shadow-blur', 'Blur', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_NUMBER, 'scrollbar-inner-shadow-spread', 'Spread', '0')
->addParam('class', 'small-text')
->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px');
$s->addElement(ffOneElement::TYPE_NEW_LINE);
$s->addOption(ffOneOption::TYPE_COLOR_LIBRARY, 'scrollbar-inner-shadow-color', 'Color', '')
->addParam('less-variable-name', '@scrollbar-inner-shadow-color');

$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

$s->addElement(ffOneElement::TYPE_TABLE_END);

$s->endSection();

return $s;
	}
}

