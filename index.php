<?php
require_once 'connect.php';

// Отримуємо списки для випадаючих меню
$nursesStmt = $pdo->query("SELECT DISTINCT name FROM nurse");
$nurses = $nursesStmt->fetchAll(PDO::FETCH_ASSOC);

$depsStmt = $pdo->query("SELECT DISTINCT department FROM nurse");
$departments = $depsStmt->fetchAll(PDO::FETCH_ASSOC);

$shiftsStmt = $pdo->query("SELECT DISTINCT shift FROM nurse");
$shifts = $shiftsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота: Чергування</title>
</head>
<body>
    <h2>Вибірка даних (Варіант 3)</h2>

    <form action="query1.php" method="GET">
        <label>Оберіть медсестру:</label>
        <select name="nurse_name" required>
            <?php foreach ($nurses as $nurse): ?>
                <option value="<?= htmlspecialchars($nurse['name']) ?>"><?= htmlspecialchars($nurse['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Показати палати</button>
    </form>
    <br><hr><br>

    <form action="query2.php" method="GET">
        <label>Оберіть відділення:</label>
        <select name="department_id" required>
            <?php foreach ($departments as $dep): ?>
                <option value="<?= htmlspecialchars($dep['department']) ?>">Відділення <?= htmlspecialchars($dep['department']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Показати медсестер</button>
    </form>
    <br><hr><br>

    <form action="query3.php" method="GET">
        <label>Оберіть зміну:</label>
        <select name="shift" required>
            <?php foreach ($shifts as $shift): ?>
                <option value="<?= htmlspecialchars($shift['shift']) ?>"><?= htmlspecialchars($shift['shift']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Показати чергування</button>
    </form>
</body>
</html>