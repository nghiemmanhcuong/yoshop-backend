<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold mb-2">Sửa danh mục</h4>
    <form class="form-add" method="post" style="width:50%;">
        <div class="mb-2">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" value="<?=$category['name']?>">
            <?php if(isset($errors["name"])):?>
            <div class="form-error"><?=$errors["name"]?></div>
            <?php endif;?>
        </div>
        <div class="form-button mt-3">
            <button class="btn btn-primary" type="submit">Lưu chỉnh sửa</button>
        </div>
    </form>
</div>