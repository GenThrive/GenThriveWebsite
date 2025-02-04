<?php

        PG_Blocks::register_block_type( array(
            'name' => 'tb-theme/btn-outline',
            'title' => __( 'Outline Button', 'tb_theme' ),
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdmi" viewBox="0 0 16 16">   <path d="M2.5 7a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1h-11Z"/>   <path d="M1 5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h.293l.707.707a1 1 0 0 0 .707.293h10.586a1 1 0 0 0 .707-.293l.707-.707H15a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H1Zm0 1h14v3h-.293a1 1 0 0 0-.707.293l-.707.707H2.707L2 9.293A1 1 0 0 0 1.293 9H1V6Z"/> </svg>',
            'category' => 'custblocks',
            'keywords' => array( 'link', 'button' ),
            'supports' => array('color' => array('background' => false,'text' => false,'gradients' => false,'link' => false,),'typography' => array('fontSize' => false,),'anchor' => false,'align' => false,),
            'base_url' => get_template_directory_uri(),
            'base_path' => get_template_directory(),
            'js_file' => 'blocks/btn-outline/btn-outline.js',
            'attributes' => array(
                'btn_align' => array(
                    'type' => 'text',
                    'default' => 'justify-content-start'
                ),
                'url' => array(
                    'type' => 'object',
                    'default' => array('post_id' => 0, 'url' => 'filler', 'post_type' => '', 'title' => '')
                ),
                'class' => array(
                    'type' => 'text',
                    'default' => 'btn-outline-primary'
                ),
                'link_open' => array(
                    'type' => 'text',
                    'default' => '_self'
                ),
                'btn_text' => array(
                    'type' => 'text',
                    'default' => 'Enter Button Text'
                )
            ),
            'example' => array(
'btn_align' => 'justify-content-start', 'url' => array('post_id' => 0, 'url' => 'filler', 'post_type' => '', 'title' => ''), 'class' => 'btn-outline-primary', 'link_open' => '_self', 'btn_text' => 'Enter Button Text'
            ),
            'dynamic' => false
        ) );
