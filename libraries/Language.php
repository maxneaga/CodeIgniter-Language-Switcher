<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
* Name:  Language Switcher
*
* Author: Maxim Neaga
*	neagamaxim@gmail.com
*
* Location: https://github.com/maxneaga/CodeIgniter-Language-Switcher/
*
* Created:  12.12.2012
*
* Description:  Tiny language detection/selection library for CodeIgniter.
*
*/

class Language {
    // Array of languages supported by the website
    private $langs = array();

    // Full name of the browser's language (for example 'emglish')
    private $browser_lang;
    
    // Full name of the user's language, as set in the session
    private $user_lang;
    
    private $CI;


    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
    
        $this->langs = array(
	        'en' => 'english',
	        'ru' => 'russian',
	        'ro' => 'romanian'
	    );
	    
	    $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	    
	    // Check if the browser's language is supported
	    // If not, use site default laguage
	    if (array_key_exists($browser_lang, $this->langs))
	    {
	        $this->browser_lang = $this->langs[substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)];
        }
        else
        {
            $this->browser_lang = $this->CI->config->item('language');
        }
        
        // Set the browser language by default if the user has not set otherwise
        $this->set_default();
    }
    
    
    /**
     * Check if the user has no language preference 
     * Set browser language by default.
     **/
    private function set_default()
    {
        $this->user_lang = $this->CI->session->userdata('lang');
        
        if (!$this->user_lang)
        {
            $this->CI->session->set_userdata(array('lang' => $this->browser_lang));
            $this->user_lang = $this->browser_lang;
        }
    }
    
    
    /**
     * Return the user's language preference 
     *
     * @return      string
     **/
    public function get()
    {
        // Make sure that the session value is valid
        if (in_array($this->user_lang, $this->langs))
        {
            return $this->user_lang;
        }
        else // if value is invalid => return site default laguage
        {
            return $this->CI->config->item('language');
        }
    }
    
    
     /**
     * Set the user's language preference
     *
     * @param       $lang       shorthang language preference (ex: 'en')
     *
     * @return      bool
     **/
    public function set($lang)
    {
        // Make sure that the session value is valid => set the session value
        if (array_key_exists($lang, $this->langs))
        {
            $this->CI->session->set_userdata(array('lang' => $this->langs[$lang]));
            return true;
        }
        else // if value is invalid => return site default laguage
        {
            return false;
        }
    }
}

/* End of file Language.php */
