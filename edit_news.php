<?php
include('include/header.php');
include('db/config.php'); // Ensure your DB connection is included

// 1. Fetch existing data (Logic placeholder)
$news_id = $_GET['id'] ?? null;
// Example Query: 
$query = mysqli_query($conn, "SELECT * FROM news WHERE id = '$news_id'");
$row = mysqli_fetch_assoc($query);

// For demonstration, using a placeholder variable $row
// $row = ['title' => 'Sample Title', 'summary' => 'Sample Summary', 'content' => '...', 'category' => 'Events', 'status' => 'published'];
?>

<?php if (isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Updated!</strong> News article has been modified successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold text-dark m-0">Edit News</h4>
    <a href="manage_news.php" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

<!-- Change action to update_news.php and add a hidden ID field -->
<form action="update_news.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="news_id" value="<?php echo $news_id; ?>">

    <div class="row g-4">
        <!-- Main Form Area -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- News Title -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">News Title</label>
                        <input type="text" name="title" class="form-control form-control-lg shadow-none"
                            value="<?php echo htmlspecialchars($row['title'] ?? ''); ?>" required>
                    </div>

                    <!-- Short Summary -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">Short Summary</label>
                        <textarea name="summary" class="form-control shadow-none" rows="3"><?php echo htmlspecialchars($row['summary'] ?? ''); ?></textarea>
                    </div>

                    <!-- News Content -->
                    <div class="mb-0">
                        <label class="form-label fw-bold text-muted small text-uppercase">Full Content</label>
                        <textarea name="content" class="form-control shadow-none" rows="12" required><?php echo htmlspecialchars($row['content'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Options -->
        <div class="col-lg-4">
            <!-- Publish Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2 text-primary"></i>Update Details</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status</label>
                        <select name="status" class="form-select shadow-none">
                            <?php $status = $row['status'] ?? 'draft'; ?>
                            <option value="published" <?php echo ($status == 'published') ? 'selected' : ''; ?>>Published</option>
                            <option value="draft" <?php echo ($status == 'draft') ? 'selected' : ''; ?>>Save as Draft</option>
                            <option value="pending" <?php echo ($status == 'pending') ? 'selected' : ''; ?>>Pending Review</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category</label>
                        <select name="category" class="form-select shadow-none" required>
                            <?php $cat = $row['category'] ?? ''; ?>
                            <option value="">Select Category</option>
                            <option value="Academic" <?php echo ($cat == 'Academic') ? 'selected' : ''; ?>>Academic</option>
                            <option value="Events" <?php echo ($cat == 'Events') ? 'selected' : ''; ?>>Events</option>
                            <option value="Sports" <?php echo ($cat == 'Sports') ? 'selected' : ''; ?>>Sports</option>
                            <option value="Exams" <?php echo ($cat == 'Exams') ? 'selected' : ''; ?>>Exams</option>
                        </select>
                    </div>

                    <hr class="text-muted opacity-25">

                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold">
                        Update News Article
                    </button>
                </div>
            </div>

            <!-- Media Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-image me-2 text-success"></i>Featured Image</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Replace Image (Optional)</label>
                        <input type="file" name="featured_image" class="form-control shadow-none">
                    </div>

                    <!-- Current Image Preview -->
                    <div class="bg-light rounded text-center py-2 border border-dashed">
                        <?php if (!empty($row['image'])): ?>
                            <img src="uploads/<?php echo $row['image']; ?>" class="img-fluid rounded mb-2" style="max-height: 150px;">
                            <p class="small text-muted mb-0">Current Image</p>
                        <?php else: ?>
                            <i class="bi bi-image fs-1 text-muted"></i>
                            <p class="small text-muted mb-0">No image uploaded</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include('include/footer.php'); ?>