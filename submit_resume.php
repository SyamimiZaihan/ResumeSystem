<?php
header('Content-Type: application/json');

// Database configuration
$host = "localhost";
$db   = "resume_system";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
    exit;
}

// Read JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['personal'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No data received'
    ]);
    exit;
}

try {
    // Start transaction
    $pdo->beginTransaction();

    // 1. Personal Details
    $p = $data['personal'];

    $stmt = $pdo->prepare("
        INSERT INTO personal_details
        (full_name, job_title, email, phone, address, linkedin)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $p['fullName'] ?? null,
        $p['jobTitle'] ?? null,
        $p['email'] ?? null,
        $p['phone'] ?? null,
        $p['address'] ?? null,
        $p['linkedin'] ?? null
    ]);

    // Dapatkan ID resume untuk foreign key
    $resume_id = $pdo->lastInsertId();

    // 2. Education
    if (!empty($data['education'])) {
        $stmt = $pdo->prepare("
            INSERT INTO education
            (personal_id, level, field, school, gpa, start_date, end_date, description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        foreach ($data['education'] as $edu) {
            // ⚡ Fix: Ubah format date dari YYYY-MM → YYYY-MM-01
            $start_date = !empty($edu['start_date']) ? $edu['start_date'].'-01' : null;
            $end_date   = !empty($edu['end_date']) ? $edu['end_date'].'-01' : null;

            $stmt->execute([
                $resume_id,
                $edu['level'] ?? null,
                $edu['field'] ?? null,
                $edu['school'] ?? null,
                $edu['gpa'] ?? null,
                $start_date,
                $end_date,
                $edu['description'] ?? null
            ]);
        }
    }

    // 3. Experience
    if (!empty($data['experience'])) {
        $stmt = $pdo->prepare("
            INSERT INTO experience
            (personal_id, title, company, start_date, end_date, description)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        foreach ($data['experience'] as $exp) {
            // ⚡ Fix: Ubah format date dari YYYY-MM → YYYY-MM-01
            $start_date = !empty($exp['start_date']) ? $exp['start_date'].'-01' : null;
            $end_date   = !empty($exp['end_date']) ? $exp['end_date'].'-01' : null;

            $stmt->execute([
                $resume_id,
                $exp['title'] ?? null,
                $exp['company'] ?? null,
                $start_date,
                $end_date,
                $exp['description'] ?? null
            ]);
        }
    }

    // 4. Skills
    if (!empty($data['skills'])) {
        $stmt = $pdo->prepare("
            INSERT INTO skills
            (personal_id, name, level)
            VALUES (?, ?, ?)
        ");

        foreach ($data['skills'] as $skill) {
            $stmt->execute([
                $resume_id,
                $skill['name'] ?? null,
                $skill['level'] ?? null
            ]);
        }
    }

    // 5. Certificates
    if (!empty($data['certificates'])) {
        $stmt = $pdo->prepare("
            INSERT INTO certificates
            (personal_id, name, org, issue_date, expiry_date)
            VALUES (?, ?, ?, ?, ?)
        ");

        foreach ($data['certificates'] as $cert) {
            // ⚡ Fix: Ubah format date dari YYYY-MM → YYYY-MM-01
            $issue_date  = !empty($cert['issue_date']) ? $cert['issue_date'].'-01' : null;
            $expiry_date = !empty($cert['expiry_date']) ? $cert['expiry_date'].'-01' : null;

            $stmt->execute([
                $resume_id,
                $cert['name'] ?? null,
                $cert['org'] ?? null,
                $issue_date,
                $expiry_date
            ]);
        }
    }

    // 6. Achievements
    if (!empty($data['achievements'])) {
        $stmt = $pdo->prepare("
            INSERT INTO achievements
            (personal_id, title, date, description)
            VALUES (?, ?, ?, ?)
        ");

        foreach ($data['achievements'] as $ach) {
            // ⚡ Fix: Ubah format date dari YYYY-MM → YYYY-MM-01
            $date = !empty($ach['date']) ? $ach['date'].'-01' : null;

            $stmt->execute([
                $resume_id,
                $ach['title'] ?? null,
                $date,
                $ach['description'] ?? null
            ]);
        }
    }

    // Commit transaction
    $pdo->commit();

    // return resume_id untuk download/redirect
    echo json_encode([
        'success'   => true,
        'resume_id'=> $resume_id
    ]);

} catch (Exception $e) {
    // Rollback kalau ada error
    $pdo->rollBack();
    echo json_encode([
        'success' => false,
        'message' => 'Failed to save resume'
    ]);
}
?>
