<?=isset($header)?$header:''?>

<body>

<div class="container">

<?php if( isset($heading) ) { ?>
<div id="heading-container">
    <?=$heading?>
</div>
<?php } ?>


<?php if( isset( $content ) ) { ?>
<div id="main-container" class="sixteen columns">
    <div id="main">
        <?=$content?>
    </div>
</div>
<?php } ?>

<?php if( isset( $footer ) ) { ?>
<div id="footer-container">
    <?=$footer?>
</div>
<?php } ?>

</div><!-- end skeleton container -->
</body>
<?php
    $js_autoload = $this->config->item('js_autoload_files');
    //if( array_search( $this->router->class , $js_autoload ) === false ) array_push( $js_autoload , $this->router->class.'.js' );
    foreach( $js_autoload as $js )
    { 
        $file = '/js/'.$js;
        ?><script type="text/javascript" src="<?=$file?>" /></script><?php
    }
?>
<?php if( ENVIRONMENT == 'production' && !$this->ion_auth->is_admin() && !$this->agent->is_robot() ) { ?>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'PUT YOUR ANALYTICS CODE HERE']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<?php } ?>
</html>
