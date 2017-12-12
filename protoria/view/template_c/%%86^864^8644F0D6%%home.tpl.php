<?php /* Smarty version 2.6.30, created on 2017-12-12 16:24:25
         compiled from home.tpl */ ?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $this->_tpl_vars['title']; ?>
</title>
		<link href="view/images/favicon.png" rel="icon">
		<link rel="stylesheet" href="view/css/stylesheet.css">
		<script src="view/js/common.js"></script>
	</head>
	<body>
		<div class="container">
			<h1><?php echo $this->_tpl_vars['title']; ?>
</h1>

			<form action="index.php" method="post" onsubmit="validate(this);return false;">
				<?php if (isset ( $this->_tpl_vars['success'] )): ?><span class="success"><?php echo $this->_tpl_vars['success']; ?>
</span><?php endif; ?>

				<label for="name_input">User Name:</label>
				<input id="name_input" type="text" name="name" placeholder="user name..." value="<?php if (isset ( $this->_tpl_vars['form']['name'] )): ?><?php echo $this->_tpl_vars['form']['name']; ?>
<?php endif; ?>" required>
				<span class="error error_name"><?php if (isset ( $this->_tpl_vars['error']['name'] )): ?><?php echo $this->_tpl_vars['error']['name']; ?>
<?php endif; ?></span>

				<label for="email_input">E-mail:</label>
				<input id="email_input" type="email" name="email" placeholder="email..." value="<?php if (isset ( $this->_tpl_vars['form']['email'] )): ?><?php echo $this->_tpl_vars['form']['email']; ?>
<?php endif; ?>" required>
				<span class="error error_email"><?php if (isset ( $this->_tpl_vars['error']['email'] )): ?><?php echo $this->_tpl_vars['error']['email']; ?>
<?php endif; ?></span>

				<label for="url_input">Homepage:</label>
				<input id="url_input" type="text" name="url" placeholder="homepage..." value="<?php if (isset ( $this->_tpl_vars['form']['url'] )): ?><?php echo $this->_tpl_vars['form']['url']; ?>
<?php endif; ?>">

				<label for="text_input">Homepage:</label>
				<textarea id="text_input" name="text" cols="30" rows="10" placeholder="text..." required><?php if (isset ( $this->_tpl_vars['form']['text'] )): ?><?php echo $this->_tpl_vars['form']['text']; ?>
<?php endif; ?></textarea>
				<span class="error error_text"><?php if (isset ( $this->_tpl_vars['error']['text'] )): ?><?php echo $this->_tpl_vars['error']['text']; ?>
<?php endif; ?></span>

				<label for="captcha_input">Captcha:</label>
				<div class="captcha_block">
					<input id="captcha_input" type="text" name="captcha" placeholder="captcha..." required>
					<img src="index.php?captcha=generate">
				</div>
				<span class="error error_captcha"><?php if (isset ( $this->_tpl_vars['error']['captcha'] )): ?><?php echo $this->_tpl_vars['error']['captcha']; ?>
<?php endif; ?></span>
				
				<button type="submit">Submit</button>
			</form>
			
			<a href="index.php?report=1" target="_blank" class="dld_btn">Download report</a>

			<table>
				<tr>
					<th><a href="<?php echo $this->_tpl_vars['sorts']['name']['href']; ?>
">User Name<?php if ($this->_tpl_vars['sorts']['name']['active'] == '1'): ?> <?php echo $this->_tpl_vars['sorts']['name']['symbol']; ?>
<?php endif; ?></a></th>

					<th><a href="<?php echo $this->_tpl_vars['sorts']['email']['href']; ?>
">E-mail<?php if ($this->_tpl_vars['sorts']['email']['active'] == '1'): ?> <?php echo $this->_tpl_vars['sorts']['email']['symbol']; ?>
<?php endif; ?></a></th>

					<th>Homepage</th>

					<th>Text</th>

					<th><a href="<?php echo $this->_tpl_vars['sorts']['date']['href']; ?>
">Date<?php if ($this->_tpl_vars['sorts']['date']['active'] == '1'): ?> <?php echo $this->_tpl_vars['sorts']['date']['symbol']; ?>
<?php endif; ?></a></th>
				</tr>

				<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['comment']):
?>
					<tr>
						<td class="name"><?php echo $this->_tpl_vars['comment']['name']; ?>
</td>
						<td class="email"><a href="mailto:<?php echo $this->_tpl_vars['comment']['email']; ?>
"><?php echo $this->_tpl_vars['comment']['email']; ?>
</a></td>
						<td class="url"><a href="<?php echo $this->_tpl_vars['comment']['url']; ?>
" target="_black" title="<?php echo $this->_tpl_vars['comment']['url']; ?>
"><?php echo $this->_tpl_vars['comment']['url']; ?>
</a></td>
						<td class="text"><?php echo $this->_tpl_vars['comment']['text']; ?>
</td>
						<td class="date"><?php echo $this->_tpl_vars['comment']['date']; ?>
</td>
					</tr>
				<?php endforeach; else: ?>
					<tr>
						<td colspan="5">Ничего не найдено</td>
					</tr>
				<?php endif; unset($_from); ?>
			</table>

			<?php echo $this->_tpl_vars['pagination']; ?>

		</div>
	</body>
</html>