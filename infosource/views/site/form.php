<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php if( isset($giphy) && $giphy ) { ?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Recaptcha success</h4>
	</div>

	<div class="modal-body">
		<img src="<?= $giphy; ?>" alt="giphy" style="max-width: 100%;"/>
	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
	</div>
<?php } else { ?>
	<?php $f = ActiveForm::begin(['id' => 'myForm']); ?>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Recaptcha</h4>
		</div>

		<div class="modal-body">
			<?= \himiklab\yii2\recaptcha\ReCaptcha::widget(['name' => 'reCaptcha']) ?>
			<script type="text/javascript">
				elem = modal.find('.g-recaptcha');

				$(elem).attr('id', 'modal-recaptcha');

				widget_id = grecaptcha.render('modal-recaptcha',{
					'sitekey':	$(elem).data('sitekey')
				});
			</script>
		</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>			<?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
		</div>
	<?php ActiveForm::end(); ?>
<?php } ?>