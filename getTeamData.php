<?php
include 'MysqlConnection.php'; // Uključi datoteku za MySQL konekciju

try {
    $stmt = $conn->prepare("SELECT name, position, image FROM team");
    $stmt->execute();

    // Postavljanje rezultata u obliku asocijativnog niza
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll(); // Dohvati sve redove iz rezultata

    // Vrati podatke u JSON formatu
    echo json_encode($data);
} catch(PDOException $e) {
    echo "Greška u dohvatu podataka iz baze: " . $e->getMessage();
}
?>
