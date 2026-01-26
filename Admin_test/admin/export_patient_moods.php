<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    header("Location: /adhd_bridge/login.php");
    exit;
}

if (!isset($_GET['uid']) || !is_numeric($_GET['uid'])) {
    die("Invalid patient ID");
}

$service_user_id = (int) $_GET['uid'];

require_once __DIR__ . '/../includes/db.php';

$stmt = $pdo->prepare("
    SELECT 
        mood_table.id,
        service_users.name AS patient_name,
        service_users.dob,
        service_users.gender,
        wards.ward_name AS ward,
        users.name AS staff_name,
        users.role AS staff_role,
        mood_table.mood_value AS mood_score,
        mood_table.mood,
        mood_table.note,
        mood_table.entry_date
    FROM mood_table
    LEFT JOIN service_users ON mood_table.service_user_id = service_users.id
    LEFT JOIN users ON mood_table.worker_id = users.id
    LEFT JOIN wards ON service_users.ward_id = wards.id
    WHERE service_users.id = ?
    ORDER BY mood_table.entry_date DESC
");

$stmt->execute([$service_user_id]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="patient_'.$service_user_id.'_mood_history.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, [
    'Entry ID',
    'Patient Name',
    'DOB',
    'Gender',
    'Ward',
    'Entered By',
    'Staff Role',
    'Mood',
    'Mood Score',
    'Note',
    'Entry Date'
]);

foreach ($data as $row) {
    fputcsv($output, [
        $row['id'],
        $row['patient_name'],
        $row['dob'],
        $row['gender'],
        $row['ward'],
        $row['staff_name'],
        $row['staff_role'],
        $row['mood'],
        $row['mood_score'],
        $row['note'],
        "\t" . $row['entry_date']   // Excel-safe
    ]);
}

fclose($output);
exit;
