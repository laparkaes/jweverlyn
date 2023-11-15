let b_url = "stock/purchase/";

set_dates_between("#f_from", "#f_to");
set_search_provider_ajax();

/* detail - file upload */
$("#btn_file_upload").on('click',(function(e) {
	if ($("#card_file_upload").hasClass("d-none")){
		$("#card_file_upload").removeClass("d-none");
		$(this).removeClass("btn-success");
		$(this).addClass("btn-outline-success");
	}else{
		$("#card_file_upload").addClass("d-none");
		$(this).removeClass("btn-outline-success");
		$(this).addClass("btn-success");
	}
}));

$("#btn_close_cfu").on('click',(function(e) {
	$("#card_file_upload").addClass("d-none");
	$("#btn_file_upload").removeClass("btn-outline-success");
	$("#btn_file_upload").addClass("btn-success");
}));

/* detail - payment */
$("#form_add_payment").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_payment", "add_payment").done(function(res) {
		set_msgs("#form_add_payment", res.msgs);
		if (res.type == "success") swal_redirection(res.type, res.msg, res.url);
		else swal(res.type, res.msg);
	});
});

$(".btn_delete_payment").on('click',(function(e) {
	ajax_simple_warning({payment_id: $(this).val()}, b_url + "delete_payment", "delete_payment").done(function(res) {
		swal_redirection(res.type, res.msg, res.url);
	});
}));

$("#btn_add_payment").on('click',(function(e) {
	if ($("#card_add_payment").hasClass("d-none")){
		$("#card_add_payment").removeClass("d-none");
		$(this).removeClass("btn-primary");
		$(this).addClass("btn-outline-primary");
	}else{
		$("#card_add_payment").addClass("d-none");
		$(this).removeClass("btn-outline-primary");
		$(this).addClass("btn-primary");
	}
}));

$("#btn_close_ap").on('click',(function(e) {
	$("#card_add_payment").addClass("d-none");
	$("#btn_add_payment").removeClass("btn-outline-primary");
	$("#btn_add_payment").addClass("btn-primary");
}));

/* detail - note */
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

$("#btn_add_note").on('click',(function(e) {
	if ($("#card_add_note").hasClass("d-none")){
		$("#card_add_note").removeClass("d-none");
		$(this).removeClass("btn-primary");
		$(this).addClass("btn-outline-primary");
	}else{
		$("#card_add_note").addClass("d-none");
		$(this).removeClass("btn-outline-primary");
		$(this).addClass("btn-primary");
	}
}));

$("#btn_close_an").on('click',(function(e) {
	$("#card_add_note").addClass("d-none");
	$("#btn_add_note").removeClass("btn-outline-primary");
	$("#btn_add_note").addClass("btn-primary");
}));

/* detail, register - payment amount start */
function calculate_balance(){
	var total = parseFloat(nf_reverse($("#pay_total").val()));
	var paid =  parseFloat(nf_reverse($("#pay_paid").val()));
	if (isNaN(paid) || paid <= 0) paid = 0;
	
	var balance = total - paid;
	if (balance < 0){
		swal("error", error_msg[default_lang]["limited_payment"]);
		balance = 0;
		paid = total;
	}
	
	$("#pay_balance").val(nf(balance));
	$("#pay_paid").val(nf(paid));
}

$("#pay_paid").on('change',(function(e) {
	calculate_balance();
})).on('keyup',(function(e) {
	if (event.which === 13) calculate_balance();
}));

/* register - product selection */
function close_select_product(){
	$("#card_select_product").addClass("d-none");
	$("#form_select_product").addClass("d-none");
	$("#form_select_product")[0].reset();
	$("#form_search_product input").val("");
	$("#msg_enter_keyword").removeClass("d-none");
	$("#bl_search_result").addClass("d-none");
}

$("#btn_open_select_product").on('click',(function(e) {
	$("#card_select_product").removeClass("d-none");
}));

$("#btn_close_select_product").on('click',(function(e) {
	close_select_product();
}));

function select_product(dom){
	$("#form_select_product")[0].reset();
	$(".btn_select_product").removeClass("list-group-item-primary");
	$(dom).addClass("list-group-item-primary");
	
	ajax_simple({product_id: $(dom).val()}, b_url + "load_product").done(function(res) {
		if (res.type == "success"){
			$("#form_select_product input[name=product_id]").val(res.product.product_id);
			$("#form_select_product input[name=product]").val(res.product.product);
			
			var dom_select = $("#form_select_product select[name=option_id]");
			dom_select.html("");
			$(dom_select).append('<option value="">Elegir</option>');
			$(res.options).each(function(index, element){
				$(dom_select).append('<option value="' + element.option_id + '">' + element.option + '</option>');
			});
			
			$("#form_select_product").removeClass("d-none");
		}else{
			swal("error", res.msg);
			$("#form_select_product").addClass("d-none");
		}
	});
}

