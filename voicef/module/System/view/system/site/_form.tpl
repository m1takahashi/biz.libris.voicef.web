{if $data.id}
<tr>
    <td>ID</td>
    <td>{$data.id}</td>
</tr>
{/if}
<tr>
    <td width="180">カテゴリーID</td>
    <td width="300">{html_options name=category_id options=$categoryMenu selected=$data.category_id}</td>
</tr>
<tr>
    <td>タイトル</td>
    <td><input type="text" name="title" value="{$data.title}" size="40" /></td>
</tr>
<tr>
    <td>ブログ URL</td>
    <td><input type="text" name="blog_url" value="{$data.blog_url}" size="40" /></td>
</tr>
<tr>
    <td>RSS URL</td>
    <td><input type="text" name="rss_url" value="{$data.rss_url}" size="40" /></td>
</tr>
<tr>
    <td>表示タイプ</td>
    <td>{html_options name=disp_type options=$siteDispTypeList selected=$data.disp_type}</td>
</tr>