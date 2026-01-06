# Resume Generator System (ATS-Friendly)

Resume Generator System is a web-based application that allows users to create, preview, and download an ATS-friendly resume.  
The system is designed to help users generate structured resumes that are readable by Applicant Tracking Systems (ATS).

---

## Project Overview
This system enables users to:
- Enter personal and professional information
- Preview the resume in ATS-friendly format
- Download the resume for job applications

## Technologies Used
- **Frontend:** HTML5, CSS3, Bootstrap, JavaScript  
- **Backend:** PHP  
- **Database:** MySQL  
- **Others:** SweetAlert, Font Awesome

## Features
- Personal Details Management
- Education Section
- Work Experience Section
- Skills with proficiency level
- Certificates & Achievements
- ATS-Friendly Resume Preview
- Resume Download (Print / PDF)
- LocalStorage usage for temporary data
- Secure database insertion using prepared statements

## Database Structure
The system uses the following main tables:
- `personal_details`
- `education`
- `experience`
- `skills`
- `certificates`
- `achievements`

Each table is linked using `personal_id` as a foreign key.

---

## Installation & Setup
1. Install **XAMPP** or any local server with PHP & MySQL.
2. Place the project folder inside: htdocs/
3. Start **Apache** and **MySQL**.
4. Create a database:
   ```sql
CREATE DATABASE resume_system;
5. Import the provided SQL file (if available).
6. Open the system in your browser: http://localhost/ResumeSystem/index.html

---

🧪 How to Use
1. Fill in Personal Details.
2. Add Education, Experience, Skills, Certificates, and Achievements.
3. Preview the resume in ATS-friendly format.
4. Download the resume using the Download Resume button.
5. Click Done to return to the main page.

👩‍💻 Author
Name: Nurizzati Syamimi Binti Zaihan
Project: Resume Generator System
Purpose: Tenchnical Assessment for Internship
