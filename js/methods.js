/* Author:
Satrya - http://twitter.com/msattt
*/

var $j = jQuery.noConflict();
$j(document).ready(function(){
	
	$j("#main").krioImageLoader();
	
	// Detect image with extension .jpg, ,.png and .gif and add rel="fancy_group"
	$j( ".gallery a[href$='.jpg'], .gallery a[href$='.png'], .gallery a[href$='.gif']" ).attr( 'rel', 'fancy_group' );
	$j( "a.fancyimg, a[rel=fancy_group]" ).fancybox();

	$j(".rslides").responsiveSlides({
		auto			: true,
		pager			: true,
		nav				: true,
		pauseControls	: true,
		pause			: true,
		speed			: 500
	});
	
});