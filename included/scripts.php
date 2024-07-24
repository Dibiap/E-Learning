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

	function showUsers(category) {
		if (category === "") {
			demo.showNotification("top", "right", "Cannot find user category");
			return;
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("users").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("POST", "func/getusers", true);
			xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xmlhttp.send("category=" + encodeURIComponent(category));

		}
	}
</script>
<?php
require_once "included/alert.php";
?>
</body>

</html>