jQuery(document).ready(function($) {
    var beans = {
    
    	loadVals: function(){
    		var shortcode = $('#_bean_shortcode').text(),
    			uShortcode = shortcode;
    		
    		$('.bean-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('bean_', ''),
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		$('#_bean_ushortcode').remove();
    		$('#bean-sc-form-table').prepend('<div id="_bean_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
    	
    	cLoadVals: function(){
    		var shortcode = $('#_bean_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';

    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.bean-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('bean_', '')
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		$('#_bean_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_bean_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		this.loadVals();
    		pShortcode = $('#_bean_ushortcode').text().replace('{{child_shortcode}}', shortcodes);

    		$('#_bean_ushortcode').remove();
    		$('#bean-sc-form-table').prepend('<div id="_bean_ushortcode" class="hidden">' + pShortcode + '</div>');
    	},
    	
    	children: function() {
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			else
    			{
    				alert('You need a minimum of one row');
    			}
    			
    			return false;
    		});

    		$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'
				
			});
    	},
    	
    	 resizeTB: function()
	     {
	            var ajaxCont = $('#TB_ajaxContent'),
	                tbWindow = $('#TB_window'),
	                beanPopup = $('#bean-popup');
	
	            tbWindow.css({
	                maxHeight: beanPopup.outerHeight() + 36,
	                width: beanPopup.outerWidth(),
	                marginLeft: -(beanPopup.outerWidth()/2)
	            });
	
	           ajaxCont.css({
	           	padding: 0,
	           	height: (tbWindow.height() - 37),
	           	overflow: 'auto', // IMPORTANT
	           	width: beanPopup.outerWidth()
	           });
	
	            $('#bean-popup').addClass('no_preview');
	    },
    	
    	load: function(){
    		var	beans = this,
    			tbWindow = $('#TB_window'),
    			popup = $('#bean-popup'),
    			form = $('#bean-sc-form', popup),
    			shortcode = $('#_bean_shortcode', form).text(),
    			popupType = $('#_bean_popup', form).text(),
    			uShortcode = '';
    			closePopup = $('#close-popup');
    		
    		closePopup.on('click', function(){
    		    tb_remove();
    		});
    		
    		tbWindow.css({
    		    border: "none",
    		});

    		beans.resizeTB();
    		$(window).resize(function() { beans.resizeTB() });

    		beans.loadVals();
    		beans.children();
    		beans.cLoadVals();
    		
    		$('.bean-cinput', form).live('change', function() {
    			beans.cLoadVals();
    		});
    		
    		$('.bean-input', form).change(function() {
    			beans.loadVals();
    		});

            $('ul.bean-form-icon-select li').click(function() {
                $(this).parent().siblings("input.icon-select-input").val($(this).data('val'));
                $(this).parent().find("li.selected").removeClass("selected");
                $(this).addClass("selected");

                beans.loadVals();
            });

    		$('.bean-insert', form).click(function() {    		 			
    			if(window.tinyMCE)
				{
					console.log($('#_bean_ushortcode', form));

                    if (typeof window.tinyMCE.activeEditor != 'undefined') {
                        window.tinyMCE.activeEditor.selection.moveToBookmark(window.tinymce_cursor);
                    }
                    if (typeof window.tinyMCE.execInstanceCommand != 'undefined') {
                        window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#_bean_ushortcode', form).html());
                    } else {
                        if (typeof window.tinyMCE.execCommand != 'undefined') {
                            window.tinyMCE.get('content').execCommand('mceInsertContent', false, $('#_bean_ushortcode', form).html());
                        }
                    }

                    tb_remove();
				}
    		});
    	}
	}

    $('#bean-popup').livequery( function() { beans.load(); } );
});