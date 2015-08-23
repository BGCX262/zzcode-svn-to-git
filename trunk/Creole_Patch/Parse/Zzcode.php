<?php

/**
 *
 * Parses for preformatted text.
 *
 * @category Text
 *
 * @package Text_Wiki
 *
 * @author Tomaiuolo Michele <tomamic@yahoo.it>
 *
 * @license LGPL
 *
 * @version $Id: Preformatted.php 182 2008-09-14 15:56:00Z i.feelinglucky $
 *
 */

class Text_Wiki_Parse_Zzcode extends Text_Wiki_Parse {


    /**
     *
     * The regular expression used to parse the source text and find
     * matches conforming to this rule. Used by the parse() method.
     *
     * @access public
     *
     * @var string
     *
     * @see parse()
     *
     */

    var $regex = '/\[code\](.*?)\[\/code\]|<pre\sclass="prettyprint">(.*?)<\/pre>/is';

    /**
     *
     * Generates a replacement for the matched text. Token options are:
     *
     * 'text' => The preformatted text.
     *
     * @access public
     *
     * @param array &$matches The array of matches from parse().
     *
     * @return string A token to be used as a placeholder
     * in the source text for the preformatted text.
     *
     */

    function process(&$matches)
    {
        $is_pre  = false;
        $content = '';
        if ( ! empty($matches[1])){
            $is_pre  = false;
            $content = $matches[1];
        }
        elseif ( ! empty($matches[2])){
            $is_pre  = true;
            $content = $matches[2];
        }
        $token = $this->wiki->addToken(
            $this->rule,
            array(
                  'text'        => $matches[0],
                  'content'     => $content,
                  'is_pre'      => $is_pre
                  )
        );
        return "\n\n" . $token . "\n\n";
    }
}
?>
