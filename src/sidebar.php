<?php
/**
 * Template :: Sidebar
 */

$data = array();
$data['dynamic_sidebar'] = Timber::get_widgets('dynamic_sidebar');
Timber::render(array('sidebar.twig'), $data);
