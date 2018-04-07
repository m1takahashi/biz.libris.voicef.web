<div class="content-subhead">
    <h4>ログ</h4>
</div>
<form action="/system/log/index" method="post">
	{html_options name=priority options=$priorityList selected=$priority}
	<input type="submit" value="変更" />
</form>

<table class="pure-table pure-table-bordered"  style="font-size: x-small;" >
    <thead>
        <tr>
            <th width="80">ID</th>
            <th width="80">Priority</th>
            <th width="80">Priority Name</th>
            <th width="300">Message</th>
            <th width="120">SubmitDate</th>
        </tr>
    </thead>
    <tbody>
    	{section name=i loop=$list}
        <tr>
            <td>{$list[i].id}</td>
            <td>{$list[i].priority}</td>
            <td>{$list[i].priorityName}</td>
            <td>{$list[i].message}</td>
            <td>{$list[i].submit_date}</td>
        </tr>
        {/section}
    </tbody>
</table>