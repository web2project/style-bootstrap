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
//TODO: check count before drawing anything


        $s .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';

        $s .= '<tr><td>';
        $s .= '<ul class="nav nav-tabs" style="margin-bottom: 0">';
        foreach ($this->tabs as $k => $v) {
            $class = ($k == $this->active) ? 'class="active"' : '';

            $s .= '<li ' . $class . '><a href="';
            if ($this->javascript) {
                $s .= 'javascript:' . $this->javascript . '(' . $this->active . ', ' . $k . ')';
            } elseif ($js_tabs) {
                $s .= 'javascript:show_tab(' . $k . ')';
            } else {
                $s .= $this->baseHRef . 'tab=' . $k;
            }

            $s .= '">';
            $s .= '&nbsp;' . $AppUI->_($v[1]) . '&nbsp;';
            $s .= '</li>';
        }
        $s .= '</ul>';
        $s .= '</td></tr>';

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
    $ret = '<table width="100%">';
    $ret .= '<tr><td><ul class="nav nav-list"><li class="divider"></li></ul></td></tr>';
    $ret .= '</table>';

    return $ret;
}

function styleRenderBoxBottom() {
    $ret = '<table width="100%">';
    $ret .= '<tr><td><ul class="nav nav-list"><li class="divider"></li></ul></td></tr>';
    $ret .= '</table>';

    return $ret;
}