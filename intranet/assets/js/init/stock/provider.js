let b_url = "stock/provider/";

set_search_provider_ajax();

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

$("#form_update_image").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "update_image", "update_provider").done(function(res) {
		set_msgs("#form_update_image", res.msgs);
		swal_redirection(res.type, res.msg, res.url);
	});
});