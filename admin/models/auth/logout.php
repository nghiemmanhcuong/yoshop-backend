<?php
if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    redirect(WEB_ROOT);
}