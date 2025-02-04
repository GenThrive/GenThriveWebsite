<div <?php if(empty($_GET['context']) || $_GET['context'] !== 'edit') echo get_block_wrapper_attributes( array('class' => "markSol plain", ) ); else echo 'data-wp-block-props="true"'; ?>> 
    <div class="wrapper <?php echo PG_Blocks::getAttribute( $args, 'cardbck' ) ?> <?php echo PG_Blocks::getAttribute( $args, 'borderradius' ) ?> <?php echo PG_Blocks::getAttribute( $args, 'bordercolor' ) ?> <?php echo PG_Blocks::getAttribute( $args, 'padding' ) ?> <?php echo PG_Blocks::getAttribute( $args, 'shadow' ) ?>"> 
        <div class="flex-column-reverse innerWrapper <?php echo PG_Blocks::getAttribute( $args, 'alignrow' ) ?>"> 
                <div class="content text-center text-lg-left" <?php if(!empty($_GET['context']) && $_GET['context'] === 'edit') echo 'data-wp-inner-blocks'; ?>>
                <?php if(empty($_GET['context']) || $_GET['context'] !== 'edit') echo PG_Blocks::getInnerContent( $args ); ?>
            </div>             
            <div class="icon <?php echo PG_Blocks::getAttribute( $args, 'hideicon' ) ?> <?php echo PG_Blocks::getAttribute( $args, 'fulltop' ) ?>"> 
                <?php if ( !PG_Blocks::getImageSVG( $args, 'svgicon', false) && PG_Blocks::getImageUrl( $args, 'svgicon', 'full' ) ) : ?>
                    <img src="<?php echo PG_Blocks::getImageUrl( $args, 'svgicon', 'full' ) ?>"/>
                <?php endif; ?>
                <?php if ( PG_Blocks::getImageSVG( $args, 'svgicon', false) ) : ?>
                    <?php echo PG_Blocks::mergeInlineSVGAttributes( PG_Blocks::getImageSVG( $args, 'svgicon' ), array() ) ?>
                <?php endif; ?> 
            </div>             
        </div>         
    </div>     
</div>