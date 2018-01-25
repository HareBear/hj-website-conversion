<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// retrieve all images
		$images = $this->images->newest();

		// Create array of formatted cells for images
		foreach ($images as $image) {
			$cells[] = $this->parser->parse('_cell', (array) $image, true);
		}

		// Load table class with parameters
		$this->load->library('table');
		$params = array(
			'table_open' => '<table class="gallery"',
			'cell_start' => '<td class="oneimage">',
			'cell_alt_start' => '<td class="oneimage">'
		);	
		$this->table->set_template($params);

		// Generate table
		$rows = $this->table->make_columns($cells, 3);

		$this->data['thetable'] = $this->table->generate($rows);
		$this->data['pagebody'] = 'welcome';
		
		$this->render(); 
	}

}
