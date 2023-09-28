let b_url = "commerce/sale/";

function calculate_change(){
	var total = parseFloat($("#total").val());
	var received =  parseFloat($("#received_txt").val());
	if (isNaN(received) || received <= 0) received = total;
	
	var change = received - total;
	if (change < 0) change = 0;
	
	$("#received_txt").val(nf(received));
	$("#received").val(received);
	
	$("#change_txt").val(nf(change));
	$("#change").val(change);
}

function calculate_amount(){
	var total = 0;
	$($(".prod_row")).each(function(index, element){
		if ($(element).find(".product_json").length > 0 && $(element).find(".stocks_json").length > 0){
			var data = JSON.parse($(element).find(".product_json").html());
			var stocks = JSON.parse($(element).find(".stocks_json").html());
			var option_id = $(element).find(".option_id").val();
			var qty = $(element).find(".ip_qty").val();
			if (qty < 1) qty = 1;
			else if (qty > parseInt(stocks[option_id])){
				qty = stocks[option_id];
				swal("warning", "Disponibilidad: " + qty);
			}
			$(element).find(".ip_qty").val(qty);
			
			var subtotal = qty * data.price;
			$(element).find(".subtotal").html("S/. " + nf(subtotal));
			total = total + subtotal;	
		}
	});
	
	$("#total, #received").val(total);
	$("#total_txt, #received_txt").val(nf(total));
	
	$("#change_txt").val(nf(0));
	$("#change").val(0);
}

var row_num = 1;
function add_product(dom){
	ajax_simple({product_id: $(dom).val()}, b_url + "load_product").done(function(res) {
		/* add doms to row */
		$("#tb_product_list").append('<tr class="prod_row align-middle" id="prod_' + row_num + '"><th class="num" scope="row">' + ($(".prod_row").length + 1) + '<input type="hidden" name="products[' + row_num + '][product_id]" value="' + res.product.product_id + '"></th><td class="product">' + res.product.product + '<div class="product_json d-none">' + JSON.stringify(res.product) + '</div></td><td class="price text-nowrap">S/. ' + nf(res.product.price) + '</td><td class="options"></td><td class="qty"><input type="number" class="form-control ip_qty" name="products[' + row_num + '][qty]" value="1" min="1" style="width: 100px;"></td><td class="subtotal text-nowrap text-end">' + nf(res.product.price) + '</td><td class="text-end"><button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_prod"><i class="bi bi-x-lg"></i></button></td></tr>');
		
		let row_id = "#prod_" + row_num;
		if (res.options.length > 0){
			$(row_id).find(".options").html('<select class="form-select option_id" name="products[' + row_num + '][option_id]" style="width: 150px;"></select>');
			
			var stocks = {};
			var dom_select = $(row_id).find(".option_id");
			$(res.options).each(function(index, element){
				$(dom_select).append('<option value="' + element.option_id + '">' + element.option + ' (' + element.stock + ')</option>');
				stocks[element.option_id] = element.stock;
			});
			$(row_id).find(".options").append('<div class="stocks_json d-none">' + JSON.stringify(stocks) + '</div>');
		}else{
			$(row_id).find(".options").html('<span class="text-nowrap text-danger">No stock</span>');
			$(row_id).find(".qty").html('');
			$(row_id).find(".subtotal").html('');
		}
		
		/* add events */
		$(row_id).find(".ip_qty").on('change',(function(e) {
			calculate_amount();
		}));
		
		$(row_id).find(".option_id").on('change',(function(e) {
			$(this).closest("tr").find(".ip_qty").val(1);
			calculate_amount();
		}));
		
		$(row_id).find(".btn_delete_prod").on('click',(function(e) {
			$(row_id).remove();
			$($(".prod_row")).each(function(index, element){
				$(this).find(".num").html(index + 1);
			});
			calculate_amount();
		}));
		
		/* close modal */
		$("#md_add_product").modal("hide");
		row_num++;
		
		/* calculate amount */
		calculate_amount();
	});
}

function search_product(keyword){
	ajax_simple({keyword: keyword}, b_url + "search_product").done(function(res) {
		$("#search_result").html("");
		if (res.type == "success"){
			$(res.products).each(function(index, element) {
				$("#search_result").append('<button class="list-group-item list-group-item-action btn_add_product" value="' + element.product_id + '"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1 me-3">' + element.product + '</h5><small class="text-nowrap">S/. ' + element.price + '</small></div><p class="mb-1">' + element.category + '</p><small>' + element.code + '</small></button>');
			});
			
			$(".btn_add_product").on('click',(function(e) {
				add_product(this);
			}));
		}else $("#search_result").html(res.msg);
	});
}

$("#received_txt").on('change',(function(e) {
	calculate_change();
}));

$("#btn_search_product").on('click',(function(e) {
	search_product($("#keyword").val());
}));

$("#keyword").on('keyup',(function(e) {
	if (e.key === "Enter") search_product($("#keyword").val());
}));

$("#doc_type_id").on('change',(function(e) {
	$("#doc_number, #client_name").val("");
	if ($("#doc_type_id option:selected").val() == 1){
		$("#doc_number").prop("disabled", true);
		$("#btn_search_person").prop("disabled", true);
		$("#client_name").prop("disabled", true);
	}else{
		$("#doc_number").prop("disabled", false);
		$("#btn_search_person").prop("disabled", false);
		$("#client_name").prop("disabled", false);
	}
}));

function search_person(){
	var data = {doc_type_id: $("#doc_type_id").val(), doc_number: $("#doc_number").val()};
	ajax_simple(data, b_url + "search_person").done(function(res) {
		swal(res.type, res.msg);
		if (res.type == "success") $("#client_name").val(res.person.name);
		else $("#client_name").val("");
	});
}

$("#doc_number").on('keyup',(function(e) {
	if (e.key === "Enter") search_person();
	else $("#client_name").prop("disabled", false);
}));

$("#btn_search_person").on('click',(function(e) {
	search_person();
}));

$("#btn_add_sale").on('click',(function(e) {
	$("#form_add_sale").submit();
}));

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

$(".btn_delete_payment").on('click',(function(e) {
	ajax_simple_warning({payment_id: $(this).val()}, b_url + "delete_payment", "delete_payment").done(function(res) {
		swal_redirection(res.type, res.msg, res.url);
	});
}));

$("#btn_add_payment").on('click',(function(e) {
	$("#form_add_payment").submit();
}));


$("#form_add_payment").submit(function(e) {
	e.preventDefault();
	
	ajax_form_warning(this, b_url + "add_payment", "add_payment").done(function(res) {
		/*
		if (res.type == "success") swal_redirection(res.type, res.msg, base_url + b_url + "detail/" + res.sale_id);
		else{
			set_msgs("#form_add_sale", res.msgs);
			swal(res.type, res.msg);
		}
		*/
	});
});



set_date(".datepicker", null);