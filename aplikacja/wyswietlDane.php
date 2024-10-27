<?php include 'scripts/sql_connection.php';

$connection = get_sql_connection();

// Sprawdzamy, czy połączenie działa
					if (!$connection) {
    					die("Połączenie nieudane: " . mysqli_connection_error());
					}
					
					$sql = "SELECT * FROM goscieportalu";
					$result = mysqli_query($connection, $sql);

					if (!$result) {
    					// Wyświetlenie błędu zapytania SQL, jeśli wystąpił problem
    					die("Błąd w zapytaniu SQL: " . mysqli_error($connection));
					}
					
					if (mysqli_num_rows($result) > 0) {

						// Tworzymy tabelę HTML do wyświetlenia wyników
						echo "<table class=\"table\" border='1'>";
						echo "<thead>
								<tr>
									<th class=\"col\">Adres IP</th>
									<th class=\"col\">Przeglądarka</th>
									<th class=\"col\">Rozdzielczość ekranu</th>
									<th class=\"col\">Rozdzielczość okna przeglądarki</th>
									<th class=\"col\">Głębia kolorów</th>
									<th class=\"col\">Ciasteczka włączone</th>
									<th class=\"col\">Java włączona</th>
									<th class=\"col\">Język przeglądarki</th>
							    </tr>
							</thead>";
						echo "<tbody>";
						// Wyświetlamy każdą linię danych
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td>" . $row['ipaddress'] . "</td>";
							echo "<td>" . $row['browser'] . "</td>";
							echo "<td>" . $row['screenResolution'] . "</td>";
							echo "<td>" . $row['windowResolution'] . "</td>";
							echo "<td>" . $row['colorDepth'] . "</td>";
							echo "<td>" . ($row['cookiesEnabled'] ? 'Tak' : 'Nie') . "</td>";
							echo "<td>" . ($row['javaEnabled'] ? 'Tak' : 'Nie') . "</td>";
							echo "<td>" . $row['browserLanguage'] . "</td>";
							echo "</tr>";
						}
						echo "</tbody>";
						// Zakończenie tabeli HTML
						echo "</table>";
					} else {
						echo "Brak danych do wyświetlenia.";
					}
?>
