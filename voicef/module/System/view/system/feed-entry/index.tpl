<h5>記事表示&nbsp;-&nbsp;{if $type == 'new'}新着{elseif $type == 'daily'}今日の人気{elseif $type == 'weekly'}今週の人気{elseif $type == 'monthly'}今月の人気{/if}</h5>

<br />
<p style="font-size: x-small">
<a href="/system/feed-entry/index?type={$type}&p={$page.prev}">Prev</a>
&nbsp; - {$page.current} - &nbsp;
<a href="/system/feed-entry/index?type={$type}&p={$page.next}">Next</a>
</p>
<table class="pure-table pure-table-bordered" style="font-size: x-small">
    <thead>
        <tr>
            <th width="40">ID</th>
            <th width="200">タイトル</th>
            <th width="160">サイト名</th>
            <th width="80">画像</th>
            <th width="40">Twitter</th>
            <th width="40">Facebook</th>
            <th width="40">Hatena</th>
            <th width="120">日時</th>
        </tr>
    </thead>
    <tbody>
    	{section name=i loop=$list}
        <tr>
            <td>{$list[i].id}</td>
            <td><a href="{$list[i].link}" target="_blank">{$list[i].title}</a></td>
            <td><a href="{$list[i].site_blog_url}" target="_blank">{$list[i].site_title}</a></td>
            <td>{if $list[i].image_url}
            	<img src="{$smarty.const.URL_IMAGE_PROXY_FULL}{$list[i].image_url}" border="0"><br />
            	<a href="{$list[i].image_url}" target="_blank">{$list[i].image_url|truncate:40}</a>
            	{/if}
            </td>
            <td>{$list[i].tw_count}</td>
            <td>{$list[i].fb_shares}</td>
            <td>{$list[i].hatena_count}</td>
            <td>{$list[i].date_modified|date_format:"Y-m-d H:i:s"}</td>
        </tr>
        {/section}
    </tbody>
</table>
