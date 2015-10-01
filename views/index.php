<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

use yii\widgets\ActiveField;

$this->title = 'Url Shorter - Главная';
?>

<?php
$form = ActiveForm::begin([
    'action' => Url::toRoute('site/url-create'),
    'method' => 'post'
]);

echo $form->field($formUrlCreate, 'url')->textInput();

?>

<div class="checkbox">
    <label for="setCustom">
        <input type="checkbox" id="setCustom" />
        Ввести вручную
    </label>
</div>

<?php

echo $form->field($formUrlCreate, 'short', ['options' => ['style' => 'display: none;']]);

echo $form->field($formUrlCreate, 'dieable')->checkbox();

?>

<button type="submit" class="btn">Уменьшить</button>

<?php ActiveForm::end(); ?>

<?php
$this->registerJs("
    $('#setCustom').change(function() {
        if ($(this).is(':checked')) {
            $('.field-formurlcreate-short').show();
        } else {
            $('.field-formurlcreate-short').hide();
        }
    });
");
?>
