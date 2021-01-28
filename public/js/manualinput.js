$(document).ready(function(){
	$("#purchasevendorcodeid").select2();
	$("#servicesubtypeid").select2();
	$('#invoiceTable').DataTable({
		'lengthChange' : false,
		'search' : false,
		'paging' : false,
		'info' : false,
	});
	$("#invoicecndnno").blur(function(){
		var invoicecndnno = $(this).val();
		if(invoicecndnno!=''){
			var token = $("#token").val();
			$.ajax({
	            type:'POST',
	            url:commonUrl+"/checkDuplicateInvoiceNo",
	            data:{invoicecndnno: invoicecndnno,'_token':token},
	            success:function(output) {
	            	if(output){
	                	$("#invoicecndnno").val('');
	                	$("#error-msg-block-prod").removeClass('dont-display');
	                	$("#error-msg-span-prod").text('This invoicecndnno is already used,please enter another one');
	            	}else{
	          			$("#error-msg-block-prod").addClass('dont-display');
	                	$("#error-msg-span-prod").text('');
	            	}
	            }
	        });
		}
	});
/*	$("#price").blur(function(){
		calculateGrossAmount();
	});
	$("#quantity").blur(function (){
		calculateGrossAmount();
	});
	$("#unitdiscount").blur(function (){
		calculateGrossDiscount();
	});*/
	$(".gstn").change(function (){
		if($(this).val()!=''){
			//checkGSTType();
		}
	});
	$("#companycodegstn").change(function (){
		var companycodegstn = $('#companycodegstn').val();
		if(companycodegstn!=''){
			var token = $("#token").val();
			$.ajax({
	            type:'POST',
	            url:commonUrl+"/getCompanyCodePOS",
	            data:{companycodegstn: companycodegstn,'_token':token},
	            success:function(output) {
	                $("#companycodepos").val(output['state']);
	                $("#companycodegstnno").val(output['gstn']);
	                $("#companyaddress").val(output['address']);

	                checkGSTType();
	            }
	        });
		}
    });
	$("#purchasevendorcodegstn").change(function (){
		var purchasevendorcodegstn = $('#purchasevendorcodegstn').val();
		if(purchasevendorcodegstn!=''){
			var token = $("#token").val();
			$.ajax({
	            type:'POST',
	            url:commonUrl+"/getPurchaseVendorCodePOS",
	            data:{purchasevendorcodegstn: purchasevendorcodegstn,'_token':token},
	            success:function(output) {
	                $("#purchasevendorcodepos").val(output['state']);
	                $("#purchasevendorcodegstnno").val(output['gstn']);
	                $("#vendoraddress").val(output['address']);
	                checkGSTType();
	                $("#spanPOS").text($('#purchasevendorcodegstn').find(":selected").text()).effect("pulsate", {}, 10000);;
	            }
	        });
		}
	});
	$("#companycodeid").change(function (){
		var companycodeid = $("#companycodeid").val();
		if(companycodeid!=''){
			var token = $("#token").val();
			$.ajax({
	            type:'GET',
	            url:commonUrl+"/getCompanyCodeGSTN",
	            data:{'companycodeid':companycodeid},
	            //dataType:'json',
	            success:function(output) {
	            	var html = '<option value="">Select Company Code GSTN</option>';
	                $.each(output, function( key, value ) {
	                    html += '<option value="'+value['id']+'" >'+value['gstn']+'</option>';        
	                });
	                $("#companycodegstn").html(html);
	            }
	        });
		}
	});
	$("#purchasevendorcodeid").change(function (){
		var purchasevendorcodeid = $("#purchasevendorcodeid").val();
		if(purchasevendorcodeid!=''){
			var token = $("#token").val();
			$.ajax({
	            type:'GET',
	            url:commonUrl+"/getPurchaseVendorCodeGSTN",
	            data:{'purchasevendorcodeid':purchasevendorcodeid},
	            //dataType:'json',
	            success:function(output) {
	            	
	            	var html = '<option value="">Select Vendor Location (GSTN)</option>';
	                $.each(output, function( key, value ) {
	                    html += '<option value="'+value['id']+'" >'+ value['poslocation'] + ',' + value['fnstate']['posname'] + '(' + value['gstn'] + ')' +'</option>';        
	                });
	                $("#purchasevendorcodegstn").html(html);            }
	        });
		}
	});
	$( "#hsncode" ).autocomplete({
		source: function( request, response ) {
			var token = $("#token").val();
			$.ajax({
				url:commonUrl+"/getMatchingHSN",
				type: 'post',
				dataType: "json",
				data: {
					hsncode: request.term,
					'_token':token
				},
				success: function( data ) {
					response( data );
				}
			});
		},
		select: function (event, ui) {
			$('#hsncode').val(ui.item.label); // display the selected text
			//$('#selectuser_id').val(ui.item.value); // save selected id to input
			return false;
		}
	});
	// $(".calableField").blur(function (){
	// 	var price = $("#price").val();
	// 	var quantity = $("#quantity").val();
	// 	var unitdiscount = $("#unitdiscount").val();
	// 	var grossamount = price * quantity;
	// 	$("#grossamount").val(grossamount.toFixed(5));
	// 	var grossdiscount = grossamount * unitdiscount / 100;
	// 	var grossamount = $("#grossamount").val();
	// 	var gstrate = $("#gstrate").val();
	// 	$("#grossdiscount").val(grossdiscount.toFixed(5));
	// 	var taxablevalue = grossamount - grossdiscount;
	// 	$("#taxablevalue").val(taxablevalue);
		
	// 	var sgstamount = taxablevalue * gstrate / 200;
	// 	var cgstamount = sgstamount;
	// 	var igstamount = taxablevalue * gstrate / 100;
	// 	var totalinvoiceamount = taxablevalue + igstamount;

	// 	var gsttype = $("#gsttype").val();
	// 	if(!isNaN(sgstamount) && gsttype=='CGST,SGST')
	// 		$("#sgstamount").text(sgstamount.toFixed(5));
	// 	if(!isNaN(cgstamount) && gsttype=='CGST,SGST')
	// 		$("#cgstamount").text(cgstamount.toFixed(5));
	// 	if(!isNaN(igstamount) && gsttype=='IGST')
	// 		$("#igstamount").text(igstamount.toFixed(5));

	// 	if(!isNaN(totalinvoiceamount))
	// 		$("#totalinvoiceamount").text(totalinvoiceamount.toFixed(5));
	// });
});

