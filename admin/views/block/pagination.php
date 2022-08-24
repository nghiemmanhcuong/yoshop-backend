<?php
    if(isset($_GET['product_id'])){
        $href = '?product_id='.$_GET['product_id'].'&page=';
    }else {
        $href = '?page=';
    }
?>

<nav class="pagination-nav">
    <ul class="pagination">
        <!-- page btn -->
        <li class="page-item <?php if($curr_page == 1) echo 'disabled';?>">
            <a class="page-link" href="<?=$href.($curr_page - 1)?>">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <!-- page btn -->
        <?php if(($curr_page - 3)  >= 1):?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $href.'1';?>">1</a>
        </li>
        <?php endif;?>
        <?php if(($curr_page - 3)  > 1):?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $href.(floor($curr_page / 2));?>">...</a>
        </li>
        <?php endif;?>
        <!-- main page -->
        <?php for ($i=1; $i <= $pages; $i++):?>
        <?php if($i > $curr_page - 3 && $i <= $curr_page + 3):?>
        <?php if($i == $curr_page) :?>
        <li class="page-item active">
            <a class="page-link" href="<?=$href.$i?>"><?= $i?></a>
        </li>
        <?php else:?>
        <li class="page-item">
            <a class="page-link" href="<?=$href.$i?>"><?= $i?>
            </a>
        </li>
        <?php endif; ?>
        <?php endif;?>
        <?php endfor;?>
        <?php if(($curr_page + 3)  < $pages -1):?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $href.($curr_page + 4);?>">...</a>
        </li>
        <?php endif;?>
        <?php if(($curr_page + 3)  < $pages):?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $href.$pages;?>"><?=$pages?></a>
        </li>
        <?php endif;?>
        <!-- main page -->
        <!-- page btn -->
        <li class="page-item <?php if($curr_page == $pages) echo 'disabled';?>">
            <a class="page-link" href="<?=$href.($curr_page+1)?>">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <!-- page btn -->
    </ul>
</nav>