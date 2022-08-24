<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold">Chi tiết đơn hàng</h4>
    <div class="mb-2">
        <a href="<?=WEB_ROOT.'/order'?>" class="btn btn-primary link">
            <i class="bi bi-arrow-left"></i>
            Quay lại
        </a>
    </div>
    <div class="row mt-5 box-content">
        <div class="col-6">
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-person-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Tên khách hàng:
                </span>
                <p style="margin-bottom:0;"><?=$order['customer_name']?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-telephone-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Số điện thoại khách hàng:
                </span>
                <p style="margin-bottom:0;"><?='0'.$order['customer_phone']?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-envelope position-absolute" style="left:0px;top:-1px;"></i>
                    Email khách hàng:
                </span>
                <p style="margin-bottom:0;"><?=$order['customer_email']?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-house-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Địa chỉ khách hàng:
                </span>
                <p style="margin-bottom:0;"><?=$order['customer_address']?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-cash position-absolute" style="left:0px;top:-1px;"></i>
                    Phương thức thanh toán:
                </span>
                <p style="margin-bottom:0;"><?=$order['payment_method']?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-chat-dots-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Ghi chú đơn hàng:
                </span>
                <p style="margin-bottom:0;">
                    <?=$order['message'] == '' ? 'không có thông tin ghi chú' : $order['message']?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-alarm-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Ngày giờ đặt hàng:
                </span>
                <p style="margin-bottom:0;"><?=$order['created_at']?></p>
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-plus-circle-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Tông tiền đơn hàng:
                </span>
                <p style="margin-bottom:0;"><?=handlePrice($order['total_price'])?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-plus-circle-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Phí ship:
                </span>
                <p style="margin-bottom:0;"><?=handlePrice($order['transport_fee'])?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-plus-circle-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Giảm giá:
                </span>
                <p style="margin-bottom:0;"><?=$order['discount']?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-plus-circle-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Tổng tiền phải thanh toán:
                </span>
                <p style="margin-bottom:0;"><?=handlePrice($total_amount_payable)?></p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <span class="fw-bold position-relative pe-3 ps-4    " style="width:250px;">
                    <i class="bi bi-plus-circle-fill position-absolute" style="left:0px;top:-1px;"></i>
                    Trạng thái đơn hàng:
                </span>
                <p style="margin-bottom:0;"><?=$order['status']?></p>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <h4 class="text-center text-uppercase fw-bold">Sản phẩm trong đơn hàng</h4>
        <table class="table table-success mt-3">
            <thead>
                <tr>
                    <th class="text-center border border-dark">STT</th>
                    <th class="text-center border border-dark">Ảnh sản phẩm</th>
                    <th class="text-center border border-dark">Tên sản phẩm</th>
                    <th class="text-center border border-dark">Màu sản phẩm</th>
                    <th class="text-center border border-dark">Kích cỡ sản phẩm</th>
                    <th class="text-center border border-dark">Số lượng mua</th>
                </tr>
            </thead>
            <tbody>
                <?php $count=0; foreach($order_detail as $item): $count++; ?>
                <tr>
                    <td class="text-center border border-dark"><?=$count?></td>
                    <td class="text-center border border-dark">
                        <img src="<?=IMG_ROOT.json_decode($item['images'])[0]?>" width="50">
                    </td>
                    <td class="text-center border border-dark"><?=$item['name']?></td>
                    <td class="text-center border border-dark"><?=$item['color']?></td>
                    <td class="text-center border border-dark"><?=$item['size']?></td>
                    <td class="text-center border border-dark"><?=$item['quantity']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>