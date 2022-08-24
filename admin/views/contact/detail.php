<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold">Chi tiết liên hệ</h4>
    <div class="mt-3 mx-auto box-content" style="width:70%">
        <div class="mb-2">
            <a href="<?=WEB_ROOT.'/contact'?>" class="btn btn-primary link">
                <i class="bi bi-arrow-left"></i>
                Quay lại
            </a>
        </div>
        <div class="mb-3">
            <span class="d-block pb-1" style="color:green;">
                <i class="bi bi-person-circle"></i>
                Tên người liên hệ :
            </span>
            <p class="fs-5"><?=$contact['customer_name']?></p>
        </div>
        <div class="mb-3">
            <span class="d-block pb-1" style="color:green;">
                <i class="bi bi-telephone-fill"></i>
                Số điện thoại người liên hệ :
            </span>
            <p class="fs-5"><?=$contact['customer_phone']?></p>
        </div>
        <div class="mb-3">
            <span class="d-block pb-1" style="color:green;">
                <i class="bi bi-envelope-fill"></i>
                Email người liên hệ :
            </span>
            <p class="fs-5"><?=$contact['customer_email']?></p>
        </div>
        <div class="mb-3">
            <span class="d-block pb-1" style="color:green;">
                <i class="bi bi-clock-fill"></i>
                Ngày giờ gửi :
            </span>
            <p class="fs-5"><?=$contact['created_at']?></p>
        </div>
        <div class="mb-3">
            <span class="d-block pb-1" style="color:green;">
                <i class="bi bi-bookmark-check-fill"></i>
                Tiêu đề liên hệ :
            </span>
            <p class="fs-5"><?=$contact['title']?></p>
        </div>
        <div class="mb-3">
            <span class="d-block pb-1" style="color:green;">
                <i class="bi bi-chat-dots-fill"></i>
                Nội dung liên hệ :
            </span>
            <p class="fs-5"><?=$contact['content']?></p>
        </div>
    </div>
</div>