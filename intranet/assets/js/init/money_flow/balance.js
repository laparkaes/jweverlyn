let b_url = "money_flow/balance/";

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
	if ($(this).val() != "") $("#form_balane_filter").submit();
}));

$("#btn_excel").on('click',(function(e) {
	ajax_simple(ob_from_form("#form_balane_filter"), b_url + "download_excel").done(function(res) {
		if (res.type == "success") location.href = res.url;
		else swal(res.type, res.msg);
	});
}));