function calculateGrossAmount() {
	var price = $("#price").val();
	var quantity = $("#quantity").val();
	var grossamount = price * quantity;
	$("#grossamount").val(grossamount);
}
function calculateGrossDiscount() {
	var grossamount = $("#grossamount").val();
	var unitdiscount = $("#unitdiscount").val();
	var grossdiscount = grossamount * unitdiscount / 100;
	$("#grossdiscount").val(grossdiscount);
}
function checkGSTType() {
	var purchasevendorcodepos = $('#purchasevendorcodepos').val();
	var companycodepos = $('#companycodepos').val();
	
	if(purchasevendorcodepos!='' && companycodepos!='') {
		if(companycodepos!=purchasevendorcodepos){
			var gsttype = 'IGST';
		} else {
			var companygst= $('#companycodegstnno').val();
			var purchasegst= $('#purchasevendorcodegstnno').val();
			if(purchasegst!='' && companygst!=''){
				
				if(purchasegst.substring(0, 1) == companygst.substring(0, 1)){
					var gsttype = 'CGST-SGST';
				} else {
					alert('Combination of POS and gst doesnt match!');
					var gsttype = '';
				}
			}
		}
		$(".cls_gsttype").val(gsttype);
		if(gsttype!=''){
			var igstamountfinal = 0;
			var sgstamountfinal = 0;
			var countOfEle = $('input[name*="taxablevalue[]"]').length;
			for (var i = 0; i < countOfEle; i++) {
				if(i==0){
					var taxablevalue = $("#taxablevalue").val();
					var gstrate = $("#gstrate").val();
					var sgstamount = parseFloat(taxablevalue) * parseFloat(gstrate) / 200;
					var igstamount = parseFloat(taxablevalue) * parseFloat(gstrate) / 100;
					
					if(!isNaN(sgstamount) && gsttype=='CGST-SGST'){
						
						$("#sgstamount").text(sgstamount.toFixed(2));
						$("#cgstamount").text(sgstamount.toFixed(2));
						$("#igstamount").text('');
						var totalinvoiceamount = parseFloat(taxablevalue) + (parseFloat(sgstamount) * 2);
						sgstamountfinal = parseFloat(sgstamountfinal) + parseFloat(sgstamount);
					}
					if(!isNaN(igstamount) && gsttype=='IGST'){
						
						$("#sgstamount").text('');
						$("#cgstamount").text('');
						$("#igstamount").text(igstamount.toFixed(2));
						var totalinvoiceamount = parseFloat(taxablevalue) + parseFloat(igstamount);
						igstamountfinal = parseFloat(igstamountfinal) + parseFloat(igstamount);
					}
					if(!isNaN(totalinvoiceamount))
						$("#totalinvoiceamount").text(totalinvoiceamount.toFixed(2));
				}else{
					var taxablevalue = $("#taxablevalue"+i).val();
					var gstrate = $("#gstrate"+i).val();
					var sgstamount = parseFloat(taxablevalue) * parseFloat(gstrate) / 200;
					var igstamount = parseFloat(taxablevalue) * parseFloat(gstrate) / 100;
					
					if(!isNaN(sgstamount) && gsttype=='CGST-SGST'){
						
						$("#sgstamount"+i).text(sgstamount.toFixed(2));
						$("#cgstamount"+i).text(sgstamount.toFixed(2));
						$("#igstamount"+i).text('');
						var totalinvoiceamount = parseFloat(taxablevalue) + (parseFloat(sgstamount) * 2);
						sgstamountfinal = parseFloat(sgstamountfinal) + parseFloat(sgstamount);
					}
					if(!isNaN(igstamount) && gsttype=='IGST'){
						
						$("#sgstamount"+i).text('');
						$("#cgstamount"+i).text('');
						$("#igstamount"+i).text(igstamount.toFixed(2));
						var totalinvoiceamount = parseFloat(taxablevalue) + parseFloat(igstamount);
						igstamountfinal = parseFloat(igstamountfinal) + parseFloat(igstamount);
					}
					if(!isNaN(totalinvoiceamount))
						$("#totalinvoiceamount"+i).text(totalinvoiceamount.toFixed(2));
				}
			}
			if(gsttype=='IGST'){
				$("#igstamountfinal").text(igstamountfinal.toFixed(2));
				$("#sgstamountfinal").text('');
				$("#cgstamountfinal").text('');
			}else{
				$("#igstamountfinal").text('');
				$("#sgstamountfinal").text(sgstamountfinal.toFixed(2));
				$("#cgstamountfinal").text(sgstamountfinal.toFixed(2));
			}
		}
	}
}