# FormHelper #
The form helper class is a helper class which provides useful methods
to work with forms. The file is located in `helpers/Form.helper.php`. You
can call methods from this class like this: `FormHelper::MethodName();`.

## Methods ##
### is_form_submitted(string $type) :bool ###
This method checks if a form was submitted. You can pass this method a submit
type. Possible are "post" and "get", but if you don't pass a type the 
default type is set to "post". If the form was submitted the method returns
`true` and if it wasn't it returns `false`.

### build_input(array $input) :string ###
This method build you a single HTML input tag with the params you've passed
the method in an array. It returns a string which can be echoed.

**Array Example**
```
$input = [
    'type' => 'input-type',                 
    'name' => 'input-name',
    'ids' => 'input-ids',                   
    'classes' => 'input-classes',           
    'title' => 'input-title',
    'placeholder' => 'input-placeholder',
    'maxlength' => 'input-maxlength',       
    'autocomplete' => 'autocomplete',       
    'value' => 'input-value',
    'disabled' => 'input-status'  ,
    'required' => 'required',
    'readonly' => 'readonly'           
];
```

### build_select(array $array) :string ###
This method build you a single HTML select tag with the params you've passed
the method in an array. It returns a string which can be echoed.

**Array Example**
```
$select = [
    'name' => 'select-name',
    'ids' => 'select-ids',
    'classes' => 'select-classes',
    'selected' => 'selected-option',
    'disabled' => 'disabled',
    'required' => 'required',
    'readonly' => 'readonly',
    'options' => [
        [
            'value' => 'option-value',
            'text' => 'option-text'
        ],
        [
            'value' => 'option-value',
            'text' => 'option-text' 
        ]
    ]
];
```
If you want a select without any pre-selected option the option `select`
must be empty.

### build_button(array $button) :string ###
This method build you a single HTML button or a tag with the params 
you've passed the method in an array. It returns a string which can 
be echoed.

**Array Example**
```
$button = [
    'type' => 'button-type',
    'name' => 'button-name',
    'link' => 'button-link',
    'title' => 'button-title',
    'text' => 'button-text',
    'ids' => 'button-ids',
    'classes' => 'button-classes'
];
```
The type can be `button` or `link`. Type `button`will result in 
`<button>` and type `link` will result in `<a>`. If you want a
`<button>` the option `link` must be empty.

### build_label(array $label) :string ###
This method build you a HTML label with the params
you've passed the method. It returns a string which can be echoed.

**Array Examples**
```
$label = [
    'for' => 'label-for',
    'text' => 'label-text',
    'classes' => 'label-classes',
    'ids' => 'label-ids'
];
```