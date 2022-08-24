<div class="container mt-3">
    <h4 class="text-center text-uppercase fw-bold">Thống kê bình luận sản phẩm</h4>
    <table class="table table-success">
        <thead>
            <tr>
                <th class="text-center border border-dark">STT</th>
                <th class="text-center border border-dark">Sản phẩm</th>
                <th class="text-center border border-dark">Tổng số bình luận</th>
                <th class="text-center border border-dark">Bình luận mới nhất</th>
                <th class="text-center border border-dark">Bình luận cũ nhất</th>
                <th class="text-center border border-dark">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php $count=0; foreach($products as $product): $count++; ?>
            <tr>
                <td class="text-center border border-dark"><?=$count?></td>
                <td class="text-center border border-dark"><?=$product['name']?></td>
                <td class="text-center border border-dark"><?=getTotalComments($product['id'])?></td>
                <td class="text-center border border-dark">
                    <?=getLatestComment($product['id']) ?? 'Chưa có bình luận cho sản phẩm này'?></td>
                <td class="text-center border border-dark">
                    <?=getOldestComment($product['id']) ?? 'Chưa có bình luận cho sản phẩm này'?></td>
                <td class="text-center border border-dark">
                    <a href="<?=WEB_ROOT?>/product/comment-list?product_id=<?=$product['id']?>" class="btn btn-primary link">
                        Chi tiết
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include_once('views/block/pagination.php');?>
</div>