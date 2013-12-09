<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sign in &middot; Twitter Bootstrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

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

        <link href="./style/<?php echo $uistyle; ?>/external.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <form class="form-signin" method="post" action="<?php echo $loginFromPage; ?>" name="loginform" accept-charset="utf-8">
                <input type="hidden" name="login" value="<?php echo time(); ?>" />
                <input type="hidden" name="lostpass" value="0" />
                <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />

                <h2 class="form-signin-heading"><?php echo $w2Pconfig['company_name']; ?> login</h2>
                <input type="text" class="input-block-level" name="username" placeholder="username">
                <input type="password" class="input-block-level" name="password" placeholder="password">
                <button class="btn btn-large btn-primary right" type="submit" name="login" value="<?php echo $AppUI->_('login'); ?>">Sign in</button>
                <a href="javascript: void(0);" onclick="f=document.loginform;f.lostpass.value=1;f.submit();"><?php echo $AppUI->_('forgotPassword'); ?></a><br />
                <?php if (w2PgetConfig('activate_external_user_creation') == 'true') { ?>
                    <a href="javascript: void(0);" onclick="javascript:window.location='./newuser.php'"><?php echo $AppUI->_('newAccountSignup'); ?></a>
                <?php } ?><br />
            </form>
        </div> <!-- /container -->
        <?php if ($AppUI->getVersion()) { ?>
            <div align="center">
                <span style="font-size:7pt">Version <?php echo $AppUI->getVersion(); ?></span>
            </div>
        <?php } ?>
        <div align="center">
            <?php
                echo '<span class="error">' . $AppUI->getMsg() . '</span>';

                $msg = '';
                $msg .= (version_compare(PHP_VERSION, MIN_PHP_VERSION, '<')) ? '<br /><span class="warning">WARNING: web2project is NOT SUPPORT for this PHP Version (' . PHP_VERSION . ')</span>' : '';
                $msg .= function_exists('mysql_pconnect') ? '' : '<br /><span class="warning">WARNING: PHP may not be compiled with MySQL support.  This will prevent proper operation of web2Project.  Please check you system setup.</span>';
                echo $msg;
            ?>
        </div>

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="./style/<?php echo $uistyle; ?>/assets/js/jquery.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-transition.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-alert.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-modal.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-dropdown.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-scrollspy.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-tab.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-tooltip.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-popover.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-button.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-collapse.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-carousel.js"></script>
        <script src="./style/<?php echo $uistyle; ?>/assets/js/bootstrap-typeahead.js"></script>
    </body>
</html>