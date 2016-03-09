 <div class="mc_metabox">
<?php
$this->upload(	'page_parallax_background_image',
				'Background Image:',
				''
           );
$this->upload(	'page_parallax_background_image_overlay',
				'Overlay Image 1:',
				''
           );
$this->upload(	'page_parallax_background_image_overlay2',
				'Overlay Image 2:',
				''
           );
$this->upload(	'page_parallax_background_image_overlay3',
				'Overlay Image 3:',
				''
           );
$this->upload(	'page_parallax_background_image_overlay4',
				'Overlay Image 4:',
				''
           );
$this->radio(	'page_parallax_image_overlay',
				'Image Overlay Options:',
				array('pattern' => 'Pattern Overlay', 'color_dark' => 'Color Overlay Dark', 'color_primary' => 'Primary Color Overlay', 'color_none' => 'None'),
				''
            );
$this->radio(	'page_parallax_container',
				'Container Type:',
				array('normal' => 'Normal', 'small' => 'Small', 'full' => 'Full'),
				''
            );                       
?> 
</div>