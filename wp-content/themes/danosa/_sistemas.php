<?php

 
?>

 <div class="_sistemas">
       <h5 ><?=$data_json["file_name"]?></h5>
    
       <label>SYS <input type="checkbox"  <?= isset($data_json["system_data_sheet"])?"checked":"" ?> onclick="return false;"> </label>
        <label>BIM <input type="checkbox"  <?= isset($data_json["bim"])?"checked":"" ?> onclick="return false;"> </label>
        <label>DWG <input type="checkbox"  <?= isset($data_json["dwg_details"])?"checked":"" ?> onclick="return false;"> </label>
        <label>COMP <input type="checkbox"  <?= isset($data_json["decomposed_prices"])?"checked":"" ?> onclick="return false;"> </label>
        <label>FT <input type="checkbox"  <?= isset($data_json["check_productos_ft"])?"checked":"" ?> onclick="return false;"> </label>
        <label>SEG <input type="checkbox"  <?= isset($data_json["check_productos_fs"])?"checked":"" ?> onclick="return false;"> </label>
          
</div>
 

