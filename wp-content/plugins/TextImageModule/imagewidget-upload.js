var widget;

function start_upload(btn) {
	widget = jQuery(btn).closest('.widget');
	formfield = jQuery(widget).find('.image-upload-field').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	return false;
}

jQuery(document).ready(function() {	
	window.send_to_editor = function(html) {
	 imgurl = jQuery('img',html).attr('src');
	 jQuery(widget).find('.image-upload-field').val(imgurl);
	 tb_remove();
	}
	
});


