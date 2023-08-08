const base_url = "/jweverlyn/intranet/";

const sp_words = {
	error: "Error",
	success: "Éxito",
	warning: "Advertencia",
}

function set_msgs(form_id, msgs){
	$(form_id + " [name]").removeClass("is-invalid").removeClass("is-valid");
	$(msgs).each(function (index, element) {
		let dom = $(form_id).find("[name=" + element.name + "]");
		dom.addClass(element.class);
		dom.next().html(element.msg);
	});
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
		url: base_url + url,
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

