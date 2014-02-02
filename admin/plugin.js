//CLOSURE TO AVOID NAMESPACE COLLISION
(function () {
	//CREATE THE PLUGIN
	tinymce.create("tinymce.plugins.BeanShortcodes", {
	
		init: function ( ed, url ) {
			ed.addCommand("beanPopup", function ( a, params ) {
				var popup = params.identifier;
				//LOAD THICKBOX
				tb_show("Insert Bean Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 640);
			});
		},

		createControl: function ( btn, e ) {
			if ( btn == "bean_button" ) {	
				
				var a = this;
				
				//CREATE THE BUTTON
				var btn = e.createSplitButton('bean_button', {
                    title: "Insert Bean Shortcode", //BUTTON TITLE
					icons: false
                });
				
				//RENDER DROPDOWN MENU
                btn.onRenderMenu.add(function (c, b) {	
                				
					a.addWithPopup( b, "Alerts", "alert" );
					a.addWithPopup( b, "Buttons", "button" );			
					a.addWithPopup( b, "Columns", "columns");
					a.addImmediate( b, "Highlight", "<br>[highlight]Place your highlighted text here.[/highlight]<br>" );
					a.addImmediate( b, "Pull Quote", "[quote]Place your quote text here.[/quote]" );
					a.addWithPopup( b, "Tabs","tabs");
					a.addWithPopup( b, "Toggles","toggle");	   
					a.addImmediate( b, "Tooltip", '[tooltip title="Tooltip" placement="" link=""]Tooltip text here[/tooltip]' );
				});
                
                return btn;
			}
			
			return null;
		},
		
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("beanPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},

		//INSERT SHORTCODE INTO CONTENT
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		
		//CREDS
		getInfo: function () {
			return {
				longname : "ThemeBeans Shortcodes",
				author : 'ThemeBeans',
				authorurl : 'http://themebeans.com/',
				infourl : 'http://themebeans.com/plugin/bean-shortcodes-plugin',
				version : "1.0"
			};
		}
	});
	
	//ADD BEAN SHORTCODES PLUGIN
	tinymce.PluginManager.add("BeanShortcodes", tinymce.plugins.BeanShortcodes);
})();