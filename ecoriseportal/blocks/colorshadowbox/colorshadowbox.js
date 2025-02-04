
( function ( blocks, element, blockEditor ) {
    const el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        ServerSideRender = PgServerSideRender,
        InspectorControls = blockEditor.InspectorControls,
        useBlockProps = blockEditor.useBlockProps;
        
    const {__} = wp.i18n;
    const {ColorPicker, TextControl, ToggleControl, SelectControl, Panel, PanelBody, Disabled, TextareaControl, BaseControl} = wp.components;
    const {useSelect} = wp.data;
    const {RawHTML, Fragment} = element;
   
    const {InnerBlocks, URLInputButton, RichText} = wp.blockEditor;
    const useInnerBlocksProps = blockEditor.useInnerBlocksProps || blockEditor.__experimentalUseInnerBlocksProps;
    
    const propOrDefault = function(val, prop, field) {
        if(block.attributes[prop] && (val === null || val === '')) {
            return field ? block.attributes[prop].default[field] : block.attributes[prop].default;
        }
        return val;
    }
    
    const block = registerBlockType( 'tb-theme/colorshadowbox', {
        apiVersion: 2,
        title: 'Color Shadow Image',
        icon: '<i class="ri-image-add-line"></i>',
        category: 'custblocks',
        keywords: [],
        supports: {color: {background: false,text: false,gradients: false,link: false,},typography: {fontSize: false,},anchor: false,align: false,},
        attributes: {
            shadowimgurl: {
                type: 'object',
                default: {id: 0, url: 'https://images.unsplash.com/photo-1637055839411-31736bf3ff87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwyMDkyMnwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NzUyODg5OQ&ixlib=rb-1.2.1&q=80&w=1080', size: ''},
            },
            shadcolor: {
                type: 'text',
                default: 'shadColor-primary',
            }
        },
        example: { attributes: { shadowimgurl: {id: 0, url: 'https://images.unsplash.com/photo-1637055839411-31736bf3ff87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwyMDkyMnwwfDF8cmFuZG9tfHx8fHx8fHx8MTY0NzUyODg5OQ&ixlib=rb-1.2.1&q=80&w=1080', size: ''}, shadcolor: 'shadColor-primary' } },
        edit: function ( props ) {
            const blockProps = useBlockProps({ className: 'colorShadowImg' });
            const setAttributes = props.setAttributes; 
            
            props.shadowimgurl = useSelect(function( select ) {
                return {
                    shadowimgurl: props.attributes.shadowimgurl.id ? select('core').getMedia(props.attributes.shadowimgurl.id) : undefined
                };
            }, [props.attributes.shadowimgurl] ).shadowimgurl;
            
            const innerBlocksProps = null;
            
            
            return el(Fragment, {}, [
                
                        el( ServerSideRender, {
                            block: 'tb-theme/colorshadowbox',
                            httpMethod: 'POST',
                            attributes: props.attributes,
                            innerBlocksProps: innerBlocksProps,
                            blockProps: blockProps
                        } ),                        
                
                    el( InspectorControls, {},
                        [
                            
                        pgMediaImageControl('shadowimgurl', setAttributes, props, 'large', true ),
                                        
                            el(Panel, {},
                                el(PanelBody, {
                                    title: __('Block properties')
                                }, [
                                    
                                    el(TextControl, {
                                        value: props.attributes.shadcolor,
                                        help: __( '' ),
                                        label: __( 'Shadow Color' ),
                                        onChange: function(val) { setAttributes({shadcolor: val}) },
                                        type: 'text'
                                    }),    
                                ])
                            )
                        ]
                    )                            

            ]);
        },

        save: function(props) {
            return null;
        }                        

    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor
);                        
