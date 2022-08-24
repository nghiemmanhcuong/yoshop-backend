$(document).ready(function () {
    if ($('.multiple-select')) {
        $('.multiple-select').selectpicker();
    }

    $('.alert > i').click(function () {
        $('.alert').hide();
    });
});
