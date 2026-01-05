<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Experience</title>
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
        .exp-card {
            border: 1px dashed #bbb;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
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
                <a href="experience.php" class="nav-item nav-link active"> <i class="fa fa-briefcase me-2"></i>Experience</a>
                <a href="#" class="nav-item nav-link disabled"> <i class="fa fa-lightbulb me-2"></i>Skills</a>
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
                <h3 class="mb-4 text-primary fw-bold">Step 3: Experience</h3>

                <form id="experienceForm">
                    <!-- Wrapper untuk semua experience card -->
                    <div id="experienceWrapper"></div>

                    <!-- Button tambah experience baru -->
                    <button type="button" class="btn btn-outline-primary mb-3" onclick="addExperience()">
                        <i class="fa fa-plus"></i> Add Experience
                    </button>

                    <!-- Navigation buttons -->
                    <div class="row mt-4 gap-2">
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100 py-2" onclick="window.location.href='education.php'">
                                Back
                            </button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                Save & Continue
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100 py-2" id="resetBtn">
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
/* Fungsi untuk tambah experience baru */
function addExperience(data = {}) {
    const div = document.createElement('div');
    div.className = 'exp-card';
    div.innerHTML = `
        <div class="row g-3">
            <!-- Butang remove -->
            <div class="col-12 text-end">
                <button type="button" class="btn btn-sm btn-danger remove-exp">
                    <i class="fa fa-trash"></i> Remove
                </button>
            </div>

            <div class="col-md-6">
                <label class="fw-semibold">Job Title / Position</label>
                <input type="text" class="form-control title" value="${data.title||''}" placeholder="Enter job title / position" required>
            </div>
            <div class="col-md-6">
                <label class="fw-semibold">Company</label>
                <input type="text" class="form-control company" value="${data.company||''}" placeholder="Enter company name" required>
            </div>
            <div class="col-md-6">
                <label class="fw-semibold">Start Date</label>
                <input type="month" class="form-control start_date" value="${data.start_date||''}" required>
            </div>
            <div class="col-md-6">
                <label class="fw-semibold">End Date</label>
                <input type="month" class="form-control end_date" value="${data.end_date||''}" required>
            </div>
            <div class="col-12">
                <label class="fw-semibold">Description / Job Scope</label>
                <textarea class="form-control description" rows="2" placeholder="Enter description / job scope" required>${data.description||''}</textarea>
            </div>
        </div>
    `;

    // Tambah card ke wrapper
    document.getElementById('experienceWrapper').appendChild(div);

    // Event listener untuk remove button
    div.querySelector('.remove-exp').addEventListener('click', function() {
        div.remove();
    });
}

/* Restore data dari localStorage bila page load */
let savedExp = JSON.parse(localStorage.getItem('experience')) || [];
if (savedExp.length > 0) {
    savedExp.forEach(e => addExperience(e));
} else {
    addExperience(); // Tambah satu card kosong sebagai default
}

/* Simpan data bila submit */
document.getElementById('experienceForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let experience = [];
    document.querySelectorAll('.exp-card').forEach(card => {
        experience.push({
            title: card.querySelector('.title').value,
            company: card.querySelector('.company').value,
            start_date: card.querySelector('.start_date').value,
            end_date: card.querySelector('.end_date').value,
            description: card.querySelector('.description').value
        });
    });

    localStorage.setItem('experience', JSON.stringify(experience));

    Swal.fire({
        icon: 'success',
        title: 'Experience Saved',
        text: 'Proceed to Skills section'
    }).then(() => window.location.href='skills.php');
});

/* ===== RESET FORM ===== */
document.getElementById('resetBtn').addEventListener('click', () => {
    Swal.fire({
        title: 'Clear all experience data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, clear'
    }).then(result => {
        if (result.isConfirmed) {
            localStorage.removeItem('experience'); // Clear localStorage
            document.getElementById('experienceWrapper').innerHTML = ''; // Clear semua card
            addExperience(); // Tambah satu card kosong
        }
    });
});
</script>

</body>
</html>
