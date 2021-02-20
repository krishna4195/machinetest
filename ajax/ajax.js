function readURL(input) {
	var ext = input.split(".");
		ext = ext[ext.length-1].toLowerCase();      
		var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];
		
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		if (arrayExtensions.lastIndexOf(ext) == -1) {
			alert("Wrong extension type.");
			$("#image").val("");
		}
		if(ext == "jpg" || ext == "png" || ext == "jpeg"){
		reader.onload = function (e) {
			$('#blah')
				.attr('src', e.target.result)
				.width(150)
				.height(200);
				$('#blah').css("display","block");
		};
		}

		reader.readAsDataURL(input.files[0]);
	}
}
	$(document).on('click','#btn-add',function(e) {
		var filtername="";
		var filterphone="";
		filtername=$('#name').val();
		filterphone=$('#phone').val();
		if(filtername == '')
         {
         //$('.error').html('Enter the filter Name')
         $('#filterErr').show();
         
         }
         else if(filterphone == '')
         {
         //$('.error').html('Enter the filter Name')
         $('#filterphoneErr').show();
         
         }
         else
         {
         $('#filterErr').hide();
         $('#filterphoneErr').hide();
		var data = $("#user_form").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "backend/save.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#addEmployeeModal').modal('hide');
						alert('Data added successfully !'); 
                        location.reload();						
					}
					else if(dataResult.statusCode==201){
					   alert(dataResult);
					}
			}
		});
		}
	});
	
	// $('input[name="email"]').on("keypress",function () {
		
	// 	var email = $(this).val();
	// 	alert(email);
	// var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
	// if (re.test(email)) {
	// 	// $('.msg').hide();
	// 	// $('.success').show();
	// } else {
	// 	$('#filteremailformatErr').show();
	// }
	
	// });
	$(document).on('click','.update',function(e) {
		var id=$(this).attr("data-id");
		var name=$(this).attr("data-name");
		var email=$(this).attr("data-email");
		var phone=$(this).attr("data-phone");
		var city=$(this).attr("data-city");
		$('#id_u').val(id);
		$('#name_u').val(name);
		$('#email_u').val(email);
		$('#phone_u').val(phone);
		$('#city_u').val(city);
	});
	
	$(document).on('click','#update',function(e) {
		var data = $("#update_form").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "backend/save.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$('#editEmployeeModal').modal('hide');
						alert('Data updated successfully !'); 
                        location.reload();						
					}
					else if(dataResult.statusCode==201){
					   alert(dataResult);
					}
			}
		});
	});
	$(document).on("click", ".delete", function() { 
		var id=$(this).attr("data-id");
		$('#id_d').val(id);
		
	});
	$(document).on("click", "#delete", function() { 
		$.ajax({
			url: "backend/save.php",
			type: "POST",
			cache: false,
			data:{
				type:3,
				id: $("#id_d").val()
			},
			success: function(dataResult){
					$('#deleteEmployeeModal').modal('hide');
					$("#"+dataResult).remove();
			
			}
		});
	});
	$(document).on("click", "#delete_multiple", function() {
		var user = [];
		$(".user_checkbox:checked").each(function() {
			user.push($(this).data('user-id'));
		});
		if(user.length <=0) {
			alert("Please select records."); 
		} 
		else { 
			WRN_PROFILE_DELETE = "Are you sure you want to delete "+(user.length>1?"these":"this")+" row?";
			var checked = confirm(WRN_PROFILE_DELETE);
			if(checked == true) {
				var selected_values = user.join(",");
				console.log(selected_values);
				$.ajax({
					type: "POST",
					url: "backend/save.php",
					cache:false,
					data:{
						type: 4,						
						id : selected_values
					},
					success: function(response) {
						var ids = response.split(",");
						for (var i=0; i < ids.length; i++ ) {	
							$("#"+ids[i]).remove(); 
						}	
					} 
				}); 
			}  
		} 
	});
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
		var checkbox = $('table tbody input[type="checkbox"]');
		$("#selectAll").click(function(){
			if(this.checked){
				checkbox.each(function(){
					this.checked = true;                        
				});
			} else{
				checkbox.each(function(){
					this.checked = false;                        
				});
			} 
		});
		checkbox.click(function(){
			if(!this.checked){
				$("#selectAll").prop("checked", false);
			}
		});
	});
