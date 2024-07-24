<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/js/plugins/chartjs.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
<script src="assets/demo/demo.js"></script>
<script>
	$(document).ready(function() {
		demo.initChartsPages();
	});

	function setUserRole(user_id, role) {
		if (user_id === "" || role === "") {
			demo.showNotification("top", "right", "Cannot find user or role");
			return;
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if (this.responseText == "Refresh") {
						window.location.reload()
					}
				}
			};
			xmlhttp.open("POST", "func/getusers", true);
			xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xmlhttp.send("user_id=" + encodeURIComponent(user_id) + "&role=" + encodeURIComponent(role));

		}
	}
</script>
<?php
require_once "included/alert.php";
?>
</body>

</html>