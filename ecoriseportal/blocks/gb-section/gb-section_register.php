<?php

        PG_Blocks::register_block_type( array(
            'name' => 'tb-theme/gb-section',
            'title' => __( 'Background Section', 'tb_theme' ),
            'description' => __( 'Give a section padding, margin, and a background color.', 'tb_theme' ),
            'icon' => 'welcome-widgets-menus',
            'category' => 'custblocks',
            'keywords' => array( 'padding', 'margin', 'background color' ),
            'supports' => array('color' => array('background' => true,'text' => false,'gradients' => false,'link' => false,),'typography' => array('fontSize' => false,),'anchor' => true,'align' => false,),
            'base_url' => get_template_directory_uri(),
            'base_path' => get_template_directory(),
            'js_file' => 'blocks/gb-section/gb-section.js',
            'attributes' => array(
                'margin_top' => array(
                    'type' => 'text',
                    'default' => 'mt-3'
                ),
                'margin_bottom' => array(
                    'type' => 'text',
                    'default' => 'mb-3'
                ),
                'padding_top' => array(
                    'type' => 'text',
                    'default' => 'pt-3'
                ),
                'padding_bottom' => array(
                    'type' => 'text',
                    'default' => 'pb-3'
                )
            ),
            'example' => array(
'margin_top' => 'mt-3', 'margin_bottom' => 'mb-3', 'padding_top' => 'pt-3', 'padding_bottom' => 'pb-3'
            ),
            'dynamic' => false,
            'has_inner_blocks' => true
        ) );
