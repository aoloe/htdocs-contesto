<table class="prices">
<colgroup>
    <col width="200" />
    <col width="400" />
</colgroup>
<tbody>
<?php foreach (array_slice($table, 0, sizeof($table) - 1) as $item) : ?>
<tr>
<td><?= $item[0] ?></td>
<td><?= $item[1] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr>
<td colspan="2"><em><?= $table[sizeof($table) - 1][0] ?></em></td>
</tr>
</tfoot>
</table>
