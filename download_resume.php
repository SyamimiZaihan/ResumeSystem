<?php
// download_resume.php (ATS-friendly version with sidebar navigation)

// Sambung ke database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "resume_system";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Ambil resume_id dari URL
$resume_id = isset($_GET['resume_id']) ? intval($_GET['resume_id']) : 0;
if ($resume_id <= 0) die("Invalid resume ID.");

// Ambil data dari database
$personal = $education = $experience = $skills = $certificates = $achievements = [];

$result = $conn->query("SELECT * FROM personal_details WHERE id = $resume_id");
if ($result && $result->num_rows > 0) $personal = $result->fetch_assoc();
else die("Resume not found.");

$result = $conn->query("SELECT * FROM education WHERE personal_id = $resume_id");
if ($result && $result->num_rows > 0) $education = $result->fetch_all(MYSQLI_ASSOC);

$result = $conn->query("SELECT * FROM experience WHERE personal_id = $resume_id");
if ($result && $result->num_rows > 0) $experience = $result->fetch_all(MYSQLI_ASSOC);

$result = $conn->query("SELECT * FROM skills WHERE personal_id = $resume_id");
if ($result && $result->num_rows > 0) $skills = $result->fetch_all(MYSQLI_ASSOC);

$result = $conn->query("SELECT * FROM certificates WHERE personal_id = $resume_id");
if ($result && $result->num_rows > 0) $certificates = $result->fetch_all(MYSQLI_ASSOC);

$result = $conn->query("SELECT * FROM achievements WHERE personal_id = $resume_id");
if ($result && $result->num_rows > 0) $achievements = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();

