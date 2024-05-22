		</nav>
		<div id="sidebar" class="bg-light">
			<div id="sidebar-field">
				<a href="home.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-home"> </i></div>  Home
				</a>
			</div>
			<?php if($_SESSION['login_user_type'] != 3): ?>
			<?php if($_SESSION['login_user_type'] == 1): ?>
			<div id="sidebar-field">
				<a href="customer.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-users"> </i></div>  Customer Care List
				</a>
			</div>
		<?php endif; ?>
			<div id="sidebar-field">
				<a href="user.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-users"> </i></div>  User List
				</a>
			</div>
			<div id="sidebar-field">
				<a href="location.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-history"> </i></div>  User Details
				</a>
			</div>

		<?php endif; ?>

		</div>
		<script>
			$(document).ready(function(){
				var loc = window.location.href;
				loc.split('{/}')
				$('#sidebar a').each(function(){
				// console.log(loc.substr(loc.lastIndexOf("/") + 1),$(this).attr('href'))
					if($(this).attr('href') == loc.substr(loc.lastIndexOf("/") + 1)){
						$(this).addClass('active')
					}
				})
			})
			
		</script>