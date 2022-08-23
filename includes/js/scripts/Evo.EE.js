nuke_jq(function($) 
{
    $.fn.jKonamicode = function(params,callback) {
        var jKC = this;
        var rights = 0;
        var defaults = {				
            code:[38,38,40,40,37,39,37,39,66,65,13],
            onRightKey:function(e){}
        }
        if($.isFunction(params)) { callback = params }
        jKC.init = function(){
            params = $.extend(defaults, params);
            $(document).bind("keydown",function(event){jKC.keyDown(event);});
        }
        jKC.keyDown = function(e){
            if(params.code[rights] == e.keyCode){
                rights++;
            }else{
                rights=0;
                if(params.code[0] == e.keyCode){
                    rights++;
                }
            }
            params.onRightKey(rights);
            if(rights==params.code.length){
                jKC.success();
            }
        }
        jKC.success = function(){
            callback.call();
        }
        jKC.init();
    return this;
    };
});