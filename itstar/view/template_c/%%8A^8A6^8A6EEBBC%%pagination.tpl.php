<?php /* Smarty version 2.6.30, created on 2017-05-28 17:19:51
         compiled from pagination.tpl */ ?>
<div class="pagination_block">
	<div class="links">
		<?php if ($this->_tpl_vars['links']): ?>
			<ul class="pagination">
				<?php $_from = $this->_tpl_vars['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['link']):
?>
					<li class="<?php echo $this->_tpl_vars['link']['class']; ?>
"><a href="<?php echo $this->_tpl_vars['link']['href']; ?>
" title="<?php echo $this->_tpl_vars['link']['title']; ?>
"><?php echo $this->_tpl_vars['link']['name']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		<?php endif; ?>
	</div>

	<span class="pagination-info">Showing <?php echo $this->_tpl_vars['start']; ?>
 to <?php echo $this->_tpl_vars['end']; ?>
 of <?php echo $this->_tpl_vars['total']; ?>
 (<?php echo $this->_tpl_vars['pages']; ?>
 Pages)</span>
</div>