<?php
require_once 'connect.php';

if (isset($_GET['shift'])) {
    $shift = $_GET['shift'];
    $sql = "SELECT n.name AS nurse_name, w.name AS ward_name 
            FROM nurse n
            JOIN nurse_ward nw ON n.id_nurse = nw.fid_nurse
            JOIN ward w ON nw.fid_ward = w.id_ward
            WHERE n.shift = :shift";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['shift' => $shift]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Не обрано зміну.");
}
?>

<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Запит 3</title></head>
<body>
    <h2>Чергування у зміну: <?= htmlspecialchars($shift) ?></h2>
    <?php if (!empty($results)): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr><th>Медсестра</th><th>Палата</th></tr>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nurse_name']) ?></td>
                    <td><?= htmlspecialchars($row['ward_name']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>У цю зміну немає чергувань.</p>
    <?php endif; ?>
    <br><a href="index.php">Повернутися на головну</a>
</body>
</html>