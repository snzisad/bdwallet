window.onload = function begin()
{

	$(".got_to_next_step_btn").on('click',function(e){
		var phone = $('.user_phone').val();

		if(phone != "" && $('.user_account').val() != ""){
			$('.phone_number').html(phone);
			$('.order_confirm_panel').slideUp();
			$('.exchange_confirm_panel').slideDown();
			return false;
		}
		return true;
	});

 	//calculate from keystroke
	// document.getElementsByName("send_amount")[0].onkeyup = calculateReceiveAmount;
	$(".send_amount")[0].onkeyup = calculateReceiveAmount;

	$(".btn_exchange_money").on('click',function(e){
		var send_amount = $(".send_amount").val();
		var receive_amount = $(".receive_amount").val();
		var minimum_transfer = $('.minimum_transfer').text();
		var minimum_transfer_type = $('.exchange_rate_from_type').text();
		var reserve = $(".reserve_amount").text();

		if(parseFloat(receive_amount)>parseFloat(reserve)){
			$(".error_panel_message").text("Receive amount cannot be greater than our Reserve");
			$('.error_panel').slideDown();
			return false;
		}
		else if(parseFloat(send_amount)<parseFloat(minimum_transfer)){
			$(".error_panel_message").text("You have to send minimum "+minimum_transfer+" "+minimum_transfer_type);
			$('.error_panel').slideDown();
			return false;
		}
		else{
			$('.error_panel').slideUp();
			return true;
		}
	});


	//calculate from triggering from selector
	$('.from_id').on('change',function(e){
		e.preventDefault();
		getExchangeDataFromServer();
	}).trigger('change');

	//calculate from triggering to selector box
	$('.to_id').on('change',function(e){
		e.preventDefault();
		getExchangeDataFromServer();
	}).trigger('change');

	function getExchangeDataFromServer(){
		$from = $('.from_id').val();
		$to = $('.to_id').val();
		$action=$(".exchange_money_info").attr("action");
		$csrf = $(".csrf_exchange_info").attr("data-token");

		if(1){
			$.ajax({
			  type: "POST",
			  url: $action,
			  async: false,
			  data: {
		        "from": $from,
		        "to": $to,
		        "_token": $csrf
		      },
		      success: function(data){
				  console.log(data.rate.from_gateway.currency.type);
				  	$('.from_image').attr('src', '/picture/icon/'+data.from_data.icon);
			      	$('.to_image').attr('src', '/picture/icon/'+data.to_data.icon);
			      	$('.reserve_amount').text(data.to_data.reserve);
				  	$('.reserve_amount_type').text(data.to_data.currency.type);
			      	$(".send_amount").val(data.rate.from_rate);
					$('.receive_amount').val(data.rate.to_rate);
				 	$('.exchange_rate_from').text(data.rate.from_rate);
				  	$('.exchange_rate_from_type').text(data.rate.from_gateway.currency.type);
					$('.exchange_rate_to').text(data.rate.to_rate);
				  	$('.exchange_rate_to_type').text(data.rate.to_gateway.currency.type);
					$('.minimum_transfer').text(data.rate.minimum_transfer);
				  	$('.exchange_rate').val(data.rate.from_rate + " " + data.rate.from_gateway.currency.type + " = " + data.rate.to_rate + " " + data.rate.to_gateway.currency.type);
				},
		      error: function(data){
		        alert('Something went wrong. Please try again');
		      }
			});
		}
	}

	function calculateReceiveAmount(){
		$from_rate = $('.exchange_rate_from').text();
		$to_rate = $('.exchange_rate_to').text();
		$send_amount = $(".send_amount").val();

		$receive_amount = $send_amount*$to_rate/$from_rate;
		$('.receive_amount').val($receive_amount.toFixed(2));

	}
}