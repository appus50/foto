/* Author:
Satrya - http://twitter.com/msattt
*/

var $j = jQuery.noConflict();
$j(document).ready(function(){
	
	$j("#main").krioImageLoader();
	
	$j( ".gallery a" ).attr( 'rel', 'fancy_group' );
	$j( "a.fancyimg, a[rel=fancy_group]" ).fancybox();
	
});


