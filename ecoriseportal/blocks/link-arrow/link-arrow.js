
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
    
    const block = registerBlockType( 'tb-theme/link-arrow', {
        apiVersion: 2,
        title: 'Button Link with Arrow',
        icon: 'button',
        category: 'custblocks',
        keywords: [ __('link'), __('button') ],
        supports: {color: {background: false,text: false,gradients: false,link: false,},typography: {fontSize: false,},anchor: false,align: false,},
        attributes: {
            btn_align: {
                type: 'text',
                default: 'justify-content-start',
            },
            link_arrow_class: {
                type: 'text',
                default: 'primary',
            },
            link_arrow_url: {
                type: 'object',
                default: {post_id: 0, url: 'filler', title: '', 'post_type': null},
            },
            link_arrow_text: {
                type: 'text',
                default: `Enter Button Text`,
            },
            link_open: {
                type: 'text',
                default: '_self',
            }
        },
        example: { attributes: { btn_align: 'justify-content-start', link_arrow_class: 'primary', link_arrow_url: {post_id: 0, url: 'filler', title: '', 'post_type': null}, link_arrow_text: `Enter Button Text`, link_open: '_self' } },
        edit: function ( props ) {
            const blockProps = useBlockProps({ className: 'd-flex jr_guten_btn_wrap ' + propOrDefault( props.attributes.btn_align, 'btn_align' ) });
            const setAttributes = props.setAttributes; 
            
            
            const innerBlocksProps = null;
            
            
            return el(Fragment, {}, [
                el('div', { ...blockProps }, [el('div', { className: 'linkArrow ' + propOrDefault( props.attributes.link_arrow_class, 'link_arrow_class' ) }, [el(RichText, { tagName: 'a', href: '#', target: propOrDefault( props.attributes.link_open, 'link_open' ), rel: 'noopener', value: propOrDefault( props.attributes.link_arrow_text, 'link_arrow_text' ), onChange: function(val) { setAttributes( {link_arrow_text: val }) }, withoutInteractiveFormatting: true, allowedFormats: [] }), el('svg', { xmlns: 'http://www.w3.org/2000/svg', width: '7.078', height: '12.379', viewBox: '0 0 7.078 12.379' }, el('path', { className: 'a', d: 'M16.191,12.384,11.506,7.7a.881.881,0,0,1,0-1.249.892.892,0,0,1,1.253,0l5.307,5.3a.883.883,0,0,1,.026,1.22l-5.329,5.341a.885.885,0,0,1-1.253-1.249Z', transform: 'translate(-11.246 -6.196)' }))]), el('div', { className: 'p-1' })]),                        
                
                    el( InspectorControls, {},
                        [
                            
                            el(Panel, {},
                                el(PanelBody, {
                                    title: __('Block properties')
                                }, [
                                    
                                    el(SelectControl, {
                                        value: props.attributes.btn_align,
                                        label: __( 'Align Button' ),
                                        onChange: function(val) { setAttributes({btn_align: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'justify-content-start', label: 'Left' },
                                            { value: 'justify-content-center', label: 'Center' },
                                            { value: 'justify-content-end', label: 'Right' }
                                        ]
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.link_arrow_class,
                                        label: __( 'Select Color Style' ),
                                        onChange: function(val) { setAttributes({link_arrow_class: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'primary', label: 'Primary' },
                                            { value: 'secondary', label: 'Secondary' },
                                            { value: 'tertiary', label: 'Tertiary' },
                                            { value: 'white', label: 'White' },
                                            { value: 'black', label: 'Black' },
                                            { value: 'gray-light', label: 'Light Gray' },
                                            { value: 'gray-med', label: 'Med Gray' },
                                            { value: 'gray-dark', label: 'Dark Gray' },
                                            { value: 'blue-light', label: 'Light Blue' }
                                        ]
                                    }),
                                    pgUrlControl('link_arrow_url', setAttributes, props, 'Enter Link URL', '', null ),
                                    el(TextControl, {
                                        value: props.attributes.link_arrow_text,
                                        help: __( '' ),
                                        label: __( 'Button Text' ),
                                        onChange: function(val) { setAttributes({link_arrow_text: val}) },
                                        type: 'text'
                                    }),
                                    el(ToggleControl, {
                                        checked: props.attributes.link_open === '_blank',
                                        label: __( 'Open in New Window' ),
                                        onChange: function(val) { setAttributes({link_open: val ? '_blank' : null}) },
                                        help: __( '' ),
                                    }),    
                                ])
                            )
                        ]
                    )                            

            ]);
        },

        save: function(props) {
            const blockProps = useBlockProps.save({ className: 'd-flex jr_guten_btn_wrap ' + propOrDefault( props.attributes.btn_align, 'btn_align' ) });
            return el('div', { ...blockProps }, [el('div', { className: 'linkArrow ' + propOrDefault( props.attributes.link_arrow_class, 'link_arrow_class' ) }, [el(RichText.Content, { tagName: 'a', href: propOrDefault( props.attributes.link_arrow_url.url, 'link_arrow_url', 'url' ), target: propOrDefault( props.attributes.link_open, 'link_open' ), rel: 'noopener', value: propOrDefault( props.attributes.link_arrow_text, 'link_arrow_text' ) }), el('svg', { xmlns: 'http://www.w3.org/2000/svg', width: '7.078', height: '12.379', viewBox: '0 0 7.078 12.379' }, el('path', { className: 'a', d: 'M16.191,12.384,11.506,7.7a.881.881,0,0,1,0-1.249.892.892,0,0,1,1.253,0l5.307,5.3a.883.883,0,0,1,.026,1.22l-5.329,5.341a.885.885,0,0,1-1.253-1.249Z', transform: 'translate(-11.246 -6.196)' }))]), el('div', { className: 'p-1' })]);
        }                        

    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor
);                        
