
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
    
    const block = registerBlockType( 'tb-theme/plaincards', {
        apiVersion: 2,
        title: 'Plain Card with Icon on Side',
        icon: 'block-default',
        category: 'custblocks',
        keywords: [ __('card'), __('icon') ],
        supports: {color: {background: false,text: false,gradients: false,link: false,},typography: {fontSize: false,},anchor: false,align: false,},
        attributes: {
            cardbck: {
                type: 'text',
                default: 'bg-white',
            },
            borderradius: {
                type: 'text',
                default: 'border-radius-none',
            },
            bordercolor: {
                type: 'text',
                default: 'border-transparent',
            },
            padding: {
                type: 'text',
                default: 'p-1',
            },
            shadow: {
                type: 'text',
                default: 'shadow-none',
            },
            alignrow: {
                type: 'text',
                default: 'flex-md-row',
            },
            hideicon: {
                type: 'text',
                default: '',
            },
            fulltop: {
                type: 'text',
                default: '',
            },
            svgicon: {
                type: 'object',
                default: {id: 0, url: 'https://via.placeholder.com/56x25.png', size: ''},
            }
        },
        example: { attributes: { cardbck: 'bg-white', borderradius: 'border-radius-none', bordercolor: 'border-transparent', padding: 'p-1', shadow: 'shadow-none', alignrow: 'flex-md-row', hideicon: '', fulltop: '', svgicon: {id: 0, url: 'https://via.placeholder.com/56x25.png', size: ''} } },
        edit: function ( props ) {
            const blockProps = useBlockProps({ className: 'markSol plain' });
            const setAttributes = props.setAttributes; 
            
            props.svgicon = useSelect(function( select ) {
                return {
                    svgicon: props.attributes.svgicon.id ? select('core').getMedia(props.attributes.svgicon.id) : undefined
                };
            }, [props.attributes.svgicon] ).svgicon;
            
            const innerBlocksProps = useInnerBlocksProps({ className: 'content text-center text-lg-left' }, {
            } );
                            
            
            return el(Fragment, {}, [
                
                        el( ServerSideRender, {
                            block: 'tb-theme/plaincards',
                            httpMethod: 'POST',
                            attributes: props.attributes,
                            innerBlocksProps: innerBlocksProps,
                            blockProps: blockProps
                        } ),                        
                
                    el( InspectorControls, {},
                        [
                            
                        pgMediaImageControl('svgicon', setAttributes, props, 'full', true, 'SVG Icon', '' ),
                                        
                            el(Panel, {},
                                el(PanelBody, {
                                    title: __('Block properties')
                                }, [
                                    
                                    el(SelectControl, {
                                        value: props.attributes.cardbck,
                                        label: __( 'Background Color' ),
                                        onChange: function(val) { setAttributes({cardbck: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'bg-primary', label: 'Primary' },
                                            { value: 'bg-secondary', label: 'Secondary' },
                                            { value: 'bg-tertiary', label: 'Tertiary' },
                                            { value: 'bg-green-light', label: 'Light Green' },
                                            { value: 'bg-white', label: 'White' },
                                            { value: 'bg-black', label: 'Black' },
                                            { value: 'bg-gray-light', label: 'Light Gray' },
                                            { value: 'bg-gray-med', label: 'Med Gray' },
                                            { value: 'bg-gray-dark', label: 'Dark Gray' }
                                        ]
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.borderradius,
                                        label: __( 'Border Radius' ),
                                        onChange: function(val) { setAttributes({borderradius: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'border-radius-none', label: 'None' },
                                            { value: 'border-radius-sm', label: 'Small' },
                                            { value: 'border-radius', label: 'Med' },
                                            { value: 'border-radius-lg', label: 'Large' }
                                        ]
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.bordercolor,
                                        label: __( 'Border Color' ),
                                        onChange: function(val) { setAttributes({bordercolor: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'border-transparent', label: 'Transparent' },
                                            { value: 'border-primary', label: 'Primary' },
                                            { value: 'border-secondary', label: 'Secondary' },
                                            { value: 'border-tertiary', label: 'Tertiary' },
                                            { value: 'border-green-light', label: 'Light Green' },
                                            { value: 'border-white', label: 'White' },
                                            { value: 'border-black', label: 'Black' },
                                            { value: 'border-gray-light', label: 'Light Gray' },
                                            { value: 'border-gray-med', label: 'Med Gray' },
                                            { value: 'border-gray-dark', label: 'Dark Gray' }
                                        ]
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.padding,
                                        label: __( 'Padding' ),
                                        onChange: function(val) { setAttributes({padding: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'p-1', label: 'Small' },
                                            { value: 'p-2', label: 'Med' },
                                            { value: 'p-3', label: 'Large' }
                                        ]
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.shadow,
                                        label: __( 'Box Shadow' ),
                                        onChange: function(val) { setAttributes({shadow: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'shadow-none', label: 'None' },
                                            { value: 'shadow-sm', label: 'Small' },
                                            { value: 'shadow', label: 'Med' },
                                            { value: 'shadow-lg', label: 'Large' }
                                        ]
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.alignrow,
                                        label: __( 'Align Icon' ),
                                        onChange: function(val) { setAttributes({alignrow: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'flex-md-row', label: 'Left' },
                                            { value: 'flex-row-reverse', label: 'Right' },
                                            { value: 'flex-column-reverse', label: 'Top' }
                                        ]
                                    }),
                                    el(ToggleControl, {
                                        checked: props.attributes.hideicon === 'd-none',
                                        label: __( 'Hide Icon?' ),
                                        onChange: function(val) { setAttributes({hideicon: val ? 'd-none' : null}) },
                                        help: __( '' ),
                                    }),
                                    el(ToggleControl, {
                                        checked: props.attributes.fulltop === 'fullTop',
                                        label: __( 'Full Width Icon at Top?' ),
                                        onChange: function(val) { setAttributes({fulltop: val ? 'fullTop' : null}) },
                                        help: __( '' ),
                                    }),    
                                ])
                            )
                        ]
                    )                            

            ]);
        },

            save: function(props) {
                return el(InnerBlocks.Content);
            }                        
    
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor
);                        
