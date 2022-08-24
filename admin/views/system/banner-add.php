<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold mb-2">Thêm banner mới</h4>
    <div class="d-flex mb-1 mx-auto"  style="width:50%;">
        <div class="me-2">
            <a href="<?=WEB_ROOT.'/system/banner'?>" class="btn btn-primary link">
                <i class="bi bi-list"></i>
                Danh sách banner
            </a>
        </div>
        <div>
            <a href="<?=WEB_ROOT.'/system/banner-add'?>" class="btn btn-success link">
                <i class="bi bi-arrow-counterclockwise"></i>
                resset
            </a>
        </div>
    </div>
    <form class="form-add" method="post" enctype="multipart/form-data" style="width:50%;">
        <?php if(isset($success)):?>
        <div class="alert alert-success small">
            <?=$success?>
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <?php endif;?>
        <?php if(isset($error)):?>
        <div class="alert alert-danger small">
            <?=$error?>
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <?php endif;?>
        <div class="mb-2">
            <label class="form-label">Ảnh banner</label>
            <input type="file" name="image" class="form-control">
            <?php if(isset($errors["image"])):?>
            <div class="form-error"><?=$errors["image"]?></div>
            <?php endif;?>
        </div>
        <div class="row">
            <div class="col-6">
                <label class="form-label">Chiều cao ảnh</label>
                <input type="text" name="height" class="form-control">
                <?php if(isset($errors["height"])):?>
                <div class="form-error"><?=$errors["height"]?></div>
                <?php endif;?>
            </div>
            <div class="col-6">
                <label class="form-label">Chiều rộng ảnh</label>
                <input type="text" name="width" class="form-control">
                <?php if(isset($errors["width"])):?>
                <div class="form-error"><?=$errors["width"]?></div>
                <?php endif;?>
            </div>
        </div>
        <div class="form-button mt-3">
            <button class="btn btn-primary" type="submit">Thêm banner</button>
        </div>
    </form>
</div>