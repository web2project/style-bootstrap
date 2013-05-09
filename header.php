<?php /* $Id$ $URL$ */
$dialog = w2PgetParam($_GET, 'dialog', 0);
if ($dialog) {
	$page_title = '';
} else {
	$page_title = ($w2Pconfig['page_title'] == 'web2Project') ? $w2Pconfig['page_title'] . '&nbsp;' . $AppUI->getVersion() : $w2Pconfig['page_title'];
}

// Include the file first of all, so that the AJAX methods are printed through xajax below
require W2P_BASE_DIR . '/includes/ajax_functions.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo @w2PgetConfig('page_title') . ' :: ' . $AppUI->_($m) . ' ' . $AppUI->_($a); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Bootstrap for web2project">
        <meta name="author" content="web2project">

        <meta name="Version" content="<?php echo $AppUI->getVersion(); ?>" />
        <meta http-equiv="Content-Type" content="text/html;charset=<?php echo isset($locale_char_set) ? $locale_char_set : 'UTF-8'; ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

        <!-- Le styles -->
        <link href="./style/<?php echo $uistyle; ?>/assets/css/bootstrap.css" rel="stylesheet">
        <link href="./style/<?php echo $uistyle; ?>/assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="./style/<?php echo $uistyle; ?>/assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./style/<?php echo $uistyle; ?>/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./style/<?php echo $uistyle; ?>/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./style/<?php echo $uistyle; ?>/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="./style/<?php echo $uistyle; ?>/assets/ico/apple-touch-icon-57-precomposed.png">

        <link rel="stylesheet" type="text/css" href="./style/common.css" media="all" charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./style/<?php echo $uistyle; ?>/main.css" media="all" charset="utf-8"/>
        <link rel="shortcut icon" href="./style/<?php echo $uistyle; ?>/favicon.ico" type="image/ico" />
        <?php
            if (isset($xajax) && is_object($xajax)) {
                $xajax->printJavascript(w2PgetConfig('base_url') . '/lib/xajax');
            }
        ?>
        <?php $AppUI->loadHeaderJS(); ?>
    </head>

    <body onload="this.focus();">

        <div id="nav-main" class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="./?m=public&a=welcome"><?php echo $w2Pconfig['company_name']; ?></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <?php echo buildHeaderNavigation($AppUI, '', 'li', '', $m); ?>
<!-- TODO: Add search box -->
<!-- TODO: Add 'new' dropdown box -->
<!-- TODO: Hide admin modules? -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="nav-sub" class="btn-group">
            <button class="btn btn-small" onclick="javascript:window.open('?m=help&amp;dialog=1&amp;hid=', 'contexthelp', 'width=800, height=600, left=50, top=50, scrollbars=yes, resizable=yes')"><?php echo $AppUI->_('Help'); ?></button>
            <button class="btn btn-small"><a href="./index.php?m=admin&amp;a=viewuser&amp;user_id=<?php echo $AppUI->user_id; ?>"><?php echo $AppUI->_('My Info'); ?></button>
            <?php if (canAccess('tasks')) { ?>
                <button class="btn btn-small"><a href="./index.php?m=tasks&amp;a=todo"><?php echo $AppUI->_('My Tasks'); ?></a></button>
            <?php } ?>
            <?php if (canAccess('calendar')) {
                $now = new w2p_Utilities_Date(); ?>
                <button class="btn btn-small"><a class="button" href="./index.php?m=calendar&amp;a=day_view&amp;date=<?php echo $now->format(FMT_TIMESTAMP_DATE); ?>"><?php echo $AppUI->_('Today'); ?></a></button>
            <?php } ?>
            <a href="./index.php?m=calendar&amp;a=day_view&amp;date=<?php echo $now->format(FMT_TIMESTAMP_DATE); ?>"><button class="btn btn-small"><?php echo $AppUI->_('Today'); ?></button></a>
            <button class="btn btn-small"><a href="./index.php?logout=-1"><?php echo $AppUI->_('Logout'); ?></a></button>
        </div>

<br /><br />

    <div class="std shadow">&nbsp;</div>

        <table width="100%" cellspacing="0" cellpadding="4" border="0">
            <tr>
                <td valign="top" align="left" width="98%">
                    <?php
                        echo $AppUI->getMsg();
                        $AppUI->boxTopRendered = false;
                        if ($m == 'help' && function_exists('styleRenderBoxTop')) {
                            echo styleRenderBoxTop();
                        }
//TODO: Basically this entire file is exactly the same as the other two header.php files in core web2project.. - caseydk 2012-07-01
//die();