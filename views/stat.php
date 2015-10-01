<?php

use yii\helpers\Url;

$this->title = 'Url Shorter - Результат';
?>

    <div class="row">
        <div class="col-sm-3"><strong>Оригинал : </strong></div>
        <div class="col-sm-6"><a href="<?= $url->origin ?>" target="_blank"><?= $url->origin ?></a></div>
    </div>

    <div class="row">
        <div class="col-sm-3"><strong>Короткий URL : </strong></div>
        <div class="col-sm-6"><a href="<?= Url::to(['site/url-redirect', 'url' => $url->short], true) ?>"  target="_blank"><?= Url::to(['site/url-redirect', 'url' => $url->short], true) ?></a></div>
    </div>

    <div class="row">
        <div class="col-sm-3"><strong>Дата создания</strong></div>
        <div class="col-sm-6"><?= $url->date_add ?></div>
    </div>

<?php if ($url->statExist) { ?>
    <h3>Переходы по странам</h3>

    <?php foreach ($url->countries as $country) { ?>
        <div class="row">
            <div class="col-sm-3"><strong><?= $country->country_name ?></strong></div>
            <div class="col-sm-6"><?= $country->counter ?></div>
        </div>
    <?php } ?>

    <h3>Переходы из браузеров</h3>

    <?php foreach ($url->browsers as $browser) { ?>
        <div class="row">
            <div class="col-sm-3"><strong><?= $browser->browser ?></strong></div>
            <div class="col-sm-6"><?= $browser->counter ?></div>
        </div>
    <?php } ?>
<?php } else { ?>
    <h3>По данной ссылке переходов не осуществлялось</h3>
<?php } ?>