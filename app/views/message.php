<!--<div class="alert --><?php //echo $status; ?><!--">-->
<!--    --><?php //echo $text; ?>
<!--</div>-->

<?php
if ($status == 'signSuccess') {
    ?>
    <div class="alert alert-success mt-3">
        Ваша подпись учтена.
    </div>
    <?php
}
if ($status == 'signExists') {
    ?>
    <div class="alert alert-warning mt-3">
        Вы уже голосовали.
    </div>
    <?php
}
if ($status == 'addSuccess'){
    ?>
    <div class="alert alert-success">
        На почту отправлено письмо для подтверждения...
    </div>
    <?php
}