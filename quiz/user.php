<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
</head>
<body>
	<?php include('nav_bar.php') ?>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary">User List</div>
		<button class="btn btn-primary bt-sm" id="new_student"><i class="fa fa-plus"></i>	Add New</button>
		<button onclick="ExportToExcel('xlsx')" class="btn btn-primary bt-sm">Export</button>
		<br>
		<br>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<colgroup>
						<col width="5%">
						<col width="15%">
						<col width="10%">
						<col width="20%">
						<col width="35%">
						<col width="15%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Contact No.</th>
							<th>Email</th>
							<th>Auth code</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$qry = $conn->query("SELECT s.*,u.name,u.number,u.user_name,u.email from students s left join users u  on s.user_id = u.id order by u.name asc ");
					$i = 1;
					if($qry->num_rows > 0){
						while($row= $qry->fetch_assoc()){
						?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['user_name'] ?></td>
						<td><?php echo $row['number'] ?></td>
						<td><?php echo $row['email'] ?></td>
						<td><?php echo $row['name'] ?></td>
						<td>
							<center>
							 <button class="btn btn-sm btn-outline-primary edit_student" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i> Edit</button>
							<button class="btn btn-sm btn-outline-danger remove_student" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i> Delete</button>
							</center>
						</td>
					</tr>
					<?php
					}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="manage_student" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModallabel">Add New student</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form id='student-frm'>
                            <div class ="modal-body">
                                <div id="msg"></div>
                                 <div class="form-group">
                                    <label>Name</label>
                                    <input type="hidden" name="id" />
                                    <input type="hidden" name="uid" />
                                    <input type="hidden" name="user_type" value = '3' />
                                    <input type="text" name ="user_name" placeholder="Name" required="" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Auth Code</label>
                                    <input type="text" name="name" placeholder="Auth Code" required="" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="text" name ="number" placeholder="Contact Number" required="" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name ="email" placeholder="Email" required="" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name ="username" placeholder="User Name" required="" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password" name ="password" placeholder="Password" required="" class="form-control" />
                                    
                                <label for="login-sign-up" class="login__label--checkbox">
                                <input id="login-sign-up" onclick="myFunction()" type="checkbox" class="login__input--checkbox" />
                                Show Password
                                </label>
                                </div>

                                <div id="message">
                                  <h6 class="login__label">Password must contain the following:</h6>
                                  <p id="letter" class="invalid">A <b>Lowercase</b> letter</p>
                                  <p id="capital" class="invalid">A <b>Capital (Uppercase)</b> letter</p>
                                  <p id="number" class="invalid">A <b>Number</b></p>
                                  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button  class="btn btn-primary btn-block" name="save"><span class="glyphicon glyphicon-save"></span> Submit</button>
                            </div>
                        </form>
					</div>
				</div>
			</div>
</body>
<script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('#new_student').click(function(){
			$('#msg').html('')
			$('#manage_student .modal-title').html('Add New student')
			$('#manage_student #student-frm').get(0).reset()
			$('#manage_student').modal('show')
		})
		$('.edit_student').click(function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./get_student.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.id)
						$('[name="uid"]').val(resp.uid)
						$('[name="name"]').val(resp.name)
						$('[name="number"]').val(resp.number)
						$('[name="email"]').val(resp.email)
						$('[name="password"]').val(resp.password)
						$('[name="user_name"]').val(resp.user_name)
						$('[name="username"]').val(resp.username)
						$('#manage_student .modal-title').html('Edit Student')
						$('#manage_student').modal('show')

					}
				}
			})

		})
		$('.remove_student').click(function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure to delete this data.');
			if(conf == true){
				$.ajax({
				url:'./delete_student.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
				}
			})
			}
		})
		$('#student-frm').submit(function(e){
			e.preventDefault();
			$('#student-frm [name="submit"]').attr('disabled',true)
			$('#student-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./save_student.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#student-frm [name="submit"]').removeAttr('disabled')
					$('#student-frm [name="submit"]').html('Save')
				},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							alert('Data successfully saved');
							location.reload()
						}else{
						$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')

						}
					}
				}
			})
		})
	})

	        function myFunction() {
        var x = document.getElementById("password");
            if (x.type === "password") {
                    x.type = "text";
            } else {
                    x.type = "password";
            }
        }

var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('table');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('User.' + (type || 'xlsx')));
        }

</script>
</html>