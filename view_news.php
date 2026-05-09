<?php 
include('include/header.php'); 
include('db/config.php');

// 1. Get ID and Security Check
if(!isset($_GET['id'])) {
    header("Location: manage_news.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// 2. Increment View Count
mysqli_query($conn, "UPDATE news SET views = views + 1 WHERE id = '$id'");

// 3. Fetch News Data
$query = "SELECT * FROM news WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$news = mysqli_fetch_assoc($result);

if(!$news) {
    echo "<h4>News not found!</h4>";
    include('include/footer.php');
    exit();
}
?>

<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="manage_news.php">Manage News</a></li>
            <li class="breadcrumb-item active" aria-current="page text-truncate" style="max-width: 200px;"><?= $news['title'] ?></li>
        </ol>
    </nav>
</div>

<div class="row g-4">
    <div class="col-lg-8 mx-auto">
        <article class="card border-0 shadow-sm overflow-hidden">
            <!-- Featured Image -->
            <?php if($news['featured_image']): ?>
                <img src="uploads/news/<?= $news['featured_image'] ?>" class="card-img-top" alt="News Image" style="height: 400px; object-fit: cover;">
            <?php endif; ?>

            <div class="card-body p-4 p-md-5">
                <!-- Meta Info -->
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="badge bg-primary px-3"><?= $news['category'] ?></span>
                    <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i> <?= date('F j, Y', strtotime($news['created_at'])) ?></span>
                    <span class="text-muted small"><i class="bi bi-eye me-1"></i> <?= $news['views'] ?> views</span>
                </div>

                <!-- Title -->
                <h1 class="display-6 fw-bold text-dark mb-4"><?= $news['title'] ?></h1>

                <!-- Summary -->
                <?php if($news['summary']): ?>
                    <div class="lead text-muted border-start border-4 border-primary ps-3 mb-5">
                        <?= nl2br($news['summary']) ?>
                    </div>
                <?php endif; ?>

                <!-- Full Content -->
                <div class="content text-secondary lh-lg" style="font-size: 1.1rem;">
                    <?= nl2br($news['content']) ?>
                </div>

                <hr class="my-5 opacity-25">

                <div class="d-flex justify-content-between align-items-center">
                    <a href="manage_news.php" class="btn btn-light">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                    <div class="text-muted small">
                        Last updated: <?= date('M d, H:i', strtotime($news['updated_at'])) ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>

<?php include('include/footer.php'); ?>