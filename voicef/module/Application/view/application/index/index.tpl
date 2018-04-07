<div class="pure-menu pure-menu-open pure-menu-horizontal">
    <ul>
        <li><a href="/?category_id=5">エンタメ</a></li>
        <li><a href="/?category_id=2">スポーツ</a></li>
        <li><a href="/?category_id=8">まとめ</a></li>
        <li><a href="/?category_id=6">コラム</a></li>
        <li><a href="/?category_id=4">テクノロジー</a></li>
        <li><a href="/?category_id=3">経済</a></li>
        <li><a href="/?category_id=9">国際</a></li>
    </ul>
</div>

<table class="pure-table pure-table-horizontal" style="font-size: x-small">
    <tbody>
    	{section name=i loop=$list}
        <tr>
        	{if $list[i].image_url}
            <td width="250">
            	<a href="{$list[i].link}">{$list[i].title}</a>
            	<div align="right">
            		<a href="{$list[i].channel_blog_url}">{$list[i].channel_title}</a>
            	</div>
            </td>
            <td width="70">{if $list[i].image_url}
            	<img src="{$smarty.const.URL_IMAGE_PROXY_FULL}{$list[i].image_url}" border="0" width="70" height="70">
            	{/if}
            </td>
        	{else}
            <td width="320" colspan="2">
            	<a href="{$list[i].link}">{$list[i].title}</a>
            	<div align="right">
            		<a href="{$list[i].channel_blog_url}">{$list[i].channel_title}</a>
            	</div>
            </td>
        	{/if}
        </tr>
        {/section}
        <tr>
        	<td colspan="2" align="center">
        		<p style="font-size: x-small">
				<a href="/?category_id={$categoryId}&p={$page.prev}">Prev</a>
				&nbsp; - {$page.current} - &nbsp;
				<a href="/?category_id={$categoryId}&p={$page.next}">Next</a>
				</p>
        	</td>
		</tr>        
    </tbody>
</table>
<br />
