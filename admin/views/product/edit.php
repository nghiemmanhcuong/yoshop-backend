<div class="container mt-3">
    <div class="content">
        <h4 class="text-center text-uppercase fw-bold">Sửa sản phẩm</h4>
        <form class="form-add" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-2 col-4">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="<?=$product['name']?>">
                    <?php if(isset($errors["name"])):?>
                    <div class="form-error"><?=$errors["name"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Danh mục sản phẩm</label>
                    <select name="category" class="form-select">
                        <?php foreach ($categories as $category):?>
                        <option <?=($product['category_id'] == $category['id']) ? 'selected' : ''?>
                            value="<?=$category['id']?>"><?=$category['name']?></option>
                        <?php endforeach;?>
                    </select>
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
                    <input type="text" name="oldPrice" class="form-control" value="<?=$product['oldPrice']?>">
                    <?php if(isset($errors["oldPrice"])):?>
                    <div class="form-error"><?=$errors["oldPrice"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Giá bán</label>
                    <input type="text" name="newPrice" class="form-control" value="<?=$product['newPrice']?>">
                    <?php if(isset($errors["newPrice"])):?>
                    <div class="form-error"><?=$errors["newPrice"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Giảm giá</label>
                    <input type="text" name="discount" class="form-control" value="<?=$product['discount']?>">
                    <?php if(isset($errors["discount"])):?>
                    <div class="form-error"><?=$errors["discount"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Số lượng</label>
                    <input type="text" name="quantity" class="form-control" value="<?=$product['quantity']?>">
                    <?php if(isset($errors["quantity"])):?>
                    <div class="form-error"><?=$errors["quantity"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Màu</label>
                    <input type="text" name="color" class="form-control" value="<?=$product['color']?>">
                    <?php if(isset($errors["color"])):?>
                    <div class="form-error"><?=$errors["color"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-4">
                    <label class="form-label">Kích cỡ</label>
                    <select name="sizes[]" class="form-select multiple-select" title="Chọn kích cỡ" multiple>
                        <option <?=in_array('S',$product_sizes) ? 'selected' : ''?> value="S">S</option>
                        <option <?=in_array('M',$product_sizes) ? 'selected' : ''?> value="M">M</option>
                        <option <?=in_array('L',$product_sizes) ? 'selected' : ''?> value="L">L</option>
                        <option <?=in_array('XL',$product_sizes) ? 'selected' : ''?> value="XL">XL</option>
                        <option <?=in_array('XXL',$product_sizes) ? 'selected' : ''?> value="XXL">XXL</option>
                        <option <?=in_array('27',$product_sizes) ? 'selected' : ''?> value="27">27</option>
                        <option <?=in_array('28',$product_sizes) ? 'selected' : ''?> value="28">28</option>
                        <option <?=in_array('29',$product_sizes) ? 'selected' : ''?> value="29">29</option>
                        <option <?=in_array('30',$product_sizes) ? 'selected' : ''?> value="30">30</option>
                        <option <?=in_array('31',$product_sizes) ? 'selected' : ''?> value="31">31</option>
                        <option <?=in_array('32',$product_sizes) ? 'selected' : ''?> value="32">32</option>
                        <option <?=in_array('33',$product_sizes) ? 'selected' : ''?> value="33">33</option>
                    </select>
                    <?php if(isset($errors["sizes"])):?>
                    <div class="form-error"><?=$errors["sizes"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-12">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control"><?=$product['description']?></textarea>
                    <?php if(isset($errors["description"])):?>
                    <div class="form-error"><?=$errors["description"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-12 d-flex align-items-center">
                    <div class="d-flex align-items-center me-3">
                        <label class="form-label me-2" style="margin-bottom: 0;">Sản phẩm mới</label>
                        <input <?=($product['is_new']==1)?'checked' : ''?> name="is_new" value="1" type="checkbox">
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="form-label me-2" style="margin-bottom: 0;">Sản phẩm nổi bật</label>
                        <input <?=($product['is_popular']==1)?'checked' : ''?> name="is_popular" value="1"
                            type="checkbox">
                    </div>
                </div>
                <div class="mb-2 col-12 d-flex align-items-center">
                    <label class="form-label me-3" style="margin-bottom: 0;">Tình trạng:</label>
                    <div class="d-flex align-items-center me-2">
                        <input type="radio" <?=$product['status'] == 1 ? 'checked' : ''?> value="1" name="status"
                            class="form-check-input me-1" style="margin-top: 0;">
                        <label for="stocking" class="form-label fw-normal" style="margin-bottom: 0;">Còn hàng</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="radio" <?=$product['status'] == 0 ? 'checked' : ''?> value="0" name="status"
                            class="form-check-input me-1" style="margin-top: 0;">
                        <label for="stocking" class="form-label fw-normal" style="margin-bottom: 0;">Hết hàng</label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="imgs" value='<?=$product['images']?>'>
            <div class="form-button mt-2">
                <button class="btn btn-primary" type="submit">Lưu chỉnh sửa</button>
            </div>
        </form>
    </div>
</div>