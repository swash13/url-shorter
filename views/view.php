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
    <div class="col-sm-3"><strong>Статистика : </strong></div>
    <div class="col-sm-6"><a href="<?= Url::to(['site/stat', 'url' => $url->short], true) ?>" ><?= Url::to(['site/stat', 'url' => $url->short], true) ?></a></div>
</div>

<div class="row">
    <div class="col-sm-3"><strong>Дата создания</strong></div>
    <div class="col-sm-6"><?= $url->date_add ?></div>
</div>

