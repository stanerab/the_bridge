<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    header("Location: /adhd_bridge/login.php");
    exit;
}

require_once __DIR__ . '/../includes/db.php';



// Fetch ALL mood entries (connected to patients + staff + wards)
$stmt = $pdo->query("
    SELECT 
        mood_table.id,
        service_users.name AS patient_name,
        service_users.dob,
        service_users.gender,
        wards.ward_name AS ward,
        users.name AS staff_name,
        users.role AS staff_role,
        mood_table.mood_value AS mood_score,
        mood_table.note,
        DATE_FORMAT(mood_table.entry_date, '%Y-%m-%d %H:%i:%s') AS entry_date
    FROM mood_table
    LEFT JOIN service_users ON mood_table.service_user_id = service_users.id
    LEFT JOIN users ON mood_table.worker_id = users.id
    LEFT JOIN wards ON service_users.ward_id = wards.id
    ORDER BY mood_table.entry_date DESC
");


$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="mood_data_export.csv"');

$output = fopen('php://output', 'w');

// Column names
fputcsv($output, [
    'Mood Entry ID',
    'Patient Name',
    'DOB',
    'Gender',
    'Ward',
    'Entered By (Staff)',
    'Staff Role',
    'Mood Score',
    'Note',
    'Entry Date'
]);

// Data rows
foreach ($data as $row) {
    fputcsv($output, [
        $row['id'],
        $row['patient_name'],
        $row['dob'],
        $row['gender'],
        $row['ward'],
        $row['staff_name'],
        $row['staff_role'],
        $row['mood_score'],
        $row['note'],
        "\t" . $row['entry_date']   // 👈 Force Excel text mode
    ]);
}

fclose($output);
exit;
