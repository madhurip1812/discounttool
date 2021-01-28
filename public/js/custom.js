$( ".datepicker" ).datepicker();
$( ".format-number" ).maskNumber();
//$('.format-number').inputmask('decimal');
$('.format-number1').mask('000,000,000,000,000.00', {reverse: true});
$(document).ready(function(){
	$(".main-menu").on('click',function () {
		$(this).find('.fa').toggleClass('fa fa-chevron-right fa fa-chevron-down');
	});
	$(".reset").click(function () {
		console.log(22);
		$('.form-control').val('');
	});
	$(".close").click(function(){
		$(this).parent().hide();
	});
	$(".editCompanyCodeGSTN").click(function(){
		var arrid = this.id.split('gstn');
		var id= arrid[1];
		var token = $("#token").val();
		$.ajax({
            type:'POST',
            url:commonUrl+"/companyCodeDetails",
            data:{'companyCodeGSTId':id,'_token':token},
            //dataType:'json',
            success:function(output) {
                //$('#overlay').fadeOut();
                if(output){
                    $(".addGSTN").html(output.html);
                    $(".AddCompanyCodeGSTN").show('slow');
                }
            }
        });
	});
	$("#add_more_details").click(function(){
		var count = $(".purchaseDetailsDiv").length;
		var ctt = count-1;
		var newElement = $("#purchasedetails0").clone();
		newElement.attr('id','purchasedetails'+count);
		newElement.find('#gstn0').attr('id','gstn'+count);
		newElement.find('#pos0').attr('id','pos'+count);
		newElement.find('#address0').attr('id','address'+count);
		newElement.find('#location0').attr('id','location'+count);
		newElement.find('#state0').attr('id','state'+count);
		newElement.find('#pincode0').attr('id','pincode'+count);
		$("#purchasedetails"+ctt).after(newElement);
		console.log(count,ctt,newElement);
	});
	$(".companyCodeGSTTable").on("click",".btn-add-company-gstn",function(){
		var token = $("#token").val();
		var companyCodeId = $("#companyCodeId").val();
		$.ajax({
            type:'POST',
            url:commonUrl+"/companyCodeDetails",
            data:{'companyCodeId':companyCodeId,'_token':token},
            //dataType:'json',
            success:function(output) {
                //$('#overlay').fadeOut();
                if(output){
                    $(".addGSTN").html(output.html);
                    $(".AddCompanyCodeGSTN").show('slow');
                }
            }
        });
	});
});

//unset add manual input form
// window.onbeforeunload = function() { 
//  let manualForm = document.getElementById('addManualInputForm');
//  if(manualForm != null) {
//  	manualForm.reset();
//  }
// };

