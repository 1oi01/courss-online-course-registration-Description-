<?php
include 'config.php';
include 'header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message = "";

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM enrollments WHERE enrollment_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "<p class='message success'>Enrollment deleted successfully. This is the DELETE query output.</p>";
    } else {
        $message = "<p class='message error'>The enrollment could not be deleted.</p>";
    }
} else {
    $message = "<p class='message error'>Invalid enrollment ID.</p>";
}
?>

<h1 class="section-title">Delete Enrollment</h1>
<?php echo $message; ?>
<a href="history.php" class="btn">Return to Enrollment History</a>

<?php include 'footer.php'; ?>
