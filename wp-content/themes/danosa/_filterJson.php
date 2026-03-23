<?php
$more_filters = false;
$system_check = array();
 if(isset($_REQUEST["system_check"]) && $_REQUEST["system_check"] != ""  && is_array($_REQUEST["system_check"]) ){
 $more_filters = true;
 $system_check = $_REQUEST["system_check"];
 }
?>
<div  >
    <div onClick="jQuery('#more_filters').toggle();" style="cursor:pointer"><?=__("More Filters")?></div>

	 <div id="more_filters" <?php if(!$more_filters){ ?>style="display: none;"<?php } ?>>
		 <div class="_sistemas">
               <label ><?=__("system")?><input type="text" name="file_name" value="<?=isset($_REQUEST["file_name"])?$_REQUEST["file_name"]:""?>"></label>
                
                <input type="checkbox" name="system_check[]" value="OR" <?= in_array("OR",$system_check)?"checked":""?>> <label>OR </label>  <br> 
                <label  style="clear: both"> SYS <input type="checkbox" name="system_check[]" <?= in_array("system_data_sheet",$system_check)?"checked":""?> value="system_data_sheet"> </label>
                <label> BIM <input type="checkbox" name="system_check[]" <?= in_array("bim",$system_check)?"checked":""?> value="bim"  > </label>
                <label> DWG <input type="checkbox" name="system_check[]" <?= in_array("dwg_details",$system_check)?"checked":""?> value="dwg_details"  > </label>
                <label> COMP <input type="checkbox" name="system_check[]" <?= in_array("decomposed_prices",$system_check)?"checked":""?> value="decomposed_prices"  > </label>
                <label> FT <input type="checkbox" name="system_check[]" <?= in_array("check_productos_ft",$system_check)?"checked":""?> value="check_productos_ft"  > </label>
                <label> SEG <input type="checkbox" name="system_check[]" <?= in_array("check_productos_fs",$system_check)?"checked":""?> value="check_productos_fs"  > </label>
                    
        </div>
	 </div>
 </div>