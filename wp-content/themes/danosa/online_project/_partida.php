<?php
$siteCountry  = getSiteCountry();
if(file_exists(__DIR__."/design-your-project/".$type."_".$siteCountry.'.json') || file_exists(__DIR__."/design-your-project/".$type.'.json')){
    if(file_exists(__DIR__."/design-your-project/".$type."_".$siteCountry.'.json')){
        $json_data = file_get_contents(__DIR__."/design-your-project/".$type."_".$siteCountry.'.json');
    }else{
        $json_data = file_get_contents(__DIR__."/design-your-project/".$type.'.json');
    }    
   
    $partidas = json_decode($json_data,true);
 
 
    forEach($partidas as $pk => $partida ){
        forEach($partida["soluciones"] as $sk => $solucion ){
            forEach($solucion["opciones"] as $ok => $opcion ){
                forEach($opcion["selector"] as $key => $value ){
                    $slug = explode(" - ",$value["text"]);
                    $slug = end($slug);
                    $value["post_id"] = 0;
                    if(array_key_exists($slug,$links)){
                        if($links[$slug]!=""){
                            $value["link"] = $links[$slug];
                            $value["post_id"] = $posts_id[$slug];
                        }
                    }else{
                        $page = get_page_by_title($slug,OBJECT,"system");
                        if($page){
                            $links[$slug] =  get_the_permalink($page);
                            $posts_id[$slug] = $page->ID;
                        }else{
                            $page = get_page_by_title($slug,OBJECT,"product");           
                            if($page){
                                $links[$slug] =  get_the_permalink($page);
                                 $posts_id[$slug] = $page->ID;
                            }else{
                                $links[$slug] = "";
                                $posts_id[$slug] = 0;
                            }
                        
                        }
                        $value["link"] = $links[$slug];
                        $value["post_id"] = $posts_id[$slug];
                    }
                 $partidas[$pk]["soluciones"][$sk]["opciones"][$ok]["selector"][$key] = $value;
                }               
            }
        }
    }


    ?>  
  
    <script>
    var partidas<?=$type?> = <?= json_encode($partidas)?>
    </script>
      <input type="hidden" id="partidasData<?=$type?>" name="partidasData<?=$type?>" value='{"<?=$type?>":{"partidas":[]}}' />
      <div class="partidas partidas-add-container" id="partidas<?=$type?>">
            <h4><?=$title?></h4>

               <div class="add_alternate">
                <div class="add_ico" onclick="jQuery(this).hide();jQuery('.add_panel').show()"></div>
                <div class="add_panel alternate add wp-block-columns" style="display:none">
                    <div class="wp-block-column">             
                            <span>M&#178;: <span><?= __("formato","danosa-design-your-project")?> 0.00</span></span>
                            <span  class="wpcf7-form-control-wrap">
                                <input id="<?=$type?>MM" onchange="updateMM<?=$type?>(jQuery(this));" type="text"  value="" size="40">
                            </span>
                      
                    </div>
                    <div class="wp-block-column">
          
                            <span><?= __("Zona de actuación","danosa-design-your-project")?>:</span>
                            <span class="wpcf7-form-control-wrap">
                            <select id="<?=$type?>Partida" >
                            <option value="" selected disabled><?= __("SELECCIONE EL TIPO","danosa-design-your-project")?></option>
                              <?php
                              foreach($partidas as $key => $value){?>
                              <option value="<?=$key?>"><?=$value["text"]?></option>
                             <?php }
                              ?>
                            </select>
                            </span>
                     

                    </div>
                    <div class="wp-block-column">
                        <button id="addPartidaButton<?=$type?>" onclick="return addPartida<?=$type?>();"><?=__("Añadir partida","danosa-design-your-project")?></button>
                    </div>
                </div>
            </div>


            <div id="partidasContent<?=$type?>" class="partida"></div>
      
     
           
             <h4><?=__("DOCUMENTACIÓN","danosa-design-your-project")?></h4>
            <div class="buttons documentacion" style="display:none;text-align: center;">
                <button onclick="return generarDocumentacion<?=$type?>();"><?=__("Generar documentación","danosa-design-your-project")?></button>
            </div>
          <?php /*
        <div class="wp-block-column">
            <button id="buscar_soluciones<?=$type?>" onclick="jQuery('#soluciones<?=$type?>').show();jQuery('#partidas<?=$type?>').hide();return false;" style="display:none">Buscar soluciones</button>
        </div> */ ?>
      </div>
 
         <?php include __DIR__."/_solucion.php";?>
    
    <script>    
    function updateMM<?=$type?>(element){
        var objid = element.data("objid");
        if(objid != "" && objid != undefined){
            var objJson =  jQuery("#partidasData<?=$type?>").val(); 
             objJson = JSON.parse(objJson);   
            objJson.<?=$type?>.partidas.forEach(obj => {     
                if(obj != null && objid == obj.id){     
                    if(element.val() == "" || element.val() == 0){
                        jQuery('#alert_mm_<?=$type?>').fadeOut(500);jQuery('#alert_mm_<?=$type?>').fadeIn(500);jQuery('#alert_mm_<?=$type?>').fadeOut(500);jQuery('#alert_mm_<?=$type?>').fadeIn(500);jQuery('#alert_mm_<?=$type?>').fadeOut(1000);
                    }else{
                        obj.mm = element.val();   
                        refreshAddPartida<?= $type ?>(objJson);
                    }
                    
                }  
            });
        }
    }
  
    function addPartida<?=$type?>(){
        var mm =  jQuery("#<?=$type?>MM").val();
        if( mm == "" ||   isNaN(mm)){
            new Noty({theme: 'sunset',type: 'error',layout: 'bottomLeft',text: '<?=__("Seleccione los <strong>m2</strong>","danosa-design-your-project")?>',timeout: 5000}).show();
            return false;
        }
        var partida =  jQuery("#<?=$type?>Partida").val();
        var partida_text = jQuery( "#<?=$type?>Partida option:selected" ).text();
        if(partida == "" || partida == null){
            new Noty({theme: 'sunset',type: 'error',layout: 'bottomLeft',text: '<?=__("Seleccione el <strong>tipo de zona</strong>","danosa-design-your-project")?>',timeout: 5000}).show();
            return false;
        }
        var objJson =  jQuery("#partidasData<?=$type?>").val(); 
        objJson = JSON.parse(objJson);    
        var p = {};
        p.partida = partida;
        p.partida_text = partida_text;
        p.mm = mm;
        p.id = ""+ Date.now()+ "";
        objJson.<?=$type?>.partidas.push(p);     
        jQuery("#partidasData<?=$type?>").val(JSON.stringify(objJson));
        refreshPartidas<?=$type?>(objJson);
        //jQuery("#<?=$type?>MM").val("");
        //jQuery('.add_ico').show();jQuery('.add_panel').hide();
        //jQuery('.add_alternate').hide();
        jQuery("#<?=$type?>MM").data("objid", p.id );
        jQuery('#<?=$type?>Partida').prop('disabled', 'disabled');
        jQuery('#addPartidaButton<?=$type?>').hide();
        return false;
    }
    function refreshPartidas<?=$type?>(objJson){
        jQuery("#buscar_soluciones<?=$type?>").hide();
        jQuery("#partidasContent<?=$type?>").html("");
         
        objJson.<?=$type?>.partidas.forEach(obj => {     
            if(obj != null){
                
                var p = '<div class="wp-block-columns added fade-left"><div  class="soluciones" id="solucionpartida'+obj.id+'<?=$type?>"></div></div>';
                jQuery("#partidasContent<?=$type?>").append(p);
                refreshSolucion<?=$type?>(objJson,obj,"#solucionpartida"+obj.id+"<?=$type?>","partida_solucion");
                jQuery("#buscar_soluciones<?=$type?>").show();
            }  
        });
        //refreshSoluciones<?=$type?>();
        refreshAddPartida<?= $type ?>(objJson);
    }
    function delPartida<?=$type?>(id){
        jQuery("#<?=$type?>MM").val("");
        jQuery('.add_ico').show();jQuery('.add_panel').hide();
        jQuery('.add_alternate').hide();
        jQuery("#<?=$type?>MM").data("objid", "");
        jQuery('#<?=$type?>Partida').prop('disabled', false);
        jQuery('#addPartidaButton<?=$type?>').show();

        var objJson =  jQuery("#partidasData<?=$type?>").val(); 
        objJson = JSON.parse(objJson);  
        for( i in objJson.<?=$type?>.partidas) {
            if(objJson.<?=$type?>.partidas[i] == null){              
                delete objJson.<?=$type?>.partidas[i];              
            }else{
                if (objJson.<?=$type?>.partidas[i].id == id) {
                    delete objJson.<?=$type?>.partidas[i];
                }
            }          
        }
        jQuery("#partidasData<?=$type?>").val(JSON.stringify(objJson));
        refreshPartidas<?=$type?>(objJson);
       jQuery('.add_alternate').show();
    }

  </script>
<?php }else{ ?>


   <div class="partidas" id="partidas<?=$type?>">
         <h4><?=$title?></h4>
            <div class="add_alternate">
            <div class="add_ico" onclick="new Noty({theme: 'sunset',type: 'error',layout: 'bottomLeft',text: '<?=__("Seleccione un Tipo de Obra","danosa-design-your-project")?>',timeout: 5000}).show();" ></div>

        </div>
         <h4>DOCUMENTACIÓN</h4>
        <div class="buttons documentacion" style="text-align: center;">
            <button   onclick="new Noty({theme: 'sunset',type: 'error',layout: 'bottomLeft',text: '<?=__("Seleccione un Tipo de Obra","danosa-design-your-project")?>',timeout: 5000}).show();return false;">Generar documentación</button>
        </div>
 
  </div>


   <?php }  ?>