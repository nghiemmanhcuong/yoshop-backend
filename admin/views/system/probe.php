<div class="container mt-3">
    <h4 class="text-center text-uppercase">Sửa thăm dò của bạn</h4>
    <form class="form-add" method="post" style="width:60%;">
        <?php if(isset($_GET['msg'])):?>
        <div class="alert alert-success small position-relative">
            <?=$_GET['msg']?>
            <a href="<?=WEB_ROOT.'/system/probe'?>" class="position-absolute" style="top:0px;right:5px;">
                <i class="bi bi-x-circle-fill"></i>
            </a>
        </div>
        <?php endif;?>
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label class="form-label">Ngày bắt đầu</label>
                    <input type="date" name="start_day" class="form-control"
                        value="<?=$poll['start_day'] ?? $poll['start_day']?>">
                    <?php if(isset($errors["start_day"])):?>
                    <div class="form-error"><?=$errors["start_day"]?></div>
                    <?php endif;?>
                </div>
                <div class="col-6 row">
                    <div class="col-6">
                        <label class="form-label">Giờ bắt đầu</label>
                        <select name="start_hours" class="form-select">
                            <?php foreach ($hours as $item):?>
                            <option <?=$poll['start_hours'] == $item ? 'selected' : ''?> value="<?=$item?>"><?=$item?>
                            </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Phút bắt đầu</label>
                        <select name="start_minute" class="form-select">
                            <?php foreach ($minutes as $item):?>
                            <option <?=$poll['start_minute'] == $item ? 'selected' : ''?> value="<?=$item?>"><?=$item?>
                            </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label class="form-label">Ngày kết thúc</label>
                    <input type="date" name="end_day" class="form-control"
                        value="<?=$poll['end_day'] ?? $poll['end_day']?>">
                    <?php if(isset($errors["end_day"])):?>
                    <div class="form-error"><?=$errors["end_day"]?></div>
                    <?php endif;?>
                </div>
                <div class="col-6 row">
                    <div class="col-6">
                        <label class="form-label">Giờ kết thúc</label>
                        <select name="end_hours" class="form-select">
                            <?php foreach ($hours as $item):?>
                            <option <?=$poll['end_hours'] == $item ? 'selected' : ''?> value="<?=$item?>"><?=$item?>
                            </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Phút kết thúc</label>
                        <select name="end_minute" class="form-select">
                            <?php foreach ($minutes as $item):?>
                            <option <?=$poll['end_minute'] == $item ? 'selected' : ''?> value="<?=$item?>"
                                value="<?=$item?>"><?=$item?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung thăm dò</label>
            <textarea name="content_poll" cols="30" rows="2"
                class="form-control"><?=$poll['content'] ?? $poll['content']?></textarea>
            <?php if(isset($errors["content_poll"])):?>
            <div class="form-error"><?=$errors["content_poll"]?></div>
            <?php endif;?>
        </div>
        <div class="mb-3 col-12 d-flex align-items-end">
            <div class="me-2" style="width:50%;">
                <label class="form-label">Câu trả lời 1</label>
                <input type="text" name="answer_one" class="form-control"
                    value="<?=$poll['answer_one'] ?? $poll['answer_one']?>">
                <?php if(isset($errors["answer_one"])):?>
                <div class="form-error"><?=$errors["answer_one"]?></div>
                <?php endif;?>
            </div>
            <div class="answer-range" style="width:50%;">
                <div class="answer-range-one" style="width:<?=$percentage_answer_one?>%;">
                </div>
                <span><?=$percentage_answer_one?>%</span>
            </div>
        </div>
        <div class="mb-3 col-12 d-flex align-items-end">
            <div class="me-2" style="width:50%;">
                <label class="form-label">Câu trả lời 2</label>
                <input type="text" name="answer_two" class="form-control"
                    value="<?=$poll['answer_two'] ?? $poll['answer_two']?>">
                <?php if(isset($errors["answer_two"])):?>
                <div class="form-error"><?=$errors["answer_two"]?></div>
                <?php endif;?>
            </div>
            <div class="answer-range" style="width:50%;">
                <div class="answer-range-two" style="width:<?=$percentage_answer_two?>%;">
                </div>
                <span><?=$percentage_answer_two?>%</span>
            </div>
        </div>
        <div class="mb-3 col-12 d-flex align-items-end">
            <div class="me-2" style="width:50%;">
                <label class="form-label">Câu trả lời 3</label>
                <input type="text" name="answer_three" class="form-control"
                    value="<?=$poll['answer_three'] ?? $poll['answer_three']?>">
                <?php if(isset($errors["answer_three"])):?>
                <div class="form-error"><?=$errors["answer_three"]?></div>
                <?php endif;?>
            </div>
            <div class="answer-range" style="width:50%;">
                <div class="answer-range-three" style="width:<?=$percentage_answer_three?>%;">
                </div>
                <span><?=$percentage_answer_three?>%</span>
            </div>
        </div>
        <div class="mb-3 col-12 d-flex align-items-end">
            <div class="me-2" style="width:50%;">
                <label class="form-label">Câu trả lời 3</label>
                <input type="text" name="answer_four" class="form-control"
                    value="<?=$poll['answer_four'] ?? $poll['answer_four']?>">
                <?php if(isset($errors["answer_four"])):?>
                <div class="form-error"><?=$errors["answer_four"]?></div>
                <?php endif;?>
            </div>
            <div class="answer-range" style="width:50%;">
                <div class="answer-range-four" style="width:<?=$percentage_answer_four?>%;">
                </div>
                <span><?=$percentage_answer_four?>%</span>
            </div>
        </div>
        <div class="mb-3 d-flex align-items-center">
            <label class="form-label me-2" style="margin-bottom:0;">Reset lại điểm voted</label>
            <input type="checkbox" class="form-check-input" name="reset_voted_points" style="margin-top:0;">
        </div>
        <?php if(checkManagers('systems',$_SESSION['user']['managers'])):?>
        <div class="form-button">
            <button class="btn btn-primary">Lưu chỉnh sửa</button>
        </div>
        <?php endif;?>
    </form>
</div>