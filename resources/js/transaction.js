$( document ).ready(function() {
	$('button.btn.addtocart').click(function(){
		prod_id = $(this).attr('data-prodid');
		$.ajax({
			url: base_url+'/transaction/addToCartPage',
			method: 'POST',
			data: {	prod_id: prod_id,
					'_token': $('meta[name="csrf-token"]').attr('content')},
			beforeSend: function(){
				$('div.modal-body > div#prdGalleryModal').parent().html('');
				$('div#modalQuickView div.modal-content div.loader-wrap').removeClass('cd-hidden');
			},
			success: function(data){
				$('div#modalQuickView div.modal-content div.loader-wrap').addClass('cd-hidden');
				$('div#modalQuickView .modal-body').html(data);

				$('div.product-quickview-carousel').not('.slick-initialized').slick({
					infinite: true,
				  	slidesToShow: 4,
				  	slidesToScroll: 4
				});

				/*
				var picker = new Lightpick({ 	field: document.getElementById('datepicker'),
												singleDate: false,
												minDate: moment(),
											    maxDate: moment().add(7,'d'),
											    format: 'D MMM'
											}); */
				$('button#doAddToCart').click(function(){
					button = $(this);
					qty = $('input[name="qty_sewa"]').val();
					$.ajax({
						url: base_url+'/transaction/doAddToCart',
						method: 'POST',
						data: {	prod_id: prod_id,
								qty: qty,
								'_token': $('meta[name="csrf-token"]').attr('content')},
						beforeSend: function(){
							button.addClass('cd-hidden');
							button.parent().find('div.loader-wrap').removeClass('cd-hidden');
						},
						success: function(data){
							$('div#alert_cart').html(data.text);
							$('div#alert_cart').removeClass('alert-danger').removeClass('alert-success');
							$('div#alert_cart').addClass('alert-'+data.res);
							$('div#alert_cart').parent().removeClass('cd-hidden');
							$('span.minicart-qty').html(data.count_cart);
							button.removeClass('cd-hidden');
							button.parent().find('div.loader-wrap').addClass('cd-hidden');
						}
					});
				});
			}
		});
	});

	$('button.btn.btn-addreview').click(function(){
		reff_no = $(this).attr('data-reff_no');
		$.ajax({
			url: base_url+'/transaction/addReviewPage',
			method: 'POST',
			data: {	reff_no: reff_no,
					'_token': $('meta[name="csrf-token"]').attr('content')},
			beforeSend: function(){
				$('div.modal-body > div#prdGalleryModal').parent().html('');
				$('div#modalQuickView div.modal-content div.loader-wrap').removeClass('cd-hidden');
			},
			success: function(data){
				$('div#modalQuickView div.modal-content div.loader-wrap').addClass('cd-hidden');
				$('div#modalQuickView .modal-body').html(data);
			}
		});
	});

	$('div.cart-table-prd-owner-profile input[name="owner_id"]').click(function(){
		if($(this).parents().eq(1).hasClass('active') == false){
			$('div.cart-table-prd-owner-profile').removeClass('active');
			$(this).parents().eq(1).addClass('active');
			owner_id = $(this).attr('data-owner-id');
			updateCartPrice();
			
			//console.log(arr_qty);
		}
	});

	$('input[name="duration"]').siblings().click(function(){
		setTimeout(function(){
			owner_id = $('div.cart-table-prd-owner-profile.active input[type="radio"]').attr('data-owner-id');
			updateCartPrice();
		},100);
	});

	$('input#prod_qty').siblings().click(function(){
		selector = $(this);
		setTimeout(function(){
			//alert(selector.siblings('input[name="prod_stock"]').val());

			is_active = selector.parents().eq(3).prevAll('.cart-table-prd-owner-profile:first').hasClass('active');
			//console.log(selector.parents().eq(3).prevAll('.cart-table-prd-owner-profile').html());
			//console.log(selector.parents().eq(3).prevAll('.cart-table-prd-owner-profile:first').html());
			//console.log(is_active);
			if(is_active == true){
				owner_id = selector.parent().find('input#prod_qty').attr('data-owner-id');
				updateCartPrice();
			}
		},100);
	});

	$('div.cart-table-prd-action a.icon-cross').click(function(e){
		e.preventDefault();
	});

	$('a#confirm-delete-cartproduct').on('shown.bs.popover', function () {
		prod_id_real = $(this).attr('data-prod-id');
		owner_id_real = $(this).attr('data-owner-id');
		$('div.popover .btn-confirm-delete').click(function(){
			//e.preventDefault();
			prod_id = $(this).attr('data-prod-id');
			//owner_id= $('div.cart-table-prd-owner-profile.active input[type="radio"]').attr('data-owner-id');
			$.ajax({
				url: base_url+'/transaction/deleteCartProduct',
				method: 'POST',
				data: {	prod_id: prod_id,
						'_token': $('meta[name="csrf-token"]').attr('content')},
				beforeSend: function(){

				},
				success: function(data){
					length = $('div.cart-table-prd[data-owner-id="'+owner_id_real+'"]').length;
					//console.log($('div.cart-table-prd[data-prod-id="'+prod_id_real+'"]').html());
					$('div.cart-table-prd[data-prod-id="'+prod_id_real+'"]').remove();
					$('span.minicart-qty').html(data.count_cart);
					if(length == 1) $('div.cart-table-prd-owner-profile[data-owner-id="'+owner_id_real+'"]').remove();
					if($('div.cart-table-prd-owner-profile.active').length == 0){
						$('div.cart-table-prd-owner-profile:first').addClass('active');
						$('div.cart-table-prd-owner-profile:first input[type="radio"]').prop("checked", true);
					}
					updateCartPrice();
				}
			});
		});
	});

	$('div.radio input[type="radio"][name="ship_courier"]').click(function(){
		val = $('div.radio input[type="radio"]:checked').parents().eq(2).find('select[name="ship_service_name"]').val();
		updateCheckoutPrice();
	});

	$('select[name="ship_service_name"]').change(function(){
		if($(this).parents().eq(1).find('input[name="ship_courier"]').is(':checked')) updateCheckoutPrice();
	});

	$('select[name="shipment_method"]').change(function(){
		updateCheckoutPrice();
		if($(this).val()=='2'){
			$('div#courier_container').parent().removeClass('cd-hidden');
		} else {
			$('div#courier_container').parent().addClass('cd-hidden');
			//$('input[type="radio"][name="ship_courier"]').prop('checked', false);
		}
	});

	$('button#payRent').click(function(){
		payRent();
	});

	//payRent();
	unhideNomorResi();

	$('select#updatestat_transaksi').change(function(){
		unhideNomorResi();
	});
});

