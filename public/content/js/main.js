
$(function () {
 	$('.edit-notice-button').on('click',function(e){
 		var notice=$(this).parent().parent().parent().children("p");
 		
 		$('#notice-text-textarea').text(notice.text());
 		$('#display-field').val("0");
 		$('#id-field').val(notice.attr('notice-id'));

 		return true;
 	})

 	$('.edit-current-notice-button').on('click',function(e){
 		var notice=$('.current-notice-text').text();
 		
 		$('#notice-text-textarea').text(notice);
 		$('#display').val("1");

 		return true;
 	})

 	$('#catagory-selection').on('change',function(e){
 		var value=$(this).val();
 		if(value=='add-catagory')
 			$('#new-catagory-modal').modal('toggle');
 	});

 	$('#collect-fee-button').on('click',function(e){
 	    
	    $action=$("#fee-collection-form").attr('action');
	    $csrf=$("#token_field").data('token');
	    $student_id=$("#student_id").val();
	    $catagory=$("#catagory-selection").val();
	    $amount=$("#fee_amount").val();

	    if(!$student_id){
	    	alert('Enter Student ID');
	    	return false;
	    }
	    else if(!$catagory){
	    	alert('Select a catagory');
	    	return false;
	    }
	    else if(!$amount){
	    	alert('Enter amount');
	    	return false;
	    }
	    
 		$('#collect-fee-button').hide();
 		$('#loading-spinner').show();
 		$('#success-text').hide();
 		$('#error-text').hide();


	    $.ajax({
	      url: $action,
	      type: 'POST',
	      async: false,
	      data: {
	        "student_id": $student_id,
	        "catagory": $catagory,
	        "amount": $amount,
	        "_token" : $csrf
	      },

	      success: function(data){
	      	data=data.message;

	      	if(data=='Success'){
		        $('#loading-spinner').hide();
		        $("#student_id").val('');
	 			$('#success-text').show().delay(1000).hide(0);
	 			$('#collect-fee-button').delay(1000).show(0);
	      	}
	      	else{
	      		$('#loading-spinner').hide();
	      		$('#catagory_error').show();
 				$('#error-text').show().delay(1000).hide(0);
 				$('#collect-fee-button').delay(1000).show(0)
	      	}

	      },

	      error: function(data){
	      	$('#loading-spinner').hide();
 			$('#error-text').show().delay(1000).hide(0);
 			$('#collect-fee-button').delay(1000).show(0);
	      }
	    });

 		return false;
 	})

});

function readLogoURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
		console.log(e.target.result);
            $('#uploaded-logo').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


