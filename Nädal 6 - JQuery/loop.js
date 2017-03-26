/**
* Kaar3l 18.03.2017.
*/
window.onload = function(){
	$('li').first().addClass('active');
	$("#next").click(function() {
		var nowActive=$("li.active")
		/**Remove all active:*/
		$( "li" ).each(function( index ) {
		  $(this).removeClass('active');
		});
		/**Active is last then make first active:*/
		if (nowActive.is($("li").last())){
			$('li').first().addClass("active");
		} else {
			nowActive.next("li").addClass("active");
		}
	});

	$("#prev").click(function() {
		var nowActive=$("li.active")
		/**Remove all active:*/
		$( "li" ).each(function( index ) {
		  $(this).removeClass('active');
		});
		/**Active is first then make last active:*/
		if (nowActive.is($("li").first())){
			$('li').last().addClass("active");
		} else {
			nowActive.prev("li").addClass("active");
		}
	});
}
