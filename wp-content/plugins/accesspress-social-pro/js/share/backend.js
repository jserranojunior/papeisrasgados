function removeMe(args){
jQuery('.'+args).html('');
}

(function ($) {
    $(function () {
        //all backend js goes here

        //sortable initialization
        $('.apps-opt-wrap').sortable({
            containment: "parent",
            update:function(event,ui){ 
                        var profile_array = [];
                        $('.apss-option-wrapper input[type="checkbox"]').each(function(){
                        profile_array.push($(this).attr('data-key')) ;
                        });
                        var social_networks_orders = profile_array.join(',');
                        $('#apss_social_newtwork_order').val(social_networks_orders);
             	      }
        });


        $( '.apss-tabs-trigger' ).click(function(){
        $( '.apss-tabs-trigger' ).removeClass( 'apss-active-tab' );
        $(this).addClass( 'apss-active-tab' );
        var board_id = 'tab-'+$(this).attr('id');
        $('.apss-tab-contents').hide();
        $('#'+board_id).show();
       });

       $('#apss_submit_settings').click(function(){
        var cache_period_val=$('#apss_cache_period').val();
        if($.isNumeric(cache_period_val)===true){ 
       }else{
        $('.invalid_cache_period').html("Please enter the integer value only.");
        $('.apss_cache_period').focus();
        return false;
       }
       }); 

       $('.floating_positions_enable_disable').click(function(){
       if($(this).val()==='1') {
           $('.apss_floating_sidebar_options').show();
                
        }else{
            $('.apss_floating_sidebar_options').hide();
        }
        
       });


       $('.floating_count_enabler').click(function(){
          if($(this).val()==='1') {
           $('.apss_floating_count_type').show();
                
          }else{
            $('.apss_floating_count_type').hide();
        }
       });

        $('.select_all_media').click(function(){

          if($(this).is(':checked')){
            $('.social_networks_class').attr('checked','checked');
          }
          else
          {
            $('.social_networks_class').removeAttr('checked');
          }
       });
    });//document.ready close

}(jQuery));