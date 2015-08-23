<?php
/**
 * 代码高亮
 * 
 * @package ZzCode
 * @author John.H
 * @version 1.0.0
 * @link http://typecho.org
 */
class ZzCode_Plugin implements Typecho_Plugin_Interface
{
    public static function activate()
    {
        //Typecho_Plugin::factory('Widget_Abstract_Contents')->filter = array('Zzcode_Plugin', 'parse');
        Typecho_Plugin::factory('Widget_Archive')->header = array('Zzcode_Plugin', 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('Zzcode_Plugin', 'footer');
        
        Typecho_Plugin::factory('Widget_Abstract_Contents')->excerpt = array('Zzcode_Plugin', 'parse');
        Typecho_Plugin::factory('Widget_Abstract_Contents')->content = array('Zzcode_Plugin', 'parse');
        
    }
    
    public static function deactivate(){}
    
    public static function config(Typecho_Widget_Helper_Form $form){}
    
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    public static function header($header, $archive)
    {
        $href = '/usr/plugins/ZzCode/google-code-prettify/prettify.css';
        echo '<link rel="stylesheet" type="text/css" media="all" href="' . $href . '" />';
    }
    
    public static function footer($footer, $archive)
    {
        //$js_src         = '/usr/plugins/ZzCode/google-code-prettify/prettify.js';
        $js_src			= 'http://www.gstatic.com/codesite/ph/17848733607936693291/js/prettify/prettify.js';
        $prettify_js    = "
        <script type=\"text/javascript\" src=\"{$js_src}\"></script>
        <script type=\"text/javascript\">if(prettyPrint)prettyPrint();</script>
        ";
        echo $prettify_js;
    }    
    
    public static function parse($text, $widget, $lastResult)
    {
        $text = empty($lastResult) ? $text : $lastResult;

        $text = preg_replace('/(?:<pre>)?\[code\](.*?)\[\/code\](?:<\/pre>)?/is', '<pre class="prettyprint">$1</pre>', $text);
        return $text;
    }
}