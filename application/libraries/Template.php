<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Template{
    var $template_data=array();
    function set($name, $value)
    {
        $this->template_data[$name]=$value;
    }
    function load($tempate='',$view='',$view_data=array(),$return=FALSE)
    {
        $this->CI=& get_instance();
        $this->set('content',$this->CI->load->view($view,$view_data,TRUE));
        return $this->CI->load->view($tempate,$this->template_data,$return);
    }
}
