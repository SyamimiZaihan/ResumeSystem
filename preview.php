<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Resume Preview</title>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Heebo', sans-serif;
            background: #f8f9fa;
        }
        .preview-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .preview-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .preview-header p {
            font-size: 1.1rem;
            color: #6c757d;
        }
        .preview-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #0d6efd;
            display: flex;
            align-items: center;
        }
        .section-title i {
            margin-right: 8px;
            color: #0d6efd;
        }
        .preview-label {
            font-weight: 500;
        }
        .preview-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .preview-item {
            flex: 1 1 45%;
        }
        .navbar-nav .nav-link.disabled {
            color: #6c757d !important;
            cursor: not-allowed;
            pointer-events: auto;
        }
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
                <a href="#" class="nav-item nav-link active"> <i class="fa fa-eye me-2"></i>Preview</a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-download me-2"></i>Download Resume</a>
            </div>
        </nav>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded p-4">
                
                <!-- Header -->
                <div class="preview-header">
                    <h1 id="fullName">Full Name</h1>
                    <p id="jobTitle">Job Title</p>
                </div>

                <!-- Preview Content -->
                <div id="previewContent"></div>

                <div class="row mt-4 gap-2">
                    <div class="col">
                        <button type="button" class="btn btn-secondary w-100 py-2" onclick="window.history.back()">
                            Back
                        </button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-success w-100 py-2" id="submitBtn">
                            Submit Resume
                        </button>
                    </div>
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

<script>
// Fungsi untuk render setiap section dengan spacing dan card style
function renderSection(title, items, fields, iconClass = 'fas fa-folder') {
    if (!items || items.length === 0) return '';

    // Container section
    let html = `
        <div class="preview-card" style="margin-bottom:20px;">
            <div class="section-title" style="font-weight:600; font-size:1.2rem; margin-bottom:10px;">
                <i class="${iconClass}"></i> ${title}
            </div>
    `;

    // Loop setiap item dalam section
    items.forEach((item, index) => {
        html += `
            <div class="preview-row" 
                 style="border:1px solid #ddd; border-radius:8px; padding:12px; margin-bottom:10px; background:#f9f9f9;">
        `;

        // Loop setiap field dalam item
        fields.forEach(f => {
            html += `
                <div class="preview-item" style="margin-bottom:6px;">
                    <span class="preview-label" style="font-weight:500;">${f.label}:</span> ${item[f.key] || '-'}
                </div>
            `;
        });

        html += `</div>`; // Tutup preview-row
    });

    html += `</div>`; // Tutup preview-card
    return html;
}

// Load semua data dari localStorage
const personal = JSON.parse(localStorage.getItem('personalDetails')) || {};
const education = JSON.parse(localStorage.getItem('education')) || [];
const experience = JSON.parse(localStorage.getItem('experience')) || [];
const skills = JSON.parse(localStorage.getItem('skills')) || [];
const certificates = JSON.parse(localStorage.getItem('certificates')) || [];
const achievements = JSON.parse(localStorage.getItem('achievements')) || [];

let previewHTML = '';

// Header
document.getElementById('fullName').innerText = personal.fullName || 'Full Name';
document.getElementById('jobTitle').innerText = personal.jobTitle || 'Job Title';

// Personal Details
previewHTML += renderSection('Personal Details', [personal], [
    {key:'email', label:'Email'},
    {key:'phone', label:'Phone'},
    {key:'address', label:'Address'},
    {key:'linkedin', label:'LinkedIn / Portfolio'}
], 'fas fa-user');

// Education
previewHTML += renderSection('Education', education, [
    {key:'level', label:'Level'},
    {key:'field', label:'Field'},
    {key:'school', label:'Institution'},
    {key:'gpa', label:'GPA/Result'},
    {key:'start_date', label:'Start'},
    {key:'end_date', label:'End'},
    {key:'description', label:'Description'}
], 'fas fa-graduation-cap');

// Experience
previewHTML += renderSection('Experience', experience, [
    {key:'title', label:'Job Title'},
    {key:'company', label:'Company'},
    {key:'start_date', label:'Start'},
    {key:'end_date', label:'End'},
    {key:'description', label:'Description'}
], 'fas fa-briefcase');

// Skills
previewHTML += renderSection('Skills', skills, [
    {key:'name', label:'Skill Name'},
    {key:'level', label:'Proficiency'}
], 'fas fa-lightbulb');

// Certificates
previewHTML += renderSection('Certificates', certificates, [
    {key:'name', label:'Certificate Name'},
    {key:'org', label:'Issuing Org'},
    {key:'issue_date', label:'Issue Date'},
    {key:'expiry_date', label:'Expiry Date'}
], 'fas fa-certificate');

// Achievements
previewHTML += renderSection('Achievements', achievements, [
    {key:'title', label:'Title'},
    {key:'date', label:'Date'},
    {key:'description', label:'Details'}
], 'fas fa-trophy');

// Masukkan HTML ke dalam container preview
document.getElementById('previewContent').innerHTML = previewHTML;

// Submit Resume and redirect to download page
document.getElementById('submitBtn').addEventListener('click', () => {
    fetch('submit_resume.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({ personal, education, experience, skills, certificates, achievements })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            Swal.fire({
                icon: 'success',
                title: 'Resume Submitted',
                text: 'Your resume has been saved to the database!'
            }).then(() => {
                localStorage.clear();
                // Redirect ke download_resume.php dengan resume_id
                window.location.href = `download_resume.php?resume_id=${data.resume_id}`;
            });
        } else {
            Swal.fire('Error', 'Failed to submit resume', 'error');
        }
    })
    .catch(err => Swal.fire('Error', 'Failed to submit resume', 'error'));
});
</script>


</body>
</html>
