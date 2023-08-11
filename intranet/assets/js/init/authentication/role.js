$("#form_add_role").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/role/add_role", "add_role").done(function(res) {
		set_msgs("#form_add_role", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "authentication/role/edit/" + res.role_id);
	});
});

//$("#sl_exam_category").change(function() {filter_exam($(this).val());});

$(".btn_delete_role").on('click',(function(e) {
	ajax_simple_warning({access_id: $(this).val()}, "authentication/role/delete_role", "delete_role").done(function(res) {
		swal_redirection(res.type, res.msg, base_url + "authentication/role");
	});
}));
