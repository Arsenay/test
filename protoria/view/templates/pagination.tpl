<div class="pagination_block">
	<div class="links">
		{if $links}
			<ul class="pagination">
				{foreach from=$links key=k item=link}
					<li class="{$link.class}"><a href="{$link.href}" title="{$link.title}">{$link.name}</a></li>
				{/foreach}
			</ul>
		{/if}
	</div>

	<span class="pagination-info">Showing {$start} to {$end} of {$total} ({$pages} Pages)</span>
</div>