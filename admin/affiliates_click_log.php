<?php


$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
if (!$_POST["hdn_page"]) $_POST["hdn_page"] = 1;
if (!$_GET['filter']) $_GET['filter'] = "all";

//var_dump($_POST);

if($_GET['id_provider']<>''){
	$A_FILTERS[] = array('providerid','=',$_GET['id_provider']);
}else $A_FILTERS = array();


$header_helper = new header_helper();
include('header.php');
?>
<div class="contentCenter">	
	<div class="contentCenterTitle">
	  <h1>
		<div class="Orange">THE</div>
		<div class="Black">ADMINISTRATION PANEL</div>
	  </h1>
	  
	</div>
	<div class="adminPageContent">
		<span style="color:red"><? foreach($error as $e) echo $e."<br>";?></span>
		<span style="color:green"><? foreach($msg as $m) echo $m."<br>";?></span>
		<h2>AFFILIATES > Banner Click Logs</h2>
		
<br>
<? 
	$year = date(Y);
	$month = date(m);
	if($_POST['period']=='') $_POST['period'] = $year."-".$month;
	for($i=($year-1);$i<=$year;$i++)
	{
		for($j=1;$j<=12;$j++){
			 if($i<$year OR ($i==$year AND $j<=$month)) $val[] = $i."-".$j;
		 }
	}
	
	//var_dump($val);
	$val = array_reverse($val);
	//var_dump($_POST);
?>
<form id="form_list_log" action="affiliates_click_log.php" method="post">
	Select period: 
	<select name="period" id="period" onChange="$('#form_list_log').submit();">
		<? 
		foreach($val as $v){
			if($v==$_POST['period']) $selected = 'selected';
			else $selected = '';
			echo '<option value="'.$v.'" '.$selected.'>'.$v.'</option>';
		}
		?>
	</select>
	</form>
<?php
$affiliate = new affiliate();
$affiliate_count = $affiliate->GetCount();
if ($affiliate_count == 0) {
	echo '<br><div>There is no affiliates registered on the system.</div>';
}
else{
	$limit = ($_POST['hdn_page'] * BACK_PAGESIZE) - BACK_PAGESIZE;
	$affiliates = $affiliate->GetList(array(), "created", false, $limit.','.BACK_PAGESIZE);
?>
		<form name="frm_affiliates" id="frm_affiliates" action="affiliates.php" method="post">
			<input type="hidden" name="hdn_page" id="hdn_page" value="<?php echo $_POST["hdn_page"]; ?>" />
			<table class="admin_table" cellpadding="6px" cellspacing="0">
				<tr class="admin_table_header">
					<th align="left">Name</th>
					<th>Click(s)</th>
					
				</tr>
<?php
$i = 0;
$acl = New Affiliate_click_log_extended;
$acl->Get($affiliate->affiliateId);
$count = $acl->GetClicksCountByPeriod($_POST['period']);

foreach ($affiliates as $affiliate) {
	
$row_class = $i % 2 == 0 ? "admin_table_row_white" : "admin_table_row_gray";
?>
				<tr class="<?php echo $row_class; ?>">
					<td><?php echo $affiliate->name; ?></td>
					<td class="admin_table_cell_center"><?=$count?></td>
				</tr>
<?php
	$i++;
}
?>
<?php
	$i++;
}
?>
			</table>
<?php
$pager = new pager($_POST['hdn_page'], BACK_PAGESIZE, $affiliate_count);
$pager->set_pager_text("Page:");
$pager->set_pager_separator("|");
$pager->set_pager_link_class("admin_pager_link");
echo $pager->get_pager("frm_affiliates", "hdn_page");
?>
		</form>

		
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>
