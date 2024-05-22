<!DOCTYPE html>
<html lang="en">
    <?php 
      include 'quiz/auth.php';
      include 'includes/headerdashboard.php';
      include 'quiz/db_connect.php';
       ?>
       
     <body style="overflow: hidden;">
          <!-- Navigation -->
    <?php include 'includes/navdashboard.php';?>
    <!-- Overlay for displaying contents -->
    <div id="lightbox" class="hidden">
      <div id="map-overlay">
        <div id="map-header">
          <button type="button" id="map-close" class="close" aria-label="Close">
            <span
              aria-hidden="true"
              class="glyphicon glyphicon-remove-circle"
            ></span>
          </button>
          <h2>Contents</h2>
          <hr class="under-title" />
        </div>
        <div id="map-list">
          <ol></ol>
        </div>
      </div>
    </div>

          <?php
          if($_SESSION['login_user_type'] == 1 || $_SESSION['login_user_type'] == 2){
          ?>
          <!-- Admin -->
            <iframe src="quiz/home"
            frameborder="0"
            marginheight="0"
            marginwidth="0"
            width="100%"
            height="950px"
            scrolling="auto">
            </iframe>
          <?php
          }
          else {
          ?>
          <!-- User -->
              <!-- App Content -->
    <div id="app-container" class="container hidden">

      <div class="row">
        <div class="col-md-4">
          <h2 class="text-center">Power Generation</h2>
          <div>
            <center>
            <div class="col-md-12">
              <h3 class="modal-header">Status</h3>
              <h4 id="device" style=""></h4>
            </div> 
            <div class="col-md-6">
              <h3 class="modal-body">Voltage</h3>
              <meter class="voltage" id ="vol" value="0" max="24" style="--progress:0 "></meter>
              <h4 id="voltage"></h4>
              <h4 id="over-vol" style=""></h4>
            </div>
            <div class="col-md-6">
              <h3 class="modal-body">Ampere</h3>
              <meter class="amp" id="amp" value="0" max="5" style="--progress:0 "></meter>
              <h4 id="ampere"></h4>
              <h4 id="over-amp" style=""></h4>
            </div>
            <div class="col-md-6">
              <h3 class="modal-body">Watt</h3>
              <meter class="watt" id="wa" value="0" max="120" style="--progress:0 "></meter>
              <h4 id="watt"></h4>
            </div>
            <div class="col-md-6" id = "display" style="display: none;">
              <h3 class="modal-header">Notice</h3>
              <h4 id="notice" style="color: red;" class="" align="justify"></h4>
            </div>
            </center>
        </div>
      </div>


        <div class="col-md-8 col-sm-6">
          <div class="text-center">
            <h2 class="text-center">Current Location</h2>
            <br>
            <iframe id="mapsrc" src="" width="700" height="450"  frameborder="0" style="border:0" allowfullscreen></iframe>
            <div id="longitude" style="display:none;"></div>
            <div id="latitude"style="display:none;"></div>
            <h4><a class="modal-header"id="map" href="#" target="_blank" style="font-style: none;">Directions</a></h4> 
          </div>
        </div>
      </div>
    <!-- /.container -->



<script src="js/details.js"></script>
<script type="text/javascript">
// Replace YOUR_AUTH_TOKEN with your Blynk API token
      const authToken = "<?php if($_SESSION['login_user_type'] == 1 || $_SESSION['login_user_type'] == 2)
                     echo '';
                  else
                     echo $name;
            ?>";
</script>
<script src="js/location.js"></script>
<script src="js/voltage.js"></script>
<?php 
}
?>




</body>
</html>