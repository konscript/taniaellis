// http://www.webmaster-source.com/2010/01/08/using-the-wordpress-uploader-in-your-plugin-or-theme/

var type = 'image';
var field = '.image-upload-field';
var widget;

function start_upload(btn) {
	widget = jQuery(btn).closest('.widget');
	
	if(jQuery(btn).is('.image')) {
		type = 'image';
		field = '.image-upload-field';
	} else {
		type = 'icon';
		field = '.icon-upload-field';
	}
	
	formfield = jQuery(widget).find(field).attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	return false;
}

jQuery(document).ready(function() {	
	window.send_to_editor = function(html) {
	 imgurl = jQuery('img',html).attr('src');
	 jQuery(widget).find(field).val(imgurl);
	 tb_remove();
	}
	
});


