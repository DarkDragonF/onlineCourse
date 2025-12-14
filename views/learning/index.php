<?php 
// Không include Header/Footer mặc định vì trang học thường full màn hình
// Nhưng ở đây mình include để giữ đồng bộ, bạn có thể bỏ nếu muốn custom riêng.
include_once './views/layouts/header.php'; 
?>

<style>
    .learning-container { background-color: #f8f9fa; min-height: 100vh; }
    .video-container { background: #000; width: 100%; height: 500px; display: flex; align-items: center; justify-content: center; border-radius: 8px; overflow: hidden; }
    .sidebar-lessons { background: #fff; height: 600px; overflow-y: auto; border-left: 1px solid #ddd; }
    .lesson-item { padding: 15px; border-bottom: 1px solid #eee; display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #333; transition: 0.2s; }
    .lesson-item:hover { background-color: #f0f0f0; color: #000; }
    .lesson-item.active { background-color: #e6f0ff; color: #0d6efd; border-left: 4px solid #0d6efd; }
    .lesson-item.locked { color: #999; cursor: not-allowed; background-color: #f9f9f9; }
    .status-icon { font-size: 1.2rem; }
</style>

<div class="learning-container py-4">
    <div class="container-fluid px-4">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="index.php?controller=course&action=mycourses" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Quay lại
            </a>
            <h5 class="fw-bold mb-0"><?= htmlspecialchars($course['title']) ?></h5>
            <div class="d-flex align-items-center">
                <span class="me-2 text-muted small">Tiến độ: <?= $progressPercent ?>%</span>
                <div class="progress" style="width: 150px; height: 8px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $progressPercent ?>%"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-lg-3 p-0">
                <div class="sidebar-lessons shadow-sm rounded">
                    <div class="p-3 bg-light border-bottom fw-bold">Nội dung khóa học</div>
                    
                    <?php 
                    $previousCompleted = true; // Biến cờ: Bài trước đã xong chưa? (Mặc định bài 1 luôn mở)
                    
                    foreach ($lessons as $index => $lesson): 
                        $isCompleted = in_array($lesson['id'], $completedLessonIds);
                        $isActive = ($currentLesson && $currentLesson['id'] == $lesson['id']);
                        
                        // Logic khóa: Nếu bài trước chưa xong và bài này cũng chưa xong -> Khóa
                        $isLocked = !$previousCompleted && !$isCompleted;
                        
                        // Update cờ cho vòng lặp sau
                        if (!$isCompleted) {
                            $previousCompleted = false; 
                        } else {
                            $previousCompleted = true;
                        }
                        
                        // Nếu đang xem bài này thì không gọi là lock (đề phòng logic sai)
                        if ($isActive) $isLocked = false;
                    ?>
                        <?php if ($isLocked): ?>
                            <div class="lesson-item locked">
                                <div>
                                    <span class="badge bg-secondary me-2">Bài <?= $index + 1 ?></span>
                                    <?= htmlspecialchars($lesson['title']) ?>
                                </div>
                                <i class="fas fa-lock status-icon"></i>
                            </div>
                        <?php else: ?>
                            <a href="index.php?controller=learning&action=index&course_id=<?= $course['id'] ?>&lesson_id=<?= $lesson['id'] ?>" 
                               class="lesson-item <?= $isActive ? 'active' : '' ?>">
                                <div>
                                    <span class="badge <?= $isCompleted ? 'bg-success' : 'bg-primary' ?> me-2">Bài <?= $index + 1 ?></span>
                                    <?= htmlspecialchars($lesson['title']) ?>
                                </div>
                                <?php if ($isCompleted): ?>
                                    <i class="fas fa-check-circle text-success status-icon"></i>
                                <?php else: ?>
                                    <i class="far fa-circle text-muted status-icon"></i>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                        
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-8 col-lg-9">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <?php if ($currentLesson): ?>
                            <div class="video-container bg-dark text-white">
                                <?php if (!empty($currentLesson['video_url'])): ?>
                                    <iframe width="100%" height="100%" src="<?= $currentLesson['video_url'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <?php else: ?>
                                    <p>Bài học này chưa có video.</p>
                                <?php endif; ?>
                            </div>

                            <div class="p-4">
                                <h3 class="fw-bold"><?= htmlspecialchars($currentLesson['title']) ?></h3>
                                <div class="text-muted mb-4">
                                    <?= nl2br(htmlspecialchars($currentLesson['content'])) ?>
                                </div>
                                
                                <hr>

                                <div class="d-flex justify-content-end">
                                    <?php if (in_array($currentLesson['id'], $completedLessonIds)): ?>
                                        <button class="btn btn-success disabled">
                                            <i class="fas fa-check me-2"></i> Đã hoàn thành
                                        </button>
                                        <?php else: ?>
                                        <form action="index.php?controller=learning&action=complete" method="POST">
                                            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                            <input type="hidden" name="lesson_id" value="<?= $currentLesson['id'] ?>">
                                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                                Hoàn thành & Bài tiếp theo <i class="fas fa-arrow-right ms-2"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="p-5 text-center">
                                <h3>Chưa có bài học nào trong khóa này.</h3>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include_once './views/layouts/footer.php'; ?>