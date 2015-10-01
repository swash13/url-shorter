<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Url Shorter - Главная';
?>

<?php
$form = ActiveForm::begin([
    'action' => Url::toRoute('site/url-create'),
    'method' => 'post'
]);

echo $form->field($formUrlCreate, 'url')->textInput();

?>

<button type="submit" class="btn">Уменьшить</button>

<?php ActiveForm::end(); ?>
