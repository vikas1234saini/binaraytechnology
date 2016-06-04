<?php
class mosPageNav 
{
	/** @var int The record number to start dislpaying from */
	var $limitstart = null;
	/** @var int Number of rows to display per page */
	var $limit 		= null;
	/** @var int Total number of rows */
	var $total 		= null;
	/** @var form name of the requested page */
	var $form_name 	= null;

	function mosPageNav( $total, $limitstart, $limit, $form_name, $k='')
	{
		$this->total 		= (int) $total;
		$this->limitstart 	= (int) max( $limitstart, 0 );
		$this->limit 		= (int) max( floor($limit), 1 );
		$this->k 			= $k;
		$this->form_name 	= $form_name;
		if ($this->limit > $this->total) {
			$this->limitstart = 0;
		}
		if (($this->limit-1)*$this->limitstart > $this->total) {
			$this->limitstart -= $this->limitstart % $this->limit;
		}
	}

	/*** @return string The html for the limit # input box ***/
	function getLimitBox ()
	{
		$limits = array();
		for ($i=5; $i <= 30; $i+=5) {
			//$limits[] = mosHTML::makeOption( "$i" );
		}
		//$limits[] = mosHTML::makeOption( "50" );

		// build the html select list
		//$html = mosHTML::selectList( $limits, 'limit', 'class="inputbox" size="1" onchange="document.$".$this->form_name.".submit();"',
		//'value', 'text', $this->limit );
		$html .= "\n<input type=\"hidden\" name=\"limitstart\" value=\"$this->limitstart\" />";
		$html .= "\n<input type=\"hidden\" name=\"k\" value=\"$this->k\" />";
		return $html;
	}

	/*** Writes the html limit # input box ***/
	function writeLimitBox ()
	{
		echo mosPageNav::getLimitBox();
	}

	function writePagesCounter()
	{
		echo $this->getPagesCounter();
	}

	/*** @return string The html for the pages counter, eg, Results 1-10 of x ***/
	function getPagesCounter()
	{
		$html = '';
		$from_result = $this->limitstart+1;
		if ($this->limitstart + $this->limit < $this->total) {
			$to_result = $this->limitstart + $this->limit;
		} else {
			$to_result = $this->total;
		}
		if ($this->total > 0) {
			$html .= "\nResults " . $from_result . " - " . $to_result . " of " . $this->total;
		} else {
			$html .= "No records found.";
		}
		return $html;
	}

	/*** Writes the html for the pages counter, eg, Results 1-10 of x ***/
	function writePagesLinks()
	{
		echo $this->getPagesLinks();
	}

	/*** @return string The html links for pages, eg, previous, next, 1 2 3 ... x ***/
	function getPagesLinks()
	{
		$html 				= '';
		$displayed_pages 	= 10;
		$total_pages 		= ceil( $this->total / $this->limit );
		$this_page 			= ceil( ($this->limitstart+1) / $this->limit );
		$start_loop 		= (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}
		if ($this_page > 1) {
			$page = ($this_page - 2) * $this->limit;
			$html .= "\n<a href='#beg' title='First page' onclick='javascript: document.".$this->form_name.".limitstart.value=0; document.".$this->form_name.".submit();return false;'>First</a>";
			$html .= "\n&nbsp;&nbsp;<a href='#prev' title='Previous page' onclick='javascript: document.".$this->form_name.".limitstart.value=$page; document.".$this->form_name.".submit();return false;'>Previous</a>&nbsp;&nbsp;";
		} else {
			$html .= "<span class='pagenav'><font style='color:#CCCCCC'>First &nbsp;&nbsp; Previous &nbsp;&nbsp;</font></span>";
		}

		for ($i=$start_loop; $i <= $stop_loop; $i++){
			$page = ($i - 1) * $this->limit;
			if ($i == $this_page) {
				$html .= "\n<span><font style='border:1px solid;background-color:#CC9900;border-color:#000000;color:#FFFFFF;'>&nbsp;<b>$i</b>&nbsp;</font></span>";
			} else {
				$html .= "\n<a href='#$i' onclick='javascript: document.".$this->form_name.".limitstart.value=$page; document.".$this->form_name.".submit();return false;'><strong>$i</strong></a>";
			}
		}

		if ($this_page < $total_pages) {
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;
			$html .= "\n&nbsp;&nbsp;<a href='#next' title='Next page' onclick='javascript: document.".$this->form_name.".limitstart.value=$page; document.".$this->form_name.".submit();return false;'>Next</a>&nbsp;&nbsp;";
			$html .= "\n<a href='#end' class='pagenav' title='Last page' onclick='javascript: document.".$this->form_name.".limitstart.value=$end_page; document.".$this->form_name.".submit();return false;'>Last</a>";
		} else {
			$html .= "\n<span class=\"pagenav\"><font style='color:#CCCCCC'>&nbsp;&nbsp; Next &nbsp;&nbsp; Last</font></span>";
		}
		return $html;
	}

