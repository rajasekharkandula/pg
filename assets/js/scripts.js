$('.owl-carousel').owlCarousel({
    loop:true,
    nav:false,
	dots:false,
	items:1,
	/* autoplay:true, */
	animateOut: 'fadeOut'
})

$("#mh-view").on("click",function(){
	$("#m-header").removeClass("hide");
	$("body").css("overflow","hidden");
});
$("#ms-view").on("click",function(){
	$(".m-search").toggle("slow");
});
$("span.toggle").on("click",function(){
	$(this).parent().find("ul.dropdown-list").toggle("slow");
});
$(document).ready(function(){
	$("#m-header").on("click",function(){
		$("#m-header").addClass("hide");
		$("body").css("overflow","auto");
	});
	$("#m-inner").on("click",function(e){
		e.stopPropagation();
	});
});

$("#m-filter").on("click",function(){
	$("#search-box").toggle("slow");
});

