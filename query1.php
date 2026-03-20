<?php
require_once 'connect.php';

if (isset($_GET['nurse_name'])) {
    $nurse_name = $_GET['nurse_name'];
    $sql = "SELECT w.name AS ward_name 
            FROM ward w
            JOIN nurse_ward nw ON w.id_ward = nw.fid_ward
            JOIN nurse n ON nw.fid_nurse = n.id_nurse
            WHERE n.name = :nurse_name";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nurse_name' => $nurse_name]);
    $wards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Не обрано медсестру.");
}
?>

<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Запит 1</title></head>
<body>
    <h2>Палати, в яких чергує медсестра: <?= htmlspecialchars($nurse_name) ?></h2>
    <?php if (!empty($wards)): ?>
        <ul>
            <?php foreach ($wards as $ward): ?>
                <li><?= htmlspecialchars($ward['ward_name']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Для цієї медсестри не знайдено прив'язаних палат.</p>
    <?php endif; ?>
    <br><a href="index.php">Повернутися на головну</a>
</body>
</html>