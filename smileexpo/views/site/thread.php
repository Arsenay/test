<?php
/* @var $this yii\web\View */

$this->title = 'Thread page';
?>
<div class="tree_area_full">
	<?php
	echo \wbraganca\fancytree\FancytreeWidget::widget([
		'options' =>[
			'source' => $data,
		]
	]);
	?>
</div>