$("#form_search_product").submit(function(e) {
	e.preventDefault();
	
	ajax_form(this, b_url + "search_product").done(function(res) {
		$("#msg_enter_keyword").addClass("d-none");
		$("#bl_search_result").removeClass("d-none");
		$("#search_result").html("");
		
		if (res.type == "success"){
			$(res.products).each(function(index, element) {
				$("#search_result").append('<button class="list-group-item list-group-item-action btn_select_product" value="' + element.product_id + '"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1 me-3">' + element.product + '</h5></div><p class="mb-1">' + element.category + '</p><small>' + element.code + '</small></button>');
			});
			
			$(".btn_select_product").on('click',(function(e) {
				select_product(this);
			}));
		}else $("#search_result").html(res.msg);
	});
});

function calculate_subtotal(){
	var price = nf_reverse($("#form_select_product input[name=price]").val());
	var qty = nf_reverse($("#form_select_product input[name=qty]").val());
	
	$("#form_select_product input[name=price]").val(nf(price));
	$("#form_select_product input[name=qty]").val(nf_int(qty));
	$("#form_select_product input[name=subtotal]").val(nf(price * qty));	
}

$(".ps_price_qty").on('change',(function(e) {
	calculate_subtotal();
})).on('keyup',(function(e) {
	if (event.which === 13) calculate_subtotal();
})).on('focusout',(function(e) {
	calculate_subtotal();
}));

function calculate_total(){
	var aux_prod;
	var total = 0;
	$($(".prod_row")).each(function(index, element){
		aux_prod = JSON.parse($(element).find(".product_json").html());
		total += aux_prod.price * aux_prod.qty;
	});
	
	$("#tb_total").html("S/ " + nf(total));
	$("#pay_total").val(nf(total));
	
	calculate_balance();
}

var row_num = 1;
function add_product(selected){
	var prod = {
		product_id: selected.product_id,
		option_id: selected.option_id,
		price: selected.price,
		qty: selected.qty,
	}
	
	$("#tb_product_list").append('<tr class="prod_row align-middle" id="prod_' + row_num + '"><th scope="row" class="num">' + ($(".prod_row").length + 1) + '</th><td>' + selected.product + '<textarea class="product_json d-none" name="products[]">' + JSON.stringify(prod) + '</textarea></td><td>' + selected.option + '</td><td class="text-nowrap text-end">S/ ' + nf(selected.price) + '</td><td class="text-end">' + nf_int(selected.qty) + '</td><td class="text-nowrap text-end">S/ ' + nf(selected.subtotal) + '</td><td class="text-end"><button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_prod"><i class="bi bi-x-lg"></i></button></td></tr>');
	
	var row_id = "#prod_" + row_num;
	$(row_id).find(".btn_delete_prod").on('click',(function(e) {
		$(row_id).remove();
		$($(".prod_row")).each(function(index, element){
			$(this).find(".num").html(index + 1);
		});
		calculate_total();
	}));
	
	/* calculate total amount to pay */
	calculate_total();
	
	/* next row number for control delete operation */
	row_num++;
	
	/* close select product block and move to top */
	close_select_product();
	move_top();
}

$("#form_select_product").submit(function(e) {
	e.preventDefault();
	
	var selected = ob_from_form("#form_select_product");
	selected.option = $("#form_select_product select[name=option_id] option:selected").text();
	selected.qty = parseInt(nf_reverse(selected.qty));
	selected.price = parseFloat(nf_reverse(selected.price));
	selected.subtotal = selected.qty * selected.price;
	
	if (isNaN(selected.qty)) selected.qty = 0;
	if (isNaN(selected.price)) selected.price = 0;
	
	if (selected.qty > 0){
		if (selected.option_id == ""){
			selected.option = "-";
			Swal.fire({
				title: "¡ " + alert_words[default_lang]["warning"].toUpperCase() + " !",
				icon: "warning",
				html: warning_msg[default_lang]["no_product_option_selected"],
				confirmButtonText: alert_words[default_lang]["confirm"],
				cancelButtonText: alert_words[default_lang]["cancel"],
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) add_product(selected);
			});
		}else add_product(selected);
	}else swal("error", error_msg.sp["qty_no_zero"]);
});

/* register - add purchase */
$("#form_add_purchase").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_purchase", "add_purchase").done(function(res) {
		set_msgs("#form_add_purchase", res.msgs);
		if (res.type == "success") swal_redirection(res.type, res.msg, base_url + b_url + "detail/" + res.purchase_id);
		else swal(res.type, res.msg);
	});
});


////////////////////////////////



$("#btn_cancel_sale").on('click',(function(e) {
	ajax_simple_warning({sale_id: $(this).val()}, b_url + "cancel_sale", "cancel_sale").done(function(res) {
		swal_redirection(res.type, res.msg, res.url);
	});
}));