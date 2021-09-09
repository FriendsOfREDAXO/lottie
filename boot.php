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
    rex_view::addJsFile($lottie->getAssetsUrl('vendor/lottie/lottie-player.js'));

    // Alle json Files als Lotties behandeln
    if(rex_addon::get('lottie')->getConfig('overall') == 1) {
        // Detail-Ansicht der Media-File
        rex_extension::register('MEDIA_DETAIL_SIDEBAR', 'lottie_mediapool::show_sidebar');
        // Listenansicht der Media-Files
        // (klappt noch nicht)
        // rex_extension::register('MEDIA_LIST_FUNCTIONS', 'lottie_mediapool::show_list_functions');
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
            rex_extension::register('MEDIA_DETAIL_SIDEBAR', 'lottie_mediapool::show_sidebar');
        }
    }
}
