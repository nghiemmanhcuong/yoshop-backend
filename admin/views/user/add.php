<div class="container mt-3">
    <div class="content">
        <h4 class="text-center text-uppercase fw-bold">Thêm quản trị viên mới</h4>
        <?php if(isset($success)):?>
        <div class="alert alert-success small">
            <?=$success?>
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <?php endif;?>
        <?php if(isset($error)):?>
        <div class="alert alert-danger small">
            <?=$error?>
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <?php endif;?>
        <div class="d-flex mb-1 mx-auto" style="width:60%;">
            <div class="me-2">
                <a href="<?=WEB_ROOT.'/user'?>" class="btn btn-primary link">
                    <i class="bi bi-list"></i>
                    Danh sách
                </a>
            </div>
            <div>
                <a href="<?=WEB_ROOT.'/user/add'?>" class="btn btn-success link">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    resset
                </a>
            </div>
        </div>
        <form class="form-add" method="post" style="width:60%;">
            <div class="row">
                <div class="mb-3 col-6">
                    <label class="form-label">Họ và tên đệm</label>
                    <input type="text" name="surname" class="form-control" value="<?=$surname ?? ''?>">
                    <?php if(isset($errors["surname"])):?>
                    <div class="form-error"><?=$errors["surname"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-3 col-6">
                    <label class="form-label">Tên người dùng</label>
                    <input type="text" name="name" class="form-control" value="<?=$name ?? ''?>">
                    <?php if(isset($errors["name"])):?>
                    <div class="form-error"><?=$errors["name"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="<?=$email ?? ''?>">
                    <?php if(isset($errors["email"])):?>
                    <div class="form-error"><?=$errors["email"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="<?=$phone ?? ''?>">
                    <?php if(isset($errors["phone"])):?>
                    <div class="form-error"><?=$errors["phone"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" value="<?=$password ?? ''?>">
                    <?php if(isset($errors["password"])):?>
                    <div class="form-error"><?=$errors["password"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-3 col-6">
                    <label class="form-label">Quền truy cập</label>
                    <select name="access" class="form-control">
                        <option selected value="saff">Nhân viên</option>
                    </select>
                    <?php if(isset($errors["access"])):?>
                    <div class="form-error"><?=$errors["access"]?></div>
                    <?php endif;?>
                </div>
                <div class="mb-3 col-6">
                    <label class="form-label">Ngày tháng năm sinh</label>
                    <input type="date" name="birthday" class="form-control" value="<?=$birthday ?? ''?>">
                    <?php if(isset($errors["birthday"])):?>
                    <div class="form-error"><?=$errors["birthday"]?></div>
                    <?php endif;?>
                </div>
                <div class="d-flex align-items-center col-6">
                    <div class="d-flex align-items-center me-3">
                        <input <?=isset($sex) && $sex == 'nam' ? 'checked' : ''?> type="radio" name="sex"
                            class="form-check-input me-1" value="nam" style="margin-top:0;">
                        <label class="form-label" style="margin-bottom:0;">Nam</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input <?=isset($sex) && $sex == 'nữ' ? 'checked' : ''?> type="radio" name="sex"
                            class="form-check-input me-1" value="nữ" style="margin-top:0;">
                        <label class="form-label" style="margin-bottom:0;">Nữ</label>
                    </div>
                    <?php if(isset($errors["sex"])):?>
                    <div class="form-error"><?=$errors["sex"]?></div>
                    <?php endif;?>
                </div>
                <div class="col-12 mt-3">
                    <label class="form-label">Chức năng quản trị</label>
                    <div class="row mt-3">
                        <?php foreach ($manager_list as $item):?>
                        <div class="col-3 d-flex align-items-center mb-3">
                            <label style="font-size:13px;margin-bottom:0;" class="me-2" for="<?=$item['slug']?>"><?=$item['name']?></label>
                            <input style="margin-top:0;" class="form-check-input" type="checkbox" name="managers[]" value="<?=$item['slug']?>">
                        </div>
                        <?php endforeach;?>
                    </div>
                    <?php if(isset($errors["managers"])):?>
                    <div class="form-error"><?=$errors["managers"]?></div>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-button mt-2">
                <button class="btn btn-primary" type="submit">Thêm</button>
            </div>
        </form>
    </div>
</div>