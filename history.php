<?php
include 'config.php';
include 'header.php';
$sql = "SELECT enrollments.enrollment_id, enrollments.student_name, enrollments.student_email, enrollments.phone, enrollments.study_mode, enrollments.notes, enrollments.enrollment_date, courses.course_name, courses.price
        FROM enrollments
        INNER JOIN courses ON enrollments.course_id = courses.course_id
        ORDER BY enrollments.enrollment_date DESC";
$result = $conn->query($sql);
?>

<h1 class="section-title">Enrollment History</h1>
<p>This page displays enrollment records from the MySQL database. It also allows students to update or delete records.</p>

<section class="table-box">
    <h2>Saved Enrollments</h2>
    <p class="badge">This page demonstrates the SELECT query.</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
            <th>Price</th>
            <th>Mode</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['enrollment_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['student_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                    <td><?php echo number_format($row['price'], 2); ?> SAR</td>
                    <td><?php echo htmlspecialchars($row['study_mode']); ?></td>
                    <td><?php echo $row['enrollment_date']; ?></td>
                    <td>
                        <div class="actions">
                            <a class="btn secondary" href="edit_enrollment.php?id=<?php echo $row['enrollment_id']; ?>">Edit</a>
                            <a class="btn danger" href="delete_enrollment.php?id=<?php echo $row['enrollment_id']; ?>" onclick="return confirm('Are you sure you want to delete this enrollment?');">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="9">No enrollment records were found.</td>
            </tr>
        <?php } ?>
    </table>
</section>

<?php include 'footer.php'; ?>
