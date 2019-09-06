# mSwitch

**mSwitch** is a jQuery plugin for apply an iOS style to CHECKBOX

An Example:

```code
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="js/jquery.mswitch.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
    $(".m_switch_check:checkbox").mSwitch({
        onRender:function(elem){
            // allows to apply a first state to the rendering of the CHECKBOX 
        },
        onRendered:function(elem){
            // exec your logic when the render is complete
        },
        onTurnOn:function(elem){
            // exec your logic when the switch is activated
        },
        onTurnOff:function(elem){
            // exec your logic when the switch is deactivated
        }
    });
});
</script>

```


## jQuery Compatibility

Works with jQuery 1.4.2 and newer.

It is known to be working with all the major browsers on all available platforms (Win/Mac/Linux)

 * IE 6/7/8+
 * FF 1.5/2/3+
 * Opera-9+
 * Safari-3+
 * Chrome-0.2+
