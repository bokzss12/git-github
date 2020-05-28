<?php
namespace PHPMaker2020\pantawid2020;
?>
<?php if ($tbl_inventory->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tbl_inventorymaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($tbl_inventory->concat_inventory->Visible) { // concat_inventory ?>
		<tr id="r_concat_inventory">
			<td class="<?php echo $tbl_inventory->TableLeftColumnClass ?>"><?php echo $tbl_inventory->concat_inventory->caption() ?></td>
			<td <?php echo $tbl_inventory->concat_inventory->cellAttributes() ?>>
<span id="el_tbl_inventory_concat_inventory">
<span<?php echo $tbl_inventory->concat_inventory->viewAttributes() ?>><?php if (!EmptyString($tbl_inventory->concat_inventory->getViewValue()) && $tbl_inventory->concat_inventory->linkAttributes() != "") { ?>
<a<?php echo $tbl_inventory->concat_inventory->linkAttributes() ?>><?php echo $tbl_inventory->concat_inventory->getViewValue() ?></a>
<?php } else { ?>
<?php echo $tbl_inventory->concat_inventory->getViewValue() ?>
<?php } ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_inventory->item_model->Visible) { // item_model ?>
		<tr id="r_item_model">
			<td class="<?php echo $tbl_inventory->TableLeftColumnClass ?>"><?php echo $tbl_inventory->item_model->caption() ?></td>
			<td <?php echo $tbl_inventory->item_model->cellAttributes() ?>>
<span id="el_tbl_inventory_item_model">
<span<?php echo $tbl_inventory->item_model->viewAttributes() ?>><?php echo $tbl_inventory->item_model->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_inventory->item_serial->Visible) { // item_serial ?>
		<tr id="r_item_serial">
			<td class="<?php echo $tbl_inventory->TableLeftColumnClass ?>"><?php echo $tbl_inventory->item_serial->caption() ?></td>
			<td <?php echo $tbl_inventory->item_serial->cellAttributes() ?>>
<span id="el_tbl_inventory_item_serial">
<span<?php echo $tbl_inventory->item_serial->viewAttributes() ?>><?php echo $tbl_inventory->item_serial->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_inventory->office_id->Visible) { // office_id ?>
		<tr id="r_office_id">
			<td class="<?php echo $tbl_inventory->TableLeftColumnClass ?>"><?php echo $tbl_inventory->office_id->caption() ?></td>
			<td <?php echo $tbl_inventory->office_id->cellAttributes() ?>>
<span id="el_tbl_inventory_office_id">
<span<?php echo $tbl_inventory->office_id->viewAttributes() ?>><?php echo $tbl_inventory->office_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_inventory->name_accountable->Visible) { // name_accountable ?>
		<tr id="r_name_accountable">
			<td class="<?php echo $tbl_inventory->TableLeftColumnClass ?>"><?php echo $tbl_inventory->name_accountable->caption() ?></td>
			<td <?php echo $tbl_inventory->name_accountable->cellAttributes() ?>>
<span id="el_tbl_inventory_name_accountable">
<span<?php echo $tbl_inventory->name_accountable->viewAttributes() ?>><?php echo $tbl_inventory->name_accountable->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_inventory->Designation->Visible) { // Designation ?>
		<tr id="r_Designation">
			<td class="<?php echo $tbl_inventory->TableLeftColumnClass ?>"><?php echo $tbl_inventory->Designation->caption() ?></td>
			<td <?php echo $tbl_inventory->Designation->cellAttributes() ?>>
<span id="el_tbl_inventory_Designation">
<span<?php echo $tbl_inventory->Designation->viewAttributes() ?>><?php echo $tbl_inventory->Designation->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_inventory->status->Visible) { // status ?>
		<tr id="r_status">
			<td class="<?php echo $tbl_inventory->TableLeftColumnClass ?>"><?php echo $tbl_inventory->status->caption() ?></td>
			<td <?php echo $tbl_inventory->status->cellAttributes() ?>>
<span id="el_tbl_inventory_status">
<span<?php echo $tbl_inventory->status->viewAttributes() ?>><?php echo $tbl_inventory->status->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>