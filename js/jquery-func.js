$(document).ready(function() {

	$(".movie-image").hover(function() {
		$(this).find(".play").show();
	}, function() {
		$(this).find(".play").hide();

	});

	$(".blink").focus(function() {
		if (this.title == this.value) {
			this.value = '';
		}
	}).blur(function() {
		if (this.value == '') {
			this.value = this.title;
		}
	});
});

function sizeGalleryImages(img,width,height) {
	var imgWidth = document.getElementByClass('.movie-image').width;
	img.width(width);
	img.height(height);
}
