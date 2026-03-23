<?php
// Necesita que haya un campo "#partidasData"+type en donde se encuentre el json con los datos
?>
<div id="resumen"></div>
<script>
    function getResumen(){
        jQuery("#resumen").html("");
        var type = jQuery('#type').val();
        var objJson =  jQuery("#partidasData"+type).val();         
        objJson = JSON.parse(objJson);        
        var s = "<div class='flexrow'>";
        objJson[type].partidas.forEach(obj => {    
            if(obj != null){
                var d = obj.solucionHorizontal_text;
                if( obj.solucionVertical2 !== undefined && obj.solucionVertical2 != ""){
                    d = '<div class="v2">'+obj.solucionVertical2_text + '</div>' + d;
                }
                if( obj.solucionVertical !== undefined && obj.solucionVertical != ""){
                    d = '<div class="v">'+ obj.solucionVertical_text + '</div>' + d;
                }
            
                s += '<div class="flexcolumn"><label>'+obj.mm+' m&#178;: '+obj.partida_text+'</label><span>'+ d +'</span></div>';
            }
        });
        s += "</div>";
        jQuery("#resumen").append(s);   
        

         var objJson = window.localStorage.getItem('system_prescripcion_online');
        jQuery("#PrescripcionSistemas").val(objJson);
        objJson = JSON.parse(objJson);
        if (Array.isArray(objJson)) {
         

            var s = "<div class='flexrow sistemas'>";
            var c = 0;
            objJson.forEach(obj => {
                if (obj != null ) {
                    c = 1;
                    d = '<div class="v2">' + obj.mm + 'm&#178;: ' + obj.sistema_text + '</div>';
                    s += '<div class="flexcolumn"><span>' + d + '</span></div>';
                }
            });
            s += "</div>";
            if (c == 1) {
                jQuery("#resumen").append("");   
                jQuery(".PrescripcionSistemas").html("");
                jQuery("#resumen").append(s);
            } 
        }  
    }
</script>