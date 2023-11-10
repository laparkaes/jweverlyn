let b_url = "commerce/client/";

set_search_client_ajax();

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