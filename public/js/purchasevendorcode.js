$(document).ready(function(){
	$( "#legalname" ).autocomplete({
		source: function( request, response ) {
			console.log(request.term,12321);
			var token = $("#token").val();
			$.ajax({
				url:commonUrl+"/getMatchingPVC",
				type: 'post',
				dataType: "json",
				data: {
					legalname: request.term,
					'_token':token
				},
				success: function( data ) {
					response( data );
				}
			});
		},
		select: function (event, ui) {
			$('#legalname').val(ui.item.label); // display the selected text
			$('#companycodeid').val(ui.item.value); // save selected id to input
			return false;
		}
	});
	$(".addMoreBankDetails").click(function () {
		var count = $(".bankdetails").length;
		var ctt = count-1;
		var newElement = $("#bankdetails0").clone();
		newElement.attr('id','bankdetails'+count);//.addClass('border-top');
		newElement.find('.addMoreBankDetails').removeClass('addMoreBankDetails btn-primary').addClass('removeBankDetails btn-danger').html('<i class="fa fa-close "></i>');
		newElement.find('.bank-input').val('');
		$("#bankdetails"+ctt).after(newElement);
	})
	$(document).on('click','.removeBankDetails',function () { 
		$(this).parent().parent().remove();
	});
});