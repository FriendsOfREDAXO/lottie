<?php
$addon = rex_addon::get('lottie');
$content = '';
$buttons = '';

// save settings
if (rex_post('formsubmit', 'string') == '1') {
    $configs = [
        ['frontend_include', 'int'],
        ['mediapool_allow_json_upload', 'int'],
        ['media_list_thumbnail', 'int'],
        ['overall', 'int'],
        ['categories', 'array'],
    ];
    $addon->setConfig(rex_post('config', $configs));
    echo rex_view::success($addon->i18n('config_saved'));
}

// lottie-player im Frontend
$content .= '<fieldset id="lottie-frontend-include"><legend>' . $addon->i18n('frontend_include_legend') . '</legend>';
$formElements = [];
$n = [];
$n['label'] = '<label for="frontend-include">' . $addon->i18n('frontend_include_label');
$n['field'] = '<input type="checkbox" id="frontend-include" name="config[frontend_include]" value="1" ' . ($this->getConfig('frontend_include') ? 'checked="checked" ' : '') . ' />';
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');
$content .= '</label>';
$content .= '</fieldset>';

// json-upload erlauben
$content .= '<fieldset id="mediapool-allow-json-fieldset"><legend>' . $addon->i18n('mediapool_allow_json_upload_legend') . '</legend>';
$content .= '<div class="well">';
$content .= $addon->i18n('mediapool_allow_json_description');
$content .= '</div>';
$formElements = [];
$n = [];
$n['label'] = '<label for="mediapool-allow-json">' . $addon->i18n('mediapool_allow_json_upload_label');
$n['field'] = '<input type="checkbox" id="mediapool-allow-json" name="config[mediapool_allow_json_upload]" value="1" ' . ($this->getConfig('mediapool_allow_json_upload') ? 'checked="checked" ' : '') . ' />';
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');
$content .= '</label>';
$content .= '</fieldset>';

// lottie-player in media_list
$content .= '<fieldset id="lottie-media-list-thumbnail"><legend>' . $addon->i18n('media_list_thumbnail_legend') . '</legend>';
$formElements = [];
$n = [];
$n['label'] = '<label for="media_list_thumbnail">' . $addon->i18n('media_list_thumbnail_checkbox_label');
$n['field'] = '<input type="checkbox" id="media_list_thumbnail" name="config[media_list_thumbnail]" value="1" ' . ($this->getConfig('media_list_thumbnail') ? 'checked="checked" ' : '') . ' />';
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');
$content .= '</label>';
$content .= '</fieldset>';


// Overall Json wie Lottie behandeln
$content .= '<fieldset><legend>' . $addon->i18n('config_legend1') . '</legend>';
$formElements = [];
$n = [];
$n['label'] = '<label for="lottie-overall">' . $addon->i18n('overall_checkbox_label') . '</label>';
$select = new rex_select();
$select->setId('lottie-overall');
$select->setAttribute('class', 'form-control selectpicker');
$select->setName('config[overall]');
$select->addOption($addon->i18n('overall_no'), 0);
$select->addOption($addon->i18n('overall_yes'), 1);
$select->setSelected($addon->getConfig('overall'));
$n['field'] = $select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

$content .= '</fieldset>';

// include categories
$content .= '<fieldset id="overall-categories"><legend>' . $addon->i18n('config_legend2') . '</legend>';
$tableSelect = new rex_media_category_select($ignore_offlines = false);
$tableSelect->setName('config[categories][]');
$tableSelect->setId('rex-categories');
$tableSelect->setMultiple();
$tableSelect->setSelected($addon->getConfig('categories'));
$tableSelect->setAttribute('class', 'form-control selectpicker ');
$tableSelect->setAttribute('data-live-search', 'true');
$tableSelect->setSize(10);

$formElements = [];
$n = [];
$n['label'] = '<label for="rex-categories">' . $addon->i18n('media_categories') . '</label>';
$n['field'] = $tableSelect->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

$content .= '</fieldset>';

// save-Button
$formElements = [];
$n = [];
$n['field'] = '<button class="btn btn-save rex-form-aligned" type="submit" name="save" value="' . $addon->i18n('config_save') . '">' . $addon->i18n('config_save') . '</button>';
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');
$buttons = '
<fieldset class="rex-form-action">
    ' . $buttons . '
</fieldset>
';

// print form
$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title', $addon->i18n('settings'));
$fragment->setVar('body', $content, false);
$fragment->setVar('buttons', $buttons, false);
$output = $fragment->parse('core/page/section.php');
$output = '
<form action="' . rex_url::currentBackendPage() . '" method="post">
<input type="hidden" name="formsubmit" value="1" />
    ' . $output . '
</form>
';

echo $output;
?>
<script>
    $(document).on('rex:ready', function() {
        // Initiativ Checken ob ja oder nein
        if( $('#lottie-overall option:selected').val() == 1) {
            $('#overall-categories').hide();
        }
        // Checken ob ja oder nein on change
        $('#lottie-overall').on('change', function() {
            if(this.value == 0){
                $('#overall-categories').show();
            }
            if(this.value == 1){
                $('#overall-categories').hide();
            }
        });
    });
</script>
