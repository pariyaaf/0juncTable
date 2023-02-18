<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h2>UPDATE</h2>
<?php
$form = ActiveForm::begin([]);
?>
<?= $form->field($car, 'name') ?>

<div class="form-group">
    <?= Html::submitButton('update', ['class' => 'btn btn-danger border p-1 mx-auto']) ?>
</div>
<?php ActiveForm::end(); ?>