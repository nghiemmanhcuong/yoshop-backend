<div class="container mt-3" style="width:50%;">
    <h4 class="text-center text-uppercase fw-bold">Danh sách bình luận</h4>
    <?php if(isset($_GET['msg'])):?>
    <div class="alert alert-success small">
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
        <div class="d-flex align-items-center mb-1">
            <div class="me-1">
                <a href="<?=WEB_ROOT.'/product/comment'?>" class="btn btn-success link">Quay lại</a>
            </div>
            <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
            <button type="button" id="checked-all-btn" class="btn btn-primary me-1 link">Chọn tất cả</button>
            <button type="button" id="unchecked-all-btn" class="btn btn-warning me-1 link">Bỏ chọn tất cả</button>
            <button type="submit"name="confirm" class="btn btn-info me-1 link">Xác nhận tất cả</button>
            <button type="submit"name="unconfirm" class="btn btn-danger me-1 link">Bỏ xác nhận tất cả</button>
            <?php endif;?>
        </div>
        <table class="table table-success">
            <thead>
                <tr>
                    <th class="text-center border border-dark">STT</th>
                    <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chọn</th>
                    <?php endif;?>
                    <th class="text-center border border-dark">Nội dung bình luận</th>
                    <th class="text-center border border-dark">Ngày bình luận</th>
                    <th class="text-center border border-dark">Người bình luận</th>
                    <th class="text-center border border-dark">Trạng thái</th>
                    <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chức năng</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php $count=0; foreach($product_comments as $product_comment): $count++; ?>
                <tr>
                    <td class="text-center border border-dark"><?=$count?></td>
                    <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <input type="checkbox" name="chooseRows[]" value="<?=$product_comment['id']?>"
                            class="form-check-input">
                    </td>
                    <?php endif;?>
                    <td class="text-center border border-dark"><?=$product_comment['content']?></td>
                    <td class="text-center border border-dark"><?=$product_comment['created_at']?></td>
                    <td class="text-center border border-dark"><?=$product_comment['name']?></td>
                    <td class="text-center border border-dark"><?=$product_comment['status'] == 0 ? 'Chưa xác nhận' : 'Đã xác nhận'?></td>
                    <?php if(checkManagers('products',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <div class="d-inline" onclick="return confirm('Bạn xoá muốn xoá bình luận này???')">
                            <a href="<?=WEB_ROOT?>/product/comment-delete?comment_id=<?=$product_comment['id']?>&product_id=<?=$product_comment['product_id']?>"
                                class="btn btn-danger link">Xoá</a>
                        </div>
                    </td>
                    <?php endif;?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <input type="hidden" name="product_comment_id" value="<?=$product_comment['product_id']?>">
    </form>
    <?php include_once('views/block/pagination.php');?>
</div>