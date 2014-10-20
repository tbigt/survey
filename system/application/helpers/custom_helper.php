<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getNavBrand'))
{
    function getNavBrand($url = "")
    {
        $CI =& get_instance();
        $CI->load->config("site");
        $logo_url = $CI->config->item("logo_url");
        $logo_text = $CI->config->item("logo_text");
        if(!empty($logo_url)) {
          return "<a class='navbar-brand' id='logo' href=" . base_url() . $url . ">
                    <img src='" . $logo_url . "'/>
                  </a>";
        }
        elseif(!empty($logo_text)) {
          return "<a class='navbar-brand' href=" . base_url() . $url . ">"
                   . $logo_text . 
                  "</a>";
        }
        else {
          return "<a class='navbar-brand' href=" . base_url() . $url . ">Untitled</a>";
        }
    }   
}

if ( ! function_exists('getFooterContent'))
{
    function getFooterContent()
    {
        $CI =& get_instance();
        $CI->load->config("site");
        $footer_text = $CI->config->item("footer_text");
        if(!empty($footer_text)) {
          return $footer_text;
        }
        else {
          return "";
        }
    }   
}

if ( ! function_exists('getDefaultTitle'))
{
    function getDefaultTitle()
    {
        $CI =& get_instance();
        $CI->load->config("site");
        $default_title = $CI->config->item("default_title");
        if(!empty($default_title)) {
          return $default_title;
        }
        else {
          return "Untitled";
        }
    }   
}