<?php /* $Id$ $URL$ */

##
##  This overrides the show function of the CTabBox_core function
##
class CTabBox extends w2p_Theme_TabBox {
	function show($extra = '', $js_tabs = false, $alignment = 'left', $opt_flat = true) {
		global $AppUI, $w2Pconfig, $currentTabId, $currentTabName, $m, $a;
		$this->loadExtras($m, $a);
		$uistyle = $AppUI->getPref('UISTYLE') ? $AppUI->getPref('UISTYLE') : $w2Pconfig['host_style'];
		if (!$uistyle) {
			$uistyle = 'web2project';
		}

		if (($a == 'addedit' || $a == 'view' || $a == 'viewuser') && function_exists('styleRenderBoxBottom')) {
			echo styleRenderBoxBottom();
		}

		reset($this->tabs);
		$s = '';
        if ($extra) {
            echo '<table border="0" cellpadding="2" cellspacing="0" width="100%"><tr>' . $extra . '</tr>' . '</table>';
        }

        // tabbed view
//echo '<pre>'; print_r($this->tabs); echo '</pre>';
        $s .= '<ul class="nav nav-tabs">';
            foreach ($this->tabs as $k => $v) {
                
            }
        $s .= '</ul>';

        $s .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
        $s .= '<tr><td><table align="' . $alignment . '" border="0" cellpadding="0" cellspacing="0"><tr>';

        if (count($this->tabs) - 1 < $this->active) {
            //Last selected tab is not available in this view. eg. Child tasks
            $this->active = 0;
        }
        foreach ($this->tabs as $k => $v) {
            $class = ($k == $this->active) ? 'tabon' : 'taboff';
            $sel = ($k == $this->active) ? 'Selected' : '';
            $s .= '<td id="toptab_' . $k . '" valign="middle" nowrap="nowrap" class="' . $class . '">&nbsp;<a href="';
            if ($this->javascript) {
                $s .= 'javascript:' . $this->javascript . '(' . $this->active . ', ' . $k . ')';
            } elseif ($js_tabs) {
                $s .= 'javascript:show_tab(' . $k . ')';
            } else {
                $s .= $this->baseHRef . 'tab=' . $k;
            }
            $s .= '">' . ($v[2] ? $v[1] : $AppUI->_($v[1])) . '</a>&nbsp;</td>';
        }
        $s .= '</tr></table></td></tr>';

        $s .= '<tr><td width="100%" colspan="' . (count($this->tabs) * 4 + 1) . '" class="tabox">';
        echo $s;
        //Will be null if the previous selection tab is not available in the new window eg. Children tasks
        if (isset($this->tabs[$this->active][0]) && $this->tabs[$this->active][0] != '') {
            $currentTabId = $this->active;
            $currentTabName = $this->tabs[$this->active][1];
            if (!$js_tabs) {
                require $this->baseInc . $this->tabs[$this->active][0] . '.php';
            }
        }
        if ($js_tabs) {
            foreach ($this->tabs as $k => $v) {
                echo '<div class="tab" id="tab_' . $k . '">';
                $currentTabId = $k;
                $currentTabName = $v[1];
                require $this->baseInc . $v[0] . '.php';
                echo '</div>';
                echo '<script language="javascript" type="text/javascript">
                    <!--
                    show_tab(' . $this->active . ');
                    //-->
                    </script>';
            }
        }
        echo '</td></tr></table>';
	}
}

function styleRenderBoxTop() {
	return '';
}

function styleRenderBoxBottom() {
	global $AppUI;
	$uistyle = $AppUI->getPref('UISTYLE') ? $AppUI->getPref('UISTYLE') : w2PgetConfig('host_style');
	if (!$uistyle) {
		$uistyle = 'web2project';
	}
	$ret = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
	$ret .= '<tbody>';
	$ret .= '<tr>';
	$ret .= '	<td valign="top" height="35" style="background:url(./style/' . $uistyle . '/images/shadow_bttm_left_corner.jpg) no-repeat;" align="left">';
	$ret .= '		<img width="19" height="35" alt="" src="./style/' . $uistyle . '/images/shadow_bttm_left_corner.jpg"/>';
	$ret .= '	</td>';
	$ret .= '	<td valign="top" width="100%" style="background: repeat-x url(./style/' . $uistyle . '/images/shadow_bottom.jpg);" align="left">';
	$ret .= '		<img width="19" height="35" alt="" src="./style/' . $uistyle . '/images/shadow_bottom.jpg"/>';
	$ret .= '	</td>';
	$ret .= '	<td valign="top" style="background:url(./style/' . $uistyle . '/images/shadow_bttm_right_corner.jpg) no-repeat;" align="right">';
	$ret .= '		<img width="19" height="35" alt="" src="./style/' . $uistyle . '/images/shadow_bttm_right_corner.jpg"/>';
	$ret .= '	</td>';
	$ret .= '</tr>';
	$ret .= '</tbody>';
	$ret .= '</table>';
	return $ret;
}