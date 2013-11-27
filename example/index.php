<?php 
	$dir = dirname(__FILE__);
	include ('../Tash.php');
	$tash = new Tash("$dir/templates/");
	
	$data = json_decode(file_get_contents("$dir/example_data.json"),true);

	if (isset($_GET['page']))
		$page = $data['pages'][$_GET['page']];	
	else
		$page = $data['pages']['Home'];
	
	$data['pages'][$page['name']]['on_page']='true';
	
	if ($page['name'] == 'Home'){
		$page['demo'] = str_replace(
			array('<','>',"\t"),
			array('&lt;','&gt;','  '),
			file_get_contents('../Tash.php'));
	}elseif ($page['name'] == 'Escaped Partials'){
		$examples = file_get_contents("$dir/templates/js/on_page.html.tash");
		$examples .= file_get_contents("$dir/templates/js/html_in_js_string.html.tash");
		$examples .= file_get_contents("$dir/templates/js/sub_file.html.tash");
		$page['demo'] = str_replace(
			array('<','>',"\t"),
			array('&lt;','&gt;','  '),
			$examples);
	}
	echo $tash->render_file('head.html',$data);
	echo $tash->render_file('page.html',$page);
	echo $tash->render_file('foot.html',$data);
?>