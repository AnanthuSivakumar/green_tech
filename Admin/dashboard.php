<?php
session_start();
include __DIR__ . '/../includes/db.php';


// if(!isset($_SESSION['admin'])) {
//     header("Location: login.php");
//     exit;
// }

$result = $conn->query("SELECT * FROM contact_messages ORDER BY id DESC");

include __DIR__ . '/../includes/header.php';
?>

<div class=" m-3">
<h2 class="text-center " style="color:white; margin-top: 146px;    margin-bottom: 4.5rem;">
    Contact Messages
</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-dark">
            <thead class="table-primary text-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Urgent</th>
                    <th>Preferred Date</th>
                    <th>Message</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td class="text-center">
                                <?= $row['urgent'] ? 
                                    '<span class="badge bg-danger">Yes</span>' : 
                                    '<span class="badge bg-secondary">No</span>'; ?>
                            </td>
                            <td><?= $row['preferred_date'] ?: '-' ?></td>
                            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                            <td><?= $row['created_at'] ?></td>
                            <td class="text-center">
                                <a href="delete.php?id=<?= $row['id'] ?>" 
                                   onclick="return confirm('Delete this message?')" 
                                   class="btn btn-sm btn-danger">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-warning">
                            No contact messages found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

    <div class="text-center mt-4">
        <a href="export.php" class="btn btn-success me-2">Export to Excel</a>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>

</div>
<div style="margin-top: 123px;">
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</div>
