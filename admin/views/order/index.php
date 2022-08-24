<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold">Danh sách đơn hàng</h4>
    <?php if(isset($_GET['msg'])):?>
        <div class="alert alert-success small">
            <?=$_GET['msg']?>
            <i class="bi bi-x-circle-fill"></i>
        </div>
    <?php endif;?>
    <table class="table table-success">
        <thead>
            <tr>
                <th class="text-center border border-dark">STT</th>
                <th class="text-center border border-dark">Tên khách hàng</th>
                <th class="text-center border border-dark">Số điện thoại</th>
                <th class="text-center border border-dark">Email</th>
                <th class="text-center border border-dark">Tổng tiền đơn hàng</th>
                <th class="text-center border border-dark">Phí ship</th>
                <th class="text-center border border-dark">Giảm giá</th>
                <th class="text-center border border-dark">Trạng thái</th>
                <?php if(checkManagers('orders',$_SESSION['user']['managers'])):?>
                <th class="text-center border border-dark">Chức năng</th>
                <?php endif;?>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($orders) && count($orders) > 0): $count=0;?>
            <?php foreach($orders as $order): $count++; ?>
            <tr>
                <td class="text-center border border-dark"><?=$count?></td>
                <td class="text-center border border-dark"><?=$order['customer_name']?></td>
                <td class="text-center border border-dark"><?=$order['customer_phone']?></td>
                <td class="text-center border border-dark"><?=$order['customer_email']?></td>
                <td class="text-center border border-dark"><?=handlePrice($order['total_price'])?></td>
                <td class="text-center border border-dark"><?=handlePrice($order['transport_fee'])?></td>
                <td class="text-center border border-dark"><?=$order['discount']?></td>
                <td class="text-center border border-dark"><?=$order['status']?></td>
                <?php if(checkManagers('orders',$_SESSION['user']['managers'])):?>
                <td class="text-center border border-dark">
                    <a href="<?=WEB_ROOT?>/order/detail?order_id=<?=$order['id']?>" class="btn btn-primary link">
                        Chi tiết
                    </a>
                    <a href="<?=WEB_ROOT?>/order/status?order_id=<?=$order['id']?>" class="btn btn-success link">
                        Thay đổi trạng thái
                    </a>
                </td>
                <?php endif;?>
            </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
    <?php include_once('views/block/pagination.php');?>
</div>