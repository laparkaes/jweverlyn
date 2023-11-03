const base_url = "/jweverlyn/intranet/";
const default_lang = "sp";

const alert_words = {
	sp: {
		error: "Error",
		success: "Éxito",
		warning: "Advertencia",
		confirm: "Confirmar",
		cancel: "Cancelar",
	},
}

const warning_msg = {
	sp: {
		add_module: "¿Desea agregar nuevo módulo?",
		delete_module: "¿Desea eliminar módulo?",
		add_access: "¿Desea agregar nuevo acceso?",
		delete_access: "¿Desea eliminar acceso?",
		add_role: "¿Desea agregar nuevo rol?",
		update_role: "¿Desea actualizar rol?",
		delete_role: "¿Desea eliminar rol?",
		add_account: "¿Desea agregar nuevo usuario?",
		update_account: "¿Desea actualizar usuario?",
		update_password: "¿Desea actualizar contraseña?",
		deactivate_account: "¿Desea desactivar usuario?",
		activate_account: "¿Desea activar usuario?",
		add_category: "¿Desea agregar nueva categoría?",
		delete_category: "¿Desea eliminar categoría?",
		move_category: "¿Desea mover todos los productos de categoría?",
		add_product: "¿Desea agregar nuevo producto?",
		update_product: "¿Desea actualizar producto?",
		add_option: "¿Desea agregar nueva opción?",
		update_option: "¿Desea actualizar opción?",
		delete_option: "¿Desea eliminar opción?",
		add_image: "¿Desea agregar nueva imagen?",
		set_main_image: "¿Desea configurar como imagen principal?",
		delete_image: "¿Desea eliminar imagen?",
		add_sale: "¿Desea agregar nueva venta?",
		cancel_sale: "¿Desea anular la venta?",
		add_payment: "¿Desea agregar pago?",
		delete_payment: "¿Desea eliminar pago?",
		add_proforma: "¿Desea agregar nueva proforma?",
		update_proforma: "¿Desea actualizar la proforma?",
		void_proforma: "¿Desea anular la proforma?",
		issue_invoice: "¿Desea emitir comprobante?",
		send_invoice: "¿Desea enviar comprobante a Sunat?",
		void_invoice: "¿Desea anular comprobante?",
		add_client: "¿Desea agregar nuevo cliente?",
		update_client: "¿Desea actualizar cliente?",
	},
}

//disable form enter submit
$('form input').on('keydown', function(event) {
	//enter key code
	if (event.keyCode === 13) event.preventDefault();
});

function nf(num){//number format
	return parseFloat(num).toLocaleString('es-US', {maximumFractionDigits: 2, minimumFractionDigits: 2});
}

function reset_form(form_id){
	$(form_id)[0].reset();
	$(form_id + " [name]").removeClass("is-invalid").removeClass("is-valid");
}

function set_msgs(form_id, msgs){
	$(form_id + " [name]").removeClass("is-invalid").removeClass("is-valid");
	$(msgs).each(function (index, element) {
		let dom = $(form_id).find("[name='" + element.name + "']");
		dom.addClass(element.class);
		//dom.next().html(element.msg);
		dom.parent().find(".invalid-feedback").html(element.msg);
	});
}

function swal(type, msg){
	if (msg != ""){
		Swal.fire({
			title: "¡ " + alert_words[default_lang][type].toUpperCase() + " !",
			icon: type,
			html: msg,
			confirmButtonText: alert_words[default_lang]["confirm"],
			cancelButtonText: alert_words[default_lang]["cancel"],
		});
	}
}

function swal_redirection(type, msg, move_to){
	if (msg != ""){
		Swal.fire({
			title: "¡ " + alert_words[default_lang][type].toUpperCase() + " !",
			icon: type,
			html: msg,
			confirmButtonText: alert_words[default_lang]["confirm"],
			cancelButtonText: alert_words[default_lang]["cancel"],
		}).then((result) => {
			if (result.isConfirmed) if (type == "success") location.href = move_to;
		});	
	}
	
}

