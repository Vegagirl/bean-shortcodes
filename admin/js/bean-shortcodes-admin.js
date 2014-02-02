
//JQUERY APPENDO
jQuery.fn.appendo = function(opt)
{
	this.each(function() { jQuery.appendo.init(this,opt); });
	return this;
};

jQuery.appendo = function() {

	var myself = this;
	
	this.opt = { };

	this.init = function(obj,opt) {

		var options = jQuery.extend({
				labelAdd:		'Add Row',
				labelDel:		'Remove',
				allowDelete:	true,
				copyHandlers:	false,
				focusFirst:		true,
				onAdd:			function() { return true; },
				onDel:		function() { return true; },
				maxRows:		0,
				wrapClass:		'appendoButtons',
				wrapStyle:		{ padding: '.4em .2em .5em' },
				buttonStyle:	{ marginRight: '.5em' },
				subSelect:		'tr:last'
			},
			myself.opt,
			opt
		);

		var $cpy = jQuery(obj).find(options.subSelect).clone(options.copyHandlers);
		
		var rows = 1;

		var $add_btn = jQuery('#form-child-add').click(clicked_add),
			$del_btn = new_button(options.labelDel).click(clicked_del).hide()
		;

		function add_row()
		{
			var $dup = $cpy.clone(options.copyHandlers);
			$dup.appendTo(obj);
			update_buttons(1);
			if (typeof(options.onAdd) == "function") options.onAdd($dup);
			if (!!options.focusFirst) $dup.find('input:first').focus();
		};

		function del_row()
		{
			var $row = jQuery(obj).find(options.subSelect);
			if ((typeof(options.onDel) != "function") || options.onDel($row))
			{
				$row.remove();
				update_buttons(-1);
			}
		};

		function update_buttons(rowdelta)
		{
			rows = rows + (rowdelta || 0);
			(options.allowDelete && (rows > 1))? $del_btn.show(): $del_btn.hide();
		};

		function new_button(label)
		{
			return jQuery('<button />')
				.css(options.buttonStyle)
				.html(label);
		};

		function nothing(e)
		{
			e.stopPropagation();
			e.preventDefault();
			return false;
		};

		function clicked_add(e)
		{
			if (!options.maxRows || (rows < options.maxRows)) add_row();
			return nothing(e);
		};

		function clicked_del(e)
		{
			if (rows > 1) del_row(); 
			return nothing(e);
		};
		
		update_buttons();
	};
	return this;
}();




//BASE 64
function base64_decode (data) {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
        ac = 0,
        dec = "",
        tmp_arr = [];

    if (!data) {
        return data;
    }

    data += '';

    do {
        h1 = b64.indexOf(data.charAt(i++));
        h2 = b64.indexOf(data.charAt(i++));
        h3 = b64.indexOf(data.charAt(i++));
        h4 = b64.indexOf(data.charAt(i++));

        bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

        o1 = bits >> 16 & 0xff;
        o2 = bits >> 8 & 0xff;
        o3 = bits & 0xff;

        if (h3 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1);
        } else if (h4 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1, o2);
        } else {
            tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
        }
    } while (i < data.length);

    dec = tmp_arr.join('');
    dec = this.utf8_decode(dec);

    return dec;
}

function base64_encode (data) {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
        ac = 0,
        enc = "",
        tmp_arr = [];

    if (!data) {
        return data;
    }

    data = this.utf8_encode(data + '');

    do {
        o1 = data.charCodeAt(i++);
        o2 = data.charCodeAt(i++);
        o3 = data.charCodeAt(i++);

        bits = o1 << 16 | o2 << 8 | o3;

        h1 = bits >> 18 & 0x3f;
        h2 = bits >> 12 & 0x3f;
        h3 = bits >> 6 & 0x3f;
        h4 = bits & 0x3f;

        tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
    } while (i < data.length);

    enc = tmp_arr.join('');

    switch (data.length % 3) {
    case 1:
        enc = enc.slice(0, -2) + '==';
        break;
    case 2:
        enc = enc.slice(0, -1) + '=';
        break;
    }

    return enc;
}

function utf8_decode (str_data) {
    var tmp_arr = [],
        i = 0,
        ac = 0,
        c1 = 0,
        c2 = 0,
        c3 = 0;

    str_data += '';

    while (i < str_data.length) {
        c1 = str_data.charCodeAt(i);
        if (c1 < 128) {
            tmp_arr[ac++] = String.fromCharCode(c1);
            i++;
        } else if (c1 > 191 && c1 < 224) {
            c2 = str_data.charCodeAt(i + 1);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
            i += 2;
        } else {
            c2 = str_data.charCodeAt(i + 1);
            c3 = str_data.charCodeAt(i + 2);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3;
        }
    }

    return tmp_arr.join('');
}

