<?php
include 'config.php';
include 'header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['enrollment_id']);
    $student_name = trim($_POST['student_name']);
    $student_email = trim($_POST['student_email']);
    $phone = trim($_POST['phone']);
    $course_id = intval($_POST['course_id']);
    $study_mode = trim($_POST['study_mode']);
    $notes = trim($_POST['notes']);

    $stmt = $conn->prepare("UPDATE enrollments SET student_name = ?, student_email = ?, phone = ?, course_id = ?, study_mode = ?, notes = ? WHERE enrollment_id = ?");
    $stmt->bind_param("sssissi", $student_name, $student_email, $phone, $course_id, $study_mode, $notes, $id);

    if ($stmt->execute()) {
        $message = "<p class='message success'>Enrollment updated successfully. This is the UPDATE query output.</p>";
    } else {
        $message = "<p class='message error'>The enrollment could not be updated.</p>";
    }
}

$stmt = $conn->prepare("SELECT * FROM enrollments WHERE enrollment_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$enrollment = $stmt->get_result()->fetch_assoc();
$courses = $conn->query("SELECT * FROM courses ORDER BY course_name ASC");
?>
<script src="assets/js/validation.js"></script>

<h1 class="section-title">Edit Enrollment</h1>
<?php echo $message; ?>

<?php if ($enrollment) { ?>
<section class="form-box">
    <form action="edit_enrollment.php?id=<?php echo $id; ?>" method="post" onsubmit="return validateEnrollmentForm();">
        <input type="hidden" name="enrollment_id" value="<?php echo $enrollment['enrollment_id']; ?>">
        <div class="form-grid">
            <div class="form-control">
                <label for="student_name">Student Name</label>
                <input type="text" id="student_name" name="student_name" value="<?php echo htmlspecialchars($enrollment['student_name']); ?>">
            </div>
            <div class="form-control">
                <label for="student_email">Student Email</label>
                <input type="email" id="student_email" name="student_email" value="<?php echo htmlspecialchars($enrollment['student_email']); ?>">
            </div>
            <div class="form-control">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($enrollment['phone']); ?>">
            </div>
            <div class="form-control">
                <label for="course_id">Course</label>
                <select id="course_id" name="course_id">
                    <option value="">Choose a course</option>
                    <?php while ($course = $courses->fetch_assoc()) { ?>
                        <option value="<?php echo $course['course_id']; ?>" <?php if ($enrollment['course_id'] == $course['course_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($course['course_name']) . " - " . number_format($course['price'], 2) . " SAR"; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-control">
                <label for="study_mode">Study Mode</label>
                <select id="study_mode" name="study_mode">
                    <option value="">Choose study mode</option>
                    <option value="Online" <?php if ($enrollment['study_mode'] === 'Online') echo 'selected'; ?>>Online</option>
                    <option value="On Campus" <?php if ($enrollment['study_mode'] === 'On Campus') echo 'selected'; ?>>On Campus</option>
                    <option value="Hybrid" <?php if ($enrollment['study_mode'] === 'Hybrid') echo 'selected'; ?>>Hybrid</option>
                </select>
            </div>
        </div>
        <div class="form-control">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes" rows="4"><?php echo htmlspecialchars($enrollment['notes']); ?></textarea>
        </div>
        <button type="submit">Update Enrollment</button>
        <a href="history.php" class="btn secondary">Back to History</a>
    </form>
</section>
<?php } else { ?>
    <p class="message error">The selected enrollment record was not found.</p>
<?php } ?>

<?php include 'footer.php'; ?>