function toastr_(type, msg){
	if (msg != ""){
		toastr.remove();
		switch (type) {
			case "success": toastr.success(msg, "¡ " + alert_words[default_lang]["success"] + " !"); break;
			case "error": toastr.success(msg, "¡ " + alert_words[default_lang]["error"] + " !"); break;
			case "warning":  toastr.warning(msg, "¡ " + alert_words[default_lang]["warning"] + " !"); break;
		}	
	}
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

function ajax_simple(data, url){
	var deferred = $.Deferred();
	$.ajax({
		url: base_url + url,
		type: "POST",
		data: data,
		success:function(res){
			deferred.resolve(res);
		}
	});
	
	return deferred.promise();
}

function ajax_form_warning(dom, url, msg_index){
	var deferred = $.Deferred();
	Swal.fire({
		title: alert_words[default_lang]["warning"],
		icon: 'warning',
		html: warning_msg[default_lang][msg_index],
		showCancelButton: true,
		confirmButtonText: alert_words[default_lang]["confirm"],
		cancelButtonText: alert_words[default_lang]["cancel"],
	}).then((result) => {
		if (result.isConfirmed) ajax_form(dom, url).done(function(res) {
			deferred.resolve(res);
		});
	});
	
	return deferred.promise();
}

function ajax_simple_warning(data, url, msg_index){
	var deferred = $.Deferred();
	Swal.fire({
		title: alert_words[default_lang]["warning"],
		icon: 'warning',
		html: warning_msg[default_lang][msg_index],
		showCancelButton: true,
		confirmButtonText: alert_words[default_lang]["confirm"],
		cancelButtonText: alert_words[default_lang]["cancel"],
	}).then((result) => {
		if (result.isConfirmed) ajax_simple(data, url).done(function(res) {
			deferred.resolve(res);
		});
	});
	
	return deferred.promise();
}

function set_date(dom_date, min){
	/*
	min = moment() // select from today
	min = null // all dates selection
	*/
	var op = {
		locale: 'es',
		allowInputToggle: true,
		showClose: true,
		showClear: true,
		format: "YYYY-MM-DD",
		widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom',
        },
		icons: {
			previous: 'bi bi-chevron-left',
			next: 'bi bi-chevron-right',
			today: 'bi bi-calendar-event',
			clear: 'bi bi-eraser',
			close: 'bi bi-x-lg',
		},
	}
	if (min != null) op.minDate = moment();
	
	$(dom_date).datetimepicker(op);
}

function set_dates_between(dom_from, dom_to){
	$(dom_from).datetimepicker({
		locale: 'es',
		allowInputToggle: true,
		showClose: true,
		showClear: true,
		format: "YYYY-MM-DD",
		widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom',
        },
		icons: {
			previous: 'bi bi-chevron-left',
			next: 'bi bi-chevron-right',
			today: 'bi bi-calendar-event',
			clear: 'bi bi-eraser',
			close: 'bi bi-x-lg',
		},
	});
	
	$(dom_to).datetimepicker({
		locale: 'es',
		allowInputToggle: true,
		showClose: true,
		showClear: true,
		format: "YYYY-MM-DD",
		widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom',
        },
		icons: {
			previous: 'bi bi-chevron-left',
			next: 'bi bi-chevron-right',
			today: 'bi bi-calendar-event',
			clear: 'bi bi-eraser',
			close: 'bi bi-x-lg',
		},
	});
	
	$(dom_from).on("dp.change", function (e) {
		$(dom_to).data("DateTimePicker").minDate(e.date);
	});
	$(dom_to).on("dp.change", function (e) {
		$(dom_from).data("DateTimePicker").maxDate(e.date);
	});
}

/* search client functions start
doms: #btn_search_person, #doc_type_id, #doc_number, #client_name */
function set_search_client_ajax(){
	function search_client(){
		var data = {doc_type_id: $("#doc_type_id").val(), doc_number: $("#doc_number").val()};
		ajax_simple(data, "commerce/client/search_client_ajax").done(function(res) {
			swal(res.type, res.msg);
			if (res.type == "success") $("#client_name").val(res.person.name);
			else $("#client_name").val("");
		});
	}
	
	$("#doc_type_id").on('change',(function(e) {
		$("#doc_number, #client_name").val("");
		if ($("#doc_type_id option:selected").val() == 1){
			$("#doc_number").prop("disabled", true);
			$("#btn_search_person").prop("disabled", true);
			$("#client_name").prop("disabled", true);
		}else{
			$("#doc_number").prop("disabled", false);
			$("#btn_search_person").prop("disabled", false);
			$("#client_name").prop("disabled", false);
		}
	}));

	$("#doc_number").on('keyup',(function(e) {
		if (e.key === "Enter") search_client();
		else $("#client_name").prop("disabled", false);
	}));

	$("#btn_search_person").on('click',(function(e) {
		search_client();
	}));
}
/* search client functions end */