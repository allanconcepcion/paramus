<?php

namespace PD\ACF\Customize\Modules;

require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/hero.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/text.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/horizontal-accordion.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/accordion.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/video-carousel.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/timeline.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/media-text.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/media-text-2x.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/cards.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/card-carousel.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/card-tabs.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/icon-blocks.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/gallery.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/video-gallery.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/modules/html.php';

use function PD\ACF\Customize\Modules\Hero\fields as hero_fields;
use function PD\ACF\Customize\Modules\Text\fields as text_fields;
use function PD\ACF\Customize\Modules\HorizontalAccordion\fields as horizontal_accordion_fields;
use function PD\ACF\Customize\Modules\Accordion\fields as accordion_fields;
use function PD\ACF\Customize\Modules\VideoCarousel\fields as video_carousel_fields;
use function PD\ACF\Customize\Modules\Timeline\fields as timeline_fields;
use function PD\ACF\Customize\Modules\MediaText\fields as media_text_fields;
use function PD\ACF\Customize\Modules\MediaText2x\fields as media_text_2x_fields;
use function PD\ACF\Customize\Modules\Cards\fields as cards_fields;
use function PD\ACF\Customize\Modules\CardCarousel\fields as card_carousel_fields;
use function PD\ACF\Customize\Modules\CardTabs\fields as card_tabs_fields;
use function PD\ACF\Customize\Modules\IconBlocks\fields as icon_blocks_fields;
use function PD\ACF\Customize\Modules\Gallery\fields as gallery_fields;
use function PD\ACF\Customize\Modules\VideoGallery\fields as video_gallery_fields;
use function PD\ACF\Customize\Modules\HTML\fields as html_fields;

function init () {
  acf_add_local_field_group([
    'key' => 'group_modules',
    'title' => 'Modules',
    'location' => [
      [
        [
	        'param' => 'options_page',
	        'operator' => '==',
	        'value' => 'customize',
        ],
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
    'graphql_field_name' => 'modules',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
    'fields' => [
      ...hero_fields(),
      ...text_fields(),
      ...icon_blocks_fields(),    
      ...video_gallery_fields('a', 'A'),
      ...gallery_fields('a', 'A'),
      ...gallery_fields('b', 'B'),
      ...gallery_fields('c', 'C'),
      ...horizontal_accordion_fields('a', 'A'),
      ...horizontal_accordion_fields('b', 'B'),
      ...accordion_fields('a', 'A'),
      ...accordion_fields('b', 'B'),
      ...accordion_fields('c', 'C'),
      ...video_carousel_fields('a', 'A'),
      ...video_carousel_fields('b', 'B'),
      ...timeline_fields('a', 'A'),
      ...timeline_fields('b', 'B'),
      ...timeline_fields('c', 'C'),
      ...media_text_fields('a', 'A'),
      ...media_text_fields('b', 'B'),
      ...media_text_fields('c', 'C'),
      ...media_text_2x_fields('a', 'A'),
      ...media_text_2x_fields('b', 'B'),
      ...media_text_2x_fields('c', 'C'),      
      ...cards_fields('a', 'A'),
      ...cards_fields('b', 'B'),
      ...cards_fields('c', 'C'),
      ...card_carousel_fields('a', 'A'), 
      ...card_carousel_fields('b', 'B'), 
      ...card_carousel_fields('c', 'C'),
      ...card_tabs_fields('a', 'A'), 
      ...card_tabs_fields('b', 'B'), 
      ...card_tabs_fields('c', 'C'),
      ...html_fields('a', 'A'),
      ...html_fields('b', 'B'),
      ...html_fields('c', 'C'),
    ]
  ]);   
}

add_action('acf/init', __NAMESPACE__ . '\\init');

