let b_url = "commerce/sale/";

set_dates_between("#f_from", "#f_to");
set_search_client_ajax();
btn_card_control("#btn_file_upload", "#btn_close_cfu", "#card_file_upload", "success");
btn_card_control("#btn_open_an", "#btn_close_an", "#card_add_note", "primary");
btn_card_control("#btn_open_ap", "#btn_close_ap", "#card_add_payment", "primary");

/* detail - invoice */
$("#btn_issue_invoice").on('click',(function(e) {
	$("#form_issue_invoice").submit();
}));

$("#form_issue_invoice").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "issue_invoice", "issue_invoice").done(function(res) {
		set_msgs("#form_issue_invoice", res.msgs);
		swal_redirection(res.type, res.msg, window.location.href);
		if (res.type == "success") window.open(res.url, '_blank');
	});
});

$("#btn_send_invoice").on('click',(function(e) {
	ajax_simple_warning({invoice_id: $(this).val()}, b_url + "send_invoice", "send_invoice").done(function(res) {
		set_msgs("#form_issue_invoice", res.msgs);
		swal_redirection(res.type, res.msg, window.location.href);
		if (res.type == "success") window.open(res.url, '_blank');
	});
}));

$("#btn_void_invoice").on('click',(function(e) {
	ajax_simple_warning({invoice_id: $(this).val()}, b_url + "void_invoice", "void_invoice").done(function(res) {
		swal_redirection(res.type, res.msg, window.location.href);
	});
}));

/* detail - file upload */
$("#form_file_upload").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_file", "add_file").done(function(res) {
		set_msgs("#form_file_upload", res.msgs);
		if (res.type == "success") swal_redirection(res.type, res.msg, res.url);
		else swal(res.type, res.msg);
	});
});

$(".btn_delete_file").on('click',(function(e) {
	ajax_simple_warning({file_id: $(this).val()}, b_url + "delete_file", "delete_file").done(function(res) {
		swal_redirection(res.type, res.msg, res.url);
	});
}));

/* detail - payment */
$(".btn_delete_payment").on('click',(function(e) {
	ajax_simple_warning({payment_id: $(this).val()}, b_url + "delete_payment", "delete_payment").done(function(res) {
		swal_redirection(res.type, res.msg, res.url);
	});
}));

$("#form_add_payment").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_payment", "add_payment").done(function(res) {
		set_msgs("#form_add_payment", res.msgs);
		if (res.type == "success") swal_redirection(res.type, res.msg, res.url);
		else swal(res.type, res.msg);
	});
});

/* detail, register - payment amount control */
function calculate_change(){
	var total = parseFloat(nf_reverse($("#pay_total").val()));
	var received =  parseFloat(nf_reverse($("#pay_received").val()));
	if (isNaN(received) || received <= 0) received = 0;
	
	var change = received - total;
	if (change < 0) change = 0;
	
	$("#pay_change").val(nf(change));
	$("#pay_received").val(nf(received));
}

$("#pay_received").on('change',(function(e) {
	calculate_change();
})).on('keyup',(function(e) {
	if (event.which === 13) calculate_change();
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

/* register - product selection */
function close_select_product(){
	$("#card_select_product").addClass("d-none");
	$("#form_select_product").addClass("d-none");
	$("#form_select_product")[0].reset();
	$("#form_search_product input").val("");
	$("#msg_enter_keyword").removeClass("d-none");
	$("#bl_search_result").addClass("d-none");
	move_top();
}

$("#btn_open_select_product").on('click',(function(e) {
	$("#card_select_product").removeClass("d-none");
}));

$(".btn_close_select_product").on('click',(function(e) {
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
			$("#form_select_product input[name=price]").val(nf(res.product.price));
			$("#form_select_product input[name=qty]").val(nf_int(1));
			$("#form_select_product input[name=subtotal]").val(nf(res.product.price));
			
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
	
	calculate_change();
}

var row_num = 1;
function add_product(selected){
	var prod = {
		product_id: selected.product_id,
		option_id: selected.option_id,
		price: selected.price,
		qty: selected.qty,
	}
	
	ajax_simple({prod: prod}, b_url + "check_stock").done(function(res) {
		if (res.type == "success"){
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
		}else swal(res.type, res.msg);
	});
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
	
	if (selected.qty > 0) add_product(selected);
	else swal("error", error_msg.sp["qty_no_zero"]);
});





$("#form_add_sale").submit(function(e) {
	e.preventDefault();
	
	//clean no stock products
	$($(".prod_row")).each(function(index, element){
		if ($(element).find(".option_id").length == 0) $(element).remove();
	});
	
	ajax_form_warning(this, b_url + "add_sale", "add_sale").done(function(res) {
		if (res.type == "success") swal_redirection(res.type, res.msg, base_url + b_url + "detail/" + res.sale_id);
		else{
			set_msgs("#form_add_sale", res.msgs);
			swal(res.type, res.msg);
		}
	});
});

$("#btn_cancel_sale").on('click',(function(e) {
	ajax_simple_warning({sale_id: $(this).val()}, b_url + "cancel_sale", "cancel_sale").done(function(res) {
		swal_redirection(res.type, res.msg, res.url);
	});
}));
