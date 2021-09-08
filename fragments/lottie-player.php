<?php
$json = $this->json;
$options = $this->options;

$out = '<lottie-player class="lottie-player" id="lottie-'.rex_media::get($json)->getId().'" src="/media/'.$json.'" background="transparent" speed="1" style="width: 100%; height: 100%;" '.$options.'></lottie-player>';

echo $out;
?>