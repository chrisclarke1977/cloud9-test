<?php
/**
 * Page builder support
 *
 * @package Very Simple Start
 */


/* Defaults */
add_theme_support( 'siteorigin-panels', array( 
	'margin-bottom' => 0,
) );

/* Theme widgets */
function verysimplestart_theme_widgets($widgets) {
	$theme_widgets = array(
		'VerySimpleStart_Services_Type_A',
		'VerySimpleStart_Services_Type_B',
		'VerySimpleStart_List',
		'VerySimpleStart_Facts',
		'VerySimpleStart_Clients',
		'VerySimpleStart_Testimonials',
		'VerySimpleStart_Skills',
		'VerySimpleStart_Action',
		'VerySimpleStart_Video_Widget',
		'VerySimpleStart_Social_Profile',
		'VerySimpleStart_Team',
		'VerySimpleStart_Latest_News',
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('verysimplestart-theme');
			$widgets[$theme_widget]['icon'] = 'dashicons dashicons-schedule';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'verysimplestart_theme_widgets');

/* Add a tab for the theme widgets in the page builder */
function verysimplestart_theme_widgets_tab($tabs){
	$tabs[] = array(
		'title' => __('Very Simple Start Theme Widgets', 'verysimplestart'),
		'filter' => array(
			'groups' => array('verysimplestart-theme')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'verysimplestart_theme_widgets_tab', 20);

/* Replace default row options */
function verysimplestart_row_styles($fields) {

	$fields['bottom_border'] = array(
		'name' => __('Bottom Border Color', 'verysimplestart'),
		'type' => 'color',
		'priority' => 3,		
	);
	$fields['padding'] = array(
		'name' => __('Top/bottom padding', 'verysimplestart'),
		'type' => 'measurement',
		'description' => __('Top and bottom padding for this row [default: 100px]', 'verysimplestart'),
		'priority' => 4,
	);
	$fields['align'] = array(
		'name' => __('Center align the content?', 'verysimplestart'),
		'type' => 'checkbox',
		'description' => __('This may or may not work. It depends on the widget styles.', 'verysimplestart'),
		'priority' => 5,
	);		
	$fields['background'] = array(
		'name' => __('Background Color', 'verysimplestart'),
		'type' => 'color',
		'description' => __('Background color of the row.', 'verysimplestart'),
		'priority' => 6,
	);
	$fields['color'] = array(
		'name' => __('Color', 'verysimplestart'),
		'type' => 'color',
		'description' => __('Color of the row.', 'verysimplestart'),
		'priority' => 7,
	);	
	$fields['background_image'] = array(
		'name' => __('Background Image', 'verysimplestart'),
		'type' => 'image',
		'description' => __('Background image of the row.', 'verysimplestart'),
		'priority' => 8,
	);
	$fields['row_stretch'] = array(
		'name' 		=> __('Row Layout', 'verysimplestart'),
		'type' 		=> 'select',
		'options' 	=> array(
			'' 				 => __('Standard', 'verysimplestart'),
			'full' 			 => __('Full Width', 'verysimplestart'),
			'full-stretched' => __('Full Width Stretched', 'verysimplestart'),
		),
		'priority' => 9,
	);
	$fields['mobile_padding'] = array(
		'name' 		  => __('Mobile padding', 'verysimplestart'),
		'type' 		  => 'select',
		'description' => __('Here you can select a top/bottom row padding for screen sizes < 1024px', 'verysimplestart'),		
		'options' 	  => array(
			'' 				=> __('Default', 'verysimplestart'),
			'mob-pad-0' 	=> __('0', 'verysimplestart'),
			'mob-pad-15'    => __('15px', 'verysimplestart'),
			'mob-pad-30'    => __('30px', 'verysimplestart'),
			'mob-pad-45'    => __('45px', 'verysimplestart'),
		),
		'priority'    => 10,
	);
	$fields['class'] = array(
		'name' => __('Row Class', 'verysimplestart'),
		'type' => 'text',
		'description' => __('Add your own class for this row', 'verysimplestart'),
		'priority' => 11,
	);
	$fields['column_padding'] = array(
		'name'        => __('Columns padding', 'verysimplestart'),
		'type'        => 'checkbox',
		'description' => __('Remove padding between columns for this row?', 'verysimplestart'),
		'priority'    => 12,
	);	

	return $fields;
}
remove_filter('siteorigin_panels_row_style_fields', array('SiteOrigin_Panels_Default_Styling', 'row_style_fields' ) );
add_filter('siteorigin_panels_row_style_fields', 'verysimplestart_row_styles');

/* Filter for the styles */
function verysimplestart_row_styles_output($attr, $style) {
	$attr['style'] = '';

	if(!empty($style['bottom_border'])) $attr['style'] .= 'border-bottom: 1px solid '. esc_attr($style['bottom_border']) . ';';
	if(!empty($style['background'])) $attr['style'] .= 'background-color: ' . esc_attr($style['background']) . ';';
	
	if(!empty($style['color'])) {
		$attr['style'] .= 'color: ' . esc_attr($style['color']) . ';';
		$attr['data-hascolor'] = 'hascolor';
	}
	
	if(!empty($style['align'])) $attr['style'] .= 'text-align: center;';
	if(!empty( $style['background_image'] )) {
		$url = wp_get_attachment_image_src( $style['background_image'], 'full' );
		if( !empty($url) ) {
			$attr['style'] .= 'background-image: url(' . esc_url($url[0]) . ');';
			$attr['data-hasbg'] = 'hasbg';
		}
	}
	if(!empty($style['padding'])) {
		$attr['style'] .= 'padding: ' . esc_attr($style['padding']) . ' 0; ';
	} else {
		$attr['style'] .= 'padding: 100px 0; ';
	}
	if( !empty( $style['row_stretch'] ) ) {
		$attr['class'][] = 'verysimplestart-stretch';
		$attr['data-stretch-type'] = esc_attr($style['row_stretch']);
	}
	if( !empty( $style['mobile_padding'] ) ) {
		$attr['class'][] = esc_attr($style['mobile_padding']);
	}
    if( !empty( $style['column_padding'] ) ) {
       $attr['class'][] = 'no-col-padding';
    }
    
	if(empty($attr['style'])) unset($attr['style']);
	return $attr;
}
add_filter('siteorigin_panels_row_style_attributes', 'verysimplestart_row_styles_output', 10, 2);