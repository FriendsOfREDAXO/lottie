<?php
// ToDo: Introduce Namespace
class lottie_mediapool
{
    public static function show_sidebar(rex_extension_point $ep)
    {
        $params = $ep->getParams();
        $file   = $params['filename'];
        $lottie = new rex_lottie();
        #dump($ep);
        if ($lottie->checkMedia($file)) {
            $media = rex_lottie::outputLottieBackend($file);
            return $media;
        }
    }

  // Hier sollte evtl. noch die Listenansicht im Medienpool folgen, da wird das Media-Thumbnail aber nicht ersetzt.
    public static function show_list_functions(rex_extension_point $ep)
    {
        $params = $ep->getParams();
        $file   = $params['filename'];
        $lottie = new rex_lottie();
        #dump($ep);
        if ($lottie->checkMedia($file)) {
            $media = rex_lottie::outputLottieBackend($file);
            return $media;
        }
    }

}
