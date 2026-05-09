<?php include('include/header.php'); ?>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> News article has been posted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold text-dark m-0">Post New News</h4>
    <a href="manage_news.php" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

<form action="process_news.php" method="POST" enctype="multipart/form-data">
    <div class="row g-4">

        <!-- Main Form Area -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- News Title -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">News Title</label>
                        <input type="text" name="title" class="form-control form-control-lg shadow-none" placeholder="Enter headline here..." required>
                    </div>

                    <!-- Short Summary -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">Short Summary</label>
                        <textarea name="summary" class="form-control shadow-none" rows="3" placeholder="Briefly describe this news..."></textarea>
                    </div>

                    <!-- News Content -->
                    <div class="mb-0">
                        <label class="form-label fw-bold text-muted small text-uppercase">Full Content</label>
                        <textarea name="content" class="form-control shadow-none" rows="12" placeholder="Write your full news article here..." required></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Options -->
        <div class="col-lg-4">

            <!-- Publish Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-send-fill me-2 text-primary"></i>Publishing Details</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status</label>
                        <select name="status" class="form-select shadow-none">
                            <option value="published">Published</option>
                            <option value="draft" selected>Save as Draft</option>
                            <option value="pending">Pending Review</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category</label>
                        <select name="category" class="form-select shadow-none" required>
                            <option value="">Select Category</option>
                            <option value="Academic">Academic</option>
                            <option value="Events">Events</option>
                            <option value="Sports">Sports</option>
                            <option value="Exams">Exams</option>
                        </select>
                    </div>

                    <hr class="text-muted opacity-25">

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                        Publish News
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
                        <label class="form-label small fw-bold text-muted">Upload Image (JPG, PNG)</label>
                        <input type="file" name="featured_image" class="form-control shadow-none">
                        <div class="form-text small mt-2">Recommended size: 1200x600px</div>
                    </div>

                    <!-- Image Preview Placeholder -->
                    <div class="bg-light rounded text-center py-4 border border-dashed">
                        <i class="bi bi-cloud-upload fs-1 text-muted"></i>
                        <p class="small text-muted mb-0">Preview will appear here</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<?php include('include/footer.php'); ?>