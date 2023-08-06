$(document).ready(function() {
	$("#send-mail-form").submit(function(e) {
		e.preventDefault();
		var btn = $(this).find("button");
		
		$(".email-result").addClass("d-none");
		$(btn).prop("disabled", true);
		$(btn).html("Enviando...");
		$.ajax({
			url: "./home/send_email",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			processData:false,
			success:function(res){
				if (res == "ok") {
					$(".email-result").addClass("text-success");
					$(".email-result").html("Su mensaje ha sido enviado. Gracias!");
					document.getElementById("send-mail-form").reset();
				}else{
					$(".email-result").addClass("text-danger");
					$(".email-result").html("Ha ocurrido error. Intente nuevamente.");
				}
				$(".email-result").removeClass("d-none");
				$(btn).prop("disabled", false);
				$(btn).html("Enviar Mensaje");
			}
		});
	});
});