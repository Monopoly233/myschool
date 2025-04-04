(()=>{"use strict";const e=window.wp.blocks,t=window.wp.i18n,o=window.React,n=window.wp.blockEditor,l=window.wp.components;(0,e.registerBlockType)("fwd-blocks/animate-block",{apiVersion:2,title:(0,t.__)("Animate Block","school"),description:(0,t.__)("A block that adds scroll animations to its content.","school"),category:"design",icon:"animation",supports:{html:!1},attributes:{animationType:{type:"string",default:"fade-up"}},edit:function({attributes:e,setAttributes:a}){const{animationType:i}=e,s=(0,n.useBlockProps)({"data-aos":i}),c=[{label:(0,t.__)("Fade Up","school"),value:"fade-up"},{label:(0,t.__)("Fade Down","school"),value:"fade-down"},{label:(0,t.__)("Fade Left","school"),value:"fade-left"},{label:(0,t.__)("Fade Right","school"),value:"fade-right"},{label:(0,t.__)("Zoom In","school"),value:"zoom-in"},{label:(0,t.__)("Zoom Out","school"),value:"zoom-out"}];return(0,o.createElement)(o.Fragment,null,(0,o.createElement)(n.InspectorControls,null,(0,o.createElement)(l.PanelBody,{title:(0,t.__)("Animation Settings","school")},(0,o.createElement)(l.SelectControl,{label:(0,t.__)("Animation Type","school"),value:i,options:c,onChange:e=>a({animationType:e})}))),(0,o.createElement)("div",{...s},(0,o.createElement)(n.InnerBlocks,null)))},save:function({attributes:e}){const{animationType:t}=e,l=n.useBlockProps.save({"data-aos":t});return(0,o.createElement)("div",{...l},(0,o.createElement)(n.InnerBlocks.Content,null))}})})();