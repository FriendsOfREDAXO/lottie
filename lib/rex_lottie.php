<?php
/**
 * This file is part of the lottie package.
 *
 * @author (c) Friends Of REDAXO
 * @author <friendsof@redaxo.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class rex_lottie
{
    /**
     * @param string $json
     *
     * @return [lottie output html]
     */
    public static function outputLottieBackend($json): string
    {
        $out = '<lottie-player id="lottie-'.rex_media::get($json)->getId().'" src="/media/'.$json.'"  background="transparent" speed="1" style="width: 100%; height: 100%;" loop autoplay></lottie-player>';
        return $out;
    }

    /**
     * @param string $json
     * @param string $options
     *
     * @return [lottie output html via fragment]
     */
    public static function outputLottie($json, string $options = "loop autoplay"): string
    {
        if(rex_lottie::checkMedia($json)) {
            $fragment = new rex_fragment();
            $fragment->setVar('json', $json, false);
            $fragment->setVar('options', $options, false);
            return $fragment->parse('lottie-player.php');
        }
        return rex_addon::get('lottie')->i18n('wrong_format');
    }

    /**
     * @param mixed $filename
     *
     * @return [boolean]
     */
    public static function checkMedia($filename): bool
    {
        $media = rex_media::get($filename);
        $checkPath = pathinfo($filename);
        if ($media) {
            if (strtolower($checkPath['extension']) == "json") {
                return true;
            }
        }
        return false;
    }

}
