let b_url = "money_flow/balance/";

//set_date(".datepicker", null)
//set_dates_between("#f_from", "#f_to");
//btn_card_control("#btn_category_admin", ".btn_close_cat_admin", "#bl_cat_admin", "primary");

function row_control(dom, prefix){
	if ($(dom).html().trim().includes("right")){//open
		$("." + prefix + "_row_" + $(dom).val()).removeClass("d-none");
		$(dom).html('<i class="bi bi-caret-down-fill"></i>');
	}else{//close
		$("." + prefix + "_row_" + $(dom).val()).addClass("d-none");
		$(dom).html('<i class="bi bi-caret-right-fill"></i>');
	}
}

$(".btn_control_by_type").on('click',(function(e) {
	row_control(this, "t");
}));

$(".btn_control_by_category").on('click',(function(e) {
	row_control(this, "c");
}));

$("#sl_bt").on('change',(function(e) {
	$("#sl_bp").val("");
	$(".bt").addClass("d-none");
	$(".bt_" + $(this).val()).removeClass("d-none");
}));

$("#sl_bp").on('change',(function(e) {
	if ($(this).val() != ""){
		location.href = base_url + "money_flow/balance?" + $.param(ob_from_form("#form_balane_filter"));
	}
}));