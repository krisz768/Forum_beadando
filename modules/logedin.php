<center> <h1> Adatok: </h1> </center>     
			<div class="container">   
				Felhasználónév :   <?php echo $_SESSION["Name"]; ?>
				<button id="LogoutButton">Kijelentkezés</button>
				
				<label>Új_Thread : </label>   
				<input id="NewThread" type="text" placeholder="Név" required>  
				<button id="NewThreadButton">Létrehozás</button>
			</div>