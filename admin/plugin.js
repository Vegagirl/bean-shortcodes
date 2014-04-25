//CLOSURE TO AVOID NAMESPACE COLLISION
(function () {

    //ADD BEAN SHORTCODES PLUGIN
    tinymce.PluginManager.add("BeanShortcodes", function(editor, url) {

        //CREATE THE BUTTON
        var btn = editor.addButton('bean_shortcodes_button', {
            type: "splitbutton",
            title: "Bean Shortcodes", //BUTTON TITLE
            menu: [
                 createSubmenuButtonWithPopup( "Alerts", "alert" ),
                 createSubmenuButtonWithPopup( "Buttons", "button" ),
                 createSubmenuButtonWithPopup( "Columns", "columns" ),
                 createSubmenuButtonImmediate( "Highlight", "<br>[highlight]Place your highlighted text here.[/highlight]<br>" ),
                 createSubmenuButtonImmediate( "Pull Quote", "[quote]Place your quote text here.[/quote]" ),
                 createSubmenuButtonWithPopup( "Tabs", "tabs" ),
                 createSubmenuButtonWithPopup( "Toggles", "toggle" ),
                 createSubmenuButtonImmediate( "Tooltip", '[tooltip title="Tooltip" placement="" link=""]Tooltip text here[/tooltip]' ),
            ],
            onclick: function() {}
        });

        editor.addCommand("beanPopup", function ( a, params ) {
            var popup = params.identifier;
            //LOAD THICKBOX
            tb_show("Insert Bean Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 640);
        });

        function createSubmenuButtonWithPopup( title, id ) {
            return {
                text: title,
                onclick: function() {
                    executeTinyMCECommand( 'beanPopup', {
                        title: title,
                        identifier: id
                    } );
                }
            };
        }

        function createSubmenuButtonImmediate( title, sc ) {
            return {
                text: title,
                onclick: function() {
                    executeTinyMCECommand( 'mceInsertContent', sc );
                }
            }
        }

        function executeTinyMCECommand( command, args ) {
            if (typeof window.tinyMCE.activeEditor != 'undefined') {
                window.tinyMCE.activeEditor.selection.moveToBookmark(window.tinymce_cursor);
            }
            if (typeof window.tinyMCE.execInstanceCommand != 'undefined') {
                window.tinyMCE.execInstanceCommand('content', command, false, args);

            } else {
                if (typeof window.tinyMCE.execCommand != 'undefined') {
                    window.tinyMCE.get('content').execCommand(command, false, args);
                }
            }
        }
    });
	
})();