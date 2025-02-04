<?php

        PG_Blocks::register_block_type( array(
            'name' => 'tb-theme/plaincards',
            'title' => __( 'Plain Card with Icon on Side', 'tb_theme' ),
            'description' => __( 'A card used in columns with icon to the right, left, or top.', 'tb_theme' ),
            'category' => 'custblocks',
            'keywords' => array( 'card', 'icon' ),
            'render_template' => 'blocks/plaincards/plaincards.php',
            'supports' => array('color' => array('background' => false,'text' => false,'gradients' => false,'link' => false,),'typography' => array('fontSize' => false,),'anchor' => false,'align' => false,),
            'base_url' => get_template_directory_uri(),
            'base_path' => get_template_directory(),
            'js_file' => 'blocks/plaincards/plaincards.js',
            'attributes' => array(
                'cardbck' => array(
                    'type' => 'text',
                    'default' => 'bg-white'
                ),
                'borderradius' => array(
                    'type' => 'text',
                    'default' => 'border-radius-none'
                ),
                'bordercolor' => array(
                    'type' => 'text',
                    'default' => 'border-transparent'
                ),
                'padding' => array(
                    'type' => 'text',
                    'default' => 'p-1'
                ),
                'shadow' => array(
                    'type' => 'text',
                    'default' => 'shadow-none'
                ),
                'alignrow' => array(
                    'type' => 'text',
                    'default' => 'flex-md-row'
                ),
                'hideicon' => array(
                    'type' => 'text',
                    'default' => ''
                ),
                'fulltop' => array(
                    'type' => 'text',
                    'default' => ''
                ),
                'svgicon' => array(
                    'type' => 'object',
                    'default' => array('id' => 0, 'url' => 'https://via.placeholder.com/56x25.png', 'size' => '')
                )
            ),
            'example' => array(
'cardbck' => 'bg-white', 'borderradius' => 'border-radius-none', 'bordercolor' => 'border-transparent', 'padding' => 'p-1', 'shadow' => 'shadow-none', 'alignrow' => 'flex-md-row', 'hideicon' => '', 'fulltop' => '', 'svgicon' => array('id' => 0, 'url' => 'https://via.placeholder.com/56x25.png', 'size' => '')
            ),
            'dynamic' => true,
            'has_inner_blocks' => true
        ) );
