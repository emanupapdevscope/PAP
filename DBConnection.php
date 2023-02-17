	
	<?php
	$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "papemanu.mysql.database.azure.com", "emanu", "P@ssword1", "pap", 3306, MYSQLI_CLIENT_SSL);
	}
	?>