	function getListFooter()
	{
		global $limit;
		$display='Displaying';	
		if($this->getPagesCounter()=='No records found.'){
			$display='';
		}
				$html=' <div id="bottom-links">'.$this->getLimitBox().'<div style="float: left;"><span>'.$display.' '.$this->getPagesCounter().'</span></div><div style="float: right;">'.$this->getPagesLinks().'</div></div>';

		
//		$html=' <div id="bottom-links">'.$this->getLimitBox().'<div style="float: left;"><strong><span>'.$display.' '.$this->getPagesCounter().'</span><span style="padding-left:150px;">Number of Records: &nbsp;<input type=text" name="limit" id="limit" class="txtbox" size="4" maxlength="5" value="'.$limit.'">&nbsp;<input type="submit" name="submit_go" value="Go" class="btn" onclick="return check_limit(this);"></span></strong></div><div style="float: right;">'.$this->getPagesLinks().'</div></div>';
		/*$html='<div style="float: right;">';
		$html.=	$this->getPagesLinks();
		$html.=$this->getLimitBox();
		$html.=$this->getPagesCounter();
		$html.='</div>';*/
		/*$html = '<table class="adminlist"><tr><th colspan="3">';
		$html .= $this->getPagesLinks();
		$html .= '</th></tr><tr>';
		$html .= '<td nowrap="true" width="48%" align="right">Display #</td>';
		$html .= '<td>' .$this->getLimitBox() . '</td>';
		$html .= '<td nowrap="true" width="48%" align="left">' . $this->getPagesCounter() . '</td>';
		$html .= '</tr></table>';*/
		return $html;
	}
	
	/*** @param int The row index 
	@return int
	*/
	function rowNumber($i)
	{
		return $i + 1 + $this->limitstart;
	}
	/**
	* @param int The row index
	* @param string The task to fire
	* @param string The alt text for the icon
	* @return string
	*/
	function orderUpIcon( $i, $condition=true, $task='orderup', $alt='Move Up')
	{
		if (($i > 0 || ($i+$this->limitstart > 0)) && $condition) {
			return '<a href="#reorder" onClick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'">
				<img src="images/uparrow.png" width="12" height="12" border="0" alt="'.$alt.'">
			</a>';
  		} else {
  			return '&nbsp;';
		}
	}
/**
* @param int The row index
* @param int The number of items in the list
* @param string The task to fire
* @param string The alt text for the icon
* @return string
*/
	function orderDownIcon( $i, $n, $condition=true, $task='orderdown', $alt='Move Down')
	{
		if (($i < $n-1 || $i+$this->limitstart < $this->total-1) && $condition) {
			return '<a href="#reorder" onClick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'">
				<img src="images/downarrow.png" width="12" height="12" border="0" alt="'.$alt.'">
			</a>';
  		} else {
  			return '&nbsp;';
		}
	}

	/**
	 * @param int The row index
	 * @param string The task to fire
	 * @param string The alt text for the icon
	 * @return string
	 */
	function orderUpIcon2( $id, $order, $condition=true, $task='orderup', $alt='#')
	{
		// handling of default value
		if ($alt = '#') {
			$alt = 'Move Up';
		}

		if ($order == 0) {
			$img = 'uparrow0.png';
			$show = true;
		} else if ($order < 0) {
			$img = 'uparrow-1.png';
			$show = true;
		} else {
			$img = 'uparrow.png';
			$show = true;
		};
		if ($show) {
			$output = '<a href="#ordering" onClick="listItemTask(\'cb'.$id.'\',\'orderup\')" title="'. $alt .'">';
			$output .= '<img src="images/' . $img . '" width="12" height="12" border="0" alt="'. $alt .'" title="'. $alt .'" /></a>';

			return $output;
   		} else {
  			return '&nbsp;';
		}
	}

	/**
	 * @param int The row index
	 * @param int The number of items in the list
	 * @param string The task to fire
	 * @param string The alt text for the icon
	 * @return string
	 */
	function orderDownIcon2( $id, $order, $condition=true, $task='orderdown', $alt='#' ) {
		// handling of default value
		if ($alt = '#') {
			$alt = 'Move Down';
		}

		if ($order == 0) {
			$img = 'downarrow0.png';
			$show = true;
		} else if ($order < 0) {
			$img = 'downarrow-1.png';
			$show = true;
		} else {
			$img = 'downarrow.png';
			$show = true;
		};
		if ($show) {
			$output = '<a href="#ordering" onClick="listItemTask(\'cb'.$id.'\',\'orderdown\')" title="'. $alt .'">';
			$output .= '<img src="images/' . $img . '" width="12" height="12" border="0" alt="'. $alt .'" title="'. $alt .'" /></a>';

			return $output;
  		} else {
  			return '&nbsp;';
		}
	}

	/*** Sets the vars for the page navigation template ***/
	function setTemplateVars( &$tmpl, $name = 'admin-list-footer')
	{
		$tmpl->addVar( $name, 'PAGE_LINKS', $this->getPagesLinks() );
		$tmpl->addVar( $name, 'PAGE_LIST_OPTIONS', $this->getLimitBox() );
		$tmpl->addVar( $name, 'PAGE_COUNTER', $this->getPagesCounter() );
	}
}
?>