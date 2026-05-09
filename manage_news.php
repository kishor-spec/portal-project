<?php
include('include/header.php');
include('db/config.php');

// Fetch all news ordered by latest
$query = "SELECT * FROM news ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold text-dark m-0">Manage News</h4>
    <a href="add_news.php" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add New
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 border-0">Image</th>
                        <th class="py-3 border-0">Title</th>
                        <th class="py-3 border-0">Category</th>
                        <th class="py-3 border-0">Views</th>
                        <th class="py-3 border-0">Status</th>
                        <th class="pe-4 py-3 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td class="ps-4">
                                <?php if ($row['featured_image']): ?>
                                    <img src="uploads/news/<?= $row['featured_image'] ?>" class="rounded" width="50" height="35" style="object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-secondary text-white rounded text-center d-flex align-items-center justify-content-center" style="width: 50px; height: 35px; font-size: 10px;">No Img</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark text-truncate" style="max-width: 250px;"><?= $row['title'] ?></div>
                                <small class="text-muted"><?= date('M d, Y', strtotime($row['created_at'])) ?></small>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?= $row['category'] ?></span></td>
                            <td><i class="bi bi-eye me-1"></i> <?= $row['views'] ?></td>
                            <td>
                                <?php
                                $statusClass = [
                                    'published' => 'bg-success-subtle text-success',
                                    'draft' => 'bg-secondary-subtle text-secondary',
                                    'pending' => 'bg-warning-subtle text-warning'
                                ];
                                $class = $statusClass[$row['status']] ?? 'bg-light';
                                ?>
                                <span class="badge <?= $class ?> text-capitalize px-3"><?= $row['status'] ?></span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group">
                                    <a href="view_news.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary" title="View Article">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="edit_news.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-dark" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="delete_news.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>