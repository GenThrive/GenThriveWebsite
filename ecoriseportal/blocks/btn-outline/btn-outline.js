
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
    
    const block = registerBlockType( 'tb-theme/btn-outline', {
        apiVersion: 2,
        title: 'Outline Button',
        icon: el('svg', { xmlns: 'http://www.w3.org/2000/svg', width: '16', height: '16', fill: 'currentColor', className: 'bi bi-hdmi', viewBox: '0 0 16 16' }, [el('path', { d: 'M2.5 7a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1h-11Z' }), el('path', { d: 'M1 5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h.293l.707.707a1 1 0 0 0 .707.293h10.586a1 1 0 0 0 .707-.293l.707-.707H15a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H1Zm0 1h14v3h-.293a1 1 0 0 0-.707.293l-.707.707H2.707L2 9.293A1 1 0 0 0 1.293 9H1V6Z' })]),
        category: 'custblocks',
        keywords: [ __('link'), __('button') ],
        supports: {color: {background: false,text: false,gradients: false,link: false,},typography: {fontSize: false,},anchor: false,align: false,},
        attributes: {
            btn_align: {
                type: 'text',
                default: 'justify-content-start',
            },
            url: {
                type: 'object',
                default: {post_id: 0, url: 'filler', title: '', 'post_type': null},
            },
            class: {
                type: 'text',
                default: 'btn-outline-primary',
            },
            link_open: {
                type: 'text',
                default: '_self',
            },
            btn_text: {
                type: 'text',
                default: `Enter Button Text`,
            }
        },
        example: { attributes: { btn_align: 'justify-content-start', url: {post_id: 0, url: 'filler', title: '', 'post_type': null}, class: 'btn-outline-primary', link_open: '_self', btn_text: `Enter Button Text` } },
        edit: function ( props ) {
            const blockProps = useBlockProps({ className: 'd-flex jr_guten_btn_wrap ' + propOrDefault( props.attributes.btn_align, 'btn_align' ) });
            const setAttributes = props.setAttributes; 
            
            
            const innerBlocksProps = null;
            
            
            return el(Fragment, {}, [
                el('div', { ...blockProps }, el('a', { className: 'btn hasArrow jr_guten_btn ' + propOrDefault( props.attributes.class, 'class' ), href: '#', target: propOrDefault( props.attributes.link_open, 'link_open' ), rel: 'noopener' }, el(RichText, { tagName: 'span', value: propOrDefault( props.attributes.btn_text, 'btn_text' ), onChange: function(val) { setAttributes( {btn_text: val }) }, withoutInteractiveFormatting: true, allowedFormats: [] }))),                        
                
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
                                    pgUrlControl('url', setAttributes, props, 'Enter Link URL', '', null ),
                                    el(SelectControl, {
                                        value: props.attributes.class,
                                        label: __( 'Select Color Style' ),
                                        onChange: function(val) { setAttributes({class: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'btn-outline-primary', label: 'Primary' },
                                            { value: 'btn-outline-secondary', label: 'Secondary' },
                                            { value: 'btn-outline-tertiary', label: 'Tertiary' },
                                            { value: 'btn-outline-white', label: 'White' },
                                            { value: 'btn-outline-black', label: 'Black' },
                                            { value: 'btn-outline-gray-light', label: 'Light Gray' },
                                            { value: 'btn-outline-gray-med', label: 'Med Gray' },
                                            { value: 'btn-outline-gray-dark', label: 'Dark Gray' }
                                        ]
                                    }),
                                    el(ToggleControl, {
                                        checked: props.attributes.link_open === '_blank',
                                        label: __( 'Open in New Window' ),
                                        onChange: function(val) { setAttributes({link_open: val ? '_blank' : null}) },
                                        help: __( '' ),
                                    }),
                                    el(TextControl, {
                                        value: props.attributes.btn_text,
                                        help: __( '' ),
                                        label: __( 'Button Text' ),
                                        onChange: function(val) { setAttributes({btn_text: val}) },
                                        type: 'text'
                                    }),    
                                ])
                            )
                        ]
                    )                            

            ]);
        },

        save: function(props) {
            const blockProps = useBlockProps.save({ className: 'd-flex jr_guten_btn_wrap ' + propOrDefault( props.attributes.btn_align, 'btn_align' ) });
            return el('div', { ...blockProps }, el('a', { className: 'btn hasArrow jr_guten_btn ' + propOrDefault( props.attributes.class, 'class' ), href: propOrDefault( props.attributes.url.url, 'url', 'url' ), target: propOrDefault( props.attributes.link_open, 'link_open' ), rel: 'noopener' }, el(RichText.Content, { tagName: 'span', value: propOrDefault( props.attributes.btn_text, 'btn_text' ) })));
        }                        

    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor
);                        
