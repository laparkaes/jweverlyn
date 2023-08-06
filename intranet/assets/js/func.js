const sp_words = {
	error: "Error",
	success: "Éxito",
}

function swal(type, msg){
	Swal.fire({
		title: sp_words[type].toUpperCase() + " !!",
		icon: type,
		html: msg
	});
}

function swal_redirection(type, msg, move_to){
	Swal.fire({
		title: sp_words[type].toUpperCase() + " !!",
		icon: type,
		html: msg
	}).then((result) => {
		if (result.isConfirmed) if (type == "success") location.href = move_to;
	});
}

function ajax_form(dom, url){
	var deferred = $.Deferred();
	$.ajax({
		url: url,
		type: "POST",
		data: new FormData(dom),
		contentType: false,
		processData:false,
		success:function(res){
			deferred.resolve(res);
		}
	});
	
	return deferred.promise();
}

