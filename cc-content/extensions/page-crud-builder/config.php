<?php 

/*define base extension*/
$base_url_extension = url_extension(basename(__DIR__)); 

/*register script file*/
$script = <<<SCRIPT
var BASE_URL_EXT = "$base_url_extension";
SCRIPT;

app()->load->library('cc_html');
app()->cc_html->registerScriptFile( $script, 'script');
app()->cc_html->registerScriptFile( $base_url_extension.'/crud-builder-ext.js');


?>