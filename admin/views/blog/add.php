<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold mb-2">Thêm bài viết mới</h4>
    <div class="d-flex mb-1 mx-auto"  style="width:70%;">
        <div class="me-2">
            <a href="<?=WEB_ROOT.'/blog'?>" class="btn btn-primary link">
                <i class="bi bi-list"></i>
                Danh sách
            </a>
        </div>
        <div>
            <a href="<?=WEB_ROOT.'/blog/add'?>" class="btn btn-success link">
                <i class="bi bi-arrow-counterclockwise"></i>
                resset
            </a>
        </div>
    </div>
    <form class="form-add" method="post" enctype="multipart/form-data" style="width:70%;">
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
            <label class="form-label">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control" value="<?=$title ?? ''?>">
            <?php if(isset($errors["title"])):?>
            <div class="form-error"><?=$errors["title"]?></div>
            <?php endif;?>
        </div>
        <div class="mb-2">
            <label class="form-label">Mô tả bài viết</label>
            <textarea name="desc" cols="20" rows="2" class="form-control"><?=$desc ?? ''?></textarea>
            <?php if(isset($errors["desc"])):?>
            <div class="form-error"><?=$errors["desc"]?></div>
            <?php endif;?>
        </div>
        <div class="row">
            <div class="mb-2 col-6">
                <label class="form-label">Tác giả</label>
                <input type="text" name="author" class="form-control" value="<?=$author ?? ''?>">
                <?php if(isset($errors["author"])):?>
                <div class="form-error"><?=$errors["author"]?></div>
                <?php endif;?>
            </div>
            <div class="mb-2 col-6">
                <label class="form-label">Ảnh bài viết</label>
                <input type="file" name="image" class="form-control">
                <?php if(isset($errors["image"])):?>
                <div class="form-error"><?=$errors["image"]?></div>
                <?php endif;?>
            </div>
        </div>
        <div class="mb-2">
            <label class="form-label">Nội dung bài viết</label>
            <textarea name="content" cols="20" rows="3" class="form-control"><?=$content ?? ''?></textarea>
            <?php if(isset($errors["content"])):?>
            <div class="form-error"><?=$errors["content"]?></div>
            <?php endif;?>
        </div>
        <div class="form-button mt-3">
            <button class="btn btn-primary" type="submit">Thêm</button>
        </div>
    </form>
</div>