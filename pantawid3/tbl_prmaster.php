<?php
namespace PHPMaker2020\pantawid2020;
?>
<?php if ($tbl_pr->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tbl_prmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($tbl_pr->prID->Visible) { // prID ?>
		<tr id="r_prID">
			<td class="<?php echo $tbl_pr->TableLeftColumnClass ?>"><?php echo $tbl_pr->prID->caption() ?></td>
			<td <?php echo $tbl_pr->prID->cellAttributes() ?>>
<span id="el_tbl_pr_prID">
<span<?php echo $tbl_pr->prID->viewAttributes() ?>><?php echo $tbl_pr->prID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_pr->date_prep->Visible) { // date_prep ?>
		<tr id="r_date_prep">
			<td class="<?php echo $tbl_pr->TableLeftColumnClass ?>"><?php echo $tbl_pr->date_prep->caption() ?></td>
			<td <?php echo $tbl_pr->date_prep->cellAttributes() ?>>
<span id="el_tbl_pr_date_prep">
<span<?php echo $tbl_pr->date_prep->viewAttributes() ?>><?php echo $tbl_pr->date_prep->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_pr->pr_number->Visible) { // pr_number ?>
		<tr id="r_pr_number">
			<td class="<?php echo $tbl_pr->TableLeftColumnClass ?>"><?php echo $tbl_pr->pr_number->caption() ?></td>
			<td <?php echo $tbl_pr->pr_number->cellAttributes() ?>>
<span id="el_tbl_pr_pr_number">
<span<?php echo $tbl_pr->pr_number->viewAttributes() ?>><?php echo $tbl_pr->pr_number->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_pr->purpose->Visible) { // purpose ?>
		<tr id="r_purpose">
			<td class="<?php echo $tbl_pr->TableLeftColumnClass ?>"><?php echo $tbl_pr->purpose->caption() ?></td>
			<td <?php echo $tbl_pr->purpose->cellAttributes() ?>>
<span id="el_tbl_pr_purpose">
<span<?php echo $tbl_pr->purpose->viewAttributes() ?>><?php echo $tbl_pr->purpose->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_pr->pr_status->Visible) { // pr_status ?>
		<tr id="r_pr_status">
			<td class="<?php echo $tbl_pr->TableLeftColumnClass ?>"><?php echo $tbl_pr->pr_status->caption() ?></td>
			<td <?php echo $tbl_pr->pr_status->cellAttributes() ?>>
<span id="el_tbl_pr_pr_status">
<span<?php echo $tbl_pr->pr_status->viewAttributes() ?>><?php echo $tbl_pr->pr_status->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_pr->employeeid->Visible) { // employeeid ?>
		<tr id="r_employeeid">
			<td class="<?php echo $tbl_pr->TableLeftColumnClass ?>"><?php echo $tbl_pr->employeeid->caption() ?></td>
			<td <?php echo $tbl_pr->employeeid->cellAttributes() ?>>
<span id="el_tbl_pr_employeeid">
<span<?php echo $tbl_pr->employeeid->viewAttributes() ?>><?php echo $tbl_pr->employeeid->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>