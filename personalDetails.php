<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Personal Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries CSS -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

    <!-- Bootstrap & Custom CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .navbar-nav .nav-link.disabled {
            color: #6c757d !important;
            cursor: not-allowed;
            pointer-events: auto;
        }
    </style>
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">

    <!-- Spinner -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="personalDetails.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-file me-2"></i>Resume</h3>
            </a>
            <div class="navbar-nav w-100">
                <a href="personalDetails.php" class="nav-item nav-link active"><i class="fa fa-user me-2"></i>Personal Details</a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-graduation-cap me-2"></i>Education</a>
                <a href="#" class="nav-item nav-link disabled"><i class="fa fa-briefcase me-2"></i>Experience </a>
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
                <h3 class="mb-4 text-primary fw-bold">Step 1: Personal Details</h3>

                <form id="personalDetailsForm">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"><i class="fas fa-user me-2"></i>Full Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"><i class="fas fa-briefcase me-2"></i>Job Title</label>
                            <input type="text" class="form-control" id="jobTitle" placeholder="Enter your job title" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"><i class="fas fa-envelope me-2"></i>Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email address" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"><i class="fas fa-phone me-2"></i>Phone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number (e.g. +601123456789)" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"><i class="fas fa-map-marker-alt me-2"></i>Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter your address" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"><i class="fas fa-link me-2"></i>LinkedIn</label>
                            <input type="url" class="form-control" id="linkedin" placeholder="Enter your LinkedIn link (optional)">
                        </div>

                        <!-- BUTTONS -->
                        <div class="col-12 d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary flex-grow-1 w-100 fw-bold">Save & Continue</button>
                            <button type="button" class="btn btn-danger flex-grow-1 w-100 fw-bold" id="resetBtn">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded-top p-4 text-center">
                &copy; Resume Generator System | Designed By Nurizzati Syamimi
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>

<script>
/* ===== LOCKED NAV ALERT ===== */
document.querySelectorAll('[data-lock]').forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault();
        Swal.fire('Locked', 'Please complete Personal Details first.', 'warning');
    });
});

/* ===== RESTORE DATA ===== */
document.addEventListener('DOMContentLoaded', () => {
    const data = JSON.parse(localStorage.getItem('personalDetails'));
    if (data) {
        Object.keys(data).forEach(k => document.getElementById(k).value = data[k]);
        unlockMenu();
    }
});

/* ===== SAVE ===== */
function saveData() {
    localStorage.setItem('personalDetails', JSON.stringify({
        fullName: fullName.value,
        jobTitle: jobTitle.value,
        email: email.value,
        phone: phone.value,
        address: address.value,
        linkedin: linkedin.value
    }));
}

/* ===== UNLOCK ===== */
function unlockMenu() {
    document.querySelectorAll('[data-lock]').forEach(link => {
        link.classList.remove('disabled');
        link.href = link.textContent.trim().toLowerCase() + '.php';
    });
}

/* ===== SUBMIT ===== */
personalDetailsForm.addEventListener('submit', e => {
    e.preventDefault();
    saveData();
    unlockMenu();
    Swal.fire('Saved!', 'Proceed to next step.', 'success')
        .then(() => window.location.href = 'education.php');
});

/* ===== RESET ===== */
resetBtn.addEventListener('click', () => {
    Swal.fire({
        title: 'Clear all data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, clear'
    }).then(result => {
        if (result.isConfirmed) {
            localStorage.removeItem('personalDetails');
            personalDetailsForm.reset();
            location.reload();
        }
    });
});
</script>

</body>
</html>
