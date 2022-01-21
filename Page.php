<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
	<link rel="stylesheet" href="Style.css">
</head>
<body>
	<div class="Page">
		<div class="Threads">
			<?php
				if(!isset($_GET['Thread'])) {
					$db = new DBOperations();
					$data = $db->getThreads();
					
					for ($i = 0; $i < count($data); $i++) {
						$date = new DateTime($data[$i]["CreatedOn"]);
						echo "<div class='Thread'><p>" . $data[$i]["Nev"] . "</p> <p>" . $date->format('Y. m. d. H:i:s') . "</p> <button onclick='Open(" . $data[$i]["Id"] . ")'>Megnyitás</button> </div>";
					}
				} else {
					$db = new DBOperations();
					$data = $db->GetComments($_GET['Thread']);
					
					for ($i = 0; $i < count($data); $i++) {
						$date = new DateTime($data[$i]["DateTime"]);
						echo "<div class='Thread'><p>" . $data[$i]["CreatedByName"] . "</p> <p>" . $date->format('Y. m. d. H:i:s') . "</p> <p>" . $data[$i]["Komment"] . "</p>  </div>";
					}

					if ($Login) {
						echo "Komment hozzáadása: <input id=\"Komment\" type=\"text\" placeholder=\"Komment\" required>  <button id=\"NewCommentButton\">Létrehozás</button>";
					}
					
				}
			?>
		</div>
		
		<div class="UserInfo">
			<?php
				if ($Login) {
					require_once './modules/logedin.php';
				} else {
					require_once './modules/login.php';
				}
			?>	
		</div>
	</div>
</body>
<script src="Jquery/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
</html>