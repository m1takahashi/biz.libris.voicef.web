<h5>{$categoryData.name}&nbsp;-&nbsp;<a href="/system/site/add?category_id={$categoryData.category_id}">追加</a></h5>
<table class="pure-table pure-table-bordered" style="font-size: x-small">
    <thead>
        <tr>
            <th width="40">ID</th>
            <th width="80">カテゴリID</th>
            <th width="120">タイトル</th>
            <th width="200">URL</th>
            <th width="80">表示タイプ</th>
            <th width="80">エラー回数</th>
            <th width="80">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    	{section name=i loop=$list}
        <tr>
            <td>{$list[i].id}</td>
            <td>{$list[i].category_id}</td>
            <td>{$list[i].title}</td>
            <td>{$list[i].blog_url}<br />
            	{$list[i].rss_url}
            </td>
            <td>{$list[i].disp_type_str}</td>
            <td>{$list[i].error_count}</td>
            <td><a href="/system/site/edit?id={$list[i].id}">編集</a></td>
        </tr>
        {/section}
    </tbody>
</table>
<p style="color: #FF0000; font-size: x-small">
	※1.削除不可、表示したくない場合には、[表示タイプ]を『非表示』に設定して下さい。<br />
	※2.カテゴリの変更をすると、取得ずみの記事とずれることがあります。
</p>