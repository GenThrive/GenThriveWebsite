<div <?php if(empty($_GET['context']) || $_GET['context'] !== 'edit') echo get_block_wrapper_attributes( array('class' => "colorShadowImg", ) ); else echo 'data-wp-block-props="true"'; ?>>
    <?php if ( !PG_Blocks::getImageSVG( $args, 'shadowimgurl', false) && PG_Blocks::getImageUrl( $args, 'shadowimgurl', 'large' ) ) : ?>
        <img src="<?php echo PG_Blocks::getImageUrl( $args, 'shadowimgurl', 'large' ) ?>" class="<?php echo PG_Blocks::getAttribute( $args, 'shadcolor' ) ?>"/>
    <?php endif; ?>
    <?php if ( PG_Blocks::getImageSVG( $args, 'shadowimgurl', false) ) : ?>
        <?php echo PG_Blocks::mergeInlineSVGAttributes( PG_Blocks::getImageSVG( $args, 'shadowimgurl' ), array() ) ?>
    <?php endif; ?>
</div>