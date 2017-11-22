<?php

/* @var $this yii\web\View */

$this->title = 'Тест';
?>

<script> var form_href = '<?php echo $form_href; ?>'; </script>

<?php function renderTree($categories){ ?>
	<ul>
		<?php foreach ($categories as $category) { ?>
			<li>
				<a href="#modal"><?= $category['name']; ?></a>
				<?php if(isset($category['child'])){ renderTree($category['child']); } ?>
			</li>
		<?php } ?>
	</ul>
<?php } renderTree($categories); ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>