// ===============================
// Function to format date as dd-mm-yyyy
// ===============================
function formatDateDMY($date) {
    if (!$date || $date == "0000-00-00") return "-";
    return date("d-m-Y", strtotime($date));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Resume Download</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        body { font-family: 'Heebo', sans-serif; background: #FFFFFF; margin:0;}
        .container-resume { max-width: 900px; margin:auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1);}
        .preview-header { text-align:center; margin-bottom:25px;}
        .preview-header h1 { margin:0; font-size:2rem;}
        .preview-header p { margin:2px 0; color:#6c757d; font-weight:500;}
        section { margin-bottom:20px;}
        section h2 { font-size:1.2rem; color:#0d6efd; margin-bottom:10px; border-bottom:1px solid #dee2e6; padding-bottom:5px;}
        ul { padding-left:20px; }
        li { margin-bottom:5px;}
        .navbar-nav .nav-link.disabled { color: #6c757d !important; cursor: not-allowed; pointer-events: auto; }

        @media print {
            body * { visibility: hidden; }
            #resume-print, #resume-print * { visibility: visible; }
            #resume-print { position: absolute; top:0; left:0; width:100%; }
        }

        .container-resume, .container-resume h1, .container-resume h2, .container-resume p, .container-resume li, .container-resume strong, .container-resume em {
            color: #000000 !important;
        }

        .contact-grid { display: flex; gap: 40px; flex-wrap: wrap; }
        .contact-item { flex: 1; }
        .contact-item p { margin: 4px 0; color: #000; }
        .resume-list { list-style: none; padding-left: 0; }
        .resume-list li { margin-bottom: 15px; }
        .edu-header, .exp-header { display: flex; justify-content: space-between; align-items: baseline; }
        .edu-date, .exp-date { font-style: italic; font-size: 0.9rem; color: #000; }
        .exp-bullets { list-style-type: disc; margin: 5px 0 0 20px; }
    </style>
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Sidebar -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="personalDetails.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-file me-2"></i>Resume</h3>
            </a>
            <div class="navbar-nav w-100">
                <a href="personalDetails.php" class="nav-item nav-link"> <i class="fa fa-user me-2"></i>Personal Details</a>
                <a href="education.php" class="nav-item nav-link"> <i class="fa fa-graduation-cap me-2"></i>Education</a>
                <a href="experience.php" class="nav-item nav-link"> <i class="fa fa-briefcase me-2"></i>Experience</a>
                <a href="skills.php" class="nav-item nav-link"> <i class="fa fa-lightbulb me-2"></i>Skills</a>
                <a href="certificates.php" class="nav-item nav-link"> <i class="fa fa-certificate me-2"></i>Certificates</a>
                <a href="achievements.php" class="nav-item nav-link"> <i class="fa fa-trophy me-2"></i>Achievements</a>
                <a href="preview.php" class="nav-item nav-link"> <i class="fa fa-eye me-2"></i>Preview</a>
                <a href="#" class="nav-item nav-link active"> <i class="fa fa-eye me-2"></i>Download Resume</a>
            </div>
        </nav>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded p-4">
                <h3 class="mb-4 text-primary fw-bold">ATS-Friendly Resume Preview</h3>

                <div class="container-resume" id="resume-print">

                    <!-- Personal Details -->
                    <div class="preview-header">
                        <h1><?php echo htmlspecialchars($personal['full_name'] ?? 'Full Name'); ?></h1>
                        <p><?php echo htmlspecialchars($personal['job_title'] ?? 'Job Title'); ?></p>
                    </div>

                    <!-- Contact -->
                    <section>
                        <h2>Contact</h2>
                        <div class="contact-grid">
                            <div class="contact-item">
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($personal['email'] ?? '-'); ?></p>
                                <p><strong>LinkedIn:</strong> <?php echo htmlspecialchars($personal['linkedin'] ?? '-'); ?></p>
                            </div>
                            <div class="contact-item">
                                <p><strong>Phone:</strong> <?php echo $personal['phone'] ?? '-'; ?></p>
                                <p><strong>Address:</strong> <?php echo htmlspecialchars($personal['address'] ?? '-'); ?></p>
                            </div>
                        </div>
                    </section>

                    <!-- Education -->
                    <section>
                        <h2>Education</h2>
                        <ul class="resume-list">
                            <?php foreach($education as $edu): ?>
                            <li>
                                <div class="edu-header">
                                    <strong><?php echo $edu['level'] ?? '-'; ?>, <?php echo $edu['field'] ?? '-'; ?> <br> <?php echo $edu['school'] ?? '-'; ?></strong>
                                    <span class="edu-date"><?php echo formatDateDMY($edu['start_date']); ?> - <?php echo formatDateDMY($edu['end_date']); ?></span>
                                </div>
                                <?php if(!empty($edu['gpa'])): ?>
                                <div><strong>GPA:</strong> <?php echo $edu['gpa']; ?></div>
                                <?php endif; ?>
                                <?php if(!empty($edu['description'])): ?>
                                <div><em><?php echo $edu['description']; ?></em></div>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>

                    <!-- Experience -->
                    <section>
                        <h2>Experience</h2>
                        <ul class="resume-list">
                            <?php foreach($experience as $exp): ?>
                            <li>
                                <div class="exp-header">
                                    <strong><?php echo $exp['title'] ?? '-'; ?> - <br><?php echo $exp['company'] ?? '-'; ?></strong>
                                    <span class="exp-date"><?php echo formatDateDMY($exp['start_date']); ?> - <?php echo formatDateDMY($exp['end_date']); ?></span>
                                </div>
                                <?php if(!empty($exp['description'])): ?>
                                <ul class="exp-bullets">
                                    <?php 
                                    $points = explode("\n", $exp['description']);
                                    foreach($points as $point) echo "<li>$point</li>";
                                    ?>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>

                    <!-- Skills -->
                    <section>
                        <h2>Skills</h2>
                        <ul>
                            <?php foreach($skills as $s): ?>
                                <li><?php echo $s['name'] . " (" . $s['level'] . ")"; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </section>

                    <!-- Certificates -->
                    <section>
                        <h2>Certificates</h2>
                        <ul>
                        <?php foreach($certificates as $cert): ?>
                            <li>
                                <?php echo $cert['name'] ?? '-'; ?> - <?php echo $cert['org'] ?? '-'; ?> 
                                (<?php echo formatDateDMY($cert['issue_date']); ?><?php echo !empty($cert['expiry_date']) ? " - ".formatDateDMY($cert['expiry_date']) : ""; ?>)
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </section>

                    <!-- Achievements -->
                    <section>
                        <h2>Achievements</h2>
                        <ul>
                        <?php foreach($achievements as $ach): ?>
                            <li><strong><?php echo $ach['title'] ?? '-'; ?></strong> (<?php echo formatDateDMY($ach['date']); ?>): <?php echo $ach['description'] ?? '-'; ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </section>
                </div>

                <!-- Buttons: Download & Done -->
                <div class="text-center my-3 d-flex justify-content-center gap-2">
                    <button class="btn btn-primary" onclick="window.print()"><i class="fas fa-download"></i> Download Resume</button>
                    <button class="btn btn-success" onclick="window.location.href='index.html'"><i class="fas fa-check"></i> Done</button>
                </div>
            </div>
        </div>

        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded-top p-4 text-center">
                &copy; Resume Generator System
            </div>
        </div>
    </div>
</div>

</body>
</html>
