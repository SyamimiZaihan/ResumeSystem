<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Achievements</title>
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
        .ach-card {
            border: 1px dashed #bbb;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            position: relative;
        }

        .remove-ach {
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
                <a href="skills.php" class="nav-item nav-link"> <i class="fa fa-lightbulb me-2"></i>Skills</a>
                <a href="certificates.php" class="nav-item nav-link"> <i class="fa fa-certificate me-2"></i>Certificates</a>
                <a href="achievements.php" class="nav-item nav-link active"> <i class="fa fa-trophy me-2"></i>Achievements</a>
                <a href="preview.php" class="nav-item nav-link disabled"> <i class="fa fa-eye me-2"></i>Preview</a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-download me-2"></i>Download Resume</a>
            </div>
        </nav>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded p-4">
                <h3 class="mb-4 text-primary fw-bold">Step 6: Achievements</h3>

                <form id="achForm">
                    <div id="achWrapper"></div>

                    <button type="button" class="btn btn-outline-primary mb-3" onclick="addAch()">
                        <i class="fa fa-plus"></i> Add Achievement
                    </button>

                    <div class="row mt-4 gap-2">
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100 py-2" onclick="window.location.href='certificates.php'">
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
/* Fungsi tambah achievement baru */
function addAch(data = {}) {
    const div = document.createElement('div');
    div.className = 'ach-card';

    div.innerHTML = `
        <button type="button" class="btn btn-sm btn-danger remove-ach"><i class="fa fa-trash"></i> Remove</button>
        <br>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="fw-semibold">Achievement Title</label>
                <input type="text" class="form-control title" value="${data.title||''}" placeholder="Enter achievement title" required>
            </div>
            <div class="col-md-6">
                <label class="fw-semibold">Date</label>
                <input type="month" class="form-control date" value="${data.date||''}" required>
            </div>
            <div class="col-12">
                <label class="fw-semibold">Description / Details</label>
                <textarea class="form-control description" rows="2" placeholder="Enter details / description" required>${data.description||''}</textarea>
            </div>
        </div>
    `;

    document.getElementById('achWrapper').appendChild(div);

    // Remove button
    div.querySelector('.remove-ach').addEventListener('click', function() {
        div.remove();
    });
}

/* Restore data dari localStorage */
let savedAch = JSON.parse(localStorage.getItem('achievements')) || [];
if (savedAch.length > 0) {
    savedAch.forEach(a => addAch(a));
} else {
    addAch(); // Tambah satu kosong default
}

/* Save data bila submit */
document.getElementById('achForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let achievements = [];
    document.querySelectorAll('.ach-card').forEach(card => {
        achievements.push({
            title: card.querySelector('.title').value,
            date: card.querySelector('.date').value,
            description: card.querySelector('.description').value
        });
    });

    localStorage.setItem('achievements', JSON.stringify(achievements));

    Swal.fire({
        icon: 'success',
        title: 'Achievements Saved',
        text: 'Proceed to Preview section'
    }).then(() => window.location.href='preview.php');
});

/* Clear semua achievements */
document.getElementById('clearBtn').addEventListener('click', () => {
    Swal.fire({
        title: 'Clear all achievements?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, clear'
    }).then(result => {
        if (result.isConfirmed) {
            localStorage.removeItem('achievements');
            document.getElementById('achWrapper').innerHTML = '';
            addAch();
        }
    });
});
</script>

</body>
</html>
