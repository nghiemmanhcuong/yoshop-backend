<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold mb-2">Sửa trạng thái đơn hàng</h4>
    <?php if(isset($error)):?>
    <div class="alert alert-danger small">
        <?=$error?>
        <i class="bi bi-x-circle-fill"></i>
    </div>
    <?php endif;?>
    <form class="form-add" method="post" style="width:40%;">
        <div class="mb-2">
            <a href="<?=WEB_ROOT.'/order'?>" class="btn btn-primary link">
                <i class="bi bi-arrow-left"></i>
                Quay lại
            </a>
        </div>
        <div class="mb-2">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" value="<?=$order['customer_name']?>" readonly>
        </div>
        <div class="mb-2">
            <label class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" value="<?='0'.$order['customer_phone']?>" readonly>
        </div>
        <div class="mb-2">
            <label class="form-label">Trạng thái đơn hàng</label>
            <select name="status" class="form-select">
                <option <?=$order['status'] == 'Chờ xác nhận' ? 'selected' : ''?> value="Chờ xác nhận">Chờ xác nhận
                </option>
                <option <?=$order['status'] == 'Đang vận chuyển' ? 'selected' : ''?> value="Đang vận chuyển">Đang vận
                    chuyển</option>
                <option <?=$order['status'] == 'Đã thanh toán' ? 'selected' : ''?> value="Đã thanh toán">Đã thanh toán
                </option>
                <option <?=$order['status'] == 'Đã huỷ' ? 'selected' : ''?> value="Đã huỷ">Đã huỷ
                </option>   
            </select>
        </div>
        <input type="hidden" name="id" value="<?=$order['id']?>" />
        <div class="form-button mt-3">
            <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
        </div>
    </form>
</div>