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
$lottie = rex_addon::get('lottie');
if (rex::isBackend() && is_object(rex::getUser())) {

    // change list of allowed mime types for mediapool
    if ($lottie->getConfig('mediapool_allow_json_upload') == 1) {
        rex_mediapool::setAllowedMimeTypes([
            ...rex_mediapool::getAllowedMimeTypes(),
            'json' => ['application/json', 'text/plain'],
        ]);
    }

    rex_view::addJsFile($lottie->getAssetsUrl('vendor/lottie/lottie-player.js'));
    // Alle json Files als Lotties behandeln
    if(rex_addon::get('lottie')->getConfig('overall') == 1) {
        // Detail-Ansicht der Media-File
        rex_extension::register('MEDIA_DETAIL_SIDEBAR', 'lottie_mediapool::show_sidebar');
        // Listenansicht der Media-Files
        if(rex_addon::get('lottie')->getConfig('media_list_thumbnail') == 1) {
            rex_extension::register('MEDIA_LIST_THUMBNAIL', 'lottie_mediapool::show_list_functions');
        }
    }
    //Current Kat
    $ckat = rex_media_category::get(rex_request('rex_file_category', 'int', rex_session('media[rex_file_category]', 'int')));

    if(is_object($ckat)) {
        $ckatId = $ckat->getId();
    } else {
        $ckatId = 0; // Damit bei Media-Root-Kategorien kein undefined index kommt
    }
    // Nur fuer die ausgewaehlten Media-Kategorien json-Files als Lotties behandeln
    if($lottie->getConfig('categories')) {
        /* Nur wenn es auch Werte in der Config gibt, PHP 8 wirft sonst einen
        * Whoops, PHP 7 gibt ne Warning
        */
        if ($lottie->getConfig('overall') == 0 && in_array($ckatId, $lottie->getConfig('categories'))) {
            // Detail-Ansicht der Media-File
            rex_extension::register('MEDIA_DETAIL_SIDEBAR', 'lottie_mediapool::show_sidebar');
            // Listenansicht der Media-Files
            if(rex_addon::get('lottie')->getConfig('media_list_thumbnail') == 1) {
                rex_extension::register('MEDIA_LIST_THUMBNAIL', 'lottie_mediapool::show_list_functions');
            }
        }
    }
}

if (rex::isFrontend() && $lottie->getConfig('frontend_include') == 1) {
    rex_extension::register('OUTPUT_FILTER', function (rex_extension_point $ep) {
        $search = ['</head>'];
        $replace = ['<script src="' . rex_addon::get('lottie')->getAssetsUrl('vendor/lottie/lottie-player.js') . '"></script></head>'];
        $ep->setSubject(str_replace($search, $replace, $ep->getSubject()));
    }, rex_extension::LATE);
}
