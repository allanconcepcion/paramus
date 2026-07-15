<?php

namespace PD\ACF\Page\Content;

require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/text.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/video.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/logo-carousel.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/cta.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/icon-blocks.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/icon-bar.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/contact-form.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/horizontal-accordion.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/accordion.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/video-carousel.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/timeline.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/media-text.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/media-text-2x.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/cards.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/gallery.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/video-gallery.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/html.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/card-carousel.php';
require WPMU_PLUGIN_DIR . '/pd/acf/page/modules/card-tabs.php';

use function PD\ACF\Page\Layout\Text\fields as text_fields;
use function PD\ACF\Page\Layout\Video\fields as video_fields;
use function PD\ACF\Page\Layout\LogoCarousel\fields as logo_carousel_fields;
use function PD\ACF\Page\Layout\Cta\fields as cta_fields;
use function PD\ACF\Page\Layout\IconBlocks\fields as icon_blocks_fields;
use function PD\ACF\Page\Layout\IconBar\fields as icon_bar_fields;
use function PD\ACF\Page\Layout\ContactForm\fields as contact_form_fields;
use function PD\ACF\Page\Layout\HorizontalAccordion\fields as horizontal_accordion_fields;
use function PD\ACF\Page\Layout\Accordion\fields as accordion_fields;
use function PD\ACF\Page\Layout\VideoCarousel\fields as video_carousel_fields;
use function PD\ACF\Page\Layout\Timeline\fields as timeline_fields;
use function PD\ACF\Page\Layout\MediaText\fields as media_text_fields;
use function PD\ACF\Page\Layout\MediaText2x\fields as media_text_2x_fields;
use function PD\ACF\Page\Layout\Cards\fields as cards_fields;
use function PD\ACF\Page\Layout\Gallery\fields as gallery_fields;
use function PD\ACF\Page\Layout\VideoGallery\fields as video_gallery_fields;
use function PD\ACF\Page\Layout\Html\fields as html_fields;
use function PD\ACF\Page\Layout\CardCarousel\fields as card_carousel_fields;
use function PD\ACF\Page\Layout\CardTabs\fields as card_tabs_fields;