var i = $("#numberOfDetails").val();
function duplicate() { 
	event.preventDefault();
	let original = document.getElementById("panel");
	let clone = original.cloneNode(true);
	clone.id = "panel" + (++i);
	original.parentNode.appendChild(clone);
	let elements = document.getElementById("panel" + i).querySelectorAll('input,span,label,textarea');
	//console.log(elements);
	Array.from(elements).forEach( (ele)=> {
      ele.id = ele.id + i;
      ele.value = "";
      if(ele.id == "unit" + i) $("#"+ele.id).val("number");
      if(ele.id == "gsttype" + i) $("#"+ele.id).val($("#gsttype").val());
      $("#"+ele.id).attr("for",$("#"+ele.id).attr("for") + i);
      if(ele.id == "price"+i || ele.id == "quantity"+i || ele.id == "unitdiscount"+i || ele.id == "gstrate"+i || ele.id == "tcsrate"+i) {
      	$("#"+ele.id).removeClass("calableField").addClass("calableField"+i);
      	//console.log('yes');
      }
      if(ele.id == "sgstamount"+i || ele.id == "cgstamount"+i || ele.id == "igstamount"+i || ele.id == "totalinvoiceamount"+i || ele.id == "tcsamount"+i) {
      	document.getElementById(ele.id).textContent = '';
      }
	});
   
 //    let minusEle = `<div class="row"><div class='col-md-12'>
 //    <button type="button" class="btn btn-sm btn-danger pull-right minus" onclick="remove('panel${i}');" style="margin-right: -25px;margin-top: -13px;"></button>
	// </div></div>`;

	// $("#panel" + i).prepend(minusEle);
	$(document).on('blur','.calableField'+i,function() {
			console.log('.calableField-INFUN',i,'--');
		    let sgstamountfinal = 0;
		    let cgstamountfinal = 0;
		    let igstamountfinal = 0;
		    let totalinvoiceamountfinal = 0;
            let gsttype = '';
            let dgrossamount = '';
            let dgrossdiscount = '';

		    let sgstamountoriginal = parseFloat($("#sgstamount").text());
			let cgstamountoriginal = parseFloat($("#cgstamount").text());
			let igstamountoriginal = parseFloat($("#igstamount").text());
			let totalinvoiceamountoriginal = parseFloat($("#totalinvoiceamount").text());

	    	for(let j = 1; j <= i; j++ ) {
	          	let dprice = $("#price"+j).val();
				let dquantity = $("#quantity"+j).val();
				let dunitdiscount = $("#unitdiscount"+j).val();

                if(dquantity == "") dgrossamount = parseFloat(dprice);
                else dgrossamount = dprice * dquantity;
				//let dgrossamount = dprice * dquantity;
				$("#grossamount"+j).val(dgrossamount.toFixed(2));

				if(dunitdiscount == "") dgrossdiscount = 0;
				else dgrossdiscount = dgrossamount * dunitdiscount / 100;

				let dgstrate = $("#gstrate"+j).val();
				$("#grossdiscount"+j).val(dgrossdiscount.toFixed(2));

				let tcstrate = $("#tcsrate"+j).val();

				let dtaxablevalue = dgrossamount - dgrossdiscount;
		        $("#taxablevalue"+j).val(dtaxablevalue.toFixed(2));

		        let tcsAmount = dtaxablevalue * (tcstrate/100);
		        tcsAmount = isNaN(tcsAmount) ? 0 : tcsAmount;
		        let dsgstamount = dtaxablevalue * dgstrate / 200;
				let dcgstamount = dsgstamount;
				let digstamount = dtaxablevalue * dgstrate / 100;
				let dtotalinvoiceamount = isNaN(digstamount) ? (dtaxablevalue + dcgstamount + dsgstamount + tcsAmount) : (dtaxablevalue + digstamount + tcsAmount);

				let dgsttype = $("#gsttype"+j).val();
				if(j == 1) {
				   gsttype = $("#gsttype"+j).val();
				}

				if(!isNaN(dsgstamount) && dgsttype=='CGST-SGST')
					$("#sgstamount"+j).text(dsgstamount.toFixed(2));
				if(!isNaN(dcgstamount) && dgsttype=='CGST-SGST')
					$("#cgstamount"+j).text(dcgstamount.toFixed(2));
				if(!isNaN(digstamount) && dgsttype=='IGST')
					$("#igstamount"+j).text(digstamount.toFixed(2));

				if(!isNaN(tcsAmount))
				$("#tcsamount"+j).text(tcsAmount.toFixed(2));

				if(!isNaN(dtotalinvoiceamount))
				$("#totalinvoiceamount"+j).text(dtotalinvoiceamount.toFixed(2));

			    sgstamountfinal += dsgstamount;
			    cgstamountfinal += dcgstamount;
			    igstamountfinal += digstamount;
			    totalinvoiceamountfinal += dtotalinvoiceamount;

	    	}
            if(gsttype=='CGST-SGST') {
            	$("#sgstamountfinal").text( isNaN(sgstamountoriginal) ? sgstamountfinal.toFixed(2) : (sgstamountoriginal + sgstamountfinal).toFixed(2) );
            	$("#cgstamountfinal").text( (cgstamountoriginal + cgstamountfinal).toFixed(2));
			}	
			
			if(gsttype=='IGST') $("#igstamountfinal").text( isNaN(igstamountoriginal) ? igstamountfinal.toFixed(2) : (igstamountoriginal + igstamountfinal).toFixed(2));
			
			$("#totalinvoiceamountfinal").text( isNaN(totalinvoiceamountoriginal) ? totalinvoiceamountfinal.toFixed(2) : (totalinvoiceamountoriginal + totalinvoiceamountfinal).toFixed(2));
	    	
	});

	for(let j = 1; j <= i; j++) {
       	$( "#hsncode" + j).autocomplete({
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
				$('#hsncode' + j).val(ui.item.label); // display the selected text
				//$('#selectuser_id').val(ui.item.value); // save selected id to input
				return false;
			}
		});
	}
 

}

