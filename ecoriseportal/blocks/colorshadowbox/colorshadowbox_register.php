<?php

        PG_Blocks::register_block_type( array(
            'name' => 'tb-theme/colorshadowbox',
            'title' => __( 'Color Shadow Image', 'tb_theme' ),
            'description' => __( 'Add an image with a color shadow behind', 'tb_theme' ),
            'icon' => '<i class="ri-image-add-line"></i>',
            'category' => 'custblocks',
            'render_template' => 'blocks/colorshadowbox/colorshadowbox.php',
            'supports' => array('color' => array('background' => false,'text' => false,'gradients' => false,'link' => false,),'typography' => array('fontSize' => false,),'anchor' => false,'align' => false,),
            'base_url' => get_template_directory_uri(),
            'base_path' => get_template_directory(),
            'js_file' => 'blocks/colorshadowbox/colorshadowbox.js',
            'attributes' => array(
                'shadowimgurl' => array(
                    'type' => 'object',
                    'default' => array('id' => 0, 'url' => 'https://images.unsplash.com/photo-1637055839411-31736bf3ff87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwyMDkyMnwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NzUyODg5OQ&ixlib=rb-1.2.1&q=80&w=1080', 'size' => '')
                ),
                'shadcolor' => array(
                    'type' => 'text',
                    'default' => 'shadColor-primary'
                )
            ),
            'example' => array(
'shadowimgurl' => array('id' => 0, 'url' => 'https://images.unsplash.com/photo-1637055839411-31736bf3ff87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwyMDkyMnwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NzUyODg5OQ&ixlib=rb-1.2.1&q=80&w=1080', 'size' => ''), 'shadcolor' => 'shadColor-primary'
            ),
            'dynamic' => true
        ) );
