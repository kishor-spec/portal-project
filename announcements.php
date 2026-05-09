<?php
include('include/header.php');
include('db/config.php');

// Fetch all announcements
$query = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-semibold text-dark m-0">Announcements</h4>
        <p class="text-muted small mb-0">Manage campus-wide alerts and notices</p>
    </div>
    <!-- Redirects to the hidden create page -->
    <a href="create_announcement.php" class="btn btn-success">
        <i class="bi bi-plus-lg me-1"></i> New Announcement
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 border-0">Title</th>
                        <th class="py-3 border-0">Message Snippet</th>
                        <th class="py-3 border-0">Date Posted</th>
                        <th class="py-3 border-0">Status</th>
                        <th class="pe-4 py-3 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark"><?= htmlspecialchars($row['title']) ?></div>
                                </td>
                                <td>
                                    <div class="text-muted text-truncate" style="max-width: 300px;">
                                        <?= htmlspecialchars($row['content']) ?>
                                    </div>
                                </td>
                                <td><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                                <td>
                                    <?php if ($row['is_active']): ?>
                                        <span class="badge bg-success-subtle text-success px-3">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted px-3 border">Archived</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group">
                                        <a href="edit_announcement.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-dark">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="delete_announcement.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this announcement?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-megaphone fs-1 d-block mb-2"></i>
                                No announcements found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>