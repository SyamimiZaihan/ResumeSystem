<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Education</title>
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
        .edu-card {
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
                <a href="personalDetails.php" class="nav-item nav-link">
                    <i class="fa fa-user me-2"></i>Personal Details
                </a>
                <a href="education.php" class="nav-item nav-link active">
                    <i class="fa fa-graduation-cap me-2"></i>Education
                </a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-briefcase me-2"></i>Experience</a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-lightbulb me-2"></i>Skills</a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-certificate me-2"></i>Certificates</a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-trophy me-2"></i>Achievements</a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-eye me-2"></i>Preview</a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-download me-2"></i>Download Resume</a>
            </div>
        </nav>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded p-4">
                <h3 class="mb-4 text-primary fw-bold">Step 2: Education</h3>

                <form id="educationForm">
                    <!-- Wrapper untuk semua education card -->
                    <div id="educationWrapper"></div>

                    <!-- Button tambah education baru -->
                    <button type="button" class="btn btn-outline-primary mb-3" onclick="addEducation()">
                        <i class="fa fa-plus"></i> Add Education
                    </button>

                    <!-- Navigation buttons -->
                    <div class="row mt-4 gap-2">
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100 py-2" onclick="window.location.href='personalDetails.php'">
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
/* Fungsi untuk tambah education baru */
function addEducation(data = {}) {
    const div = document.createElement('div');
    div.className = 'edu-card';
    div.innerHTML = `
        <div class="row g-3">
            <!-- Butang remove -->
            <div class="col-12 text-end">
                <button type="button" class="btn btn-sm btn-danger remove-edu">
                    <i class="fa fa-trash"></i> Remove
                </button>
            </div>

            <div class="col-md-6">
                <label class="fw-semibold">Education Level</label>
                <select class="form-select level" required>
                    <option value="">Select</option>
                    <option ${data.level==='Primary School'?'selected':''}>Primary School</option>
                    <option ${data.level==='Secondary School'?'selected':''}>Secondary School</option>
                    <option ${data.level==='SPM / O-Level'?'selected':''}>SPM / O-Level</option>
                    <option ${data.level==='STPM / Foundation'?'selected':''}>STPM / Foundation</option>
                    <option ${data.level==='Diploma'?'selected':''}>Diploma</option>
                    <option ${data.level==='Bachelor Degree'?'selected':''}>Bachelor Degree</option>
                    <option ${data.level==='Master Degree'?'selected':''}>Master Degree</option>
                    <option ${data.level==='PhD'?'selected':''}>PhD</option>
                    <option ${data.level==='Certification'?'selected':''}>Certification</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="fw-semibold">Field of Study</label>
                <input type="text" class="form-control field" value="${data.field||''}" placeholder="Enter your field of study" required>
            </div>

            <div class="col-md-6">
                <label class="fw-semibold">Institution</label>
                <input type="text" class="form-control school" value="${data.school||''}" placeholder="Enter your institution name" required>
            </div>

            <div class="col-md-6">
                <label class="fw-semibold">GPA / Result</label>
                <input type="text" class="form-control gpa" value="${data.gpa||''}" placeholder="Enter your GPA or result" required>
            </div>

            <div class="col-md-6">
                <label class="fw-semibold">Start Date</label>
                <input type="month" class="form-control start_date" value="${data.start_date||''}" placeholder="Select start month" required>
            </div>

            <div class="col-md-6">
                <label class="fw-semibold">End Date</label>
                <input type="month" class="form-control end_date" value="${data.end_date||''}" placeholder="Select end month" required>
            </div>

            <div class="col-12">
                <label class="fw-semibold">Description / Achievements</label>
                <textarea class="form-control description" rows="2" placeholder="Enter description or achievements" required>${data.description||''}</textarea>
            </div>
        </div>
    `;

    // Tambah card ke wrapper
    document.getElementById('educationWrapper').appendChild(div);

    // Event listener untuk remove button
    div.querySelector('.remove-edu').addEventListener('click', function() {
        div.remove();
    });
}

/* Restore data dari localStorage bila page load */
let saved = JSON.parse(localStorage.getItem('education')) || [];
if (saved.length > 0) {
    saved.forEach(e => addEducation(e));
} else {
    addEducation(); // Tambah satu card kosong sebagai default
}

/* Simpan data bila submit */
document.getElementById('educationForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let education = [];
    document.querySelectorAll('.edu-card').forEach(card => {
        education.push({
            level: card.querySelector('.level').value,
            field: card.querySelector('.field').value,
            school: card.querySelector('.school').value,
            gpa: card.querySelector('.gpa').value,
            start_date: card.querySelector('.start_date').value,
            end_date: card.querySelector('.end_date').value,
            description: card.querySelector('.description').value
        });
    });

    localStorage.setItem('education', JSON.stringify(education));

    Swal.fire({
        icon: 'success',
        title: 'Education Saved',
        text: 'Proceed to Experience section'
    }).then(() => {
        window.location.href = 'experience.php';
    });
});

/* ===== RESET FORM ===== */
document.getElementById('resetBtn').addEventListener('click', () => {
    Swal.fire({
        title: 'Clear all education data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, clear'
    }).then(result => {
        if (result.isConfirmed) {
            localStorage.removeItem('education'); // Clear localStorage
            document.getElementById('educationWrapper').innerHTML = ''; // Clear semua card
            addEducation(); // Tambah satu card kosong
        }
    });
});
</script>

</body>
</html>
