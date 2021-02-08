$(".ExcludeBtn").click(function(){
   var btn= $(this).attr("id");  
   var excludeval='';
       switch(btn)
       {
        case "btnExcludeBrands":
                  excludeval=$("#txtbrands").val();
                   break;                
        case "btnExcludeCat":
                   excludeval=$("#txtCat").val();
                   break;
        case "btnExcldeSubCat":
                 excludeval=$("#txtSubCat").val();
                   break;
        case "btnExcludeProducts":
                  excludeval=$("#txtProduct").val();
                   break;        

       }
        
        $.ajax({
            type:'GET',
            url:"./CouponExcludeIds",
            data:{'btn':btn,'excludeval':excludeval },           
            success:function(value) {
            	console.log(value);
            if(value.success)
			{
				var p="<div class='alert alert-success alert-dismissible' role='alert' id='success-msg-block-prod'> <span class='col-md-11' id='error-msg-span-prod'>"+value.message+"</span><a href='#' class='col-md-1 close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></a></div>";
				$("#error-success-message").html(p);
				$("#success-msg-block-prod").delay(2000).fadeOut(2000);
			} else {              	
				var p="<div class='col-md-12 alert alert-danger alert-dismissible' role='alert' id='error-msg-block-prod'> <span class='col-md-11' id='success-msg-span-prod'>"+value.message+"</span><a href='#' class='col-md-1 close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></a></div>";
				$("#error-success-message").html(p);
				
			}
            }

        });

    });
$("#btnShowDesc").click(function(){
   	var btn= $(this).attr("id");  
   	$.ajax({
        type:'GET',
        url:"./CouponExcludeIds",
        data:{'btn':btn},           
        success:function(data) {
	      	
	        if(data.success)
			{
				$("#lvBrand").html("");
				$("#lvCat").html("");
				$("#lvSubCat").html("");
				 $.each( data.message, function( key, value ) {
				 	  $.each(value, function( key1, value1 ) {
				 	  	if(key=="commonbrands")
				 	  	{
				 	  	  $("#lvBrand").append("&nbsp;"+value1+ " - "+key1+"\n");
				 	  	}else if(key=="commonCategory")
				 	  	{
	                       $("#lvCat").append("&nbsp;"+value1+" - "+key1+"\n");
				 	  	}
				 	  	else if(key=="commonsubCategory")
				 	  	{
	                       $("#lvSubCat").append("&nbsp;"+value1+" - "+key1+"\n");
				 	  	}
				 	  	
				 	  });
				 });
			} else {              	
				var p="<div class='col-md-12 alert alert-danger alert-dismissible' role='alert' id='error-msg-block-prod'> <span class='col-md-11' id='success-msg-span-prod'>"+value.message+"</span><a href='#' class='col-md-1 close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></a></div>";
				$("#error-success-message").html(p);
			}
        }
    });
});