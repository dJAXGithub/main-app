<?php
class pager
{
	private $page_number;
	private $elements_per_page;
	private $total_elements;
	private $pager_class;
	private $current_page_class;
	private $pager_text;
	private $pager_separator;
	private $start_element;
	private $end_element;
	private $total_pages;
	private $pager_link_class;
	
	public function pager($page_number, $elements_per_page, $total_elements)
	{
		$this->page_number = $page_number ? $page_number : 1;
		$this->elements_per_page = $elements_per_page;
		$this->total_elements = $total_elements;
		if ($this->page_number)
		{
			$this->start_element = $this->elements_per_page * ($this->page_number - 1);
			$this->end_element = $this->start_element + $this->elements_per_page;
		}
		else
		{
			$this->start_element = 0;
			$this->end_element = $this->elements_per_page;
		}
		if ($this->end_element > $this->total_elements)
		{
			$this->end_element = $this->total_elements;
		}
		$this->total_pages = ceil($this->total_elements / $this->elements_per_page);
	}
	
	public function get_start_element()
	{
		return $this->start_element;
	}
	
	public function get_end_element()
	{
		return $this->end_element;
	}
	
	public function get_total_pages()
	{
		return $this->total_pages;
	}
	
	public function set_pager_class($pager_class)
	{
		$this->pager_class = $pager_class;
	}
	
	public function set_current_page_class($current_page_class)
	{
		$this->current_page_class = $current_page_class;
	}
	
	public function set_pager_text($pager_text)
	{
		$this->pager_text = $pager_text;
	}
	
	public function set_pager_separator($pager_separator)
	{
		$this->pager_separator = $pager_separator;
	}
	
	public function set_pager_link_class($pager_link_class)
	{
		$this->pager_link_class = $pager_link_class;
	}
	
	public function get_pager($form_name, $hidden_field_name, $frame_size = 15)
	{
		if ($this->total_pages > 1)
		{
			if ($this->pager_link_class) $this->pager_link_class = ' class="'.$this->pager_link_class.'"';
			$pager = '<table class="'.$this->pager_class.'" cellspacing="0" width="100%">
			<tr style="height:20px">
			<td width="20%" align="center">
				'.(($this->page_number > 1) ? ('<a'.$this->pager_link_class.' href="#" onclick="return command_submit(\''.$form_name.'\', \''.$hidden_field_name.'\', \''.($this->page_number - 1).'\')">Previous</a>') : '')
			.'</td>
			<td align="center" width="60%">'.$this->pager_text;
			for ($i = 1; $i <= $this->total_pages; $i++)
			{
				if ((int)($this->page_number - $frame_size) < $i && (int)($this->page_number + $frame_size) > $i) {
					if ((!$this->page_number and $i == 1) or $this->page_number == $i)
					{
						if ($this->page_number and $i > 1) {
							$pager .= '&nbsp;'.$this->pager_separator;
						}
						$pager .= '&nbsp;<span class="'.$this->current_page_class.'">'.$i.'</span>';
					}
					else
					{
						if ($this->page_number and $i > 1) {
							$pager .= '&nbsp;'.$this->pager_separator;
						}
						$pager .= '&nbsp;<a'.$this->pager_link_class.' href="#" onclick="return command_submit(\''.$form_name.'\', \''.$hidden_field_name.'\', \''.$i.'\')">'.$i.'</a>';
					}
				}
			}
			$pager .= '</td><td width="20%" align="center">
				'.((($this->page_number * $this->elements_per_page) < $this->total_elements) ? ('<a'.$this->pager_link_class.' href="#" onclick="return command_submit(\''.$form_name.'\', \''.$hidden_field_name.'\', \''.($this->page_number + 1).'\')">Next</a>') : '')
			.'</td></tr></table>';
			return $pager;
		}
	}
	
	public function get_ajax_pager($function_name)
	{
		if ($this->total_pages > 1)
		{
			if ($this->pager_link_class) $this->pager_link_class = ' class="'.$this->pager_link_class.'"';
			$pager = '<table class="'.$this->pager_class.'" cellspacing="0" width="100%">
			<tr style="height:20px">
			<td width="20%" align="center">
				'.(($this->page_number > 1) ? ('<a'.$this->pager_link_class.' href="javascript:'.$function_name.'('.($this->page_number - 1).')" title="Anterior">Anterior</a>') : '')
			.'</td>
			<td align="center" width="60%">'.$this->pager_text;
			for ($i = 1; $i <= $this->total_pages; $i++)
			{
				if ((!$this->page_number and $i == 1) or $this->page_number == $i)
				{
					if ($this->page_number and $i > 1) {
						$pager .= '&nbsp;'.$this->pager_separator;
					}
					$pager .= '&nbsp;<span class="'.$this->current_page_class.'">'.$i.'</span>';
				}
				else
				{
					if ($this->page_number and $i > 1) {
						$pager .= '&nbsp;'.$this->pager_separator;
					}
					$pager .= '&nbsp;<a'.$this->pager_link_class.' href="javascript:'.$function_name.'('.$i.')" title="'.$i.'">'.$i.'</a>';
				}
			}
			$pager .= '</td><td width="20%" align="center">
				'.((($this->page_number * $this->elements_per_page) < $this->total_elements) ? ('<a'.$this->pager_link_class.' href="javascript:'.$function_name.'('.($this->page_number + 1).')" title="Siguiente">Siguiente</a>') : '')
			.'</td></tr></table>';
			return $pager;
		}
	}
}
?>