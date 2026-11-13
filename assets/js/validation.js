function showErrors(errors) {
    if (errors.length > 0) {
        alert("Please fix the following errors:\n\n- " + errors.join("\n- "));
        return false;
    }
    return true;
}

function validateRegisterForm() {
    const errors = [];
    const name = document.getElementById("full_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (name.length < 3) {
        errors.push("Full name must contain at least 3 characters.");
    }

    if (!email.includes("@") || !email.includes(".")) {
        errors.push("Email address must be written in a valid format.");
    }

    if (password.length < 6) {
        errors.push("Password must contain at least 6 characters.");
    }

    if (errors.length === 0) {
        alert("Registration form submitted successfully.");
    }

    return showErrors(errors);
}

function validateLoginForm() {
    const errors = [];
    const email = document.getElementById("login_email").value.trim();
    const password = document.getElementById("login_password").value.trim();

    if (email === "") {
        errors.push("Email address is required for login.");
    }

    if (password === "") {
        errors.push("Password is required for login.");
    }

    if (errors.length === 0) {
        alert("Login form submitted successfully.");
    }

    return showErrors(errors);
}

function validateEnrollmentForm() {
    const errors = [];
    const studentName = document.getElementById("student_name").value.trim();
    const studentEmail = document.getElementById("student_email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const courseId = document.getElementById("course_id").value;
    const studyMode = document.getElementById("study_mode").value;

    if (studentName.length < 3) {
        errors.push("Student name must contain at least 3 characters.");
    }

    if (!studentEmail.includes("@") || !studentEmail.includes(".")) {
        errors.push("Student email must be valid.");
    }

    if (phone.length < 8) {
        errors.push("Phone number must contain at least 8 digits.");
    }

    if (courseId === "") {
        errors.push("Please choose a course.");
    }

    if (studyMode === "") {
        errors.push("Please choose a study mode.");
    }

    if (errors.length === 0) {
        alert("Enrollment form submitted successfully.");
    }

    return showErrors(errors);
}

function filterCourses() {
    const input = document.getElementById("courseSearch").value.toLowerCase();
    const cards = document.querySelectorAll(".course-card");
    let visibleCount = 0;

    cards.forEach(function(card) {
        const text = card.innerText.toLowerCase();
        if (text.includes(input)) {
            card.style.display = "block";
            visibleCount++;
        } else {
            card.style.display = "none";
        }
    });

    const output = document.getElementById("searchOutput");
    if (output) {
        output.innerText = visibleCount + " course(s) found.";
    }
}
