<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold mb-2">Sửa banner</h4>
    <div class="d-flex mb-1 mx-auto" style="width:50%;">
        <div class="me-2">
            <a href="<?=WEB_ROOT.'/system/banner'?>" class="btn btn-primary link">
                <i class="bi bi-list"></i>
                Danh sách banner
            </a>
        </div>
    </div>
    <form class="form-add" method="post" enctype="multipart/form-data" style="width:50%;">
        <div class="row mb-3">
            <div class="col-6">
                <label class="form-label">Chiều cao ảnh</label>
                <input type="text" name="height" class="form-control" value="<?=$banner['height']?>">
                <?php if(isset($errors["height"])):?>
                <div class="form-error"><?=$errors["height"]?></div>
                <?php endif;?>
            </div>
            <div class="col-6">
                <label class="form-label">Chiều rộng ảnh</label>
                <input type="text" name="width" class="form-control" value="<?=$banner['width']?>">
                <?php if(isset($errors["width"])):?>
                <div class="form-error"><?=$errors["width"]?></div>
                <?php endif;?>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh banner</label>
            <input type="file" name="image" class="form-control">
            <img class="mt-1" src="<?=IMG_ROOT.$banner['image']?>" width="100">
            <?php if(isset($errors["image"])):?>
            <div class="form-error"><?=$errors["image"]?></div>
            <?php endif;?>
        </div>
        <div class="mb-3 col-12 d-flex align-items-center">
            <label class="form-label me-3" style="margin-bottom: 0;">Tình trạng:</label>
            <div class="d-flex align-items-center me-2">
                <input type="radio" <?=$banner['status'] == 1 ? 'checked' : ''?> value="1" name="status"
                    class="form-check-input me-1" style="margin-top: 0;" id="visible">
                <label for="visible" class="form-label fw-normal" style="margin-bottom: 0;">Hiện</label>
            </div>
            <div class="d-flex align-items-center">
                <input type="radio" <?=$banner['status'] == 0 ? 'checked' : ''?> value="0" name="status"
                    class="form-check-input me-1" style="margin-top: 0;" id="hidden">
                <label for="hidden" class="form-label fw-normal" style="margin-bottom: 0;">Ẩn</label>
            </div>
        </div>
        <div class="form-button mt-3">
            <button class="btn btn-primary" type="submit">Lưu chỉnh sửa</button>
        </div>
    </form>
</div>