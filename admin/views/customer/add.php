<div class="container mt-3">
    <div class="content">
        <h4 class="text-center text-uppercase fw-bold">Thêm người dùng</h4>
        <form class="form-add" method="post" style="width:60%;">
            <div class="mb-1">
                <a href="<?=WEB_ROOT.'/customer'?>" class="btn btn-success link">Quay lại</a>
            </div>
            <div class="row">
                <div class="mb-2 col-6">
                    <label class="form-label">Họ và tên đệm</label>
                    <input type="text" name="surname" class="form-control">
                    <?php if(isset($errors["surname"])):?>
                    <div class="form-error"><?=$errors["surname"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-6">
                    <label class="form-label">Tên người dùng</label>
                    <input type="text" name="name" class="form-control">
                    <?php if(isset($errors["name"])):?>
                    <div class="form-error"><?=$errors["name"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control">
                    <?php if(isset($errors["email"])):?>
                    <div class="form-error"><?=$errors["email"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control">
                    <?php if(isset($errors["phone"])):?>
                    <div class="form-error"><?=$errors["phone"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2">
                    <label class="form-label">Mật khẩu</label>
                    <input type="text" name="password" class="form-control">
                    <?php if(isset($errors["password"])):?>
                    <div class="form-error"><?=$errors["password"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-2 col-6">
                    <label class="form-label">Ngày tháng năm sinh</label>
                    <input type="date" name="birthday" class="form-control">
                    <?php if(isset($errors["birthday"])):?>
                    <div class="form-error"><?=$errors["birthday"]?></div>
                    <?php endif;?>
                </div>
                <div class="d-flex align-items-center col-6">
                    <div class="d-flex align-items-center me-3">
                        <input type="radio" name="sex"
                            class="form-check-input me-1" value="nam" style="margin-top:0;">
                        <label class="form-label" style="margin-bottom:0;">Nam</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="radio" name="sex"
                            class="form-check-input me-1" value="nữ" style="margin-top:0;">
                        <label class="form-label" style="margin-bottom:0;">Nữ</label>
                    </div>
                    <?php if(isset($errors["sex"])):?>
                    <div class="form-error"><?=$errors["sex"]?></div>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-button mt-2">
                <button class="btn btn-primary" type="submit">Thêm</button>
            </div>
        </form>
    </div>
</div>