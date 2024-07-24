<?php
try {
	$con = mysqli_connect("localhost", "root", "", "logbook");
} catch (Exception $e) {
	// Contains Database Error Messages
	echo '<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Connection Error</title><style>body{font-family:Arial,sans-serif;background-color:#15111f;margin:0;padding:0;display:flex;align-items:center;justify-content:center;height:100vh;}.error-container{text-align:center;background-color:#240c3c;padding:20px;border-radius:8px;box-shadow:0 0 10px rgba(255,255,255,0.9);max-width:400px;width:100%;}.error-icon{font-size:50px;color:#dc3232;margin-bottom:20px;}.error-message{font-size:18px;color:#f1f1f1;margin-bottom:20px;}.retry-button{display:inline-block;padding:10px 20px;background-color:#5142FC;color:#fff;text-decoration:none;border-radius:4px;transition:background-color 0.3s;}.retry-button:hover{background-color:#292181;}p{color:#f1f1f1}</style></head><body><div class="error-container"><div class="error-icon">&#9888;</div><div class="error-message">Connection Failed</div><p>There was an error while attempting a connection. Please check your connection settings.</p><a href="index" class="retry-button">Retry</a></div></body></html>';
	exit;
}