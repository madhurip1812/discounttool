$("#rulefor1").click(()=>{ //product
	$(".intellikitsubscbox").hide();
	$(".product").show();
});

$("#rulefor2").click(()=>{ //intellikit
	$(".intellikitsubscbox").show();
	$(".product").hide();
});

$(document).ready(()=>{
	$(".product").hide();
});