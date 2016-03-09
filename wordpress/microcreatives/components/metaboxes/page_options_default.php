 <div class="mc_metabox">
<?php 
$this->radio(	'page_default_background',
				'Background:',
				array('white' => 'White', 'light_grey' => 'Light Grey', 'light_green' => 'Light Green', 'light_blue' => 'Light Blue'),
				''
            );    
$this->radio(	'page_default_container',
				'Container Type:',
                array('normal' => 'Normal', 'small' => 'Small', 'full' => 'Full'),
				''
            );
?>    
</div>