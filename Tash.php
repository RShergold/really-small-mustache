<?php

class Tash{
	public $template_dir;
	
	public function __construct($template_dir){
		$this->template_dir = $template_dir;
	}
	
	public function render_file($template_name,$params,$escape_type = false){
		$tmplate = file_get_contents($this->template_dir.$template_name.'.tash');
		return $this->escape_file($this->render_text($tmplate,$params),$escape_type);
	}
	public function render_text($tmplate,$params){
		return preg_replace_callback(
			'/{{(\w+)}}|{{{(\w+)}}}|{{#(\w+)}}(.+?){{\/\3}}|{{\d?\>([\w\.\/]+)}}/s',
			function($m) use($params) {
				if (isset($m[1]) && isset($params[$m[1]])) {
					# {{value}}
					return htmlspecialchars($params[$m[1]]);
				}elseif (isset($m[2]) && isset($params[$m[2]])) {
					# {{{value}}}
					return $params[$m[2]];
				}elseif (isset($m[3]) && isset($params[$m[3]])) {
					# {{#value}}
					if(is_array($params[$m[3]])){
						# loop
						return $this->loop_section($m[4],$m[3],$params);
					}else{
						# if
						return $this->render_text($m[4],$params);
					}
				}elseif (isset($m[5])) {
					# {{>template.name}}
					$esc_type = ($m[0][2]!='>' ? (int)$m[0][2] : false);
					return $this->render_file($m[5],$params,$esc_type);
				}
			},
			$tmplate);
	}
	
	private function loop_section($tmplate,$section_key,$params){
		$rtn = '';
		foreach ($params[$section_key] as $section){
			$section_params = array_merge($params,$section);
			$rtn .= $this->render_text($tmplate,$section_params);
		}
		return $rtn;
	}
	
	private function escape_file($file_text,$escape_type){
		if ($escape_type==1){
			return json_encode($file_text);
		}
		return $file_text;
	}
	
}

?>