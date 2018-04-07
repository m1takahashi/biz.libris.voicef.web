<h3>{$smarty.const.SERVICE_NAME_DISPLAY}管理画面</h3>

<h5>環境設定</h5>
<form action="/system/index/edit" method="post">
<table class="pure-table pure-table-bordered" style="font-size: x-small">
    <tbody>
        <tr>
            <td width="120">開発 or 運用</td>
            <td width="240">{if $smarty.const.APPLICATION_ENV == 'development'}
            	開発環境
            	{else if $smarty.const.APPLICATION_ENV == 'production'}
            	運用環境
            	{else}
            	<font color="#FF0000">環境設定を見直して下さい。</font>
            	{/if}　
        </tr>
        <tr>
            <td>基本 URL</td>
            <td>{$smarty.const.URL_BASE}</td>
        </tr>
        <tr>
            <td>現行ビルド番号</td>
            <td><input type="text" name="current_build" value="{$data.current_build}" size="10" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="編集" /></td>
        </tr>
    </tbody>
</table>