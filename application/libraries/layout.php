<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
    private $CI;
    private $content;

    public function __construct()
    {
        $this->CI = get_instance();
    }
    /**
     * Renvoye une vue dans une template
     * @param string $name : nom de la vue
     * @param string $data : données envoyées à la vue
     */
    public function view($template, $name, $data = array())
    {
        $this->content = $this->CI->load->view($name, $data, true);
        $this->CI->load->view($template, array('content' => $this->content));
    }
    /**
     * Stocke la vue dans une variable
     * @param string $name : nom de la vue
     * @param string $data : données envoyées à la vue
     */
    public function views($name, $data = array())
    {
        $this->content = $this->CI->load->view($name, $data, true);
        return $this;
    }
}
