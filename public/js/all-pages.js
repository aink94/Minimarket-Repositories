var modal = '' +
        '<div id="modal" class="modal modal" role="dialog" tabindex="-1" aria-labelledby="" aria-hidden="true">'+
        '<div class="modal-dialog">'+
        '<div class="modal-content">'+
        '<div class="modal-header">'+
        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
        '<h4 class="modal-title"></h4>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>';
//notif
var notif = (function (){
	function self(){};

	self.Add = function(params){
		var notification = new NotificationFx({
			// the message
			message : params.message || "Message",
			// layout type: growl|attached|bar|other
			layout  : params.layout || 'growl',
			// effects for the specified layout:
			// for growl layout: scale|slide|genie|jelly
			// for attached layout: flip|bouncyflip
			// for other layout: boxspinner|cornerexpand|loadingcircle|thumbslider
			// ...
			effect  : params.effect ||'slide',
			// notice, warning, error, success
			// will add class ns-type-warning, ns-type-error or ns-type-success
			type    : params.type || 'error',
			// if the user doesn´t close the notification then we remove it 
			// after the following time
			ttl : 5000,//5 detik
		});
		notification.show();
	}

	return self;

})($);

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	},
	//global : false,
	//async  : false
});

$(document).ajaxStart(onStart)
	.ajaxStop(onStop)
	.ajaxSend(onSend)
	.ajaxComplete(onComplete)
	.ajaxSuccess(onSuccess)
	.ajaxError(onError);

function onStart(event, settings){
	//console.log("Start Global =========================================");
	//console.log('------ # Event      :');
	//console.log(event);
	//console.log('------ # settings   :');
	//console.log(settings);
}

function onStop(event){
	//console.log("Stop Global =========================================");
	//console.log('------ # Event      :');
	//console.log(event);
}

function onSend(event, xhr, settings){
	//console.log("Send Global =========================================");
	//console.log('------ # Event      :');
	//console.log(event);
	//console.log('------ # jqXHR      :');
	//console.log(xhr);
	//console.log('------ # Setting    :');
	//console.log(settings);
	if(typeof settings.context !== 'undefined'){
		switch(settings.context.context){
			case "form":
				$(".loading").show();
			break;
		}
	}
}

function onComplete(event, xhr, settings){
	//console.log("Complete Global =====================================");
	//console.log('------ # Event      :');
	//console.log(event);
	//console.log('------ # jqXHR      :');
	//console.log(xhr);
	//console.log('------ # Setting    :');
	//console.log(settings);

	if(typeof settings.context !== "undefined"){
		switch(settings.context.context){
			case "form":
				$('.loading').hide();
			break;
		}
	}
}

function onSuccess(event, xhr, settings){
	//console.log("Success Global ======================================");
	//console.log('------ # Event      :');
	//console.log(event);
	//console.log('------ # jqXHR      :');
	//console.log(xhr);
	//console.log('------ # Setting    :');
	//console.log(settings);

	if(typeof settings.context !== "undefined"){
		switch(settings.context.context){
			case "form" :
				$(".loading").hide();
				$("#modal").modal("hide");
				notif.Add({
					type : "success",
					message : xhr.responseJSON.title
				});
			break;
		}
	}
}

function onError(event, xhr, settings, thrownError){
	//console.log("Error Global =========================================");
	//console.log('------ # Event      :');
	//console.log(event);
	//console.log('------ # jqXHR      :');
	//console.log(xhr);
	//console.log('------ # Setting    :');
	//console.log(settings);
	//console.log('------ # thrownError:');
	//console.log(thrownError);

	if(typeof settings.context !== "undefined"){
		switch(settings.context.context){
			case "form":
				switch (xhr.status){
					//form-validation
					case 422:
						var msg = '';
						$.each(xhr.responseJSON, function(key, val){
							msg += '<p>'+val+'</p>';	
						});
						notif.Add({
							message : msg,
						});
						
					break;
					//cridential
					case 401:
						notif.Add({
							message : xhr.responseJSON
						});
					break;
					case 400:
						notif.Add({
							message : xhr.responseJSON.message
						});
					break;
				}
			break;
			case "rfid":{
				console.log(xhr.responseJSON);
			}
			break;
		}	
	}
}

$(function(){
	var url = window.location;
    $('ul.sidebar-menu a').filter(function() {
        return this.href == url; //true
    }).parent('li').addClass('active');
    $('ul.treeview-menu a').filter(function(){
        return this.href == url;
    }).parents('li.treeview').addClass('active');
});