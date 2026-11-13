<?php
include 'config.php';
include 'header.php';
$result = $conn->query("SELECT * FROM courses ORDER BY price ASC");
?>
<script src="assets/js/validation.js"></script>

<h1 class="section-title">Course Listing</h1>
<p>Students can use this page to compare courses before selecting the right program.</p>

<div class="search-panel">
    <input type="text" id="courseSearch" onkeyup="filterCourses()" placeholder="Search by course name, level, or description">
    <span class="badge" id="searchOutput">All courses are shown.</span>
</div>

<section class="grid">
    <?php while ($course = $result->fetch_assoc()) { ?>
        <article class="card course-card">
            <h3><?php echo htmlspecialchars($course['course_name']); ?></h3>
            <p><?php echo htmlspecialchars($course['short_description']); ?></p>
            <p><span class="badge"><?php echo htmlspecialchars($course['level_name']); ?></span></p>
            <p>Duration: <?php echo htmlspecialchars($course['duration']); ?></p>
            <p class="price"><?php echo number_format($course['price'], 2); ?> SAR</p>
            <a class="btn" href="enroll.php?course_id=<?php echo $course['course_id']; ?>">Enroll in this course</a>
        </article>
    <?php } ?>
</section>

<?php include 'footer.php'; ?>
