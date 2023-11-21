let b_url = "commerce/client/";

set_search_client_ajax();
btn_card_control("#btn_add_note", "#btn_close_an", "#card_add_note", "success");

$("#form_add_client").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add", "add_client").done(function(res) {
		set_msgs("#form_add_client", res.msgs);
		swal_redirection(res.type, res.msg, res.url);
	});
});

$("#form_update_data").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "update_data", "update_client").done(function(res) {
		set_msgs("#form_update_data", res.msgs);
		swal_redirection(res.type, res.msg, res.url);
	});
});

$("#form_update_image").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "update_image", "update_client").done(function(res) {
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