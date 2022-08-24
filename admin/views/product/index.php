<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold">Danh sách sản phẩm</h4>
    <?php if(isset($_GET['msg'])):?>
    <div class="alert alert-success small mb-1">
        <?=$_GET['msg']?>
        <i class="bi bi-x-circle-fill"></i>
    </div>
    <?php endif;?>
    <?php if(isset($error)):?>
    <div class="alert alert-danger small mb-1">
        <?=$error?>
        <i class="bi bi-x-circle-fill"></i>
    </div>
    <?php endif;?>
    <form method="post" id="form-delete-all">
        <div class="mb-1 d-flex align-items-center">
            <div class="me-1">
                <a href="<?=WEB_ROOT.'/product/add'?>" class="btn btn-success link">Thêm sản phẩm</a>
            </div>
            <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
            <button type="button" id="checked-all-btn" class="btn btn-primary me-1 link">Chọn tất cả</button>
            <button type="button" id="unchecked-all-btn" class="btn btn-warning me-1 link">Bỏ chọn tất cả</button>
            <button type="submit" id="submit-form-delete-all" class="btn btn-danger me-1 link">Xoá mục đã chọn</button>
            <?php endif;?>
        </div>
        <table class="table table-success">
            <thead>
                <tr>
                    <th class="text-center border border-dark">STT</th>
                    <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chọn</th>
                    <?php endif;?>
                    <th class="text-center border border-dark">Tên sản phẩm</th>
                    <th class="text-center border border-dark">Giá thị trường</th>
                    <th class="text-center border border-dark">Giá bán</th>
                    <th class="text-center border border-dark">Giảm giá</th>
                    <th class="text-center border border-dark">Danh mục</th>
                    <th class="text-center border border-dark">Đã bán</th>
                    <th class="text-center border border-dark">Trạng thái</th>
                    <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chức năng</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($products) && count($products) > 0): $count=0;?>
                <?php foreach($products as $product): $count++; ?>
                <tr>
                    <td class="text-center border border-dark"><?=$count?></td>
                    <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <input type="checkbox" name="chooseRows[]" value="<?=$product['id']?>"
                            class="form-check-input">
                    </td>
                    <?php endif;?>
                    <td class="text-center border border-dark"><?=$product['name']?></td>
                    <td class="text-center border border-dark"><?=handlePrice($product['oldPrice'])?></td>
                    <td class="text-center border border-dark"><?=handlePrice($product['newPrice'])?></td>
                    <td class="text-center border border-dark"><?=$product['discount']?><sup>%</sup></td>
                    <td class="text-center border border-dark"><?=getCategoryName($product['category_id'])?></td>
                    <td class="text-center border border-dark"><?=$product['sold']?></td>
                    <td class="text-center border border-dark">
                        <?=$product['status'] == 1 ? 'Còn hàng' : 'Hết hàng'?>
                    </td>
                    <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <a href="<?=WEB_ROOT?>/product/edit?product_id=<?=$product['id']?>"
                            class="btn btn-primary link">
                            Sửa
                        </a>

                        <div class="d-inline" onclick="return confirm('Bạn xoá buốn xoá sản phẩm này???')">
                            <a href="<?=WEB_ROOT?>/product/delete?product_id=<?=$product['id']?>"
                                class="btn btn-danger link">Xoá</a>
                        </div>
                    </td>
                    <?php endif;?>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </form>
    <?php include_once('views/block/pagination.php');?>
</div>