var path = '/Realtors';
var notID='';
var nType='';
var room_notification_ID = 'room_notification'+$('#myUserID').val();

//alert(room_notification_ID);
$('[data-toggle="popover"]').popover();
$(".select2").select2({containerCssClass: "select",placeholder:"Select"});
$(".select2.image").select2({
	containerCssClass: "image select",
	dropdownCssClass: "image",
	placeholder: "Select client...",
	templateResult: formatState,
	templateSelection: formatState,
	allowClear: false
});
function formatState (opt) {
	if (!opt.id) {
		return opt.text;
	}               
	var optimage = $(opt.element).data('image'); 
	var subtext = $(opt.element).data('subtext'); 
	if(!subtext)subtext = '';
	if(!optimage){
		return opt.text;
	} else {                    
		var $opt = $(
			'<span class="ic"><img src="' + optimage + '" /> <span class="name">' + opt.text + '<div class="sub">'+ subtext +' </div></span> </span>'
		);
		return $opt;
	}
};
$("header .select2").select2({
	dropdownCssClass : 'h-select',
	allowClear:true
});
 
$("#h-btn").on("click",function(){
	$("body").append('<div class="r-layer"></div>');
	$("#r-header").css("right","0px");
});
$(document).on("click","#r-close,.r-layer",function(){
	$(".r-layer","body").remove();
	$("#r-header").css("right","-100%");
});
$("#m-search").on("click",function(){
	if($("#search-dropdown").css("display") == "none") {
		$("#search-dropdown").show();
		$("body>.container").append('<div class="g-layer"></div>');
		$(".g-layer","body>.container").css("top","50px");
	}else{
		$("#search-dropdown").hide();
		$(".g-layer","body").remove();
	}
});

$("#city").on("change",function(){
	var cityID = $(this).val();
	var targetID = $(this).data("targetid");
	var selectID = $("#"+targetID).data("selectid");
	$.ajax({
		url:path+'/home/getLocation',
		type:'POST',
		dataType:'JSON',
		data:{'type':'LOCALITY_BY_CITY','cityID':cityID}
	}).done(function(data){
		var html = '<option></option>';
		for(var i=0;i<data.length;i++){
			if(selectID == data[i]['localityID'])
				html+='<option value="'+data[i]['localityID']+'" selected>'+data[i]['localityName']+'</option>';
			else
				html+='<option value="'+data[i]['localityID']+'">'+data[i]['localityName']+'</option>';
		}
		$("#"+targetID).html(html);
		$("#"+targetID).select2({containerCssClass: "select",placeholder:"Select"});
	});
});
 

$(document).ready(function(){
	if(document.getElementById('search_key'))
		autocomplete2 = new google.maps.places.Autocomplete(document.getElementById('search_key'), { types: [ 'geocode' ] });
	if(document.getElementById('msearch_key'))
		autocomplete2 = new google.maps.places.Autocomplete(document.getElementById('msearch_key'), { types: [ 'geocode' ] });
	
	
	document.addEventListener("backbutton", function (e) {
	e.preventDefault();
	}, false );
	
})

$("#search_form").submit(function(e){
	e.preventDefault();
	var url = path+'/property/search?';
	var param = '';
	$("#search_form input,#search_form select").each(function(){
		if($(this).val() !=""){
			if(param !="")param+='&';
			param+=$(this).attr("name")+'='+$(this).val();
		}
	});
	window.location=url+param;
});
$("header .search-btn").on("click",function(){
	$("#search_form").submit();
});
$("#msearch_form").submit(function(e){
	e.preventDefault();
	var url = path+'/property/search?';
	var param = '';
	$("#msearch_form input,#msearch_form select").each(function(){
		if($(this).val() !=""){
			if(param !="")param+='&';
			param+=$(this).attr("name")+'='+$(this).val();
		}
	});
	window.location=url+param;
});
$("#msearch-btn").on("click",function(){
	$("#msearch_form").submit();
});
  


function triggerWebAppNotifications(nType, notID){
	$.ajax({
		url:path+'/chats/triggerWebAppNotifications',
		type:'POST',
		data:{'type':nType,'notificationID':notID},
		dataType:'JSON'
	}).success(function(data){
		if(data.length>0){
			for(var i=0; i<data.length; i++){
				var rID = data[i]['toUserID'];
				notificationPage.emit('sendnotification', { 
					room_id: rID,
					comingFrom: data[i]['comingFrom'],
					comingImage: data[i]['comingImage'],
					notificationType: data[i]['notificationType'],
					readOrNot: data[i]['readOrNot'],
					redirectUrl: data[i]['redirectUrl'],
					sendTime: data[i]['sendTime'],
					message: data[i]['message'],
					messageIcon: data[i]['messageIcon'],
					toUserID: data[i]['toUserID']
                });
			}
		}
	});
}

var socket = io.connect('http://localhost:8080');				
var notificationPage=socket.of('/notification')				
	.on('connect_failed', function (reason) {
	console.error('unable to connect notificationPage to namespace', reason);
	})
	.on('error',function(reason){
	//alert("in error func");
	console.error('unable to connect notificationPage to namespace', reason);
	})
	.on('reconnect_failed',function(){
	
	})
	.on('connect', function () {
	console.info('sucessfully established a connection of notificationPage with the namespace');
	notificationPage.emit('sendBasicdata',{user_id:$('#myUserID').val(),room_id:$('#myUserID').val()});
	});
	notificationPage.on( 'showNotification', function( data ) {
		console.log(data);
		var top_html_content = '<div class="msg">'+
									'<a href="javascript:void(0)">'+
										'<img class="m-img" src="'+path+'/'+data.comingImage+'">'+
										'<div class="data">'+
											'<div class="content">'+data.message+'</div>'+
											'<div class="status">'+data.messageIcon+' '+data.sendTime+'</div>'+
										'</div>'+
									'</a>'+
								'</div>';
	$('.new-notification-list').prepend(top_html_content);
	setTimeout(function(){ changeCount(data);},500);
	
});
function changeCount(data){
	var notCount = $('.new-notification').attr('data-notCount');
	console.log(notCount);
	notCount = parseInt(notCount)+1;
	$('.new-notification').html(notCount);
	$('.new-notification').attr('data-notCount', notCount);
	console.log(notCount);
	$.notify({
		icon: path+'/'+data.comingImage,
		title: data.message,
		message: data.messageIcon+' '+data.sendTime,
		placement: {
		from: 'bottom',
		align: 'left'
		}
	},{
		placement: {
			from: 'bottom',
			align: 'left'
		},
		type: 'minimalist',
		delay: 5000,
		icon_type: 'image',
		template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
			'<img data-notify="icon" class="img-circle pull-left">' +
			'<span data-notify="title">{1}</span>' +
			'<span data-notify="message">{2}</span>' +
		'</div>'
	});
}

