<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold">Danh sách bài viết</h4>
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

        <div class="mb-1 d-flex align-items-center">
            <div class="me-1">
                <a href="<?=WEB_ROOT.'/blog/add'?>" class="btn btn-success link">Thêm bài viết</a>
            </div>
            <?php if(checkManagers('blogs',$_SESSION['user']['managers'])):?>
            <button type="button" id="checked-all-btn" class="btn btn-primary me-1 link">Chọn tất cả</button>
            <button type="button" id="unchecked-all-btn" class="btn btn-warning me-1 link">Bỏ chọn tất cả</button>
            <button type="submit" id="submit-form-delete-all" class="btn btn-danger me-1 link">Xoá mục đã chọn</button>
            <?php endif;?>
        </div>

        <table class="table table-success">
            <thead>
                <tr>
                    <th class="text-center border border-dark">STT</th>
                    <?php if(checkManagers('blogs',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chọn</th>
                    <?php endif;?>
                    <th class="text-center border border-dark">Ảnh</th>
                    <th class="text-center border border-dark">Tiêu đề</th>
                    <th class="text-center border border-dark">Tác giả</th>
                    <th class="text-center border border-dark">Ngày viết bài</th>
                    <?php if(checkManagers('blogs',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chức năng</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($blogs) && count($blogs) > 0): $count=0;?>
                <?php foreach($blogs as $blog): $count++; ?>
                <tr>
                    <td class="text-center border border-dark"><?=$count?></td>
                    <?php if(checkManagers('blogs',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <input type="checkbox" name="chooseRows[]" value="<?=$blog['id']?>" class="form-check-input">
                    </td>
                    <?php endif;?>
                    <td class="text-center border border-dark">
                        <img src="<?=IMG_ROOT.$blog['image']?>" width="50">
                    </td>
                    <td class="text-center border border-dark"><?=$blog['title']?></td>
                    <td class="text-center border border-dark"><?=$blog['author']?></td>
                    <td class="text-center border border-dark"><?=$blog['created_at']?></td>
                    <?php if(checkManagers('blogs',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <a href="<?=WEB_ROOT?>/blog/edit?blog_id=<?=$blog['id']?>" class="btn btn-primary link">
                            Sửa
                        </a>

                        <div class="d-inline" onclick="return confirm('Bạn thật sự muốn xoá bài viết này')">
                            <a href="<?=WEB_ROOT?>/blog/delete?blog_id=<?=$blog['id']?>" class="btn btn-danger link">
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