<?php
function ocdi_import_files() {
    return [
      [
        'import_file_name'           => 'Demo Import 1',
        'categories'                 => [ 'Category 1', 'Category 2' ],
        'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content.xml',
        /*'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets.json',
        'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer.dat',
        'import_redux'               => [
          [
            'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
            'option_name' => 'redux_option_name',
          ],
        ],*/
        'import_preview_image_url'   => get_template_directory_uri() . '/ocdi/screenshot_1.png',
        //'preview_url'                => 'http://www.your_domain.com/my-demo-1',
      ],
      [
        'import_file_name'           => 'Demo Basic',
        'categories'                 => [ 'New category', 'Old category' ],
        'import_file_url'            => 'http://www.your_domain.com/ocdi/basic.xml',
        /*'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets2.json',
        'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer2.dat',
        'import_redux'               => [
          [
            'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
            'option_name' => 'redux_option_name',
          ],
          [
            'file_url'    => 'http://www.your_domain.com/ocdi/redux2.json',
            'option_name' => 'redux_option_name_2',
          ],
        ],*/
        'import_preview_image_url'   => get_template_directory_uri() . '/ocdi/screenshot_2.jpg',
        //'preview_url'                => 'http://www.your_domain.com/my-demo-2',
      ],
    ];
  }
  add_filter( 'ocdi/import_files', 'ocdi_import_files' );