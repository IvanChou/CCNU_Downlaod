<script language="javascript" type="text/javascript">
<!--
function HTMerDel()
{
	if(confirm("将删除一级栏目下的所有软件，确定删除？"))
    return true;
    else
    return false;
}
function HTMerDel2()
{
	if(confirm("将删除该二级栏目下的所有软件，确定删除？"))
    return true;
    else
    return false;
}
function jiaodian(){
	document.form1.term.focus();
}
-->
</script>
<h3 style="text-align:center;float:none;">添加一级栏目</h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->

<div class="content-box-content">
<div class="tab-content default-tab" > <!-- This is the target div. id must match the href of this div's tab -->
<form method="post" action="./sort/transact_sorts.php" style="text-align:center; float:none;" name="form1">
<table style="width:100%;margin:0 auto;padding:0;"><tr><td style="text-align:center;font-weight:bold;">一级栏目名称</td><td><input type="text" name="term" class="text-input small-input" style="width:80% !important;" /></td></tr>
<tr><td colspan='2' style="text-align:center;"><input type="submit" name="action" class="button" value="添加" style="margin-left:29px;"/>
<input type="reset" class="button" value="重置" style="margin-left:10px;"/></td></tr></table>
</form>
</div> <!-- End #tab1 -->
</div> <!-- End .content-box-content -->

<div class="content-box-header">
<h3 style="text-align:center;float:none;">栏目列表</h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<div class="content-box-content">
<script type="text/javascript" src="./resources/scripts/ajax.js"></script>	
<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
数据加载中……
</div> <!-- End #tab1 -->
<script type="text/javascript" src="./resources/scripts/ajax.page.sort.js"></script>