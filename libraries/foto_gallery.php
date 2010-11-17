<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Photogallery
 *
 * Allows images to be shown in a gallery
 *
 * @package	MojoMotor
 * @subpackage	Addons
 * @author	Tiziano
 */
class Foto_gallery
{
	public $mojo;
	public $display_name  = 'Photo-Gallery';
	public $addon_version = '1.0';

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{		
		$this->mojo =& get_instance();
	}

	// --------------------------------------------------------------------

	public function gallery($data = array())
	{
	  	$image_dir 	= $this->getParameter($data,'imagedir');
	  	
	  	if( $image_dir== FALSE)
	  	{
	  		$image_dir= $filename;
	  	}
		
		$files1 = scandir($image_dir.'pics/');
		$files2 = array();
		
		foreach ($files1 as $value)
		{
			 if ($value != "." && $value != "..") 
			 {
			 	  $files2[] = $value;
			 }	    
		}		
		
		$rows = 1 + ( count($files2) / 5);
		$result = '<table class="adminlinks">';

		for ($tr = 0; $tr < $rows; $tr++)
		{
			$result.='<tr>';
								
			for($i  = 0 ; $i < 5; $i++)
			{
				$file = $tr * 5 + $i;
				if($file < count($files2))
				{
					$result.='<td>';
					$result.='<div class="photo">';
					$result.='<a rel="shadowbox[consolato];options={slideshowDelay:3}" href="/'.$image_dir.'pics/'.$files2[$file].'">';
					$result.='<img class="gal" src="/'.$image_dir.'tmb/'.$files2[$file].'"/>'; 
					$result.='</a>';
					$result.= '</div>';
					$result.= '</td>';	
				}						
			}
			$result.='</tr>';
		}
				
		$result .= '</table>';

        return $result;
	}

	private function getParameter($data,$parameter="")
	{
		if (isset( $data['parameters'][$parameter])) 
		{
			return trim($data['parameters'][$parameter]);			
		}
		else
		{
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
}

/* End of file show.php */
/* Location: system/mojomotor/third_party/downloads/libraries/downloads.php */