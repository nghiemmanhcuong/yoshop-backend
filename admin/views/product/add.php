<div class="container mt-3">
    <div class="content">
        <h4 class="text-center text-uppercase fw-bold">Thêm sản phẩm mới</h4>
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
        <div class="d-flex mb-1">
            <div class="me-2">
                <a href="<?=WEB_ROOT.'/product'?>" class="btn btn-primary link">
                    <i class="bi bi-list"></i>
                    Danh sách
                </a>
            </div>
            <div>
                <a href="<?=WEB_ROOT.'/product/add'?>" class="btn btn-success link">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    resset
                </a>
            </div>
        </div>
        <form class="form-add" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-2 col-4">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="<?=$name ?? ''?>">
                    <?php if(isset($errors["name"])):?>
                    <div class="form-error"><?=$errors["name"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Danh mục sản phẩm</label>
                    <select name="category" class="form-select">
                        <option value="">--Chọn--</option>
                        <?php foreach ($categories as $category):?>
                        <option value="<?=$category['id']?>"><?=$category['name']?></option>
                        <?php endforeach;?>
                    </select>
                    <?php if(isset($errors["category"])):?>
                    <div class="form-error"><?=$errors["category"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Ảnh sản phẩm</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                    <?php if(isset($errors["images"])):?>
                    <div class="form-error"><?=$errors["images"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Giá thị trường</label>
                    <input type="text" name="oldPrice" class="form-control" value="<?=$oldPrice ?? ''?>">
                    <?php if(isset($errors["oldPrice"])):?>
                    <div class="form-error"><?=$errors["oldPrice"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Giá bán</label>
                    <input type="text" name="newPrice" class="form-control" value="<?=$newPrice ?? ''?>">
                    <?php if(isset($errors["newPrice"])):?>
                    <div class="form-error"><?=$errors["newPrice"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Giảm giá</label>
                    <input type="text" name="discount" class="form-control" value="<?=$discount ?? ''?>">
                    <?php if(isset($errors["discount"])):?>
                    <div class="form-error"><?=$errors["discount"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Số lượng</label>
                    <input type="text" name="quantity" class="form-control" value="<?=$quantity ?? ''?>">
                    <?php if(isset($errors["quantity"])):?>
                    <div class="form-error"><?=$errors["quantity"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Màu</label>
                    <input type="text" name="color" class="form-control" value="<?=$color ?? ''?>">
                    <?php if(isset($errors["color"])):?>
                    <div class="form-error"><?=$errors["color"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Kích cỡ</label>
                    <select name="sizes[]" class="form-select multiple-select" title="Chọn kích cỡ" multiple>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                    </select>
                    <?php if(isset($errors["sizes"])):?>
                    <div class="form-error"><?=$errors["sizes"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-12">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control"><?=$description ?? ''?></textarea>
                    <?php if(isset($errors["description"])):?>
                    <div class="form-error"><?=$errors["description"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-12 d-flex align-items-center">
                    <div class="d-flex align-items-center me-5">
                        <label class="form-label me-2" style="margin-bottom: 0;">Sản phẩm mới</label>
                        <input <?=(isset($is_new) && $is_new==1)?'checked' : ''?> name="is_new" value="1"
                            type="checkbox">
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="form-label me-2" style="margin-bottom: 0;">Sản phẩm nổi bật</label>
                        <input <?=(isset($is_popular) && $is_popular==1)?'checked' : ''?> name="is_popular" value="1"
                            type="checkbox">
                    </div>
                </div>
            </div>
            <div class="form-button mt-2">
                <button class="btn btn-primary" type="submit">Thêm</button>
            </div>
        </form>
    </div>
</div>