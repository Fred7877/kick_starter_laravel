# Components
## input
###### Attributes
- type: text, file, hidden, email, password, etc...
- id: Id of the field
- label: Label of the field  
- name: Name of the field  
- value: value of the field   
- placeholder: Placeholder of the field.
- isInputGroup: Display field on group field, true ([see](https://getbootstrap.com/docs/4.0/components/input-group/ "see"))
- isPrepend: if isInputGroup is true, true by default.  
- isAppend: if isInputGroup is true, false by default.  
- class: class of the field, form-control by default.  
- addClass: Allow add classes to the field  
- addGroupClass: Allow add classes to the group fields, see the configuration file components.sizing-form.  
- row: if true, display the label and the field on a row, isInputGroup must be set to false
- disabled: if true, disabled the field

## Select
###### Attributes
- options: Options of the select  
- id: Id of the field
- label: Label of the select  
- name: name of the select
- id: name of the select
- isInputGroup: true ([see](https://getbootstrap.com/docs/4.0/components/input-group/ "see"))
- isPrepend: if isInputGroup is true, true by default.
- isAppend: if isInputGroup is true, false by default.
- class: class of the field, form-control by default.
- addClass: class of the field, form-control by default.
- addGroupClass: Allow add classes to the field
###### optional - used by DualList
- nonSelectedListLabel: can be a string specifying the name of the non selected list.
- selectedListLabel: can be a string specifying the name of the selected list.
- preserveSelectionOnMove: can be 'all' (for selecting both moved elements and the already selected ones in the target list) or 'moved' (for selecting moved elements only)
- moveAllLabel: the label for the "Move All" button.
- removeAllLabel: the label for the "Remove All" button.
- isDualList: show a dual list selection,
- comparingModel: the comparing model for the selected attribut in the option tag,
- methodComparing: method used by the model who compare (ex: hasRole, hasPermissionTo)
- multiple: multiple or single choice
- isSelect2: show a select2 selection,
- size: 10 by default,  indicates the number of lines that should be visible on the screen at the same time

## TextArea
###### Attributes  
- label: Label of the field
- id: Id of the field
- name: Name of the field
- value: value of the field
- class: class of the field, form-control by default.
- addClass: Allow add classes to the field
- addGroupClass: Allow add classes to the group fields, see the configuration file components.sizing-form.  
- => slot : Content of the textarea

## Styling
see config/kick-starter.php  
