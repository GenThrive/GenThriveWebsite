<?php

        PG_Blocks::register_block_type( array(
            'name' => 'tb-theme/imglink',
            'title' => __( 'Button With Icon', 'tb_theme' ),
            'category' => 'custblocks',
            'supports' => array('color' => array('background' => false,'text' => false,'gradients' => false,'link' => false,),'typography' => array('fontSize' => false,),'anchor' => false,'align' => false,),
            'base_url' => get_template_directory_uri(),
            'base_path' => get_template_directory(),
            'js_file' => 'blocks/imglink/imglink.js',
            'attributes' => array(
                'thelink' => array(
                    'type' => 'object',
                    'default' => array('post_id' => 0, 'url' => '#', 'post_type' => '', 'title' => '')
                ),
                'bordercolor' => array(
                    'type' => 'text',
                    'default' => 'border-transparent'
                ),
                'icon' => array(
                    'type' => 'object',
                    'default' => array('id' => 0, 'url' => esc_url( get_template_directory_uri() . '/a_images/Air%20Quality%20Icon.png' ), 'size' => '')
                ),
                'linktext' => array(
                    'type' => 'text',
                    'default' => 'Air Quality'
                )
            ),
            'example' => array(
'thelink' => array('post_id' => 0, 'url' => '#', 'post_type' => '', 'title' => ''), 'bordercolor' => 'border-transparent', 'icon' => array('id' => 0, 'url' => esc_url( get_template_directory_uri() . '/a_images/Air%20Quality%20Icon.png' ), 'size' => ''), 'linktext' => 'Air Quality'
            ),
            'dynamic' => false
        ) );
