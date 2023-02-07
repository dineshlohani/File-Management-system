var JQ = jQuery.noConflict();

JQ(document).ready(function(){
    JQ("li:has(ul)").click(function(){

        JQ("ul",this).toggle('slow');
        });
	JQ(document).on("click","#edititem",function() {
	 	var column_name = JQ(this).attr('name');
		JQ('.edit_item').show();
	 	
    });
    JQ(document).on("click","#calculate_ltr",function() {
        var total_qty_ltr=0;
        
           JQ(".bottle_size").each(function() {
               
                var size_name = JQ(this).attr("id");
                var no_of_cartoons = JQ(this).val();
                var param = {};
                param.size_name = size_name;
                param.no_of_cartoons = no_of_cartoons;
               
                
                JQ.post('calulate_vol_cartoon.php',param,function(res){
                        var obj = JSON.parse(res);
                        total_qty_ltr = parseFloat(total_qty_ltr) + parseFloat(obj.qty_ltr); 
                        JQ('#qty_ltr').val(total_qty_ltr.toFixed(3));
                        var qty_jarti = total_qty_ltr/100;
                        JQ('#qty_jarti').val(qty_jarti.toFixed(3)); 
                    });
                

            });
       
      
        
    });
     JQ(document).on("change","#dealer_id",function() {
        
        var dealer_id = JQ('#dealer_id').val();
        var param = {};
        param.dealer_id = dealer_id;
        
		JQ.post('get_dealer_data.php',param,function(res){
                var obj = JSON.parse(res);
        		       
                JQ('#dealer_address').val(obj.dealer_address);
				JQ('#dealer_vat_no').val(obj.dealer_vat_no);
				JQ('#dealer_excise_no').val(obj.dealer_excise_no);
				JQ('#dealer_ird_name').val(obj.dealer_ird_name);
				false;
            });
        
        
    });
	  JQ(document).on("change","#parent_topic_id",function() {
        
        var parent_topic_id = JQ('#parent_topic_id').val();
		if(parent_topic_id == 0)
		{
			JQ('#second_topic').html("");
		}
		else
		{
			var param = {};
       		 param.parent_topic_id = parent_topic_id;
        
			JQ.post('get_sub_topic.php',param,function(res){
				
                var obj = JSON.parse(res);
        		       
                JQ('#second_topic').html(obj.html);
				false;
            });
        

		}
                
    });
	   JQ(document).on("click","#findpan",function(e) {
    	var pan_no = JQ('#taxpayer_panno').val();
		//alert(pan_no);
        var param = {};
        param.pan_no = pan_no;
       JQ.post('getpan.php',param,function(res){
                var obj = JSON.parse(res);
				//alert(obj.msg); false;
                JQ('#taxpayer_company').attr('value',obj.taxpayer_company);
                //JQ('#address').attr('value',obj.address);
                 //JQ('#purpose').attr('value',obj.purpose);
                 JQ('#taxpayer_name').attr('value',obj.taxpayer_name);
                 //JQ('#reg_no').attr('value',obj.reg_no);
                 //JQ('#letter_no').attr('value',obj.letter_no);
                 //e.preventDefault();
                 //false;
            }); 
    });
     JQ(document).on("change","#cartoon_brand_id",function() {
        
        var brand_id = JQ('#cartoon_brand_id').val();
        var param = {};
        param.brand_id = brand_id;
        
		JQ.post('get_all_sizes.php',param,function(res){
                var obj = JSON.parse(res);
        		       
                JQ('#size_list').show();
                 JQ("#size_list").html(obj.html);
                false;
            });
        
        
    });
     JQ(document).on("change","#populate_brand_id",function() {
        
        var brand_id = JQ('#populate_brand_id').val();
        var param = {};
        param.brand_id = brand_id;
        param.task = "populate";
        
        JQ.post('get_all_sizes.php',param,function(res){
                var obj = JSON.parse(res);
               
                JQ('#size_list').show();
                 JQ("#size_list").html(obj.html);
                false;
            });
        
        
    });
     JQ(document).on("click",".populate_size_batch_list",function() {
       if(JQ(this).is(':checked'))
       {
            var brand_id = JQ(this).val();
               var param = {};
                param.brand_id = brand_id;
               
                
                JQ.post('get_sizes_batch.php',param,function(res){
                        var obj = JSON.parse(res);
                        JQ("#size_list").append(obj.html);
                        false;
                    });
        }
        else
        {
            var div = "pop" + JQ(this).val();
            JQ('.'+div).hide();
        }
       
        
        
    });
      JQ(document).on("click",".populate_size_list",function() {
       if(JQ(this).is(':checked'))
	   {
			var brand_id = JQ(this).val();
			   var param = {};
				param.brand_id = brand_id;
			   
				
				JQ.post('get_sizes.php',param,function(res){
						var obj = JSON.parse(res);
						JQ("#size_list").append(obj.html);
						false;
					});
		}
		else
		{
			var div = "pop" + JQ(this).val();
			JQ('.'+div).hide();
		}
	   
        
        
    });
    JQ(document).on("change","#blend_brand_id",function() {
        
        var brand_id = JQ('#blend_brand_id').val();
        var param = {};
        param.brand_id = brand_id;
        
        
        JQ.post('get_size_list.php',param,function(res){
                var obj = JSON.parse(res);

                //JQ('#size_list').show();
                 JQ("#size_list").html(obj.html);
                
                false;
            });
        JQ.post('get_blend_stock.php',param,function(res){
                var obj = JSON.parse(res);
                JQ("#prev_blend_stock").html(obj.prev_stock + " Ltr");
                false;
            });
        
    });
    JQ(document).on("change","#spirit_id",function() {
        
        var spirit_id = JQ('#spirit_id').val();
        var param = {};
        param.spirit_id = spirit_id;
        
        
        JQ.post('get_spirit_stock.php',param,function(res){
                var obj = JSON.parse(res);
                JQ("#prev_spirit_stock").html(obj.prev_stock + " Ltr");
                false;
            });
        
    });
     JQ(document).on("change","#brand_id",function() {
        
        var brand_id = JQ('#brand_id').val();

        var param = {};
        param.brand_id = brand_id;
        
        
        JQ.post('get_blend_stock.php',param,function(res){
                var obj = JSON.parse(res);
                JQ("#prev_blend_stock").html(obj.prev_stock + " Ltr");
                false;
            });
        
    });
      JQ(document).on("click",".add_sticker",function() {
        
       // var name  = JQ(this).attr("name");
        var param = {};
        param.name = "addsticker";
        
        
        JQ.post('get_sticker_div.php',param,function(res){
              var obj = JSON.parse(res);
              
               JQ("#sticker_add_section").append(obj.html);
                false;
            });
        
    });
	  JQ(document).on("click",".remove_sticker",function() {
        	
         JQ(".remove").last().remove();
     });
    JQ(document).on("keyup","#qty_ltr",function() {
         var param = {};
        var qty_ltr = JQ('#qty_ltr').val();
        var spirit_id = JQ('#spirit_id').val();
        var brand_id = JQ('#brand_id').val();
        if(brand_id === undefined)
        {
            param.brand_id = "undefined";
        }
        else
        {
            param.brand_id = brand_id;   
        }
       
        param.qty_ltr = qty_ltr;
        param.spirit_id = spirit_id;
        
        
        JQ.post('calculate_lpltr.php',param,function(res){
                var obj = JSON.parse(res);
                //alert(obj.msg);
                if(obj.msg==="undefined")
                {
                    JQ('#qty_lpltr').val(obj.qty_lpltr);    
                }
                else
                {
                    JQ('#qty_lpltr').val(obj.qty_lpltr);
                    JQ('#water_qty_ltr').val(obj.water_qty_ltr);
                    JQ('#blend_qty_ltr').val(obj.blend_qty_ltr);
                    false;    
                }
                
            });
        
    });

    JQ(document).on("keyup","#blend_qty_ltr_calc",function() {

        var val = JQ('#blend_qty_ltr_calc').val();
		if(val.length!=0){
		var jarti = val/100;
		var total_blend = parseFloat(val) + parseFloat(jarti);
		JQ('#qty_jarti').val(jarti.toFixed(3));
		JQ('#total_blend_qty').val(total_blend.toFixed(3));
		}
		else
		{
			JQ('#qty_jarti').val("0");
			JQ('#total_blend_qty').val("0");
		}
        
    });
	JQ(document).on("keyup","#end_no",function() {

        var start_no = JQ('#start_no').val();
        var end_no = JQ('#end_no').val();
        if(start_no.length!=0 && end_no.length !=0){
        var quantity = end_no - start_no + 1;
        JQ('#quantity').val(quantity);
        }else{
             JQ('#quantity').val("0");
        }
        
    });
    JQ(document).on("keyup","#start_no",function() {
        var start_no = JQ('#start_no').val();
        var end_no = JQ('#end_no').val();
         if(start_no.length!=0 && end_no.length !=0){
        var quantity = end_no - start_no + 1;
        JQ('#quantity').val(quantity);
        }else{
             JQ('#quantity').val("0");
        }
        
    });
	JQ(document).on("keyup",".start_no",function() {
		var index = $(this).attr("alt");
       	var id = $(this).attr("id");
		var start_no = JQ('#start_no_'+index).val();
        var end_no = JQ('#end_no_'+index).val();
         if(start_no.length!=0 && end_no.length !=0){
        var quantity = end_no - start_no + 1;
        JQ('#quantity_'+index).val(quantity);
        }else{
             JQ('#quantity_'+index).val("0");
        }
        
    });
		JQ(document).on("keyup",".end_no",function() {
		var index = $(this).attr("alt");
       	var id = $(this).attr("id");
		var start_no = JQ('#start_no_'+index).val();
        var end_no = JQ('#end_no_'+index).val();
         if(start_no.length!=0 && end_no.length !=0){
        var quantity = end_no - start_no + 1;
        JQ('#quantity_'+index).val(quantity);
        }else{
             JQ('#quantity_'+index).val("0");
        }
        
    });
	JQ(document).on("keyup","#confirm_password",function() {

        var password = JQ('#password').val();
        var confirm_password = JQ('#confirm_password').val();
        if(confirm_password==="")
        {
            JQ('#check_password').html("");
        }
        else
        {
           if(password===confirm_password)
            {
                var html = '<img src="images/right.png" width="32px" height="32px">';
                JQ('#check_password').html(html);
            }
            else
            {
               var html = '<img src="images/wrong.png" width="32px" height="32px">';
               JQ('#check_password').html(html);
            }
        }
    });
	JQ(document).on("click","#saveitem",function() {
	 	var column_name = JQ(this).attr('name');
	 	 //alert(column_name); false;
        
        var bitem_name = JQ('#bitem_name').val();
        var bitem_weight = JQ('#bitem_weight').val();
		var bitem_carat = JQ('#bitem_carat').val();
		var bitem_quantity = JQ('#bitem_quantity').val();
		var bitem_desc = JQ('#bitem_desc').val();
		

		var param = {};
		param.column_name =column_name;
		param.bitem_name =bitem_name;
		param.bitem_weight = bitem_weight;
		param.bitem_carat =bitem_carat;
		param.bitem_quantity = bitem_quantity;
		param.bitem_desc = bitem_desc;
		
		JQ.post('updateitem.php',param,function(res){
				JQ('#bitem_name_edited').html(bitem_name);
				JQ('#bitem_weight_edited').html(bitem_weight);
				JQ('#bitem_carat_edited').html(bitem_carat);
				JQ('#bitem_quantity_edited').html(bitem_quantity);
				JQ('#bitem_desc_edited').html(bitem_desc);
				JQ('.edit_item').hide();
				var obj = JSON.parse(res);
				alert(obj.msg);
			});
    });
	JQ(document).on("click",".updateOnClick",function() {
	 	var column_name = JQ(this).attr('name');
	 	 //alert(column_name); false;
         if(column_name=='corresauthors'){
         var texts= $(".test .text-field").map(function() {
           return $(this).val();
        }).get();
        }
        var column_value = JQ(column_name).val();
        //alert(column_value); false;

		var param = {};
		param.option='com_manuscript';
		
		param.task = 'updateType';
		
		param.column_name =column_name;
		
		param.column_value = column_value;
		
		JQ.post('index.php',param,function(res){
				var obj = JSON.parse(res);
				alert(obj.msg);
			});
    });
    JQ(document).on("click",".calculate_interest",function() {

        var id = JQ(this).attr('name');
        var end_date = JQ("#end_date_"+id).val();
       
        var param = {};
        param.bandaki_id =id;
        param.end_date = end_date;
        JQ.post('calculate_interest.php',param,function(res){
               var obj = JSON.parse(res);
               JQ('#interest_amount_'+id).val(obj.interest_amount);
               
              // alert(obj.interest_amount);
            });
    });
    JQ(document).on("click",".addOnClick",function() {
        var param = {};
        param.option='com_manuscript';
        param.task = 'checkCorresAuthor';
        
        JQ.post('index.php',param,function(res){
                var obj = JSON.parse(res);
                var html = obj.msg;
                  JQ("#corresauthors").append(html);
                    false;
            });
        //var html = '<input type="text" name="corresauthor1" placeholder="title name affiliation"/> <button name="removeOnClick">Remove</button>';
      
    });
    JQ(document).on("click",".descblock",function() {
    	var textblock = JQ(this).attr('name');
    	var styleval = JQ(textblock).css('display');
    	if(styleval =="block"){
    		JQ(textblock).hide();
    	}
    	else{
    		JQ(textblock).show();	
    	}
    	//alert(styleval); false;
    });

    JQ("#uploadOnClick").on("click", function() {
    	//alert("here uplaod"); false;
        var uploadfile = JQ('#upload')[0].files[0];
          //alert(uploadfile); false; 
    //var form_data = new FormData(file_data);                  
    //form_data.append("file", file_data);
    //var data = {

    //	option: 'com_manuscript',
    //	task: 'uploadImage',
    //	form_data: form_data
    //};
    //alert(form_data);   false;                          
    	var param = {};
        param.option = 'com_manuscript';
        param.task = 'uploadImage';
        param.uploadfile = uploadfile;
		//param.tmp_name = tmp_name;
		 JQ.post('index.php',param,function(res){
               
                alert(res);
            });
	});


});
//  JQ(function () {
//         JQ('.table1').DataTable()
//  });