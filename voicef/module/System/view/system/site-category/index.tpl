<h5>カテゴリ</h5>
<table class="pure-table pure-table-bordered" style="font-size: x-small">
    <thead>
        <tr>
            <th width="40">ID</th>
            <th width="80">名前</th>
            <th width="80">サイト数</th>
            <th width="120">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    	{section name=i loop=$list}
        <tr>
            <td>{$list[i].category_id}</td>
            <td>{$list[i].name}</td>
            <td>{$list[i].site_count|default:'0'}</td>
            <td><a href="/system/site/index?category_id={$list[i].category_id}">サイト管理</a></td>
        </tr>
        {/section}
    </tbody>
</table>
<p style="color: #FF0000; font-size: x-small">※管理画面では、カテゴリの編集は行えません。</p>
