let b_url = "stock/provider/";

set_search_provider_ajax();
btn_card_control("#btn_open_ap", "#btn_close_ap", "#card_add_person", "success");
btn_card_control("#btn_add_note", "#btn_close_an", "#card_add_note", "success");

$("#form_add_provider").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add", "add_provider").done(function(res) {
		set_msgs("#form_add_provider", res.msgs);
		swal_redirection(res.type, res.msg, res.url);
	});
});

$("#form_update_data").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "update_data", "update_provider").done(function(res) {
		set_msgs("#form_update_data", res.msgs);
		swal_redirection(res.type, res.msg, res.url);
	});
});

$("#form_add_person").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_person", "add_person").done(function(res) {
		set_msgs("#form_add_person", res.msgs);
		swal_redirection(res.type, res.msg, res.url);
	});
});

$(".btn_delete_person").on('click',(function(e) {
	ajax_simple_warning({person_id: $(this).val()}, b_url + "delete_person", "delete_person").done(function(res) {
		swal_redirection(res.type, res.msg, res.url);
	});
}));


$("#form_update_image").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "update_image", "update_provider").done(function(res) {
		set_msgs("#form_update_image", res.msgs);
		swal_redirection(res.type, res.msg, res.url);
	});
});

$("#form_add_note").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_note", "add_note").done(function(res) {
		set_msgs("#form_add_note", res.msgs);
		if (res.type == "success") swal_redirection(res.type, res.msg, res.url);
		else swal(res.type, res.msg);
	});
});

$(".btn_delete_note").on('click',(function(e) {
	ajax_simple_warning({note_id: $(this).val()}, b_url + "delete_note", "delete_note").done(function(res) {
		swal_redirection(res.type, res.msg, res.url);
	});
}));