/**/
$(document).on('blur','.calableField'+i,function() {
			console.log('.calableField',i,'--');
		    let sgstamountfinal = 0;
		    let cgstamountfinal = 0;
		    let igstamountfinal = 0;
		    let totalinvoiceamountfinal = 0;
            let gsttype = '';
            let dgrossamount = '';
            let dgrossdiscount = '';

		    let sgstamountoriginal = parseFloat($("#sgstamount").text());
			let cgstamountoriginal = parseFloat($("#cgstamount").text());
			let igstamountoriginal = parseFloat($("#igstamount").text());
			let totalinvoiceamountoriginal = parseFloat($("#totalinvoiceamount").text());

	    	for(let j = 1; j <= i; j++ ) {
	          	let dprice = $("#price"+j).val();
				let dquantity = $("#quantity"+j).val();
				let dunitdiscount = $("#unitdiscount"+j).val();

                if(dquantity == "") dgrossamount = parseFloat(dprice);
                else dgrossamount = dprice * dquantity;
				//let dgrossamount = dprice * dquantity;
				$("#grossamount"+j).val(dgrossamount.toFixed(2));

				if(dunitdiscount == "") dgrossdiscount = 0;
				else dgrossdiscount = dgrossamount * dunitdiscount / 100;

				let dgstrate = $("#gstrate"+j).val();
				$("#grossdiscount"+j).val(dgrossdiscount.toFixed(2));

				let tcstrate = $("#tcsrate"+j).val();

				let dtaxablevalue = dgrossamount - dgrossdiscount;
		        $("#taxablevalue"+j).val(dtaxablevalue.toFixed(2));

		        let tcsAmount = dtaxablevalue * (tcstrate/100);
		        tcsAmount = isNaN(tcsAmount) ? 0 : tcsAmount;
		        let dsgstamount = dtaxablevalue * dgstrate / 200;
				let dcgstamount = dsgstamount;
				let digstamount = dtaxablevalue * dgstrate / 100;
				let dtotalinvoiceamount = isNaN(digstamount) ? (dtaxablevalue + dcgstamount + dsgstamount + tcsAmount) : (dtaxablevalue + digstamount + tcsAmount);

				let dgsttype = $("#gsttype"+j).val();
				if(j == 1) {
				   gsttype = $("#gsttype"+j).val();
				}

				if(!isNaN(dsgstamount) && dgsttype=='CGST-SGST')
					$("#sgstamount"+j).text(dsgstamount.toFixed(2));
				if(!isNaN(dcgstamount) && dgsttype=='CGST-SGST')
					$("#cgstamount"+j).text(dcgstamount.toFixed(2));
				if(!isNaN(digstamount) && dgsttype=='IGST')
					$("#igstamount"+j).text(digstamount.toFixed(2));

				if(!isNaN(tcsAmount))
				$("#tcsamount"+j).text(tcsAmount.toFixed(2));

				if(!isNaN(dtotalinvoiceamount))
				$("#totalinvoiceamount"+j).text(dtotalinvoiceamount.toFixed(2));

			    sgstamountfinal += dsgstamount;
			    cgstamountfinal += dcgstamount;
			    igstamountfinal += digstamount;
			    totalinvoiceamountfinal += dtotalinvoiceamount;

	    	}
            if(gsttype=='CGST-SGST') {
            	$("#sgstamountfinal").text( isNaN(sgstamountoriginal) ? sgstamountfinal.toFixed(2) : (sgstamountoriginal + sgstamountfinal).toFixed(2) );
            	$("#cgstamountfinal").text( (cgstamountoriginal + cgstamountfinal).toFixed(2));
			}	
			
			if(gsttype=='IGST') $("#igstamountfinal").text( isNaN(igstamountoriginal) ? igstamountfinal.toFixed(2) : (igstamountoriginal + igstamountfinal).toFixed(2));
			
			$("#totalinvoiceamountfinal").text( isNaN(totalinvoiceamountoriginal) ? totalinvoiceamountfinal.toFixed(2) : (totalinvoiceamountoriginal + totalinvoiceamountfinal).toFixed(2));
	    	
	});
