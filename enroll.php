<?php
include 'config.php';
include 'header.php';
$courses = $conn->query("SELECT * FROM courses ORDER BY course_name ASC");
$selected_course = isset($_GET['course_id']) ? intval($_GET['course_id']) : "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_name = trim($_POST['student_name']);
    $student_email = trim($_POST['student_email']);
    $phone = trim($_POST['phone']);
    $course_id = intval($_POST['course_id']);
    $study_mode = trim($_POST['study_mode']);
    $notes = trim($_POST['notes']);

    $stmt = $conn->prepare("INSERT INTO enrollments (student_name, student_email, phone, course_id, study_mode, notes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $student_name, $student_email, $phone, $course_id, $study_mode, $notes);

    if ($stmt->execute()) {
        $message = "<p class='message success'>Enrollment added successfully. This is the INSERT query output.</p>";
    } else {
        $message = "<p class='message error'>Enrollment was not saved. Please try again.</p>";
    }
}
?>
<script src="assets/js/validation.js"></script>

<h1 class="section-title">Course Enrollment</h1>
<p>Students can complete this form to register for one of the available courses.</p>

<?php echo $message; ?>

<section class="form-box">
    <form action="enroll.php" method="post" onsubmit="return validateEnrollmentForm();">
        <div class="form-grid">
            <div class="form-control">
                <label for="student_name">Student Name</label>
                <input type="text" id="student_name" name="student_name" placeholder="Enter student name">
            </div>
            <div class="form-control">
                <label for="student_email">Student Email</label>
                <input type="email" id="student_email" name="student_email" placeholder="student@example.com">
            </div>
            <div class="form-control">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="Enter phone number">
            </div>
            <div class="form-control">
                <label for="course_id">Course</label>
                <select id="course_id" name="course_id">
                    <option value="">Choose a course</option>
                    <?php while ($course = $courses->fetch_assoc()) { ?>
                        <option value="<?php echo $course['course_id']; ?>" <?php if ($selected_course == $course['course_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($course['course_name']) . " - " . number_format($course['price'], 2) . " SAR"; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-control">
                <label for="study_mode">Study Mode</label>
                <select id="study_mode" name="study_mode">
                    <option value="">Choose study mode</option>
                    <option value="Online">Online</option>
                    <option value="On Campus">On Campus</option>
                    <option value="Hybrid">Hybrid</option>
                </select>
            </div>
        </div>
        <div class="form-control">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes" rows="4" placeholder="Write any preferred schedule or learning notes"></textarea>
        </div>
        <button type="submit">Submit Enrollment</button>
    </form>
</section>

<?php include 'footer.php'; ?>
