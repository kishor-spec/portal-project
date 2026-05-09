<?php include('include/header.php'); ?>
<?php include('db/config.php') ?>

<?php
$newsStmt = "SELECT 
    COUNT(*) AS total_news,
    SUM(status = 'pending') AS pending_news
    FROM news";
$newsResult = $conn->execute_query($newsStmt)->fetch_assoc();

$announcements = $conn->execute_query(("select count(*) as count from announcements;"))->fetch_assoc()['count'];
?>


<h4 class="mb-4 fw-semibold text-dark">Dashboard Overview</h4>

<!-- Stats Grid -->
<div class="row g-4">
    <div class="col-md-4">
        <div class="card stat-card bg-news">
            <div class="card-body p-4">
                <i class="bi bi-newspaper fs-1 mb-3 d-block"></i>
                <h5 class="opacity-75">Total News</h5>
                <h2 class="fw-bold display-5 m-0"> <?= $newsResult['total_news'] ?> </h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-announcement">
            <div class="card-body p-4">
                <i class="bi bi-megaphone fs-1 mb-3 d-block"></i>
                <h5 class="opacity-75">Announcements</h5>
                <h2 class="fw-bold display-5 m-0"> <?= $announcements ?> </h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-pending">
            <div class="card-body p-4">
                <i class="bi bi-clock-history fs-1 mb-3 d-block"></i>
                <h5 class="opacity-75">Pending</h5>
                <h2 class="fw-bold display-5 m-0"> <?= $newsResult['pending_news'] ?> </h2>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>