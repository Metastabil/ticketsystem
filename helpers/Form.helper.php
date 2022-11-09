<?php
class FormHelper {
    public static function is_post_submitted() {
        return (isset($_POST) && !empty($_POST)) ? true : false;
    }

    /*
     * The array must be multidimensional
     *
     * $inputs = [
     *  [
     *      'type' => 'text',
     *      'name' => 'input-name',
     *      'id' => 'input-id',
     *      'title' => 'input-title',
     *      'placeholder' => 'input-placeholder',
     *      'maxlength' => '255',
     *      'class' => 'input-class-1 input-class-2',
     *      'autocomplete' => 'off',
     *      'value' => 'Some Value'
     *  ],
     *  [
     *      'type' => 'text',
     *      'name' => 'input-name',
     *      'id' => 'input-id',
     *      'title' => 'input-title',
     *      'placeholder' => 'input-placeholder',
     *      'maxlength' => '255',
     *      'class' => 'input-class-1 input-class-2',
     *      'autocomplete' => 'off',
     *      'required' => 'required',
     *      'value' => 'Some Value'
     *  ]
     * ];
     */

    /*
     * Currently not available with selects and labels
     * The arrays inputs and buttons must be multidimensional
     */
    public static function build_form($form_information, $inputs, $buttons) {
        $form_string = '';

        /* Exit if given params aren't arrays */
        if (!is_array($form_information) || !is_array($inputs) || !is_array($buttons)) {
            if (ENVIRONMENT === 'development') {
                echo LANG['DevelopmentErrors']['FormHelper']['BuildForm']['NotAnArray'];
                die();
            }
            else {
                ApplicationHelper::redirerct_to_error();
            }
        }

        $action = (empty($form_information['action'])) ? '' : $form_information['action'];
        $method = (empty($form_information['method'])) ? 'POST' : $form_information['method'];
        $form_classes = (empty($form_information['classes'])) ? '' : $form_information['classes'];

        /* Build the form tag */
        $form_string .= "<form action='$action' method='$method' class='$form_classes'>";

        $default_input_type = 'text';
        $default_max_length = 255;

        /* Build the input fields */
        foreach ($inputs as $input) {
            $type = (empty($input['type'])) ? $default_input_type : $input['type'];
            $name = (empty($input['name'])) ? '' : $input['name'];
            $id = (empty($input['id'])) ? '' : $input['id'];
            $title = (empty($input['title'])) ? '' : $input['title'];
            $placeholder = (empty($input['placeholder'])) ? '' : $input['placeholder'];
            $maxlength = (empty($input['maxlength'])) ? $default_max_length : $input['maxlength'];
            $classes = (empty($input['classes'])) ? '' : $input['classes'];
            $autocomplete = (empty($input['autocomplete'])) ? 'on' : $input['autocomplete'];
            $required = (empty($input['required'])) ? '' : 'required';
            $value = (empty($input['value'])) ? '' : $input['value'];

            $form_string .= "<input type='$type' name='$name' id='$id' title='$title' placeholder='$placeholder' maxlength='$maxlength' class='$classes' autocomplete='$autocomplete' value='$value' $required/>";
        }

        /* Build the buttons */
        foreach ($buttons as $button) {
            $type = (empty($button['type'])) ? '' : $button['type'];
            $button_name = (empty($button['name'])) ? '' : $button['name'];
            $link = (empty($button['link'])) ? '' : $button['link'];
            $title = (empty($button['title'])) ? '' : $button['title'];
            $text = (empty($button['text'])) ? '' : $button['text'];
            $button_classes = (empty($button['classes'])) ? '' : $button['classes'];

            if ($type === 'button') {
                $form_string .= "<button name='$button_name' title='$title' class='$button_classes'>$text</button>";
            }
            elseif ($type === 'link') {
                $form_string .= "<a href='$link' name='$name' title='$title' class='$button_classes'>$text</a>";
            }
        }

        $form_string .= '</form>';

        return $form_string;
    }
}