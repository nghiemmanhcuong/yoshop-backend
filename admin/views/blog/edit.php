<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold mb-2">Thêm bài viết mới</h4>
    <form class="form-add" method="post" enctype="multipart/form-data" style="width:70%;">
        <div class="mb-2">
            <label class="form-label">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control" value="<?=$blog['title']?>">
            <?php if(isset($errors["title"])):?>
            <div class="form-error"><?=$errors["title"]?></div>
            <?php endif;?>
        </div>
        <div class="mb-2">
            <label class="form-label">Mô tả bài viết</label>
            <textarea name="desc" cols="20" rows="2" class="form-control"><?=$blog['description']?></textarea>
            <?php if(isset($errors["desc"])):?>
            <div class="form-error"><?=$errors["desc"]?></div>
            <?php endif;?>
        </div>
        <div class="mb-2">
            <label class="form-label">Nội dung bài viết</label>
            <textarea name="content" cols="20" rows="3" class="form-control"><?=$blog['content']?></textarea>
            <?php if(isset($errors["content"])):?>
            <div class="form-error"><?=$errors["content"]?></div>
            <?php endif;?>
        </div>
        <div class="row">
            <div class="mb-2 col-6">
                <label class="form-label">Tác giả</label>
                <input type="text" name="author" class="form-control" value="<?=$blog['author']?>">
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
                <img class="mt-2" src="<?=IMG_ROOT.$blog['image']?>" height="50" width="50">
            </div>
        </div>
        <input type="hidden" name="id" value="<?=$blog['id']?>">
        <input type="hidden" name="img" value="<?=$blog['image']?>">
        <div class="form-button mt-3">
            <button class="btn btn-primary" type="submit">Lưu chỉnh sửa</button>
        </div>
    </form>
</div>