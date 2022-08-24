<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold">Danh sách người dùng</h4>
    <?php if(isset($_GET['msg'])):?>
        <div class="alert alert-success small">
            <?=$_GET['msg']?>
            <i class="bi bi-x-circle-fill"></i>
        </div>
    <?php endif;?>
    <div class="mb-1">
        <a href="<?=WEB_ROOT.'/user/add'?>" class="btn btn-success link">Thêm quản trị viên</a>
    </div>
    <table class="table table-success">
        <thead>
            <tr>
                <th class="text-center border border-dark">STT</th>
                <th class="text-center border border-dark">Họ và Tên đệm</th>
                <th class="text-center border border-dark">Tên</th>
                <th class="text-center border border-dark">Email</th>
                <th class="text-center border border-dark">Số điện thoại</th>
                <th class="text-center border border-dark">Sinh nhật</th>
                <th class="text-center border border-dark">Giới tính</th>
                <th class="text-center border border-dark">Chức vụ</th>
                <?php if(checkManagers('users',$_SESSION['user']['managers'])):?>
                <th class="text-center border border-dark">Chức năng</th>
                <?php endif;?>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($users) && count($users) > 0): $count=0;?>
            <?php foreach($users as $user): $count++; ?>
            <tr>
                <td class="text-center border border-dark"><?=$count?></td>
                <td class="text-center border border-dark"><?=$user['surname']?></td>
                <td class="text-center border border-dark"><?=$user['name']?></td>
                <td class="text-center border border-dark"><?=$user['email']?></td>
                <td class="text-center border border-dark"><?=$user['phone']?></td>
                <td class="text-center border border-dark"><?=$user['birthday']?></td>
                <td class="text-center border border-dark"><?=$user['sex']?></td>
                <td class="text-center border border-dark"><?=$user['access']?></td>
                <?php if(checkManagers('users',$_SESSION['user']['managers'])):?>
                <td class="text-center border border-dark">
                    <a href="<?=WEB_ROOT?>/user/edit?user_id=<?=$user['id']?>" class="btn btn-primary link">
                        Sửa
                    </a>
                <div class="d-inline" onclick="return confirm('Bạn xoá buốn xoá người dùng này???')">
                    <a href="<?=WEB_ROOT?>/user/delete?user_id=<?=$user['id']?>" class="btn btn-danger link">Xoá</a>
                </div>
                </td>
                <?php endif;?>
            </tr>
            <?php endforeach;?>
            <?php else:?>
            <div class="text-center">Không tìm thấy người dùng nào</div>
            <?php endif;?>
        </tbody>
    </table>
    <?php if(isset($users) && count($users) > 0):?>
    <?php include_once('views/block/pagination.php');?>
    <?php endif;?>
</div>