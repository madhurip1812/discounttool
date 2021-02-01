/**  hide productid field on page load   **/
$(document).ready(()=>{
	$(".product").hide();
});

/**  dispaly the fields as per selection of rulefor    **/
$("input:radio[name='rulefor']").on('change',()=>{
   let ruleFor = $("input:radio[name='rulefor']:checked").val();
   
   if(ruleFor == 'intellikit') { //intellikit
       	$(".intellikitsubscbox").show();
	    $(".product").hide();
   } else if(ruleFor == 'time') { //product
       $(".intellikitsubscbox").hide();
       $(".product").show();
   } else {

   }
});