/**/


function remove(panelId) {
 document.getElementById(panelId).remove();
 --i;
}
/**
	Generate Invoice / PDF Code
**/
function genetatepdf(invoiceNo,documentType){
	var token = $("input[name=_token]").val();

	$.ajax({
        type:'POST',
        url:commonUrl+"/generatepdf",
        data:{'invoiceNo':invoiceNo,'documentType':documentType,'_token':token},
        success:function(output) {
        	if(output==false){
        		alert('Failed to generate pdf');
        		return;
        	}
            window.open(output,'_blank');
        }
    });
}

function generateManualInvoice(){
	let flag = confirm("Kindly verify the data before generating the invoice. This is irreversible transaction. Are you sure, you want to continue?");
	if(flag) {
	var token = $("input[name=_token]").val();
	var invoiceNo = $("#txt-inv-hid-val").val();
	// alert('hi');
	$.ajax({
        type:'POST',
        url:commonUrl+"/generateManualInvoice",
        data:{'invoiceNo':invoiceNo,'_token':token},
        success:function(output) {
            if(output===true || output==1){
            	$("#generate-manual-inv-btn").addClass('hide-generate-btn');
            	alert('success');
            }else{
            	alert(output);
            }
        }
    });
   }
}
/**
	Generate Invoice / PDF Code End
**/
$(document).on('blur','.calableField',function () { 
	let sgstamountfinal = 0;
	let cgstamountfinal = 0;
	let igstamountfinal = 0;
	let totalinvoiceamountfinal = 0;
    let grossdiscount = '';

	var price = $("#price").val();
	var quantity = $("#quantity").val();
	var unitdiscount = $("#unitdiscount").val();
    let grossamount = '';
	//var grossamount = price * quantity;
	if(quantity == "") grossamount = parseFloat(price);
    else grossamount = price * quantity;
	$("#grossamount").val(grossamount.toFixed(2));

	if(unitdiscount == "") grossdiscount = 0;
	else grossdiscount = grossamount * unitdiscount / 100;
	
	var gstrate = $("#gstrate").val();
	$("#grossdiscount").val(grossdiscount.toFixed(2));

	var tcsrate = $("#tcsrate").val();

	var taxablevalue = grossamount - grossdiscount;
	$("#taxablevalue").val(taxablevalue.toFixed(2));
	
	var tcsAmount = taxablevalue * (tcsrate / 100);
	tcsAmount = isNaN(tcsAmount) ? 0 : tcsAmount;
	var sgstamount = taxablevalue * gstrate / 200;
	var cgstamount = sgstamount;
	var igstamount = taxablevalue * gstrate / 100;
	var totalinvoiceamount = isNaN(igstamount) ? (taxablevalue + cgstamount + sgstamount + tcsAmount) : (taxablevalue + igstamount + tcsAmount);

	var gsttype = $("#gsttype").val();

	if(!isNaN(sgstamount) && gsttype=='CGST-SGST') {
       $("#sgstamount").text(sgstamount.toFixed(2));
       $("#sgstamountfinal").text(sgstamount.toFixed(2));
	}
		
	
	if(!isNaN(cgstamount) && gsttype=='CGST-SGST') {
       $("#cgstamount").text(cgstamount.toFixed(2));
       $("#cgstamountfinal").text(cgstamount.toFixed(2));
	}
		
	
	if(!isNaN(igstamount) && gsttype=='IGST') {
       $("#igstamount").text(igstamount.toFixed(2));
       $("#igstamountfinal").text(igstamount.toFixed(2));
	}
	
	if(!isNaN(tcsAmount)){
		$("#tcsamount").text(tcsAmount.toFixed(2));
	}

	if(!isNaN(totalinvoiceamount)) {
	   	$("#totalinvoiceamount").text(totalinvoiceamount.toFixed(2));
	   	var countOfEle = $('.totalinvoiceamount').length;
	   	totalinvoiceamountfinal = totalinvoiceamount;
	   	for (var i = 1; i < countOfEle; i++) {
	   		var tia = $("#totalinvoiceamount"+i).text();
	   		totalinvoiceamountfinal += parseFloat(tia);
	   	}
	   	$("#totalinvoiceamountfinal").text(totalinvoiceamountfinal.toFixed(2));	
	}
	
    
});