function unhideNomorResi(){
	//console.log($('select#updatestat_transaksi option:selected').html());
	if($('select#updatestat_transaksi option:selected').html()=='DIKIRIM' || $('select#updatestat_transaksi option:selected').html()=='DIKIRIM KEMBALI'){
		$('div#container_nomor_resi').removeClass('cd-hidden');

	}
	else $('div#container_nomor_resi').addClass('cd-hidden');
}

function updateCartPrice(){
	arr_qty = [];
	
	owner_id= $('div.cart-table-prd-owner-profile.active input[type="radio"]').attr('data-owner-id');
	durasi = $('input[name="duration"]').val();
	$('input#prod_qty[data-owner-id="'+owner_id+'"]').each(function(){
		arr_qty.push(	{'prod_id': $(this).attr('data-prod-id'),
						'qty': $(this).val()});
	});
	$.ajax({
		url: base_url+'/transaction/countCartPrice',
		method: 'POST',
		data: {	owner_id: owner_id,
				arr_qty: arr_qty,
				durasi: durasi,
				'_token': $('meta[name="csrf-token"]').attr('content')},
		beforeSend: function(){
			//button.addClass('cd-hidden');
			//button.parent().find('div.loader-wrap').removeClass('cd-hidden');
			$('span#subtotal').html('');
			$('td#price').html('');
			$('td#service_charge').html('');
			$('span#subtotal').siblings('.loader-wrap').removeClass('cd-hidden');
		},
		success: function(data){
			$('span#subtotal').siblings('.loader-wrap').addClass('cd-hidden');
			$('td#price').html(data.price);
			$('td#service_charge').html(data.service_charge);
			$('span#subtotal').html(data.subtotal);

			$('form#formCheckout input[name="owner_id"]').val(data.enc_owner_id);
		}
	});
}

