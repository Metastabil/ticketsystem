<?php
/*
 * The documentation for this helper can be found in documentation/helpers/FormHelper.md
 */

class FormHelper {
    public static function is_form_submitted(string $type = 'post') :bool {
        if (strtolower($type) === 'post') {
            $submitted = isset($_POST) && !empty($_POST);
        }
        elseif (strtolower($type) === 'get') {
            $submitted = isset($_GET) && !empty($_GET);
        }
        else {
            if (ApplicationHelper::is_development()) {
                echo 'Error: ' . LANG['DevelopmentErrors']['FormHelper']['IsFormSubmitted']['UnknownType'];
                exit();
            }
            else {
                ApplicationHelper::redirect_to_error();
                exit();
            }
        }

        return $submitted;
    }

    public static function build_input(array $input) :string {
        $html = '';
        $html .= '<input ';
        $html .= empty($input['type']) ? '' : 'type="' . $input['type'] . '" ';
        $html .= empty($input['name']) ? '' : 'name="' . $input['name'] . '" ';
        $html .= empty($input['ids']) ? '' : 'id="' . $input['ids'] . '" ';
        $html .= empty($input['classes']) ? '' : 'class="' . $input['classes'] . '" ';
        $html .= empty($input['title']) ? '' : 'title="' . ApplicationHelper::make_string_safe($input['title']) . '" ';
        $html .= empty($input['placeholder']) ? '' : 'placeholder="' . ApplicationHelper::make_string_safe($input['placeholder']) . '" ';
        $html .= empty($input['maxlength']) ? '' : 'maxlength="' . intval($input['maxlength']) . '" ';
        $html .= empty($input['autocomplete']) ? '' : 'autocomplete="' . $input['autocomplete'] . '" ';
        $html .= empty($input['value']) ? '' : 'value="' . ApplicationHelper::make_string_safe($input['value']) . '" ';
        $html .= empty($input['disabled']) ? '' : 'disabled ';
        $html .= empty($input['required']) ? '' : 'required ';
        $html .= empty($input['readonly']) ? '' : 'readonly ';
        $html .= '/>';

        return $html;
    }

    public static function build_select(array $select) :string {
        $selected = (empty($select['selected'])) ? '' : $select['selected'];
        $html = '';
        $html .= '<select ';
        $html .= empty($select['name']) ? '' : 'name="' . ApplicationHelper::make_string_safe($select['name']) . '" ';
        $html .= empty($select['ids']) ? '' : 'id="' . $select['ids'] . '" ';
        $html .= empty($select['classes']) ? '' : 'class="' . $select['classes'] . '" ';
        $html .= empty($select['disabled']) ? '' : '' . $select['disabled'] . ' ';
        $html .= empty($select['required']) ? '' : '' . $select['required'] . ' ';
        $html .= empty($select['readonly']) ? '' : '' . $select['readonly'] . ' ';
        $html .= '>';

        foreach ($select['options'] as $option) {
            $value = empty($option['value']) ? '' : $option['value'];
            $html .= '<option ';
            $html .= empty($option['value']) ? 'value="0"' : 'value="' . $option['value'] . '" ';
            $html .= $selected == $option['value'] ? 'selected ' : '';
            $html .= '>';
            $html .= empty($option['text']) ? 'TEXT' : ApplicationHelper::make_string_safe($option['text']);
        }

        $html .= '</select>';

        return $html;
    }

    public static function build_button(array $button) :string {
        $html = '';

        if (strtolower($button['type']) === 'link') {
            $html .= '<a ';
            $html .= empty($button['link']) ? '' : 'href="' . $button['link'] . '" ';
            $html .= empty($button['title']) ? '' : 'title="' . ApplicationHelper::make_string_safe($button['title']) . '" ';
            $html .= empty($button['ids']) ? '' : 'id="' . $button['ids'] . '" ';
            $html .= empty($button['classes']) ? '' : 'class="' . $button['classes'] . '" ';
            $html .= '>';
            $html .= empty($button['text']) ? 'TEXT' : ApplicationHelper::make_string_safe($button['text']);
            $html .= '</a>';
        }
        elseif (strtolower($button['type']) === 'button') {
            $html .= '<button ';
            $html .= empty($button['ids']) ? '' : 'id="' . $button['ids'] . '" ';
            $html .= empty($button['classes']) ? '' : 'class="' . $button['classes'] . '" ';
            $html .= '>';
            $html .= empty($button['text']) ? 'TEXT' : ApplicationHelper::make_string_safe($button['text']);
            $html .= '</button>';
        }
        else {
            if (ApplicationHelper::is_development()) {
                echo 'Error: ' . LANG['DevelopmentErrors']['FormHelper']['BuildButton']['UnknownType'];
                exit();
            }
            else {
                ApplicationHelper::redirect_to_error();
                exit();
            }
        }

        return $html;
    }

    public static function build_label(array $label) :string {
        $html = '';
        $html .= '<label ';
        $html .= empty($label['for']) ? '' : 'for="' . $label['for'] . '" ';
        $html .= empty($label['ids']) ? '' : 'id="' . $label['ids'] . '" ';
        $html .= empty($label['classes']) ? '' : 'class="' . $label['classes'] . '" ';
        $html .= '>';
        $html .= empty($label['text']) ? 'LABEL TEXT' : ApplicationHelper::make_string_safe($label['text']);
        $html .= '</label>';

        return $html;
    }
}