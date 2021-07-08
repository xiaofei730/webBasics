<?php
class Smarty
{
    public $template_dir = './templates/';      //默认模板目录
    public $templatec_dir = './templates_c/';   //默认混编目录
    private $tpl_var = array();

    public function assign($k, $v)
    {
        $this->tpl_var[$k] = $v;
    }

    public function display($tpl)
    {
        require $this->compile($tpl);  
    }

    private function compile($tpl)
    {
        $tpl_file = $this->template_dir.$tpl;       //拼接模板地址
        $com_file = $this->templatec_dir.$tpl.'.php';        //混编文件地址
        if (file_exists($com_file) && filemtime($tpl_file) < filemtime($com_file)) {
            return $com_file;       //返回混编地址
        } else {
            $str = file_get_contents($tpl_file);
            $str = str_replace('{$', '<?php echo $this->tpl_var[\'', $str);        //替换左大括号
            $str = str_replace('}', '\']; ?>', $str);            //替换右大括号
            // echo $str;
    
            file_put_contents($com_file, $str);
            return $com_file;
        } 
        
    }
}