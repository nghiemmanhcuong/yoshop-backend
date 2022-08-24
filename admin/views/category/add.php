<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold mb-2">Thêm danh mục mới</h4>
    <div class="d-flex mb-1 mx-auto"  style="width:50%;">
        <div class="me-2">
            <a href="<?=WEB_ROOT.'/category'?>" class="btn btn-primary link">
                <i class="bi bi-list"></i>
                Danh sách
            </a>
        </div>
        <div>
            <a href="<?=WEB_ROOT.'/category/add'?>" class="btn btn-success link">
                <i class="bi bi-arrow-counterclockwise"></i>
                resset
            </a>
        </div>
    </div>
    <form class="form-add" method="post" style="width:50%;">
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
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" value="<?=$category_name ?? ''?>">
            <?php if(isset($errors["name"])):?>
            <div class="form-error"><?=$errors["name"]?></div>
            <?php endif;?>
        </div>
        <div class="form-button mt-3">
            <button class="btn btn-primary" type="submit">Thêm</button>
        </div>
    </form>
</div>