<?php
 


     global $wpdb;  
    $form = $wpdb->get_results($wpdb->prepare("select * from ".$wpdb->base_prefix.$_REQUEST["blog_id"]."_dynamics_form where guid=%s",array($_REQUEST["guid"])) , OBJECT ); 
 
    $data = json_decode(str_replace("\\","",$form[0]->json_data),true);
      
?>
 

<div class='flexrow resumen_proyecto'>
    <?php 
    $type = array_key_first($data);
    ?>
    <h4><?=$type?></h4>
    <?php
    forEach($data[$type]["partidas"] as $partida){
        if(  isset($sistemas["mm"]) && (int)$partida["mm"] > 0){
            ?> 
                <div class="flexcolumn"><label><?=(int)$partida["mm"]?>m&#178;: <?=$partida["partida_text"]?></label> 
                    <span> 
                        <?php if( $partida["solucionVertical2"] !== "undefined" &&  $partida["solucionVertical2"]  != ""){?>
                        <div class="v2"><?=$partida["solucionVertical2_text"]?></div>  
                        <?php                }else  if($partida["solucionVertical"] !== "undefined" && $partida["solucionVertical"] != ""){ ?>
                        <div class="v">'+ obj.solucionVertical_text + '</div>  
                        <?php                }  ?>
                        <?=$partida["solucionHorizontal_text"]?> 
                    </span>
                </div>
            <?php	 
         }
     }
    forEach($data["sistemas"] as $sistema){
        if((int)$sistema["mm"] > 0){
        ?> 
        <div class="flexcolumn"><label><?=(int)$sistema["mm"]?>m&#178;: <?=$sistema["sistema_text"]?></label> 
            <span> 
                
                <div class="v2"><?=$sistema["sistema_tipo"]?></div>  
 
                <div class="v"><?=$sistema["sistema_desc"]?></div>  
               
                ID: <a href="<?=$sistema["link"]?>" target="_blank"><?=$sistema["sistema"]?></a>

            </span>
        </div>
        <?php	 
        }
     }
     
     
     
     
     ?>


 
</div>