function storeCompanyCodeDetails () {
    $.ajax({
        type: 'POST',
        url: commonUrl+'/storeCompanyCodeDetails',
        data: $('#addCompanyCodeGSTForm').serialize(),
        success: function (output) {
        	if(output.errors){
	        	var errMsg = '';
	            $.each(output.errors, function( key, value ) {
	                errMsg += value;
	                errMsg += '<br>';
	            });
	            $("#error-msg-span-prod").html(errMsg);
	            $("#success-msg-block-prod").hide();
	            $("#error-msg-block-prod").show();
        	} else {
	            $(".addGSTN").html('');
	            $(".AddCompanyCodeGSTN").hide();
	            $(".companyCodeGSTTable").load(location.href+" .companyCodeGSTTable>*","");
        	}
        }
    });
    return false;
}
$(document).on("keydown",".numbertxt",function(e){
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 188]) !== -1 ||
        // Allow: Ctrl+A
    (e.ctrlKey === true) ||
        // Allow: home, end, left, right, down, up
    (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

function invalidateManualInput(id) {
	//console.log("{!! csrf_token() !!}");return;
	$.ajax({
		url:commonUrl + '/invalidateManualInput',
		type:'GET',
		data:{
			//'_token':'{{csrf_token();}}',
			'id':id,
		},
		dataType:'json',
		success:function(data) {
         //console.log(data);
         alert('Invoice Invalidated!!');
         location.reload();
		},
		error:function(status) {
          console.log(status);
		}
	});

}

function searchInvoiceData(){
	var startDate = $('#ip-start-date').val();
	var endDate = $('#ip-end-date').val();
	var token = $("input[name=_token]").val();
	
	$.ajax({
		url:commonUrl + '/searchInvoiceData',
		type:'POST',
		data:{
			'startDate':startDate,
			'_token':token,
			'endDate':endDate
		},
		// dataType:'json',
		success:function(data) {
			// alert(data);
			console.log('Data - ',data);
			// $('#div-invoice-table-data').html('');
			$('#div-invoice-table-data').html(data);
			$('#invoiceTable').DataTable({
		        'lengthChange' : true,
		        'search' : false,
		        'paging' : true,
		        'info' : false,
		    });
		},
		error:function(status) {
          console.log('Error - ',status);
		}
	});

}