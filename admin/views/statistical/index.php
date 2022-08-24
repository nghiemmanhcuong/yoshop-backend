<div class="pt-3">
    <div class="container">
        <div class="synthetic mb-3">
            <h4>Tổng hợp</h4>
            <div class="row">
                <div class="col-3">
                    <div class="synthetic-item green">
                        <h5>Tổng số sản phẩm</h5>
                        <div class="synthetic-item-content">
                            <i class="bi bi-bag-fill"></i>
                            <span><?=$count_products?></span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="synthetic-item red">
                        <h5>Tổng số bài viết</h5>
                        <div class="synthetic-item-content">
                            <i class="bi bi-bootstrap-fill"></i>
                            <span><?=$count_blogs?></span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="synthetic-item blue">
                        <h5>Tổng số khách hàng</h5>
                        <div class="synthetic-item-content">
                            <i class="bi bi-people-fill"></i>
                            <span><?=$count_customers?></span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="synthetic-item yellow">
                        <h5>Tổng số quản trị viên</h5>
                        <div class="synthetic-item-content">
                            <i class="bi bi-person-square"></i>
                            <span><?=$count_admin?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="statistical">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex align-items-center">
                        <h4 style="margin-bottom:0;" class="me-2">Doang số</h4>
                        <select class="form-select" name="sales" id="sales" style="width:200px;">
                            <option <?=(!isset($_GET['sales']) || $_GET['sales'] == 'year' ? 'selected' : '')?> value="?sales=year">1 năm qua
                            </option>
                            <option <?=(isset($_GET['sales']) && $_GET['sales'] == 'six_months' ? 'selected' : '')?> value="?sales=six_months">6
                                tháng qua</option>
                            <option <?=(isset($_GET['sales']) && $_GET['sales'] == 'most_recent_month' ? 'selected' : '')?>
                                value="?sales=most_recent_month">1 tháng gần đây</option>
                            <option <?=(isset($_GET['sales']) && $_GET['sales'] == 'week_past' ? 'selected' : '')?> value="?sales=week_past">1
                                tuần qua</option>
                        </select>
                    </div>
                    <div id="doanhso" style="height: 230px;"></div>
                </div>
                <div class="col-6">
                    <h4 style="margin-bottom:0;">Người dùng đã đăng ký</h4>
                    <div id="nguoidung" style="height: 270px;"></div>
                </div>
                <div class="col-6">
                    <h4 style="margin-bottom:0;">Số sản phẩm trên loại</h4>
                    <div id="sanpham" style="height: 270px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
const salesData = <?=json_encode(array_reverse($sales_data))?>;
new Morris.Area({
    element: 'doanhso',
    data: salesData,
    xkey: 'year',
    ykeys: ['value'],
    labels: ['Doanh số'],
});

const customersData = <?=json_encode(array_reverse($customers_data))?>;
new Morris.Bar({
    element: 'nguoidung',
    data: customersData,
    xkey: 'year',
    ykeys: ['value'],
    labels: ['Số người đăng ký']
});

const products = <?=json_encode($categories)?>;
const dataProductChart = products.map((item) => {
    return {
        label: item.name,
        value: item.product_number,
    }
});
new Morris.Donut({
    element: 'sanpham',
    data: dataProductChart,
    colors: [
        '#50ADF5',
        '#FF7965',
        '#FFCB45',
        '#6877e5',
        '#6FB07F',
        '#CC3232',
    ]
});

const sales = document.getElementById('sales');

if (sales) {
    sales.onchange = () => {
        sales.options[sales.selectedIndex].value && (window.location = sales.options[sales.selectedIndex]
            .value);
    }
}
</script>