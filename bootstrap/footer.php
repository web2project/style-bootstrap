<?php /* $Id$ $URL$ */
                    global $a, $AppUI;

                    $links = array();
                    if (canAccess('users')) {
                        $links[] = '<a href="./index.php?m=admin">' . $AppUI->_('User Management') . '</a>';
                    }
                    if (canAccess('system')) {
                        $links[] = '<a href="./index.php?m=system">' . $AppUI->_('System Administration') . '</a>';
                    }
                    ?>
                </td>
            </tr>
        </table>
    <hr />
    <div class="center footer">
        <?php
            echo implode('|' , $links);
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
    <?php echo $AppUI->getTheme()->loadFooterJS(); ?>