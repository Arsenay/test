<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>{$title}</title>
		<link href="view/images/favicon.png" rel="icon">
		<link rel="stylesheet" href="view/css/stylesheet.css">
		<script src="view/js/common.js"></script>
	</head>
	<body>
		<div class="container">
			<h1>{$title}</h1>

			<form action="index.php" method="post" onsubmit="validate(this);return false;">
				{if isset($success)}<span class="success">{$success}</span>{/if}

				<label for="name_input">User Name:</label>
				<input id="name_input" type="text" name="name" placeholder="user name..." value="{if isset($form.name)}{$form.name}{/if}" required>
				<span class="error error_name">{if isset($error.name)}{$error.name}{/if}</span>

				<label for="email_input">E-mail:</label>
				<input id="email_input" type="email" name="email" placeholder="email..." value="{if isset($form.email)}{$form.email}{/if}" required>
				<span class="error error_email">{if isset($error.email)}{$error.email}{/if}</span>

				<label for="url_input">Homepage:</label>
				<input id="url_input" type="text" name="url" placeholder="homepage..." value="{if isset($form.url)}{$form.url}{/if}">

				<label for="text_input">Homepage:</label>
				<textarea id="text_input" name="text" cols="30" rows="10" placeholder="text..." required>{if isset($form.text)}{$form.text}{/if}</textarea>
				<span class="error error_text">{if isset($error.text)}{$error.text}{/if}</span>

				<label for="captcha_input">Captcha:</label>
				<div class="captcha_block">
					<input id="captcha_input" type="text" name="captcha" placeholder="captcha..." required>
					<img src="index.php?captcha=generate">
				</div>
				<span class="error error_captcha">{if isset($error.captcha)}{$error.captcha}{/if}</span>
				
				<button type="submit">Submit</button>
			</form>
			
			<a href="index.php?report=1" target="_blank" class="dld_btn">Download report</a>

			<table>
				<tr>
					<th><a href="{$sorts.name.href}">User Name{if $sorts.name.active eq '1'} {$sorts.name.symbol}{/if}</a></th>

					<th><a href="{$sorts.email.href}">E-mail{if $sorts.email.active eq '1'} {$sorts.email.symbol}{/if}</a></th>

					<th>Homepage</th>

					<th>Text</th>

					<th><a href="{$sorts.date.href}">Date{if $sorts.date.active eq '1'} {$sorts.date.symbol}{/if}</a></th>
				</tr>

				{foreach from=$comments key=k item=comment}
					<tr>
						<td class="name">{$comment.name}</td>
						<td class="email"><a href="mailto:{$comment.email}">{$comment.email}</a></td>
						<td class="url"><a href="{$comment.url}" target="_black" title="{$comment.url}">{$comment.url}</a></td>
						<td class="text">{$comment.text}</td>
						<td class="date">{$comment.date}</td>
					</tr>
				{foreachelse}
					<tr>
						<td colspan="5">Ничего не найдено</td>
					</tr>
				{/foreach}
			</table>

			{$pagination}
		</div>
	</body>
</html>