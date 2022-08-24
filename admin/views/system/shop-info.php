<div class="container mt-3" style="width:60%;">
    <h4 class="text-center text-uppercase">Thông tin shop trên website</h4>
    <?php if(isset($_GET['msg'])):?>
    <div class="alert alert-success small position-relative">
        <?=$_GET['msg']?>
        <a href="<?=WEB_ROOT.'/system/shop-info'?>" class="position-absolute" style="top:0px;right:5px;">
            <i class="bi bi-x-circle-fill"></i>
        </a>
    </div>
    <?php endif;?>
    <table class="table table-success mb-5">    
        <thead>
            <tr>
                <th class="text-center border border-dark">Số điện thoại</th>
                <th class="text-center border border-dark">Email liên hệ</th>
                <th class="text-center border border-dark">Địa chỉ shop</th>
                <th class="text-center border border-dark">Giới thiệu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center border border-dark" width="20%"><?='0'.$shop_info['shop_phone']?></td>
                <td class="text-center border border-dark"><?=$shop_info['shop_email']?></td>
                <td class="text-center border border-dark"><?=$shop_info['shop_address']?></td>
                <td class="text-center border border-dark"><?=$shop_info['about_text']?></td>
            </tr>
        </tbody>
    </table>
    <h4 class="text-center text-uppercase">Sửa thông tin shop</h4>
    <form method="post" class="form-add">
        <div class="row">
            <div class="mb-3 col-6">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="shop_phone" class="form-control" value="<?='0'.$shop_info['shop_phone']?>">
                <?php if(isset($errors["shop_phone"])):?>
                <div class="form-error"><?=$errors["shop_phone"]?></div>
                <?php endif;?>
            </div>
            <div class="mb-3 col-6">
                <label class="form-label">Email</label>
                <input type="text" name="shop_email" class="form-control" value="<?=$shop_info['shop_email']?>">
                <?php if(isset($errors["shop_email"])):?>
                <div class="form-error"><?=$errors["shop_email"]?></div>
                <?php endif;?>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="shop_address" class="form-control" value="<?=$shop_info['shop_address']?>">
            <?php if(isset($errors["shop_address"])):?>
            <div class="form-error"><?=$errors["shop_address"]?></div>
            <?php endif;?>
        </div>
        <div class="mb-3">
            <label class="form-label">Giới thiệu</label>
            <textarea name="about_text" cols="30" rows="5"
                class="form-control"><?=$shop_info['about_text']?></textarea>
            <?php if(isset($errors["about_text"])):?>
            <div class="form-error"><?=$errors["about_text"]?></div>
            <?php endif;?>
        </div>
        <input type="hidden" name="id" value="<?=$shop_info['id']?>">
        <?php if(checkManagers('systems',$_SESSION['user']['managers'])):?>
        <div class="form-button">
            <button class="btn btn-primary" type="submit">Lưu chỉnh sửa</button>
        </div>
        <?php endif;?>
    </form>
</div>