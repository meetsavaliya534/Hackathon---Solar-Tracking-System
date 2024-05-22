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
		<div class="col-md-12 alert alert-primary">Location List</div>
		<br>
		<br>
		<div>
			<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<colgroup>
						<col width="5%">
						<col width="15%">
						<col width="10%">
						<col width="20%">
						<col width="35%">
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
							 <button class="btn btn-sm btn-outline-primary edit_student" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-info-circle"></i> Info</button>
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
							
							<h4 class="modal-title" id="myModallabel">Details</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
            <div class ="modal-body">
                <div class="form-group" style="display:none;">
                    <label style="">Auth Code</label>
                    <input type="text" style="display: none;" name="name" placeholder="Auth Code" required="" class="form-control" />
                    <p id="demo" >000000000000000000000000000000000</p>
                </div>
          <h2 class="text-center">Power Generation</h2>
          <div>
            <center>  
            	<div class="col-md-12">
              <h3 class="text-center">Status</h3>
              <h4 id="device" class="text-center" style=""></h4>
            </div>
            <div class="col-md-12">
              <h3 class="text-center">Voltage</h3>
              <meter class="voltage" id ="vol" value="0" max="24" style="--progress:0 "></meter>
              <h4 id="voltage"></h4>							
            </div>
            <div class="col-md-12">
              <h3 class="text-center">Ampere</h3>
              <meter class="amp" id="amp" value="0" max="5" style="--progress:0 "></meter>
              <h4 id="ampere"></h4>
            </div>
            <div class="col-md-12">
              <h3 class="text-center">Watt</h3>
              <meter class="watt" id="wa" value="0" max="120" style="--progress:0 "></meter>
              <h4 id="watt"></h4>
            </div>
            <h2 class="text-center">Current Location</h2>
            <div id="longitude" style="display:none;"></div><div id="latitude" style="display:none;"></div>
            <h4>Directions: <a class="text-center"id="map" href="#" target="_blank"><h4>Google Map</h4></a></h4>
            <iframe id="mapsrc" src="" width="100%" height="450"  frameborder="0" style="border:0" allowfullscreen></iframe>
            </center>
        </div>
      </div>
    </div>

</body>
<script src="../js/details.js"></script>
<script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('#new_student').click(function(){
			$('#msg').html('')
			$('#manage_student .modal-title').html('Details')
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
						$('#manage_student .modal-title').html('Details')
						$('#manage_student').modal('show')

   
		 $(document).ready(function() {
        $("button").click(function() {
              
            // Here the value is stored in variable. 
            var authToken = $("input:text").val();
            document.getElementById("demo").innerHTML = authToken;



      // Replace VIRTUAL_PIN with the virtual pin number you want to read from
      const virtualPin0 = "v0";
      const virtualPin1 = "v1";
      const virtualPin2 = "v2";
      const virtualPin3 = "v3";

      // Set up the Blynk API URL
      const apiUrl0 = `https://blr1.blynk.cloud/external/api/get?token=${authToken}&${virtualPin0}`;
      const apiUrl1 = `https://blr1.blynk.cloud/external/api/get?token=${authToken}&${virtualPin1}`;
      const apiUrl2 = `https://blr1.blynk.cloud/external/api/get?token=${authToken}&${virtualPin2}`;
      const apiUrl3 = `https://blr1.blynk.cloud/external/api/get?token=${authToken}&${virtualPin3}`;
      const apiUrl4 = `https://blr1.blynk.cloud/external/api/isHardwareConnected?token=${authToken}`;


      // Set up the fetch options
      const fetchOptions = {
        method: "GET",
        mode: "cors",
        cache: "no-cache"
      };

      // Fetch the data from the Blynk API
      async function fetchData() {
        try {
        	const response0 = await fetch(apiUrl0, fetchOptions);
          const response1 = await fetch(apiUrl1, fetchOptions);
          const response2 = await fetch(apiUrl2, fetchOptions);
          const response3 = await fetch(apiUrl3, fetchOptions);
          const response4 = await fetch(apiUrl4, fetchOptions);


          const longitude = await response0.json();
          const latitude = await response1.json();
          const voltage = await response2.json();
          const ampere = await response3.json();
          const isHardwareConnected = await response4.json();



          // Extract the value from the response data
          const value0 = longitude;
          const value1 = latitude;

          const map = `https://www.google.com/maps/dir//${longitude}+${latitude}/@${longitude},${latitude},16z`;
          const mapsrc = `https://www.google.com/maps/embed/v1/view?key=${key}&center=${longitude},${latitude}&zoom=20`;
          const value2 = parseFloat(voltage).toFixed(2);
          const value3 = parseFloat(ampere).toFixed(2);
          var value4 = parseFloat(value2*value3).toFixed(2);
          const value5 = isHardwareConnected;

          // Display the value on the webpage
          if(value5 === true)
           {
                category = "Solar System is Online!";
                document.getElementById("device").style = "background: #fff; padding: 20px 15px 20px 20px; border-radius: 10px; border-left: 5px solid #2ecc71; box-shadow: 20px 15px 14px -5px rgba(0,0,0,0.15); width: 300px; display: flex; align-items: center; justify-content: space-between;";
                document.getElementById("voltage").innerHTML = "Voltage: " + value2 + "V";
                document.getElementById("ampere").innerHTML = "Ampere: " +  value3 + "mA";
                document.getElementById("watt").innerHTML = "Watt: " +  value4 + " mW";
                document.getElementById("vol").style = "--progress:" + value2;
                document.getElementById("amp").style = "--progress:" + value3;
                document.getElementById("wa").style = "--progress:" + value4;
                document.getElementById("vol").value = value2;
                document.getElementById("amp").value = value3;
                document.getElementById("wa").value = value4;
                document.getElementById("device").innerHTML = category;
           }
          else{
            category = "Solar System is Offline";
            document.getElementById("device").style = "background: #fff; padding: 20px 15px 20px 20px; border-radius: 10px; border-left: 5px solid #cc0000; box-shadow: 20px 15px 14px -5px rgba(0,0,0,0.15); width: 300px; display: flex; align-items: center; justify-content: space-between;";
              document.getElementById("voltage").innerHTML = "Voltage: " + 0 + "V";
              document.getElementById("ampere").innerHTML = "Ampere: " +  0 + "mA";
              document.getElementById("watt").innerHTML = "Watt: " +  0 + " mW";
              document.getElementById("vol").style = "--progress:" + 0;
              document.getElementById("amp").style = "--progress:" + 0;
              document.getElementById("wa").style = "--progress:" + 0;
              document.getElementById("vol").value = 0;
              document.getElementById("amp").value = 0;
              document.getElementById("wa").value = 0;
              document.getElementById("device").innerHTML = category;
          }


          document.getElementById("longitude").innerHTML = value0;
          document.getElementById("latitude").innerHTML = value1;
          const link = document.getElementById("map");
          link.href = map;
          document.getElementById("mapsrc").src = mapsrc;
        } 
          catch (error) {
          // If there is an error, display it on the webpage
          document.getElementById("voltage").innerHTML = error;
          document.getElementById("ampere").innerHTML = error;
          document.getElementById("watt").innerHTML = error;
          document.getElementById("vol").innerHTML = error;
          document.getElementById("amp").innerHTML = error;
          document.getElementById("wa").innerHTML = error;
          document.getElementById("longitude").innerHTML = error;
          document.getElementById("latitude").innerHTML = error;
          document.getElementById("map").innerHTML = error;
        }
      }

      fetchData();

       });
    });

		 		 }
				}
			})
		})
	})
</script>
</html>