function utf8_encode (argString) {
    var string = (argString + '');
    var utftext = "",
        start, end, stringl = 0;

    start = end = 0;
    stringl = string.length;
    for (var n = 0; n < stringl; n++) {
        var c1 = string.charCodeAt(n);
        var enc = null;

        if (c1 < 128) {
            end++;
        } else if (c1 > 127 && c1 < 2048) {
            enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
        } else {
            enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
        }
        if (enc !== null) {
            if (end > start) {
                utftext += string.slice(start, end);
            }
            utftext += enc;
            start = end = n + 1;
        }
    }

    if (end > start) {
        utftext += string.slice(start, stringl);
    }

    return utftext;
}




//JQUERY LIVEQUERY 
(function($) {

$.extend($.fn, {
	livequery: function(type, fn, fn2) {
		var self = this, q;

		if ($.isFunction(type))
			fn2 = fn, fn = type, type = undefined;
			
		$.each( $.livequery.queries, function(i, query) {
			if ( self.selector == query.selector && self.context == query.context &&
				type == query.type && (!fn || fn.$lqguid == query.fn.$lqguid) && (!fn2 || fn2.$lqguid == query.fn2.$lqguid) )
					return (q = query) && false;
		});

		q = q || new $.livequery(this.selector, this.context, type, fn, fn2);

		q.stopped = false;

		q.run();

		return this;
	},

	expire: function(type, fn, fn2) {
		var self = this;

		if ($.isFunction(type))
			fn2 = fn, fn = type, type = undefined;

		$.each( $.livequery.queries, function(i, query) {
			if ( self.selector == query.selector && self.context == query.context &&
				(!type || type == query.type) && (!fn || fn.$lqguid == query.fn.$lqguid) && (!fn2 || fn2.$lqguid == query.fn2.$lqguid) && !this.stopped )
					$.livequery.stop(query.id);
		});

		return this;
	}
});

$.livequery = function(selector, context, type, fn, fn2) {
	this.selector = selector;
	this.context  = context;
	this.type     = type;
	this.fn       = fn;
	this.fn2      = fn2;
	this.elements = [];
	this.stopped  = false;

	this.id = $.livequery.queries.push(this)-1;

	fn.$lqguid = fn.$lqguid || $.livequery.guid++;
	if (fn2) fn2.$lqguid = fn2.$lqguid || $.livequery.guid++;

	return this;
};

$.livequery.prototype = {
	stop: function() {
		var query = this;

		if ( this.type )
			this.elements.unbind(this.type, this.fn);
		else if (this.fn2)
			this.elements.each(function(i, el) {
				query.fn2.apply(el);
			});

		this.elements = [];

		this.stopped = true;
	},

	run: function() {
		if ( this.stopped ) return;
		var query = this;

		var oEls = this.elements,
			els  = $(this.selector, this.context),
			nEls = els.not(oEls);

		this.elements = els;

		if (this.type) {
			nEls.bind(this.type, this.fn);

			if (oEls.length > 0)
				$.each(oEls, function(i, el) {
					if ( $.inArray(el, els) < 0 )
						$.event.remove(el, query.type, query.fn);
				});
		}
		else {

			nEls.each(function() {
				query.fn.apply(this);
			});

			if ( this.fn2 && oEls.length > 0 )
				$.each(oEls, function(i, el) {
					if ( $.inArray(el, els) < 0 )
						query.fn2.apply(el);
				});
		}
	}
};

$.extend($.livequery, {
	guid: 0,
	queries: [],
	queue: [],
	running: false,
	timeout: null,

	checkQueue: function() {
		if ( $.livequery.running && $.livequery.queue.length ) {
			var length = $.livequery.queue.length;
			
			while ( length-- )
				$.livequery.queries[ $.livequery.queue.shift() ].run();
		}
	},

	pause: function() {
		$.livequery.running = false;
	},

	play: function() {
		$.livequery.running = true;

		$.livequery.run();
	},

	registerPlugin: function() {
		$.each( arguments, function(i,n) {
		
			if (!$.fn[n]) return;

			var old = $.fn[n];

			$.fn[n] = function() {

				var r = old.apply(this, arguments);

				$.livequery.run();

				return r;
			}
		});
	},

	run: function(id) {
		if (id != undefined) {
			if ( $.inArray(id, $.livequery.queue) < 0 )
				$.livequery.queue.push( id );
		}
		else
			$.each( $.livequery.queries, function(id) {
				if ( $.inArray(id, $.livequery.queue) < 0 )
					$.livequery.queue.push( id );
			});

		if ($.livequery.timeout) clearTimeout($.livequery.timeout);
		$.livequery.timeout = setTimeout($.livequery.checkQueue, 20);
	},

	stop: function(id) {
		if (id != undefined)
			$.livequery.queries[ id ].stop();
		else
			$.each( $.livequery.queries, function(id) {
				$.livequery.queries[ id ].stop();
			});
	}
});

$.livequery.registerPlugin('append', 'prepend', 'after', 'before', 'wrap', 'attr', 'removeAttr', 'addClass', 'removeClass', 'toggleClass', 'empty', 'remove', 'html');

$(function() { $.livequery.play(); });

})(jQuery);