$(function(){

	calc();

	$('#calc_plan').on('change', calc);
	$('#inv_amount').bind('change keyup', calc).on('keypress', isNumberKey);

});

function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 45 || charCode > 57))
		return false;
	return true;
}

function calc() {

	var plan = $('#calc_plan').val();
	var amount = $('#inv_amount').val();
	var percent;

		switch (plan) {
		case '1':
			switch (true) {
				case (amount<100):
					percent = 0;
					break;
				case (amount>499):
					percent = 0;
					break;
				case (amount<=100):
					percent = 20;
					break;
				case (amount<=499):
					percent = 20;
					break;

			   default:
					percent = 0;
			}
			break;
			
		case '2':
			switch (true) {
				case (amount<10):
					percent = 0;
					break;
				case (amount>999):
					percent = 0;
					break;
				case (amount<=500):
					percent = 50;
					break;
				case (amount<=999):
					percent = 50;
					break;

			   default:
					percent = 0;
			}
			break;
			
		case '3':
			switch (true) {
				case (amount<1000):
					percent = 80;
					break;
				
				case (amount>=1000):
					percent = 80;
					break;
			   default:
					percent = 0;
			}
			break;
			
		case '4':
			switch (true) {
				case (amount<2000):
					percent = 200;
					break;
				case (amount>=2000):
					percent = 200;
					break;
			   default:
					percent = 0;
			}
			break;
			
			
			
	}

$('#assign_per').text(percent+'%');
	var total = amount*percent/100;
	var result = parseInt(total) + parseInt(amount);
	$('#total_return').text('$'+result.toFixed(2));
	
	if(total <= 0){
		$('#net_profit').text('0.00');
	}else{
		$('#net_profit').text('$'+(total).toFixed(2));
	}
	
	
	

}