function updateCheckoutPrice(){
	reff_no = $('div#container_checkout input[name="reff_no"]').val();
	ship_method = $('select[name="shipment_method"]').val();
	if(ship_method == '2'){
		ship_service_name = $('div.radio input[type="radio"]:checked').parents().eq(1).find('select[name="ship_service_name"]').val();
		$('div#panel-with-deposit').removeClass('cd-hidden');
		$('div#panel-without-deposit').addClass('cd-hidden');
	}
	else {
		ship_service_name = false;
		$('div#panel-with-deposit').addClass('cd-hidden');
		$('div#panel-without-deposit').removeClass('cd-hidden');
	}

	$.ajax({
		url : base_url+'/transaction/cekCheckoutPrice',
		method : 'POST',
		data : {reff_no: reff_no,
				ship_service_name:ship_service_name,
				'_token': $('meta[name="csrf-token"]').attr('content')},
		beforeSend : function(){
			$('div#loader-wrap-grandtotal').removeClass('cd-hidden');
			$('span.card-ship-price').html('');
			$('span.card-deposit-price').html('');
			$('span.card-total-price').html('');
		},
		success : function(data){
			console.log(data);
			$('div#loader-wrap-grandtotal').addClass('cd-hidden');
			$('span.card-ship-price').html(data.ship_price);
			$('span.card-deposit-price').html(data.tx_deposit);
			$('span.card-total-price').html(data.total_price);
			$('span#grand_total').html(data.total_price);

			if(ship_method=='2'){
				$('span#container_deposit_value').html(data.tx_deposit);
			}
		}
	});
}

function payRent(){
	reff_no = $('div#container_checkout input[name="reff_no"]').val();
	ship_method = $('select[name="shipment_method"]').val();

	if(ship_method == '2'){
		ship_service_name = $('div.radio input[type="radio"]:checked').parents().eq(1).find('select[name="ship_service_name"]').val();
		ship_courier = $('div.radio input[type="radio"]:checked').val();
	}
	else {
		ship_service_name = false;
		ship_courier = false;
	}

	$.ajax({
		url : base_url+'/transaction/payRent',
		method : 'POST',
		data : {reff_no: reff_no,
				ship_service_name:ship_service_name,
				ship_courier: ship_courier,
				'_token': $('meta[name="csrf-token"]').attr('content')},
		beforeSend : function(){
			$('button#payRent span').addClass('cd-hidden');
			$('button#payRent div#loader-wrap-payrent').removeClass('cd-hidden');
		},
		success : function(data){
			console.log(data);
			if(data.is_paid==false){
				snap.pay(data.snap_token,{
					onSuccess: function(result){
						console.log('success');
						console.log(result);
			            //document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
			          	window.location.replace(base_url+'/transaction/finishPayment?order_id='+result.order_id+
			          		'&gross_amount='+result.gross_amount+'&transaction_time='+result.transaction_time+'&status_message='+result.status_message+
			          		'&payment_type='+result.payment_type+'&transaction_id='+result.transaction_id+'&transaction_status='+result.transaction_status+
			          		'&fraud_status='+result.fraud_status+'&ship_service_name='+ship_service_name+'&ship_courier='+ship_courier);
			          
			          },
			          // Optional
			          onPending: function(result){
			            //document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
			          	
						console.log('pending');
						window.location.replace(base_url+'/transaction/finishPayment?order_id='+result.order_id+
			          		'&gross_amount='+result.gross_amount+'&transaction_time='+result.transaction_time+'&status_message='+result.status_message+
			          		'&payment_type='+result.payment_type+'&transaction_id='+result.transaction_id+'&transaction_status='+result.transaction_status+
			          		'&fraud_status='+result.fraud_status+'&ship_service_name='+ship_service_name+'&ship_courier='+ship_courier);

						},
			          // Optional
			          onError: function(result){
			            //document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
			          	console.log('error');
						window.location.replace(base_url+'/transaction/finishPayment?order_id='+result.order_id+
			          		'&gross_amount='+result.gross_amount+'&transaction_time='+result.transaction_time+'&status_message='+result.status_message+
			          		'&payment_type='+result.payment_type+'&transaction_id='+result.transaction_id+'&transaction_status='+result.transaction_status+
			          		'&fraud_status='+result.fraud_status+'&ship_service_name='+ship_service_name+'&ship_courier='+ship_courier);
			          }
				});
			} else window.location.replace(base_url+'/transaction/details?reff_no='+data.reff_no+'&step=step4');
			/*
			var payButton = document.getElementById('payRent');
		      payButton.addEventListener('click', function () {
		        snap.pay(data); // store your snap token here
		      });*/
			$('button#payRent span').removeClass('cd-hidden');
			$('button#payRent div#loader-wrap-payrent').addClass('cd-hidden');
		},
		done : function(){
			$('button#payRent span').removeClass('cd-hidden');
			$('button#payRent div#loader-wrap-payrent').addClass('cd-hidden');
		}
	});
}