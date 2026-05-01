<?php
require 'connect.php';


header('Content-Type: application/json');

$type = $_GET['type'] ?? '';
$value = $_GET['value'] ?? '';
$results = [];

try {
    if ($type === 'department') {
        // 1. Медсестри за відділенням
        $stmt = $pdo->prepare("SELECT name FROM nurse WHERE department = ?");
        $stmt->execute([$value]);
        $results = $stmt->fetchAll();
    } 
    elseif ($type === 'wards') {
        // 2. Палати вибраної медсестри
        $sql = "SELECT w.name AS ward_name 
                FROM ward w 
                JOIN nurse_ward nw ON w.id_ward = nw.fid_ward 
                JOIN nurse n ON nw.fid_nurse = n.id_nurse 
                WHERE n.name = ?";
                
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value]);
        $results = $stmt->fetchAll();
    } 
    elseif ($type === 'shift') {
        // 3. Медсестри за зміною
        $stmt = $pdo->prepare("SELECT name, department FROM nurse WHERE shift = ?");
        $stmt->execute([$value]);
        $results = $stmt->fetchAll();
    }

    echo json_encode($results);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>