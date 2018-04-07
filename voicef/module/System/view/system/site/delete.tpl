<h5>サイト&nbsp;-&nbsp;削除</h5>
<form action="/system/site/delete" method="post">
<input type="hidden" name="id" value="{$data.id}" />
<input type="hidden" name="category_id" value="{$data.category_id}" />
<p style="color: #FF0000; font-size: x-small">本当に削除しますか？<br />
<input type="submit" value="削除" />
</p>
</form>