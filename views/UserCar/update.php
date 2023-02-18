<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; // load classes
use kartik\select2\Select2;

?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'user_id')->widget(Select2::className(), [
'data' => $Useritems,
'options' => ['placeholder' => 'Select a state ...'],
'pluginOptions' => [
'allowClear' => true
],
]);?>


 <?= $form->field($model, 'car_id')->widget(Select2::className(), [
'data' => $Caritems,
'options' => ['placeholder' => 'Select a state ...'],
'pluginOptions' => [
'allowClear' => true
],
]);?>




<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary border p-1 mx-auto mt-3']) ?>
</div>
<?php ActiveForm::end(); ?>

