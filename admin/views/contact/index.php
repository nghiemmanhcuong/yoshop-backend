<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold">Danh sách liên hệ</h4>
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
        <?php if(checkManagers('contacts',$_SESSION['user']['managers'])):?>
        <div class="mb-1 d-flex align-items-center">
            <button type="button" id="checked-all-btn" class="btn btn-primary me-1 link">Chọn tất cả</button>
            <button type="button" id="unchecked-all-btn" class="btn btn-warning me-1 link">Bỏ chọn tất cả</button>
            <button type="submit" id="submit-form-delete-all" class="btn btn-danger me-1 link">Xoá mục đã chọn</button>
        </div>
        <?php endif;?>
        <table class="table table-success">
            <thead>
                <tr>
                    <th class="text-center border border-dark">STT</th>
                    <?php if(checkManagers('contacts',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chọn</th>
                    <?php endif;?>
                    <th class="text-center border border-dark">Tên</th>
                    <th class="text-center border border-dark">Số điện thoại</th>
                    <th class="text-center border border-dark">Email</th>
                    <th class="text-center border border-dark">Ngày gửi</th>
                    <?php if(checkManagers('contacts',$_SESSION['user']['managers'])):?>
                    <th class="text-center border border-dark">Chức năng</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($contacts) && count($contacts) > 0): $count=0;?>
                <?php foreach($contacts as $contact): $count++; ?>
                <tr>
                    <td class="text-center border border-dark"><?=$count?></td>
                    <?php if(checkManagers('contacts',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <input type="checkbox" name="chooseRows[]" value="<?=$contact['id']?>"
                            class="form-check-input">
                    </td>
                    <?php endif;?>
                    <td class="text-center border border-dark"><?=$contact['customer_name']?></td>
                    <td class="text-center border border-dark"><?=$contact['customer_phone']?></td>
                    <td class="text-center border border-dark"><?=$contact['customer_email']?></td>
                    <td class="text-center border border-dark"><?=$contact['created_at']?></td>
                    <?php if(checkManagers('contacts',$_SESSION['user']['managers'])):?>
                    <td class="text-center border border-dark">
                        <a href="<?=WEB_ROOT?>/contact/detail?contact_id=<?=$contact['id']?>"
                            class="btn btn-primary link">
                            Chi tiết
                        </a>
                
                        <div class="d-inline" onclick="return confirm('Bạn thật sự muốn xoá liên hệ này')">
                            <a href="<?=WEB_ROOT?>/contact/delete?contact_id=<?=$contact['id']?>"
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
