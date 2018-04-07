<h5>サイト&nbsp;-&nbsp;編集</h5>
<form action="/system/site/edit" method="post">
<input type="hidden" name="id" value="{$data.id}" />
<table class="pure-table pure-table-bordered"  style="font-size: x-small;" >
    <tbody>
    	{include file="./_form.tpl"}
    	<tr>
            <td colspan="2" align="center"><input type="submit" value="編集" /></td>
        </tr>
    </tbody>          	
</table>
</form>