<?php
 // partidas $type
 //   var objJson =  jQuery("#partidasData $type ").val(); 
 //   objJson = JSON.parse(objJson);    
?>  
<script>
    function refreshSolucion<?=$type?>(objJson,partida,container_selector,aclass){
     
        con_opciones = false;
        var completed = "";
        if(partida.solucionHorizontal != "" && partida.solucionHorizontal != undefined){     
          completed = "completed";
        }else{
            completed = "pending";
        }
        
        var s = '<div class="partida '+aclass+' '+completed+'" id="partida<?= $type ?>'+partida.id+'">';// CADA PARTIDA
        s += '<div class="header"><h4><?=__("ELIJA LA OPCIÓN QUE DESEA AÑADIR","danosa-design-your-project")?></h4><i class="close danosa-cross" title="Eliminar" onclick="return delPartida<?=$type?>('+partida.id+');"></i></div><div class="body">';
        var v = ""; 
        var v2 = ""; 
        var h = "";
               
        var config = partidas<?=$type?>[partida.partida];
               
        if(Object.keys(config.soluciones).length > 1){
            con_opciones = true;
            v += '<div class="vertical">';
            for (var [key, value] of Object.entries(config.soluciones)) {
                var selected = "";
                var visibleV2 = "display:none";
              
                if(key == partida.solucionVertical){
                    selected = 'checked="checked"';
                    if(Object.keys(value.opciones).length > 1){
                      visibleV2 = "";
                    }                  
                }
                v += '<label><input id="v1'+key+'_'+partida.id+'" onchange="setSolucionVertical<?= $type ?>(\''+partida.id+'\',\''+key+'\',\''+value.text+'\')" type="radio" name="radio'+partida.id+'"  value="'+key+'" '+selected+'/>'+value.text+'</label>';
              
            
                v2 += '<div class="vertical2 vertical2<?= $type ?>'+key+'" style="'+visibleV2+'">';
                if(Object.keys(value.opciones).length > 1){                    
                    for (var [optk, optv] of Object.entries(value.opciones)) {      
                        selected = "";
                        if(optk == partida.solucionVertical2){
                            selected = 'checked="checked"';
                            visibleh = "";
                        }
                        v2 += '<label><input id="v2'+optk+'_'+partida.id+'" class="vertical2input" onchange="setSolucionVertical2<?= $type ?>(\''+partida.id+'\',\''+key+'\',\''+optk+'\',\''+optv.text+'\')" type="radio" name="radio'+partida.id+'_'+key+'" value="'+optk+'" '+selected+'"/>'+optv.text+'</label>';
                    }  
                }   
                v2 += '</div>'; // vertical2
            }
                
            v += '</div>'; // vertical

        }else{
            for (var [key, value] of Object.entries(config.soluciones)) {
                if(value.text !== undefined){
                    v2 += '<h5>'+value.text+'</h5>';
                }
            }
        }              
                    

        h += '<div class="horizontal">';
        for (var [key, value] of Object.entries(config.soluciones)) {
            if(con_opciones){
                var visibleh = "display:none";
                if(key == partida.solucionVertical){
                    visibleh = "";
                }
                h += '<div class="solucion solucion<?=$type?>'+key+'" style="'+visibleh+'">';   
            }else{
                h += '<div class="solucion solucion<?=$type?>'+key+'">';   
            }
                           
            for (var [optk, optv] of Object.entries(value.opciones)) {  
                if(con_opciones){
                    var visibleh = "display:none";
                    if(optk == partida.solucionVertical2){
                        visibleh = "";
                    }
                    h += '<div class="selector selector<?=$type?>'+key+'_'+optk+'" style="'+visibleh+'">';
                }else{
                    h += '<div class="selector selector<?=$type?>'+key+'_'+optk+'">';
                }
                h += '<h5>Elija una solución:</h5>';
                h += '<div class="select-option-horizontal">';
                h += '<select class="hidden list" name="solucionHorizontal<?=$type?>'+partida.id+'_'+key+'_'+optk+'"  onchange="setSolucionHorizontal<?=$type?>(\''+partida.id+'\',\''+key+'\',\''+optk+'\')">';
                for (var [selk, selv] of Object.entries(optv.selector)) {       
                    var selected = "";
                    if(selk == partida.solucionHorizontal){
                        selected = "selected";
                    }
                    h += '<option value="'+selk+'" data-link="'+selv.link+'" data-post_id="'+selv.post_id+'" '+selected+'>'+selv.text+'</option>';
                }
                h += '</select>';

                h += '<ul class="setSolucionHorizontal">';
                for (var [selk, selv] of Object.entries(optv.selector)) {   
 
                    var final_text =   selv.text.split(' - ').pop();
                    var final_desc = selv.text.replace(' - '+final_text,'');
                  
                    var selected = "";
                    if(selk == partida.solucionHorizontal){
                        selected = "selected";
                    }
                    h += '<li class="'+selected+' li<?= $type ?>_'+partida.id+'_'+key+'_'+selk+'" id="li<?= $type ?>_'+partida.id+'_'+key+'_'+optk+'" onclick="jQuery(\'#partida<?= $type ?>'+partida.id+' .selector<?=$type?>'+key+'_'+optk+' select\').val(\''+selk+'\');setSolucionHorizontal<?=$type?>(\''+partida.id+'\',\''+key+'\',\''+optk+'\');jQuery(this).siblings(\'li\').removeClass(\'selected\');jQuery(this).addClass(\'selected\');">';
                    h += '<span class="subsystem-system-title"><i class="danosa-arrow-go"></i>'+final_text+'</span>';
                    h += '<span class="subsystem-system-name">'+final_desc+'</span>';

                    if(selv.link !== undefined && selv.link !=""  ){
                        h += '<a target="_blank" href="'+selv.link+'" ><?= __("Ver solución","danosa-design-your-project"); ?> <i class="danosa-arrow-go"></i></a>';
                    }
                    
                    h += '</li>';
                }
                h += '</ul>';


            
               // h += '<button onclick="verSolucion<?=$type?>(\''+partida.id+'\',\''+key+'\',\''+optk+'\');return false;" id="versolucion'+partida.id+'_'+optk+'">Ver solución</button>'
                h += '<button onclick="addSolucion<?=$type?>(\''+partida.id+'\',\''+key+'\',\''+optk+'\');return false;" id="addSolucion'+partida.id+'_'+optk+'"><?= __("Agregar partida","danosa-design-your-project")?></button>'
                h += '</div>';
                h += '</div>';
            }
            h += '</div>'; // solucion
        }   
        h += '</div>'; // horizontal
        s += v;
        s += v2;
        s += h;
        s += '</div></div>';  // body/partida

        jQuery(container_selector).append(s); 
               
        if(!con_opciones){
            partida.solucionHorizontal =  jQuery("#partida<?= $type ?>"+partida.id+" .selector<?=$type?>"+key+"_"+optk+" select").val();
            partida.solucionHorizontal_text = jQuery("#partida<?= $type ?>"+partida.id+" .selector<?=$type?>"+key+"_"+optk+" select option:selected").text();
            jQuery("#partida<?= $type ?>"+partida.id).addClass("completed");
            var link = jQuery("#partida<?= $type ?>"+partida.id+" .selector<?=$type?>"+key+"_"+optk+" select option:selected").data("link");
           // if(link === undefined || link ==""){
                    jQuery("#versolucion"+partida.id+"_"+key).remove();
           // }else{
            //        jQuery("#versolucion"+partida.id+"_"+key).show();
           // }
            jQuery("#partidasData<?=$type?>").val(JSON.stringify(objJson));
        }
      
        refreshAddPartida<?= $type ?>(objJson);
    }
    function addSolucion<?=$type?>(id,key,optk){
        jQuery("#<?=$type?>MM").val("");
        jQuery('.add_ico').show();jQuery('.add_panel').hide();
        jQuery('.add_alternate').hide();
        jQuery("#<?=$type?>MM").data("objid", "");
        jQuery('#<?=$type?>Partida').prop('disabled', false);
        jQuery('#addPartidaButton<?=$type?>').show();

      var objJson =  jQuery("#partidasData<?=$type?>").val();
      objJson = JSON.parse(objJson);
    
      objJson.<?=$type?>.partidas.forEach(obj => {     
            if(obj != null ){
                var post_id = jQuery("#partida<?= $type ?>"+id+" .selector<?=$type?>"+key+"_"+optk+" select option:selected").data("post_id");
                var link = jQuery("#partida<?= $type ?>"+id+" .selector<?=$type?>"+key+"_"+optk+" select option:selected").data("link");                  
                var desc = jQuery("#partida<?= $type ?>"+id+" .selector<?=$type?>"+key+"_"+optk+" select option:selected").text();   
                var final_text =   desc.split(' - ').pop();
                var final_desc = desc.replace(' - '+final_text,'');
                var type = obj.partida_text;  
                var mm = obj.mm;  
                var vertical = obj.solucionVertical_text;  
                var vertical2 = obj.solucionVertical2_text;  
                addPrescripcionSistemas(post_id,final_text,mm,type,link,final_desc,vertical,vertical2);
                delPartida<?=$type?>(id);
            }  
        });


       
    }
    function refreshAddPartida<?= $type ?>(objJson){
        var oculta = false;
        objJson.<?=$type?>.partidas.forEach(obj => {     
            if(obj != null && !oculta){
                if(obj.solucionHorizontal == "" || obj.solucionHorizontal == undefined){                
                   // jQuery("#partidas<?= $type ?> .add").hide();                 
                   // jQuery("#partidas<?= $type ?> .documentacion").hide();
                   // oculta =  true;
                }
            }  
        });
        if(!oculta){
            jQuery("#partidas<?= $type ?> .add button").html("Ver soluciones");
            //jQuery("#partidas<?= $type ?> .add").show();
            jQuery("#partidas<?= $type ?> .documentacion").show();
        }    
        
        jQuery("#partidasData<?=$type?>").val(JSON.stringify(objJson));
        window.localStorage.setItem('online_project_prescripcion_online', jQuery("#form-online-project").serialize());
    }
    function refreshSoluciones<?=$type?>(){
	    var objJson =  jQuery("#partidasData<?= $type ?>").val();    
	    objJson = JSON.parse(objJson); 
        jQuery("#solucionesContent<?=$type?>").html("");
        var altern = 1;
        var con_opciones = false;
	    objJson.<?=$type?>.partidas.forEach(obj => {     
            if(obj != null){   
                
                altern  = altern * -1;
                var aclass = "altern";
                if(altern >0){
                    aclass = "alternate";
                }
                con_opciones = false;

               refreshSolucion<?=$type?>(objJson,obj,"#solucionesContent<?=$type?>",aclass);


            } // obj NULL
        }); // forEach
    } //Function

    function setSolucionVertical<?=$type?>(id,key,texto){
        var objJson =  jQuery("#partidasData<?=$type?>").val(); 
        var vertical_unica = true;
        objJson = JSON.parse(objJson);
        objJson.<?=$type?>.partidas.forEach(obj => {    
         if(obj != null){
            if(obj.id == id){
                jQuery("#partida<?= $type ?>"+obj.id).removeClass("completed");
                console.log("remove completed 1");
                jQuery(".vertical2input").prop('checked', false);
                jQuery("#partida<?= $type ?>"+obj.id+ " .selector").hide();
                obj.solucionVertical = key;
                obj.solucionVertical_text = texto;
                obj.solucionVertical2 = "";
                obj.solucionVertical2_text = "";
                obj.solucionHorizontal = "";
                obj.solucionHorizontal_text = "";
                var config = partidas<?=$type?>[obj.partida];
                if(Object.keys(config.soluciones[key].opciones).length == 1){ // Solamente hay una solución vertical2, seleccionamos directamente el valor                      
                      selk = Object.keys(config.soluciones[key].opciones)[0]; // La primera clave de opciones
                     
                      jQuery("#partida<?= $type ?>"+obj.id+" .vertical2").hide();
                      jQuery("#partida<?= $type ?>"+obj.id+" .selector").hide();
                      jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+"_"+selk).show();
                      jQuery("#partida<?= $type ?>"+obj.id+" .solucion").hide();
                      jQuery("#partida<?= $type ?>"+obj.id+" .solucion<?=$type?>"+key).show();
                      obj.solucionVertical2 = selk;
                      obj.solucionHorizontal =   jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+"_"+selk+" select").val();
                      obj.solucionHorizontal_text =   jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+"_"+selk+" select option:selected").text();
                      jQuery(".li<?= $type ?>_"+obj.id+"_"+key).removeClass("selected");
                      jQuery("#li<?= $type ?>_"+obj.id+"_"+key+"_"+selk).addClass("selected");
                      jQuery("#partida<?= $type ?>"+obj.id).addClass("completed");   
                      refreshAddPartida<?= $type ?>(objJson);
                }else{
                  
                    jQuery("#partida<?= $type ?>"+obj.id+" .vertical2").hide();
                    jQuery("#partida<?= $type ?>"+obj.id+" .vertical2<?=$type?>"+key).show();
                    jQuery("#partida<?= $type ?>"+obj.id+" .solucion").hide();
                    jQuery("#partida<?= $type ?>"+obj.id+" .solucion<?=$type?>"+key).show();
                }

                jQuery("#partidasData<?=$type?>").val(JSON.stringify(objJson));
            }
          }
        });      
    }
     function setSolucionVertical2<?=$type?>(id,key,optk,texto){
       var objJson =  jQuery("#partidasData<?=$type?>").val(); 
        objJson = JSON.parse(objJson);
        objJson.<?=$type?>.partidas.forEach(obj => {     
             if(obj != null){
                 if(obj.id == id){
                        obj.solucionVertical2 = optk;
                        obj.solucionVertical2_text = texto;
                        obj.solucionHorizontal =  jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+'_'+optk+" select").val();
                        obj.solucionHorizontal_text = jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+'_'+optk+" select option:selected").text();
                        jQuery("#partida<?= $type ?>"+obj.id).addClass("completed");
                         console.log("add completed 2");
                        refreshAddPartida<?= $type ?>(objJson);
                        var link = jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+'_'+optk+" select option:selected").data("link");
                        if(link === undefined || link ==""){
                            jQuery("#versolucion"+obj.id+"_"+key).hide();
                        }
                        jQuery("#partida<?= $type ?>"+obj.id+" .selector").hide();
                        jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+'_'+optk).show();
                    }
             }
            
        });        
       jQuery("#partidasData<?=$type?>").val(JSON.stringify(objJson));

    }
    function setSolucionHorizontal<?=$type?>(id,key,optk){
        jQuery(".li<?= $type ?>_"+id+"_"+key).removeClass("selected");
        jQuery("#li<?= $type ?>_"+id+"_"+key+'_'+optk).addClass("selected");
        var objJson =  jQuery("#partidasData<?=$type?>").val(); 
        objJson = JSON.parse(objJson);
        objJson.<?=$type?>.partidas.forEach(obj => {   
         if(obj != null){
          if(obj.id == id){
                obj.solucionHorizontal =  jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+'_'+optk+" select").val();      
                obj.solucionHorizontal_text = jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+'_'+optk+" select option:selected").text();
                var link = jQuery("#partida<?= $type ?>"+obj.id+" .selector<?=$type?>"+key+'_'+optk+" select option:selected").data("link");
                if(link === undefined || link ==""){
                       jQuery("#versolucion"+obj.id+"_"+key).hide();
                }else{
                    jQuery("#versolucion"+obj.id+"_"+key).show();
                }
                jQuery("#partida<?= $type ?>"+obj.id).addClass("completed");
                console.log("add completed 3");
                refreshAddPartida<?= $type ?>(objJson);
            }
         }
           
        });        
       jQuery("#partidasData<?=$type?>").val(JSON.stringify(objJson));
    }
    function generarDocumentacion<?=$type?>(){
        var objJson =  jQuery("#partidasData<?=$type?>").val(); 
        objJson = JSON.parse(objJson);
        var complete = true; 
        var c = 0;
        var pendientes = 0;
        objJson.<?=$type?>.partidas.forEach(obj => {  
            if(obj != null){
                pendientes ++;
                if( obj.solucionHorizontal === undefined ||  obj.solucionHorizontal == "" ){
                    complete =  false;
                }else{
                    c ++;
                }
            }           
        });  

         var objJson = window.localStorage.getItem('system_prescripcion_online'); 
        objJson = JSON.parse(objJson);
        if (Array.isArray(objJson)) {   
            objJson.forEach(obj => {
                if (obj != null ) {
                    c += 1;
 
                }
            });
        }  

        if(  c == 0 ){
            new Noty({theme: 'sunset',type: 'error',layout: 'bottomLeft',text: '<?= __("Añade al menos una partida o sistema","danosa-design-your-project")?>',timeout: 5000}).show();
        }else{
            if(pendientes > 0){
                new Noty({theme: 'sunset',type: 'error',layout: 'bottomLeft',text: '<?= __("Tiene partidas pendientes de añadir, finalice la seleccción o elimine la partida","danosa-design-your-project")?>',timeout: 5000}).show();
            }else{
                if(   jQuery("#project_name").val() == "" ){
                    new Noty({theme: 'sunset',type: 'error',layout: 'bottomLeft',text: '<?= __("Indica un nombre de proyecto","danosa-design-your-project")?>',timeout: 5000}).show();
                }else{
                    if(complete){
                        jQuery('#partidas<?=$type?>').hide();jQuery('#registro').show();getResumen();createDinamicsForm('prescripcion_online');
                    }else{
                        new Noty({theme: 'sunset',type: 'error',layout: 'bottomLeft',text: '<?= __("Completa los datos de las partidas","danosa-design-your-project")?>',timeout: 5000}).show();
                    }
                }
            }


        }

    
      return false;
    }
       function verSolucion<?=$type?>(id,key,optk){
           var link = jQuery("#partida<?= $type ?>"+id+" .selector<?=$type?>"+key+'_'+optk+" select option:selected").data("link");
           verSolucionLink<?=$type?>(link);
       }
       function verSolucionLink<?=$type?>(link){
        
           if(link !== undefined && link !=""){
                   window.open(link, '_blank').focus();
           }
       }
 </script>
    <div  class="soluciones" id="soluciones<?=$type?>" style="display:none">
        <h3><?=$title?></h3>
        <div  class="solucionesContent" id="solucionesContent<?=$type?>"></div>
        <div class="buttons">
            <button   onclick="jQuery('#soluciones<?=$type?>').hide();jQuery('#partidas<?=$type?>').show();return false;"><?= __("Volver","danosa-design-your-project")?></button>
        </div>
        <div class="buttons">

            <button   onclick="return generarDocumentacion<?=$type?>();"><?= __("Generar documentación","danosa-design-your-project")?></button>
        </div>
    </div>
