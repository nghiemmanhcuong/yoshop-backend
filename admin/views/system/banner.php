<div class="container mt-3" style="width:50%;">
    <h4 class="text-center text-uppercase fw-bold">Danh sách banner</h4>
    <?php if(isset($_GET['msg'])):?>
    <div class="alert alert-success small">
        <?=$_GET['msg']?>
        <i class="bi bi-x-circle-fill"></i>
    </div>
    <?php endif;?>
    <div class="mb-1">
        <a href="<?=WEB_ROOT.'/system/banner-add'?>" class="btn btn-success link">Thêm banner</a>
    </div>
    <table class="table table-success">
        <thead>
            <tr>
                <th class="text-center border border-dark">STT</th>
                <th class="text-center border border-dark">Ảnh</th>
                <th class="text-center border border-dark">Chiều cao</th>
                <th class="text-center border border-dark">Chiều rộng</th>
                <th class="text-center border border-dark">Trạng thái</th>
                <?php if(checkManagers('systems',$_SESSION['user']['managers'])):?>
                <th class="text-center border border-dark">Chức năng</th>
                <?php endif;?>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($banners) && count($banners) > 0):?>
            <?php $count=0; foreach($banners as $banner): $count++; ?>
            <tr>
                <td class="text-center border border-dark"><?=$count?></td>
                <td class="text-center border border-dark">
                    <img src="<?=IMG_ROOT.$banner['image']?>" width="40">
                </td>
                <td class="text-center border border-dark"><?=$banner['height']?></td>
                <td class="text-center border border-dark"><?=$banner['width']?></td>
                <td class="text-center border border-dark"><?=($banner['status'] == 1 ? 'Hiện' : 'Ẩn')?></td>
                <?php if(checkManagers('systems',$_SESSION['user']['managers'])):?>
                <td class="text-center border border-dark">
                    <a href="<?=WEB_ROOT?>/system/banner-edit?banner_id=<?=$banner['id']?>" class="btn btn-primary link">
                        Sửa
                    </a>
                    <div class="d-inline" onclick="return confirm('Bạn có thực sự muốn xoá banner này???')">
                        <a href="<?=WEB_ROOT?>/system/banner-delete?banner_id=<?=$banner['id']?>" class="btn btn-danger link">Xoá</a>
                    </div>
                </td>
                <?php endif;?>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <?php endif;?>
    </table>
    <?php include_once('views/block/pagination.php');?>
</div>