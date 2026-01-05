<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Skills</title>
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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .skill-card {
            border: 1px dashed #bbb;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            position: relative;
        }

        .remove-skill {
            position: absolute;
            top: 10px;
            right: 10px;
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
                <a href="skills.php" class="nav-item nav-link active"> <i class="fa fa-lightbulb me-2"></i>Skills</a>
                <a href="#" class="nav-item nav-link disabled"> <i class="fa fa-certificate me-2"></i>Certificates</a>
                <a href="#" class="nav-item nav-link disabled"> <i class="fa fa-trophy me-2"></i>Achievements</a>
                <a href="#" class="nav-item nav-link disabled"> <i class="fa fa-eye me-2"></i>Preview</a>
                 <a href="#" class="nav-item nav-link disabled"><i class="fa fa-download me-2"></i>Download Resume</a>
            </div>
        </nav>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded p-4">
                <h3 class="mb-4 text-primary fw-bold">Step 4: Skills</h3>

                <form id="skillsForm">
                    <!-- Wrapper untuk semua skill -->
                    <div id="skillsWrapper"></div>

                    <!-- Button tambah skill baru -->
                    <button type="button" class="btn btn-outline-primary mb-3" onclick="addSkill()">
                        <i class="fa fa-plus"></i> Add Skill
                    </button>

                    <!-- Navigation buttons -->
                    <div class="row mt-4 gap-2">
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100 py-2" onclick="window.location.href='experience.php'">
                                Back
                            </button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                Save & Continue
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100 py-2" id="clearBtn">
                                Clear
                            </button>
                        </div>
                    </div>
                </form>

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
/* Fungsi tambah skill baru */
function addSkill(data = {}) {
    const div = document.createElement('div');
    div.className = 'skill-card';

    // HTML untuk setiap skill, lengkap dengan remove button, placeholder dan required
    div.innerHTML = `
        <button type="button" class="btn btn-sm btn-danger remove-skill">
            <i class="fa fa-trash"></i> Remove
        </button><br><br>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="fw-semibold">Skill Name</label>
                <input type="text" class="form-control name" value="${data.name||''}" placeholder="Enter skill name" required>
            </div>
            <div class="col-md-6">
                <label class="fw-semibold">Proficiency</label>
                <select class="form-select level" required>
                    <option value="">Select Level</option>
                    <option ${data.level==='Beginner'?'selected':''}>Beginner</option>
                    <option ${data.level==='Intermediate'?'selected':''}>Intermediate</option>
                    <option ${data.level==='Advanced'?'selected':''}>Advanced</option>
                    <option ${data.level==='Expert'?'selected':''}>Expert</option>
                </select>
            </div>
        </div>
    `;

    document.getElementById('skillsWrapper').appendChild(div);

    // Event listener untuk remove button
    div.querySelector('.remove-skill').addEventListener('click', function() {
        div.remove();
    });
}

/* Restore data dari localStorage bila page load */
let savedSkills = JSON.parse(localStorage.getItem('skills')) || [];
if (savedSkills.length > 0) {
    savedSkills.forEach(e => addSkill(e));
} else {
    addSkill(); // Tambah satu skill kosong default
}

/* Save data bila submit */
document.getElementById('skillsForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let skills = [];
    document.querySelectorAll('.skill-card').forEach(card => {
        skills.push({
            name: card.querySelector('.name').value,
            level: card.querySelector('.level').value
        });
    });

    localStorage.setItem('skills', JSON.stringify(skills));

    Swal.fire({
        icon: 'success',
        title: 'Skills Saved',
        text: 'Proceed to Certificates section'
    }).then(() => window.location.href='certificates.php');
});

/* Clear semua skill */
document.getElementById('clearBtn').addEventListener('click', () => {
    Swal.fire({
        title: 'Clear all skills?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, clear'
    }).then(result => {
        if (result.isConfirmed) {
            localStorage.removeItem('skills');
            document.getElementById('skillsWrapper').innerHTML = '';
            addSkill(); // Tambah satu kosong
        }
    });
});
</script>

</body>
</html>
