
$(function(){
	$('body').addClass('login-page');
	$("#sign").click(function(event){
		$.ajax({
			context  : {
				event   : event,
				context : "form"
			},
			async    : false,
			global   : true,
			type     : "POST",
			url      : "/login",
			dataType : "json",
			data     : {
				"username" : $("input[name='username']").val(),
				"password" : $('input[name="password"]').val()
			}
		}).done(function(request, textStatus, errorThrown){
			setTimeout(function(){
				window.location.replace(request.intended);//location.reload(request);
			}, 3000);
		});
	});
});