<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Home page';
?>

<?php $form = ActiveForm::begin([
	'method' => 'post',
    'action' => ['site/form'],
    'fieldConfig' => [
	        'template' => "<div class=\"col-xs-3\">{label}</div>\n<div class=\"col-xs-9\">{input}</div>\n<div class=\"col-xs-9 col-xs-offset-3\">{error}</div>",
	        'labelOptions' => ['class' => ''],
	    ],
    ]); ?>

	<div class="row">
	    <div class="col-xs-6">
	    	<?= $form->field($model, 'items')->textInput(['value' => '20']) ?>
	    </div>
		<div class="col-xs-6">
		    <div class="form-group">
		        <?= Html::submitButton('Генерировать дерево', ['class' => 'btn btn-primary']) ?>
		    </div>
		</div>
	</div>
<?php ActiveForm::end(); ?>

<div class="tree_area">
	<?php
	echo \wbraganca\fancytree\FancytreeWidget::widget([
		'options' =>[
			'source' => $data,
		]
	]);
	?>
</div>