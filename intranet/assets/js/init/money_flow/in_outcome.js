let b_url = "money_flow/in_outcome/";

set_date(".datepicker", null)
set_dates_between("#f_from", "#f_to");
btn_card_control("#btn_category_admin", ".btn_close_cat_admin", "#bl_cat_admin", "primary");

/* category */
$("#form_add_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_category", "add_category").done(function(res) {
		set_msgs("#form_add_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url);
	});
});

$("#form_delete_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "delete_category", "delete_category").done(function(res) {
		set_msgs("#form_delete_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url);
	});
});

/* register */
$("#form_add_in_outcome").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_in_outcome", "add_in_outcome").done(function(res) {
		set_msgs("#form_add_in_outcome", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url);
	});
});

$(".btn_delete_io").on('click',(function(e) {
	ajax_simple_warning({in_outcome_id: $(this).val()}, b_url + "delete_in_outcome", "delete_in_outcome").done(function(res) {
		swal_redirection(res.type, res.msg, base_url + b_url);
	});
}));

$("#type_id").on('change',(function(e) {
	$(".sl_cat").addClass("d-none");
	$(".sl_cat_" + $(this).val()).removeClass("d-none");
	$("#category_id").val("");
}));

function amount_validation(){
	var amount = nf_reverse($("#amount").val());
	if (isNaN(amount)) amount = 0;
	else if (amount < 0) amount = 0;
	
	$("#amount").val(nf(amount));
}

$("#amount").on('change',(function(e) {
	amount_validation();
})).on('keyup',(function(e) {
	if (event.which === 13) amount_validation();
}));