<?php
/**
 * @link http://www.writesdown.com/
 * @author Agiel K. Saputra <13nightevil@gmail.com>
 * @copyright Copyright (c) 2015 WritesDown
 * @license http://www.writesdown.com/license/
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model common\models\Term */
/* @var $taxonomy common\models\Taxonomy */
?>

<div class="term-form">
    <?php $form = ActiveForm::begin(['id' => 'term-form']) ?>

    <?= $form->field($model, 'name')->textInput([
        'maxlength' => 200,
        'placeholder' => $model->getAttributeLabel('name'),
    ])->hint(Yii::t('writesdown', 'The name is how it appears on your site.')) ?>

    <?= $form->field($model, 'slug')->textInput([
        'maxlength' => 200,
        'placeholder' => $model->getAttributeLabel('slug'),
    ])->hint(Yii::t('writesdown',
        'The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.')) ?>

    <?= $form->field($model, 'description')->textarea([
        'rows' => 6,
        'placeholder' => $model->getAttributeLabel('description'),
    ]) ?>

    <?php if ($taxonomy->hierarchical): ?>
        <?= $form->field($model, 'parent')->dropDownList(
            ArrayHelper::map($taxonomy->terms, 'id', 'name'),
            ['prompt' => '']
        )->hint(Yii::t(
            'writesdown',
            'Taxonomy hierarchical can have a hierarchy that have children, something like Parent Term and Child Term. This is optional.')
        ) ?>
    <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('writesdown', 'Save') : Yii::t('writesdown', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-flat btn-success' : 'btn btn-flat btn-primary']
        ) ?>

    </div>
    <?php ActiveForm::end() ?>

</div>
