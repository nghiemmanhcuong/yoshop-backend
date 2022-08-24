<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold">Danh sách danh mục</h4>
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
                <a href="<?=WEB_ROOT.'/category/add'?>" class="btn btn-success link">Thêm danh mục</a>
            </div>
            <?php if(checkManagers('categories',$_SESSION['user']['managers'])):?>
            <button type="button" id="checked-all-btn" class="btn btn-primary me-1 link">Chọn tất cả</button>
            <button type="button" id="unchecked-all-btn" class="btn btn-warning me-1 link">Bỏ chọn tất cả</button>
            <button type="submit" id="submit-form-delete-all" class="btn btn-danger me-1 link">Xoá mục đã chọn</button>
            <?php endif; ?>
        </div>
        <table class="table table-success">
            <thead>
                <tr>
                    <th class="text-center border border-dark">STT</th>
                    <?php if(checkManagers('categories',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chọn</th>
                    <?php endif; ?>
                    <th class="text-center border border-dark">Tên danh mục</th>
                    <?php if(checkManagers('categories',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chức năng</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($categories) && count($categories) > 0): $count=0;?>
                <?php foreach($categories as $category): $count++; ?>
                <tr>
                    <td class="text-center border border-dark"><?=$count?></td>
                    <?php if(checkManagers('categories',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <input type="checkbox" name="chooseRows[]" value="<?=$category['id']?>"
                            class="form-check-input">
                    </td>
                    <?php endif;?>
                    <td class="text-center border border-dark"><?=$category['name']?></td>
                    <?php if(checkManagers('categories',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <a href="<?=WEB_ROOT?>/category/edit?category_id=<?=$category['id']?>"
                            class="btn btn-primary link">
                            Sửa
                        </a>
            
                        <div class="d-inline" onclick="return confirm('Bạn thật sự muốn xoá danh mục này')">
                            <a href="<?=WEB_ROOT?>/category/delete?category_id=<?=$category['id']?>"
                                class="btn btn-danger link">
                                Xoá
                            </a>
                        </div>
                    <?php endif;?>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </form>
    <?php include_once('views/block/pagination.php');?>
</div>
