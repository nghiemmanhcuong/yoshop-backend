    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js">
    </script>
    <script src="../config/ckeditor/ckeditor.js"></script>
    <script>
        if (document.querySelector('textarea[name=description]')) {
            CKEDITOR.replace('description',{
                extraPlugins: 'filebrowser',
                filebrowserBrowseUrl:'<?=WEB_ROOT?>/config/browser.php',
                filebrowserUploadMethod:'form',
                filebrowserUploadUrl:'<?=WEB_ROOT?>/config/upload.php'
            });
        }

        if (document.querySelector('textarea[name=content]')) {
            CKEDITOR.replace('content',{
                extraPlugins: 'filebrowser',
                filebrowserBrowseUrl:'<?=WEB_ROOT?>/config/browser.php',
                filebrowserUploadMethod:'form',
                filebrowserUploadUrl:'<?=WEB_ROOT?>/config/upload.php'
            });
        }

        let isDelete = false;
        const formDeleteAll = document.getElementById('form-delete-all');
        const submitFormDeleteAll = document.getElementById('submit-form-delete-all');
        const checkedBtn = document.getElementById('checked-all-btn');
        const uncheckedBtn = document.getElementById('unchecked-all-btn');
        const selectInput = document.querySelectorAll('input[type=checkbox]');

        if (formDeleteAll && checkedBtn && uncheckedBtn && selectInput) {
            checkedBtn.onclick = () => {
                selectInput.forEach(input => {
                    input.checked = true;
                })
            }

            uncheckedBtn.onclick = () => {
                selectInput.forEach(input => {
                    input.checked = false;
                })
            }
        }

        if(submitFormDeleteAll){
            submitFormDeleteAll.onclick = () => {
                if(confirm('Bạn chắc chắn muốn xoá tất cả cột đã chọn???')){
                    isDelete = true;
                    console.log(isDelete)
                }

                if(!isDelete){
                    formDeleteAll.onsubmit = (e) => {
                        e.preventDefault();
                    }
                }else {
                    formDeleteAll.submit();
                }
            }
        }
    </script>
    <script src="<?=WEB_ROOT?>/public/js/main.js"></script>
    </body>

    </html>