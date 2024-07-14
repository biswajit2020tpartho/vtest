var site_url = "http://localhost/venkatesh/public/";
var lang = $('meta[name="lang"]').attr('content');
$(document).ajaxStart(function(){
  $('.pageloader').show();
});
$(document).ajaxComplete(function(){
  $('.pageloader').hide();
   $('.bodywrapper').addClass('showcontent');
});

function submitInquiry(){
	$.ajax({
		url: 'http://localhost/venkatesh/public/'+lang+'/submitInquiry',
		type: 'post',
		dataType: 'json',
		data: $("#form-feedback").serialize(),
		beforeSend: function() {
			$('#feed_form').button('loading');
		},
		complete: function() {
			$('#feed_form').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible').remove();

			if (json['error']) {
				$('#feback').html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#feback').html('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('input[name=\'email\']').val('');
				$('input[name=\'message\']').val('');
				
			}
		}
	});
}

$('#button-review').on('click', function() {
	$.ajax({
		url: 'http://localhost/venkatesh/public/adsReview',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-dismissible').remove();

			if (json['error']) {
				$('#review').after('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review').after('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
});

$('#inquery_button').on('click', function() {
	$.ajax({
		url: 'http://localhost/venkatesh/public/adsInquery',
		type: 'post',
		dataType: 'json',
		data: $("#inquery_form").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(data) {
			var html = '';
		    if(data.errors)
		    {
		    	// <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>

		      html = '<div class="alert alert-danger alert-dismissible">';
		      for(var count = 0; count < data.errors.length; count++)
		      {
		       html += '<p>' + data.errors[count] + '</p>';
		      }
		      html += '</div>';
		    }
		    if(data.success)
		    {
		      html = '<div class="alert alert-success">' + data.success + '</div>';	
		      $('input[name=\'name\']').val('');
		      $('input[name=\'email\']').val('');
		      $('input[name=\'phone_no\']').val('');
		      $('input[name=\'message\']').val('');
			  $('textarea[name=\'text\']').val('');
			  $('input[name=\'rating\']:checked').prop('checked', false);      
		    }
		    $('#form_result').html(html);
		}
	});
});

$("#forgot_pwd").click(function(){
  $("#forgot_password_form").css('display','block');
  $("#login_form").css('display','none');
  //$("#current").text('Forgot Password');  
});
$("#sign_in").click(function(){
  $("#forgot_password_form").css('display','none');
  $("#login_form").css('display','block');
  // $("#current").text('Sign In');
});



// Product List
function list_view(){
	$('.probxsec .row > .product-list').attr('class', 'product-list col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pl-2 pr-2 colproject');
	$('.grid-view').removeClass('active');
	$('.list-view').addClass('active');
	localStorage.setItem('display', 'list');
}

$('#list-view').click(function() {
	// $('#content .product-grid > .clearfix').remove();
	$('.probxsec .row > .product-list').attr('class', 'product-list col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pl-2 pr-2 colproject');
	$('#grid-view').removeClass('active');
	$('#list-view').addClass('active');
	localStorage.setItem('display', 'list');
});

// Product Grid
$('#grid-view').click(function() {
	$('.probxsec .row > .product-list').attr('class', 'product-list col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 pl-2 pr-2 colproject colprojectgrid');
	$('#list-view').removeClass('active');
	$('#grid-view').addClass('active');
	localStorage.setItem('display', 'grid');
});

function grid(rq){
	$('.probxsec .row > .product-list').attr('class', 'product-list col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 pl-2 pr-2 colproject colprojectgrid');
	$('.list-view').removeClass('active');
	$('.grid-view').addClass('active');
	localStorage.setItem('display', 'grid');
}



if (localStorage.getItem('display') == 'list') {
	$('#list-view').trigger('click');
	$('#list-view').addClass('active');
} else {
	$('#grid-view').trigger('click');
	$('#grid-view').addClass('active');
}

$(document).ready(function() {
 	// $('#inquery_list').DataTable({
  // 	processing: true,
  // 	serverSide: true,
  // 	ajax:{
  //  		url: "http://localhost/venkatesh/public/en/view-inquiries",   		
  // 	},
  // 	columns:[
		// { data: 'id',	name: 'id'},
		// { data: 'name',	name: 'name'},
		// { data: 'email', name: 'email'},
		// { data: 'phone_no', name: 'phone_no'},
		// { data: 'message',name: 'message'},
		// { data: 'action',name: 'action'}
  // 	]
 	// });

 	$('#inquery_list').DataTable();
});

$(document).on('click', '.view', function(){
	var id = $(this).attr('id');
	$.ajax({
		url: 'http://localhost/venkatesh/public/inquery_data/'+id,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'get',
		dataType: 'json',
		success: function(html) {
			$('#name').html(html.data.name);
			$('#email').html(html.data.email);
			$('#phone_no').html(html.data.phone_no);
			$('#message').html(html.data.message);				
			$('#exampleModalCenter').modal('show');
		}
	});
	
});

var wishlist = {
	'add': function(product_id) {
		$.ajax({
			url: 'http://localhost/venkatesh/public/wishlist-add',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'post',
			data: 'ads_id=' + product_id,
			dataType: 'json',
			success: function(json) {				
				$('.alert-dismissible').remove();

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json['success']) {
					$('#content').parent().before('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					if(json['is_exists'] == "1"){
						$('.sharerightb #wishlist > i').attr('class', 'fa fa-heart');
						$("#heartbx_"+product_id).html('<a href="javascript:void(0);" onclick="wishlist.add('+product_id+');"><i class="fa fa-heart"></i></a>');
					}else{
						$('.sharerightb #wishlist > i').attr('class', 'fa fa-heart-o');
						$("#heartbx_"+product_id).html('<a href="javascript:void(0);" onclick="wishlist.add('+product_id+');"><i class="fa fa-heart-o"></i></a>');
					}					
					alertify.alert(json['success']).set('basic', true); 
				}

				$('#wishlist-total span').html(json['total']);
				$('#wishlist-total').attr('title', json['total']);

				$('html, body').animate({ scrollTop: 0 }, 'slow');
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'remove': function() {

	}
}

$(document).on('click', '.packageDetails', function(){
	var id = $(this).attr('id');
	var lang = $('meta[name="lang"]').attr('content');
	$.ajax({
		url: 'http://localhost/venkatesh/public/package_details/'+id,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'get',
		dataType: 'json',
		success:function(html){
			$("#amount").val(html.data.price);
			$("#item_id").val(id);
			if(lang == "en"){
			$('#pck_name').html(html.data.title.en);
			$('#pck_description').html(html.data.description.en);
			}else{
			$('#pck_name').html(html.data.title.ge);
			$('#pck_description').html(html.data.description.ge);
			}
			$('#pck_price').html('<i class="fa fa-euro"></i>'+html.data.price+'<span>/ '+html.data.expires_in_months+' Month</span>');
			
			$('#pck_crept').html('Credit Point :'+html.data.credit_point);
			$('#packageModalCenter').modal('show');
		}
	});		
});

$(document).on('click','.ads_details',function(){
	var id = $(this).attr('id');
	$.ajax({
		url: 'http://localhost/venkatesh/public/view-ads-details/'+id,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'get',
		dataType: 'json',
		success:function(data){
			if(data.success == true) {             
              $('#user_jobs').html(data.html);
            } else {
              $('#user_jobs').html(data.html + '{{ $user->username }}');
            }
			$("#ads_details_modal").modal('show');
		}
	});	
});

$(document).ready(function(){
	$("#selectall").click(function(){
        if(this.checked){
            $('.checkboxall').each(function(){
                $(".checkboxall").prop('checked', true);
            })
        }else{
            $('.checkboxall').each(function(){
                $(".checkboxall").prop('checked', false);
            })
        }
    });	
});

$(document).ready(function() {
  $('#change_val').on('change', function() {
  	filter = [];
  	var change_val = $("#change_val").val();
	$('input[name^=\'select_all\']:checked').each(function(element) {
		filter.push(this.value);
	});
	if(change_val==""){
		alertify.alert("Please select action").set('basic', true); 
	}else if(filter.length === 0){
		alertify.alert("Please select atleast one record!").set('basic', true); 
	}else{
		this.form.submit();
	}
    
  });
});	

$(document).on('click', '.message-view', function(){
	var id = $(this).attr('id');	
	$.ajax({
		url: 'http://localhost/venkatesh/public/mail-data/'+id,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'get',
		dataType: 'json',
		success: function(html) {
			$('#modal_subject').html(html.data.subject);			
			$('#modal_message').html(html.data.message);				
			$('#messageDetailsview').modal('show');
		}
	});
	
});

function showhide_email_block(text){
	var current_value = text.value;
	if(current_value == "customer"){
		$(".customer-block").show();
		$(".any-email-block").hide();
	}else if(current_value == "any_email"){
		$(".customer-block").hide();
		$(".any-email-block").show();
	}else{
		$(".customer-block").hide();
		$(".any-email-block").hide();
	}
}

function deleteAds(id)
{
  alertify.confirm('Are you sure want to delete this Ads?',function(e){
    if(e){
      $.ajax({
        url : 'http://localhost/venkatesh/public/delete-ads',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",       
        data: {id:id},
        success: function(response)
        {
          if(response == 'sucess'){
            window.location.href = 'http://localhost/venkatesh/public/en/view-and-manage-ads';
          }
          else if(response == 'fail'){
            alertify.alert('Unable to delete this data from this list');
          }
        }
      });
    }
  });

}

function deleteAdsImage(id)
{
  alertify.confirm('Are you sure want to delete this image?',function(e){
    if(e){
      $.ajax({
        url : 'http://localhost/venkatesh/public/delete-ads-image',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",       
        data: {id:id},
        success: function(response)
        {
          if(response == 'sucess'){
            window.location.href = 'http://localhost/venkatesh/public/en/view-and-manage-ads';
          }
          else if(response == 'fail'){
            alertify.alert('Unable to delete this data from this list');
          }
        }
      });
    }
  });

}

$(document).ready(function() {
$("#customer_email").select2({
    multiple: true,
});
$("#amenities").select2({
    multiple: true,
});
});

function getstate(id){
	var countryId = id.value;
	if(countryId !=""){
		$.ajax({
        url : 'http://localhost/venkatesh/public/get_state',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",     
        dataType: 'json',  
        data: {id:countryId},
        success: function(response)
        {
          
          var city_options = []; 
          city_options.push('<option value="">Please select state</option>');	      
	        $.each(response.data, function(i, item) {	        
	         var newOption = '<option value="' + item.id + '">' + item.state_name + '</option>';
	         city_options.push(newOption);
	       });
	       $("#state").html(city_options);
        }        
      });

	}
}

function getCity(id){
	var stateId = id.value;
	if(stateId !=""){
		$.ajax({
        url : 'http://localhost/venkatesh/public/get_city',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",     
        dataType: 'json',  
        data: {id:stateId},
        success: function(response)
        {
          
          var city_options = []; 
          city_options.push('<option value="">Please select city</option>');
	        $.each(response.data, function(i, item) {	        
	         var newOption = '<option value="' + item.id + '">' + item.city_name + '</option>';
	         city_options.push(newOption);
	       });
	       $("#city").html(city_options);
        }        
      });

	}
}

$(document).ready(function(){
    $('#upload_image').ajaxForm({
        beforeSend:function(){
            $('#success').empty();
            $('.progress-bar').text('0%');
            $('.progress-bar').css('width', '0%');
        },
        uploadProgress:function(event, position, total, percentComplete){
        	$('.progress').show();
            $('.progress-bar').text(percentComplete + '0%');
            $('.progress-bar').css('width', percentComplete + '0%');
        },
        success:function(data)
        {
            if(data.success)
            {
                $('.progress-bar').text('Uploaded');
                $('.progress-bar').css('width', '100%');                
                setTimeout(function(){
                	$('.close').trigger('click');
				    window.location.href = window.location.href
				},5000)
            }
        }
    });
});

function getaminities(id){
	var cat_id = id.value;
	var lang = $('meta[name="lang"]').attr('content');
	if(cat_id !=""){
		$.ajax({
        url : 'http://localhost/venkatesh/public/'+lang+'/get_aminities/'+cat_id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "get",     
        dataType: 'json',
        success: function(response)
        {
          
          var city_options = []; 
          city_options.push('<option value="">Please select amenities</option>');	      
	        $.each(response.data, function(i, item) {	        
	         var newOption = '<option value="' + item.id + '">' + item.name + '</option>';
	         city_options.push(newOption);
	       });
	       $("#amenities").html(city_options);
        }        
      });

	}
}

$(document).on('change','.catcls',function(){
	var cat_id='';
	var rating_id='';
	var lang = $('meta[name="lang"]').attr('content');
    $('input:checkbox.catcls').each(function () {
        var current = (this.checked ? $(this).val() : "");
        if(current!="")
        {
            if(cat_id=='')
            {
               cat_id=current;
            }
            else
            {
              cat_id+=','+current;
            }
            
        }                     
    });

    $('input:checkbox.rating_filter').each(function () {
        var current2 = (this.checked ? $(this).val() : "");
        if(current2!="")
        {
            if(rating_id=='')
            {
               rating_id=current2;
            }
            else
            {
              rating_id+=','+current2;
            }
            
        }                     
    });
    if(cat_id=='')
    {
      cat_id=0;
    }
    if(rating_id ==''){
    	rating_id=0;
    }
    var state_name = $("#state_id").val();
    var price=$("#min_p").val()+','+$("#max_p").val();
    $.ajax({
        url : site_url+lang+'/get-ads/'+cat_id+'/'+rating_id+'/'+price+'/'+state_name,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "get",     
        dataType: 'json',
        success: function(response)
        {
        	//console.log(response)
            $("#all_ads").html(response.html);
            $('.pagination>li>a').addClass("get-service-paginate");
        }        
    });

});

function filter_sortby(txt){
	var sort_by = txt.value;
	var cat_id='';
	var rating_id ='';
	var lang = $('meta[name="lang"]').attr('content');
    $('input:checkbox.catcls').each(function () {
        var current = (this.checked ? $(this).val() : "");
        if(current!="")
        {
            if(cat_id=='')
            {
               cat_id=current;
            }
            else
            {
              cat_id+=','+current;
            }
            
        }                     
    });
     $('input:checkbox.rating_filter').each(function () {
        var current2 = (this.checked ? $(this).val() : "");
        if(current2!="")
        {
            if(rating_id=='')
            {
               rating_id=current2;
            }
            else
            {
              rating_id+=','+current2;
            }
            
        }                     
    });
    if(cat_id=='')
    {
      cat_id=0;
    }
    if(rating_id ==''){
    	rating_id=0;
    }
    var state_name = $("#state_id").val();
    var price=$("#min_p").val()+','+$("#max_p").val();
    $.ajax({
        url : site_url+lang+'/get-ads/'+cat_id+'/'+rating_id+'/'+price+'/'+state_name+'/?'+sort_by,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "get",     
        dataType: 'json',
        success: function(response)
        {
        	//console.log(response)
            $("#all_ads").html(response.html);
            $('.pagination>li>a').addClass("get-service-paginate");
        }        
    });

}

$(document).on('change','.rating_filter',function(){
	
	var cat_id='';
	var rating_id='';
	var lang = $('meta[name="lang"]').attr('content');
    $('input:checkbox.catcls').each(function () {
        var current = (this.checked ? $(this).val() : "");
        if(current!="")
        {
            if(cat_id=='')
            {
               cat_id=current;
            }
            else
            {
              cat_id+=','+current;
            }
            
        }                     
    });

    $('input:checkbox.rating_filter').each(function () {
        var current2 = (this.checked ? $(this).val() : "");
        if(current2!="")
        {
            if(rating_id=='')
            {
               rating_id=current2;
            }
            else
            {
              rating_id+=','+current2;
            }
            
        }                     
    });
    var state_name = $("#state_id").val();
    var price=$("#min_p").val()+','+$("#max_p").val();
    if(cat_id=='')
    {
      cat_id=0;
    }
    if(rating_id ==''){
    	rating_id=0;
    }
    $.ajax({
        url : site_url+lang+'/get-ads/'+cat_id+'/'+rating_id+'/'+price+'/'+state_name,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "get",     
        dataType: 'json',
        success: function(response)
        {
        	//console.log(response)
            $("#all_ads").html(response.html);
            $('.pagination>li>a').addClass("get-service-paginate");
        }        
    });

});


$(document).on('click','.get-service-paginate',function(){
	var cat_id='';
	var rating_id='';
	var lang = $('meta[name="lang"]').attr('content');
    $('input:checkbox.catcls').each(function () {
        var current = (this.checked ? $(this).val() : "");
        if(current!="")
        {
            if(cat_id=='')
            {
               cat_id=current;
            }
            else
            {
              cat_id+=','+current;
            }
            
        }                     
    });

    $('input:checkbox.rating_filter').each(function () {
        var current2 = (this.checked ? $(this).val() : "");
        if(current2!="")
        {
            if(rating_id=='')
            {
               rating_id=current2;
            }
            else
            {
              rating_id+=','+current2;
            }
            
        }                     
    });
    if(cat_id=='')
    {
      cat_id=0;
    }
    if(rating_id ==''){
    	rating_id=0;
    }   
    var state_name = $("#state_id").val();
    var price=$("#min_p").val()+','+$("#max_p").val(); 
    var pageNum = $(this).attr('href');      
    pageNum = pageNum.split("=");      
    pageNum = pageNum[1];

    $.ajax({
        url : site_url+lang+'/get-ads/'+cat_id+'/'+rating_id+'/'+price+'/'+state_name+'/?page='+pageNum,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "get",     
        dataType: 'json',
        success: function(response)
        {
        	//console.log(response)
            $("#all_ads").html(response.html);
            $('.pagination>li>a').addClass("get-service-paginate");
        }        
    });
     return false;
}); 	

$(document).ready(function(){
	if($('#sl2').length){		
	  	var priceSliderObj = $('#sl2').slider();
	  	var lang = $('meta[name="lang"]').attr('content');		    
	    priceSliderObj.on('slideStop', function(ev){
	      $('.first').html(ev.value[0]);
	      $('.sec').html(ev.value[1]);
	      $("#min_p").val(ev.value[0]);
          $("#max_p").val(ev.value[1]);
	      var price = ev.value[0]+','+ev.value[1];
	      var state_name = $("#state_id").val();
	      var cat_id='';
		  var rating_id='';
	      $('input:checkbox.catcls').each(function () {
		        var current = (this.checked ? $(this).val() : "");
		        if(current!="")
		        {
		            if(cat_id=='')
		            {
		               cat_id=current;
		            }
		            else
		            {
		              cat_id+=','+current;
		            }
		            
		        }                     
		  });

		    $('input:checkbox.rating_filter').each(function () {
		        var current2 = (this.checked ? $(this).val() : "");
		        if(current2!="")
		        {
		            if(rating_id=='')
		            {
		               rating_id=current2;
		            }
		            else
		            {
		              rating_id+=','+current2;
		            }
		            
		        }                     
		    });
		    if(cat_id=='')
		    {
		      cat_id=0;
		    }
		    if(rating_id ==''){
		    	rating_id=0;
		    }
		   
			    $.ajax({
			        url : site_url+lang+'/get-ads/'+cat_id+'/'+rating_id+'/'+price+'/'+state_name,
			        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			        type: "get",     
			        dataType: 'json',
			        success: function(response)
			        {
			        	//console.log(response)
			            $("#all_ads").html(response.html);
			            $('.pagination>li>a').addClass("get-service-paginate");
			        }        
			    });
		    
		});	    
	}
});

$(".myid li").click(function() {
    var state_id = ($(this).attr('id'));
    var state_name = ($(this).attr('value'));
    $("#state_id").val(state_name);
    $("#search_state").val(state_name);
    var cat_id='';
	var rating_id='';
	var lang = $('meta[name="lang"]').attr('content');
    $('input:checkbox.catcls').each(function () {
        var current = (this.checked ? $(this).val() : "");
        if(current!="")
        {
            if(cat_id=='')
            {
               cat_id=current;
            }
            else
            {
              cat_id+=','+current;
            }
            
        }                     
    });

    $('input:checkbox.rating_filter').each(function () {
        var current2 = (this.checked ? $(this).val() : "");
        if(current2!="")
        {
            if(rating_id=='')
            {
               rating_id=current2;
            }
            else
            {
              rating_id+=','+current2;
            }
            
        }                     
    });
    if(cat_id=='')
    {
      cat_id=0;
    }
    if(rating_id ==''){
    	rating_id=0;
    }
    var price=$("#min_p").val()+','+$("#max_p").val();
    $.ajax({
        url : site_url+lang+'/get-ads/'+cat_id+'/'+rating_id+'/'+price+'/'+state_name,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "get",     
        dataType: 'json',
        success: function(response)
        {
        	//console.log(response)
            $("#all_ads").html(response.html);
            $('.pagination>li>a').addClass("get-service-paginate");
        }        
    });
});


$("#search_state").blur(function(){
    var state_name = $("#search_state").val();
    $("#state_id").val(state_name);
    var cat_id='';
	var rating_id='';
	var lang = $('meta[name="lang"]').attr('content');
    $('input:checkbox.catcls').each(function () {
        var current = (this.checked ? $(this).val() : "");
        if(current!="")
        {
            if(cat_id=='')
            {
               cat_id=current;
            }
            else
            {
              cat_id+=','+current;
            }
            
        }                     
    });

    $('input:checkbox.rating_filter').each(function () {
        var current2 = (this.checked ? $(this).val() : "");
        if(current2!="")
        {
            if(rating_id=='')
            {
               rating_id=current2;
            }
            else
            {
              rating_id+=','+current2;
            }
            
        }                     
    });
    if(cat_id=='')
    {
      cat_id=0;
    }
    if(rating_id ==''){
    	rating_id=0;
    }
    var price=$("#min_p").val()+','+$("#max_p").val();
    $.ajax({
        url : site_url+lang+'/get-ads/'+cat_id+'/'+rating_id+'/'+price+'/'+state_name,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "get",     
        dataType: 'json',
        success: function(response)
        {
        	//console.log(response)
            $("#all_ads").html(response.html);
            $('.pagination>li>a').addClass("get-service-paginate");
        }        
    });
});

 $(document).ready(function(){
	$("#search_state").keyup(function(){
		$.ajax({
		type: "post",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		url: site_url+lang+'/get-state',
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(response){
			var city_options = [];    
          	
	        $.each(response.data, function(i, item) {	        
	         var newOption = '<li id="jkjk_'+item.id+'" value="'+item.state_name+'"><a href="javascript:void(0);">' + item.state_name + '</a></li>';
	         city_options.push(newOption);
	       	});      
			$("#suggesstion-box").show();
			$(".myid").html(city_options);			
		}
		});
	});
});	
