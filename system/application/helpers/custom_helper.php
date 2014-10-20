<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getNavBrand'))
{
    function getNavBrand($url = "")
    {
        $CI =& get_instance();
        $CI->load->config("site");
        if(!empty($CI->config->item("logo_url"))) {
          return "<a class='navbar-brand' id='logo' href=" . base_url() . $url . ">
                    <img src='" . $CI->config->item("logo_url") . "'/>
                  </a>";
        }
        elseif(!empty($CI->config->item("logo_text"))) {
          return "<a class='navbar-brand' href=" . base_url() . $url . ">"
                   . $CI->config->item("logo_text") . 
                  "</a>";
        }
        else {
          return "<a class='navbar-brand' href=" . base_url() . $url . ">Untitled</a>";;
        }
    }   
}

if ( ! function_exists('getFooterContent'))
{
    function getFooterContent()
    {
        $CI =& get_instance();
        $CI->load->config("site");
        if(!empty($CI->config->item("footer_text"))) {
          return $CI->config->item("footer_text");
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
        if(!empty($CI->config->item("default_title"))) {
          return $CI->config->item("default_title");
        }
        else {
          return "";
        }
    }   
}