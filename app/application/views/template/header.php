<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title><?php echo isset( $title ) ? $title." | " : ""; ?><?=SITE_NAME?></title>
    <meta name="description" content="<?=isset( $description ) && trim( $description ) != ''?$description:''?>">
    <meta name="author" content="Me, <?=COMPANY_NAME?>">
    <meta name="keywords" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
    <?php if( ( ENVIRONMENT == 'development' || ENVIRONMENT == 'dev_local' ) && !isset( $_GET['less'] ) ) { ?>

    <link rel="stylesheet/less" type="text/css" href="/css/less/less.less" />
    <script src="/js/less.min.js" type="text/javascript"></script>

    <?php } else { ?>

    <link rel="stylesheet" type="text/css" href="/css/min.global.css?<?=date('U')?>" />

    <?php } ?>

    <!-- favicons and apple touch icons -->
    <!--
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="50x50" href="/images/Icon-Small-50.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/images/Icon.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/images/Icon-72.png" />
    <link rel="apple-touch-icon" sizes="100x100" href="/images/Icon-Small-50@2x.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/images/Icon@2x.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/images/Icon-72@2x.png" />
    -->

	<!-- SCRIPTS
  ================================================== -->
    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <script type="text/javascript" src="/js/lib/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
        <?php
            $js_array = $this->config->item('js_autoload_files_header');
            foreach( $js_array as $js ) { 
                if( !preg_match( '~http[s]?://.*~' , $js ) )
                    $js = '/js/'.$js;
            ?>
                <script type="text/javascript" src="<?=$js?>"></script>
            <?php } 
        ?>
</head>
