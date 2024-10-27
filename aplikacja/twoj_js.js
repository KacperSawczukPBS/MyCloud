function myLoadHeader() 
{ 
	$(document).ready(function()
	{ 
		$('#myHeader').load("header.php"); 
	}); 
}

function getUserInfo() {
	// Pobieranie danych z przeglądarki
	var screenResolution = screen.width + "x" + screen.height; // Rozdzielczość ekranu
	var windowResolution = window.innerWidth + "x" + window.innerHeight; // Rozdzielczość okna przeglądarki
	var colorDepth = screen.colorDepth; // Ilość kolorów
	var cookiesEnabled = navigator.cookieEnabled; // Czy ciasteczka są włączone
	var javaEnabled = navigator.javaEnabled(); // Czy Java jest włączona
	var browserLanguage = navigator.language || navigator.userLanguage; // Język przeglądarki

	// Tworzenie obiektu do przechowywania informacji
	var userInfo = {
		screenResolution: screenResolution,
		windowResolution: windowResolution,
		colorDepth: colorDepth,
		cookiesEnabled: cookiesEnabled,
		javaEnabled: javaEnabled,
		browserLanguage: browserLanguage
	};

	// Wysyłanie danych do PHP za pomocą AJAX
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "geolokalizacja.php", true);
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			console.log(xhr.responseText); // Odpowiedź z PHP
		}
	};
	xhr.send(JSON.stringify(userInfo));
}