
if (document.getElementById("LoginButton")) {
	document.getElementById("LoginButton").onclick = function() {Login()};
}

if (document.getElementById("RegButton")) {
	document.getElementById("RegButton").onclick = function() {Reg()};
}

if (document.getElementById("LogoutButton")) {
	document.getElementById("LogoutButton").onclick = function() {Logout()};
}

if (document.getElementById("NewThreadButton")) {
	document.getElementById("NewThreadButton").onclick = function() {NewThread()};
}

if (document.getElementById("NewCommentButton")) {
	document.getElementById("NewCommentButton").onclick = function() {NewComment()};
}


function Login() {
	var Email = document.getElementById("LogName");
	var Pass = document.getElementById("LogPass");
	
	$.ajax({
		url: '',
		type: 'POST',               
		data: function(){
			var data = new FormData();
			
			data.append('type', 0 );  
			data.append('Username', Email.value );
			data.append('Password', Pass.value );							
			return data;
		}(),
		success: function (data) {
			try {
				var obj = JSON.parse(data);
				if(obj.error) {
					ServerError("Error: " + obj.data);
				} else{
					location.reload();
				}
			} catch (e) {
				ServerError(e);
			}
		},
		error: function (data) {
			ServerError(data.status + ": " + data.statusText);
		},
		complete: function () {                 

		},
		cache: false,
		contentType: false,
		processData: false
	});
}

function Reg() {
	var Email = document.getElementById("RegName");
	var Pass = document.getElementById("RegPass");
	
	$.ajax({
		url: '',
		type: 'POST',               
		data: function(){
			var data = new FormData();
			
			data.append('type', 1 );  
			data.append('Username', Email.value );
			data.append('Password', Pass.value );							
			return data;
		}(),
		success: function (data) {
			try {
				var obj = JSON.parse(data);
				if(obj.error) {
					ServerError("Error: " + obj.data);
				} else{
					ServerError( obj.data);
				}
			} catch (e) {
				ServerError(e);
			}
		},
		error: function (data) {
			ServerError(data.status + ": " + data.statusText);
		},
		complete: function () {                 

		},
		cache: false,
		contentType: false,
		processData: false
	});
}

function Logout() {
	
	$.ajax({
		url: '',
		type: 'POST',               
		data: function(){
			var data = new FormData();
			
			data.append('type', 2 );  						
			return data;
		}(),
		success: function (data) {
			try {
				var obj = JSON.parse(data);
				if(obj.error) {
					ServerError("Error: " + obj.data);
				} else{
					location.reload();
				}
			} catch (e) {
				ServerError(e);
			}
		},
		error: function (data) {
			ServerError(data.status + ": " + data.statusText);
		},
		complete: function () {                 

		},
		cache: false,
		contentType: false,
		processData: false
	});
}

function NewThread() {
	var Nev = document.getElementById("NewThread");
	
	$.ajax({
		url: '',
		type: 'POST',               
		data: function(){
			var data = new FormData();
			
			data.append('type', 4 );  	
			data.append('Name', Nev.value ); 			
			return data;
		}(),
		success: function (data) {
			try {
				var obj = JSON.parse(data);
				if(obj.error) {
					ServerError("Error: " + obj.data);
				} else{
					location.reload();
				}
			} catch (e) {
				ServerError(e);
			}
		},
		error: function (data) {
			ServerError(data.status + ": " + data.statusText);
		},
		complete: function () {                 

		},
		cache: false,
		contentType: false,
		processData: false
	});
}

function NewComment() {
	var Komment = document.getElementById("Komment");

	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	const Id = urlParams.get('Thread')
	
	$.ajax({
		url: '',
		type: 'POST',               
		data: function(){
			var data = new FormData();
			
			data.append('type', 6 );
			data.append('For', Id );
			data.append('Text', Komment.value ); 			
			return data;
		}(),
		success: function (data) {
			try {
				var obj = JSON.parse(data);
				if(obj.error) {
					ServerError("Error: " + obj.data);
				} else{
					location.reload();
				}
			} catch (e) {
				ServerError(e);
			}
		},
		error: function (data) {
			ServerError(data.status + ": " + data.statusText);
		},
		complete: function () {                 

		},
		cache: false,
		contentType: false,
		processData: false
	});
}

function Open(Id) {
	window.location.href = "https://krisz768.hu/egyetem/beadando?Thread=" + Id;
}

function ServerError(Error) {
	alert(Error);
}