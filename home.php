<?php
include 'backend/database.php';
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Data</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
	<script src="ajax/ajax.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
</head>
<style>
	.error{
	color:red;
}
</style>
<body>
    <div class="container">
	<div style="float: right;margin-top:10px;"><a href = "logout.php">Sign Out</a></div>
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Users</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover" id="userdata">
                <thead>
                    <tr>
						
						<th>SL NO</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
						<th>PHONE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
				<tbody>
				
				
				</tbody>
			</table>
			
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form" method="post" enctype="multipart/form-data" role="form" data-toggle="validator" novalidate="true">
					<div class="modal-header">						
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>NAME</label>
							<input type="text" id="name" name="name" class="form-control" required="required" >
							<span class="error" style="display:none" id="filterErr" >Please Enter the Name<span>
            			</div>
						<div class="form-group">
							<label>EMAIL</label>
							<input type="email" id="email" name="email" class="form-control" required="required" >
							<span class="error" style="display:none" id="filteremailErr" >Please Enter the email<span>
							<span class="error" style="display:none" id="filteremailformatErr" >Please Enter the valid email<span>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="password" name="password" class="form-control"  >
							<span class="error" style="display:none" id="filterpasswordErr" >Please Enter the Password<span>
						</div>
						<div class="form-group">
							<label>PHONE</label>
							<input type="number" id="phone" name="phone" class="form-control" required="required" >
							<span class="error" style="display:none" id="filterphoneErr" >Please Enter the phone number<span>
						</div>
						
						
						<div class="form-group">
							<input name="userImage" type="file" class="form-controller userimage" onchange="readURL(this);" /><br>
							<img id="blah" src="#" alt="your image" style="width:150px;height:150px;display:none;"/>
						</div>
						
										
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input value="Add" type="submit" class="btn btn-success"  id="btn-add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form" method="post" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Edit User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" >					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name_u" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="email_u" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="password_u" name="password" class="form-control"  >
						</div>
						<div class="form-group">
							<label>PHONE</label>
							<input type="number" id="phone_u" name="phone" class="form-control" required>
						</div>
						<div class="form-group">
							<input name="userImage" type="file" class="form-controller userimage" onchange="readURL(this);" /><br>
							<img id="blah" src="#" alt="your image" style="width:150px;height:150px;display:none;"/>
						</div>
										
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
       var datatable = $('#userdata').dataTable({
            "processing": true,
            "serverSide": true,
			"ajax" :  "data.php",
			"type": "POST",
			'serverMethod': 'post',
                "datatype": "json", 
				"bSearchable":true,
                "bFilter": true,
				"bSort": false,
				"columns": [
					{"data": "id"},
					{"data": "name"},
					{"data": "email"},
					{"data": "phone"},
					{
						"render": function ( data, type, row, meta ) {
							console.log(row,"row")
								var template = `<a href="#editEmployeeModal" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="${row.id}"
							data-name="${row.name}"
							data-email="${row.email}"
							data-phone="${row.phone}"
							title="Edit">&#xE254;</i>
						</a>
						<a href="#deleteEmployeeModal" class="delete" data-id="${row.id}" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete">&#xE872;</i></a>`
								return template;
							}
					}
				],
			
               
		});
	
	</script>
	
</body>
</html>                                		                            
<?php } else{
	header("location: index.php");
    exit;
}?>