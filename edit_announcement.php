<?php include('include/header.php'); ?>
<?php

include_once('db/config.php');

$id = $_GET['id'];

$announcement = $conn->execute_query('select * from announcements where id=' . $id)->fetch_assoc();

?>

<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="announcements.php">Announcements</a></li>
            <li class="breadcrumb-item active">Create New</li>
        </ol>
    </nav>
    <h4 class="fw-semibold text-dark">Create Announcement</h4>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="update_announcement.php" method="POST">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase text-muted">Announcement Title</label>
                        <input type="text" name="title" class="form-control shadow-none" value="<?= $announcement['title'] ?>" placeholder="e.g., Holiday Notice" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase text-muted">Detailed Message</label>
                        <textarea name="message" class="form-control shadow-none" rows="6" placeholder="Type the announcement details here..." required>
<?= $announcement['content'] ?>
                        </textarea>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="activeSwitch" checked>
                            <label class="form-check-label fw-medium" for="activeSwitch">Active</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4">Update Announcement</button>
                        <a href="announcements.php" class="btn btn-light px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Helping Note -->
    <div class="col-lg-5">
        <div class="card bg-primary text-white border-0 shadow-sm">
            <div class="card-body p-4">
                <h6><i class="bi bi-info-circle me-2"></i> Admin Tip</h6>
                <p class="small mb-0 opacity-75">
                    Announcements are short, urgent notices displayed on the student portal header or marquee. Keep the message concise for better readability.
                </p>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>