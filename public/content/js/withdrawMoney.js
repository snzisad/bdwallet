$('.wallet_id').on('change', function (e) {
		e.preventDefault();
		$gateway = $(this).attr("gateway");
		$position = e.target.selectedIndex;
		$account = JSON.parse($gateway)[$position].account;

		$('.marchant_account').val($account);
	}).trigger('change');

 	//calculate from keystroke
	// document.getElementsByName("amount_send")[0].onkeyup = calculateWalletReceiveAmount;

	$(".amount_send")[0].onkeyup = calculateWalletReceiveAmount;

	$(".btn_withdraw_money").on('click',function(e){
		var send_amount = $(".amount_send").val();
		var receive_amount = $(".amount_receive").val();
		var balance = $('.wallet_balance').text();
		var reserve = $(".gateway_reserve_amount").text();

		if(parseFloat(receive_amount)>parseFloat(reserve)){
			$(".error_panel_message").text("Receive amount cannot be greater than our Reserve");
			$('.error_panel').slideDown();
			return false;
		}
		else if (parseFloat(send_amount) > parseFloat(balance)){
			$(".error_panel_message").text("Send amount cannot be greater than your balance");
			$('.error_panel').slideDown();
			return false;
		}
		else{
			$('.error_panel').slideUp();
			return true;
		}
	});

	//calculate from triggering from selector
    $('.from_wallet_id').on('change',function(e){
		e.preventDefault();
		getWalletDataFromServer();
	}).trigger('change');

	//calculate from triggering to selector box
    $('.to_wallet_id').on('change',function(e){
		e.preventDefault();
		getWalletDataFromServer();
	}).trigger('change');

	function getWalletDataFromServer(){
		$from = $('.from_wallet_id').val();
		$to = $('.to_wallet_id').val();
		$action = $(".withdraw_money_link").attr("action");
		$csrf = $(".csrf_exchange_info").attr("data-token");
		$user_id = $(".user_id").val();

		if(1){
			$.ajax({
			  type: "POST",
			  url: $action,
			  async: false,
			  data: {
		        "from": $from,
		        "to": $to,
				"user_id": $user_id,
		        "_token": $csrf
		      },
		      success: function(data){
				  console.log(data);
				  $('.gateway_reserve_amount').text(data.to_data.reserve);
				  $('.gateway_reserve_amount_type').text(data.to_data.currency.type);
				  $(".amount_send").val(data.rate.from_rate);
				  $('.amount_receive').val(data.rate.to_rate);
				  $('.wallet_balance').text(data.balance);
				  $('.wallet_balance_type').text(data.from_data.currency.type);
				  $('.wallet_exchange_rate_from').text(data.rate.from_rate);
				  $('.wallet_exchange_rate_from_type').text(data.rate.from_gateway.currency.type);
				  $('.wallet_exchange_rate_to').text(data.rate.to_rate);
				  $('.wallet_exchange_rate_to_type').text(data.rate.to_gateway.currency.type);
				  $('.wallet_exchange_rate').val(data.rate.from_rate + " " + data.rate.from_gateway.currency.type + " = " + data.rate.to_rate + " " + data.rate.to_gateway.currency.type);
				},
		      error: function(data){
		        alert('Something went wrong. Please try again');
		      }
			});
		}
	}

	//get balance by triggering from selector
	$('.my_wallet').on('change', function (e) {
		e.preventDefault();
		getWalletBalanceFromServer();
	}).trigger('change');

	function getWalletBalanceFromServer() {
		$wallet = $('.my_wallet').val();
		$action = $(".wallet_balance_link").attr("action");
		$csrf = $(".csrf_exchange_info").attr("data-token");
		$user_id = $(".user_id").val();

		if (1) {
			$.ajax({
				type: "POST",
				url: $action,
				async: false,
				data: {
					"wallet": $wallet,
					"user_id": $user_id,
					"_token": $csrf
				},
				success: function (data) {
					console.log(data.balance);
					$(".my_wallet_balance").val(data.balance);
				},
				error: function (data) {
					alert('Something went wrong. Please try again');
				}
			});
		}
	}

	function calculateWalletReceiveAmount(){
		$from_rate = $('.wallet_exchange_rate_from').text();
		$to_rate = $('.wallet_exchange_rate_to').text();
        $send_amount = $(".amount_send").val();

		$receive_amount = $send_amount*$to_rate/$from_rate;
        $('.amount_receive').val($receive_amount.toFixed(2));

	}
	