function init () {
  acf_add_local_field_group([
    'key' => 'group_page_content',
    'title' => 'Page Content',
    'fields' => [
      [
	'key' => 'field_page_modules',
	'label' => 'Modules',
	'name' => 'modules',
	'type' => 'flexible_content',
	'show_in_graphql' => 1,
	'layouts' => [
	  'layout_text' => [
	    'key' => 'layout_text',
	    'name' => 'text',
	    'label' => 'Text',
	    'display' => 'block',
	    'sub_fields' => text_fields(),
	  ],
    'layout_video' => [
      'key' => 'layout_video',
	    'name' => 'video',
	    'label' => 'Video',
	    'display' => 'block',
	    'sub_fields' => video_fields()
    ],
    'layout_logo_carousel' => [
	    'key' => 'layout_logo_carousel',
	    'name' => 'logo_carousel',
	    'label' => 'Logo Carousel',
	    'display' => 'block',
	    'sub_fields' => logo_carousel_fields()
    ],
    'layout_cta' => [
	    'key' => 'layout_cta',
	    'name' => 'cta',
	    'label' => 'CTA',
	    'display' => 'block',
	    'sub_fields' => cta_fields()
    ],
    'layout_icon_blocks' => [
      'key' => 'layout_icon_blocks',
	    'name' => 'icon_blocks',
	    'label' => 'Icon Blocks',
	    'display' => 'block',
	    'sub_fields' => icon_blocks_fields()
    ],
		'layout_icon_bar' => [
      'key' => 'layout_icon_bar',
	    'name' => 'icon_bar',
	    'label' => 'Icon Bar',
	    'display' => 'block',
	    'sub_fields' => icon_bar_fields()
    ],
		'layout_html' => [
      'key' => 'layout_html',
	    'name' => 'html',
	    'label' => 'HTML',
	    'display' => 'block',
	    'sub_fields' => html_fields()
    ],		  
    'layout_gallery_a' => [
      'key' => 'layout_gallery_a',
	    'name' => 'gallery_a',
	    'label' => 'Gallery',
	    'display' => 'block',
	    'sub_fields' => gallery_fields('a')
    ],
    'layout_gallery_b' => [
      'key' => 'layout_gallery_b',
	    'name' => 'gallery_b',
	    'label' => 'Gallery - B (Legacy)',
	    'display' => 'block',
	    'sub_fields' => gallery_fields('b')
    ],
	  'layout_gallery_c' => [
      'key' => 'layout_gallery_c',
	    'name' => 'gallery_c',
	    'label' => 'Gallery - C (Legacy)',
	    'display' => 'block',
	    'sub_fields' => gallery_fields('c')
    ],
    'layout_video_gallery_a' => [
      'key' => 'layout_video_gallery_a',
	    'name' => 'video_gallery_a',
	    'label' => 'Video Gallery',
	    'display' => 'block',
	    'sub_fields' => video_gallery_fields('a')
    ],                                                            
    'layout_contact_form' => [
      'key' => 'layout_contact_form',
	    'name' => 'contact_form',
	    'label' => 'Contact Form',
	    'display' => 'block',
	    'sub_fields' => contact_form_fields()
    ],                              
    'layout_horizontal_accordion_a' => [
	    'key' => 'layout_horizontal_accordion_a',
	    'name' => 'horizontal_accordion_a',
	    'label' => 'Horizontal Accordion',
	    'display' => 'block',
	    'sub_fields' => horizontal_accordion_fields('a')
    ],
    'layout_horizontal_accordion_b' => [
	    'key' => 'layout_horizontal_accordion_b',
	    'name' => 'horizontal_accordion_b',
	    'label' => 'Horizontal Accordion - B (Legacy)',
	    'display' => 'block',
	    'sub_fields' => horizontal_accordion_fields('b')
          ],
          'layout_accordion_a' => [
	    'key' => 'layout_accordion_a',
	    'name' => 'accordion_a',
	    'label' => 'Accordion',
	    'display' => 'block',
	    'sub_fields' => accordion_fields('a')
          ],
          'layout_accordion_b' => [
	    'key' => 'layout_accordion_b',
	    'name' => 'accordion_b',
	    'label' => 'Accordion - B (Legacy)',
	    'display' => 'block',
	    'sub_fields' => accordion_fields('b')
          ],
          'layout_accordion_c' => [
	    'key' => 'layout_accordion_c',
	    'name' => 'accordion_c',
	    'label' => 'Accordion - C (Legacy)',
	    'display' => 'block',
	    'sub_fields' => accordion_fields('c')
          ],          
          'layout_video_carousel_a' => [
	    'key' => 'layout_video_carousel_a',
	    'name' => 'video_carousel_a',
	    'label' => 'Video Carousel',
	    'display' => 'block',
	    'sub_fields' => video_carousel_fields('a')
          ],
          'layout_video_carousel_b' => [
	    'key' => 'layout_video_carousel_b',
	    'name' => 'video_carousel_b',
	    'label' => 'Video Carousel - B (Legacy)',
	    'display' => 'block',
	    'sub_fields' => video_carousel_fields('b')
          ],
          'layout_timeline_a' => [
	    'key' => 'layout_timeline_a',
	    'name' => 'timeline_a',
	    'label' => 'Timeline',
	    'display' => 'block',
	    'sub_fields' => timeline_fields('a')
          ],
          'layout_timeline_b' => [
	    'key' => 'layout_timeline_b',
	    'name' => 'timeline_b',
	    'label' => 'Timeline - B (Legacy)',
	    'display' => 'block',
	    'sub_fields' => timeline_fields('b')
          ],
          'layout_timeline_c' => [
            'key' => 'layout_timeline_c',
	    'name' => 'timeline_c',
	    'label' => 'Timeline - C (Legacy)',
	    'display' => 'block',
	    'sub_fields' => timeline_fields('c')
          ],
          'layout_media_text_a' => [
            'key' => 'layout_media_text_a',
	    'name' => 'media_text_a',
	    'label' => 'Media Text',
	    'display' => 'block',
	    'sub_fields' => media_text_fields('a')
          ],
          'layout_media_text_b' => [
            'key' => 'layout_media_text_b',
	    'name' => 'media_text_b',
	    'label' => 'Media Text - B (Legacy)',
	    'display' => 'block',
	    'sub_fields' => media_text_fields('b')
          ],
          'layout_media_text_c' => [
            'key' => 'layout_media_text_c',
	    'name' => 'media_text_c',
	    'label' => 'Media Text - C (Legacy)',
	    'display' => 'block',
	    'sub_fields' => media_text_fields('c')
          ],
          'layout_media_text_2x_a' => [
            'key' => 'layout_media_text_2x_a',
	    'name' => 'media_text_2x_a',
	    'label' => 'Media Text 2x',
	    'display' => 'block',
	    'sub_fields' => media_text_2x_fields('a')
          ],
          'layout_media_text_2x_b' => [
            'key' => 'layout_media_text_2x_b',
	    'name' => 'media_text_2x_b',
	    'label' => 'Media Text 2x - B (Legacy)',
	    'display' => 'block',
	    'sub_fields' => media_text_2x_fields('b')
          ],
          'layout_media_text_2x_c' => [
            'key' => 'layout_media_text_2x_c',
	    'name' => 'media_text_2x_c',
	    'label' => 'Media Text 2x - C (Legacy)',
	    'display' => 'block',
	    'sub_fields' => media_text_2x_fields('c')
          ],          
          'layout_cards_a' => [
            'key' => 'layout_cards_a',
	    'name' => 'cards_a',
	    'label' => 'Cards',
	    'display' => 'block',
	    'sub_fields' => cards_fields('a')
          ],
          'layout_cards_b' => [
            'key' => 'layout_cards_b',
	    'name' => 'cards_b',
	    'label' => 'Cards - B (Legacy)',
	    'display' => 'block',
	    'sub_fields' => cards_fields('b')
    ],
    'layout_cards_c' => [
      'key' => 'layout_cards_c',
	    'name' => 'cards_c',
	    'label' => 'Cards - C (Legacy)',
	    'display' => 'block',
	    'sub_fields' => cards_fields('c')
     ],
		 'layout_card_carousel' => [
      'key' => 'layout_card_carousel',
	    'name' => 'card_carousel',
	    'label' => 'Card Carousel',
	    'display' => 'block',
	    'sub_fields' => card_carousel_fields()
     ],
		 'layout_card_tabs' => [
      'key' => 'layout_card_tabs',
	    'name' => 'card_tabs',
	    'label' => 'Card Tabs',
	    'display' => 'block',
	    'sub_fields' => card_tabs_fields()
     ],
	],
	'button_label' => 'Add Module',
	'min' => '',
	'max' => '',
	],
  ],
  'location' => [
  	[
      [
        'param' => 'post_type',
	      'operator' => '==',
    	  'value' => 'page',
      ]        
    ],
  ],
    'menu_order' => 3,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    'show_in_graphql' => 1,
    'graphql_field_name' => 'pageContent',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
  ]);
}

add_action('acf/init', __NAMESPACE__ . '\\init');

