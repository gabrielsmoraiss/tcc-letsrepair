<?php
Form::macro('dateField', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $element = '<div class="datepicker-input input-group date">';
    $element .= Form::text($name, $value ? $value : old($name), field_attributes($name, $attributes));
    $element .= '<span class="input-group-addon">';
    $element .= '<i class="fa fa-calendar"></i>';
    $element .= '</span>';
    $element .= '</div>';

    return field_wrapper($name, $label, $element);
});

Form::macro('currencyField', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $element = Form::text($name, $value ? $value : old($name), field_attributes($name, ['data-currency' => 'true']));

    return field_wrapper($name, $label, $element);
});

Form::macro('textFieldClean', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['placeholder' => $label]);
    $element = Form::text($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return form_group($element, $name);
});

Form::macro('textField', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $element = Form::text($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper($name, $label, $element);
});

Form::macro('textFieldM', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $element = Form::text($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper_float($name, $label, $element);
});

Form::macro('numberFieldClean', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['placeholder' => $label]);
    $element = Form::number($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return form_group($element, $name);
});

Form::macro('numberField', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $element = Form::number($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper($name, $label, $element);
});

Form::macro('numberFieldIcon', function ($name, $label, $content = 'pencil', $end = false, array $attributes = [], $value = NULL) {
    $addon = '<span class="input-group-addon">';
    $addon .= '<span class="fa fa-' . $content . '"></span>';
    $addon .= "</span>";
    $element = Form::number($name, $value ? $value : old($name), field_attributes($name, $attributes));
    $out = '<div class="input-group">';
    $out .= $end ? '' : $addon;
    $out .= $element;
    $out .= $end ? $addon : '';
    $out .= '</div>';

    return field_wrapper($name, $label, $out);
});

Form::macro('numberFieldM', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $element = Form::number($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper_float($name, $label, $element);
});

Form::macro('emailField', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $element = Form::email($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper($name, $label, $element);
});

Form::macro('emailFieldM', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $element = Form::email($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper_float($name, $label, $element);
});

Form::macro('emailFieldClean', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['placeholder' => $label]);
    $element = Form::email($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return form_group($element, $name);
});

Form::macro('passwordField', function ($name, $label = NULL, $attributes = []) {
    $element = Form::password($name, field_attributes($name, $attributes));

    return field_wrapper($name, $label, $element);
});

Form::macro('passwordFieldM', function ($name, $label = NULL, $attributes = []) {
    $element = Form::password($name, field_attributes($name, $attributes));

    return field_wrapper_float($name, $label, $element);
});

Form::macro('passwordFieldClean', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['placeholder' => $label]);
    $element = Form::password($name, field_attributes($name, $attributes));

    return form_group($element, $name);
});

Form::macro('textareaField', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['rows' => 4]);
    $element = Form::textarea($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper($name, $label, $element);
});

Form::macro('textareaFieldM', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['rows' => 4]);
    $element = Form::textarea($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper_float($name, $label, $element);
});

Form::macro('tinymce', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['rows' => 4, 'data-tinymce' => 'true']);
    $element = Form::textarea($name, $value ? $value : old($name), field_attributes($name, $attributes));
    $element .= Form::hidden($name . '_text', $value ? $value : old($name), ['id' => $name . '_text']);

    return field_wrapper($name, $label, $element);
});

Form::macro('fileField', function ($name, $label = NULL, $attributes = []) {
    $element = '<p>' . Form::file($name, field_attributes($name, $attributes, true)) . '</p>';

    return field_wrapper($name, $label, $element);
});

Form::macro('textareaFieldClean', function ($name, $label = NULL, $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['placeholder' => $label, 'rows' => 4]);
    $element = Form::textarea($name, $value ? $value : old($name), field_attributes($name, $attributes));

    return form_group($element, $name);
});

Form::macro('selectFieldClean', function ($name, $label = NULL, $options, $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['placeholder' => $label]);
    $element = Form::select($name, $options, $value ? $value : old($name), field_attributes($name, $attributes));

    return form_group($element, $name);
});

Form::macro('selectizeClean', function ($name, $label = NULL, $options, $attributes = [], $value = NULL) {
    $attributes = array_merge($attributes, ['data-selectize' => 'true', 'placeholder' => $label]);
    $element = Form::select($name, $options, $value ? $value : old($name), field_attributes($name, $attributes));

    return form_group($element, $name);
});

Form::macro('selectize', function ($name, $label = NULL, $options = [], $attributes = [], $value = NULL) {
    $attributes = array_merge($attributes, ['data-selectize' => 'true']);
    $element = Form::select($name, $options, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper($name, $label, $element);
});

Form::macro('selectField', function ($name, $label = NULL, $options = [], $attributes = [], $value = NULL) {
    $element = Form::select($name, $options, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper($name, $label, $element);
});

Form::macro('selectFieldM', function ($name, $label = NULL, $options = [], $attributes = [], $value = NULL) {
    $element = Form::select($name, $options, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper_float($name, $label, $element);
});

Form::macro('imagePickerField', function ($name, $images, $value = NULL) {
    $value = $value ? $value : old($name);
    $element = '<select name="' . $name . '"  class="image-picker show-html">';
    $element .= '<option ' . selected(!$value) . ' value=""></option>';

    foreach($images as $image) {
        $element .= '<option ' . selected($value == $image->id) . '  data-img-src="' . $image->url . '" value="' . $image->id . '"></option>';
    }
    $element .= '</select>';

    return form_group($element, $name);
});

Form::macro('submitBtn', function ($name = 'Enviar', $class = "btn btn-sm btn-success margin-top") {
    $btn = '<button type="submit" class="'. $class .'"> <span class="glyphicon glyphicon-save" aria-hidden="true"></span> ' . $name . ' </button>';

    return form_group($btn);
});

Form::macro('selectMultipleField', function ($name, $label = NULL, $options = [], $attributes = [], $value = NULL) {
    $attributes = array_merge($attributes, ['multiple' => true]);
    $element = Form::select($name . '[]', $options, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper_float($name, $label, $element);
});

Form::macro('selectMultipleFieldM', function ($name, $label = NULL, $options = [], $attributes = [], $value = NULL) {
    $attributes = array_merge($attributes, ['multiple' => true]);
    $element = Form::select($name . '[]', $options, $value ? $value : old($name), field_attributes($name, $attributes));

    return field_wrapper_float($name, $label, $element);
});

Form::macro('selectMultipleFieldClean', function ($name, $label = NULL, $options = [], $value = NULL, $attributes = []) {
    $attributes = array_merge($attributes, ['placeholder' => $label]);
    $attributes = array_merge($attributes, ['multiple' => true]);
    $element = Form::select($name . '[]', $options, $value ? $value : old($name), field_attributes($name, $attributes));

    return form_group($element, $name);
});

Form::macro('radioInlineM', function ($name, $label = NULL, array $options, $checked = NULL, $attributes = []) {

    $out = $label ? '<label for="' . $name . '"> ' . $label . '</label>' : '';
    $values = array_keys($options);

    $out .= '<div class="">';
    foreach($values as $value) {
        $out .= '<label style="padding-right: 20px;" class="">';
        $out .= Form::radio($name, $value, $checked ? $checked == $value : old($name) == $value , $attributes) . $options[$value];
        $out .= '</label>';
    }
    $out .= '</div>';
    return form_group($out, $name);
});

Form::macro('radioInline', function ($name, $label = NULL, array $options, $checked = NULL, $attributes = []) {

    $out = $label ? '<label for="' . $name . '">' . $label . '</label>' : '';
    $values = array_keys($options);

    $out .= '<div class="radio">';
    foreach($values as $value) {
        $out .= '<label class="radio-inline">';
        $out .= Form::radio($name, $value, $checked ? $checked == $value : old($name) == $value , $attributes) . $options[$value];
        $out .= '</label>';
    }
    $out .= '</div>';
    return form_group($out, $name);
});

Form::macro('radioStack', function ($name, $label = NULL, array $options, $checked = NULL, $attributes = []) {

    $out = $label ? '<label for="' . $name . '">' . $label . '</label>' : '';
    $values = array_keys($options);

    foreach($values as $value) {
        $out .= '<div class="radio">';
        $out .= '<label>';
        $out .= Form::radio($name, $value, $checked ? $checked == $value : old($name) == $value , $attributes) . $options[$value];
        $out .= '</label>';
        $out .= '</div>';
    }
    return form_group($out, $name);
});

Form::macro('checkboxField', function ($name, $label = NULL, $value = 1, $checked = NULL, $attributes = []) {

    $out = '<div class="checkbox';
    $out .= field_error($name) . '">';
    $out .= '<label>';
    $out .= Form::checkbox($name, $value, $checked ? $checked : old($name), $attributes) . $label;
    $out .= '</div>';

    return $out;
});

Form::macro('delete', function ($route, $id, $text = '', $tooltip = false, $icon = true) {
    $model = explode('.', $route);
    $model = ucfirst(substr($model[1], 0, -1));
    $tooltip = $tooltip ? $tooltip : 'Deletar ' . $model;

    $out = Form::open(['route' => [$route . '.destroy', $id], 'method' => 'DELETE', 'data-id' => $id, 'style' => 'display: inline-block']);
    $out .= '<button data-toggle="tooltip" data-placement="top" data-original-title="' . $tooltip . '" type="submit" data-id="' . $id . '" class="btn btn-danger btn-sm ' . ($icon ? 'btn-fw' : '') . '">';
    $out .= $icon ? '<i class="fa fa-times"></i> &nbsp;' . $text : $text;
    $out .= '</button>';
    $out .= Form::close();
    return $out;
});

Form::macro('undelete', function ($route, $id, $text = '', $tooltip = false) {
    $model = explode('.', $route);
    $model = ucfirst(substr($model[1], 0, -1));
    $tooltip = $tooltip ? $tooltip : 'Reativar ' . $model;
    $out = Form::open(['route' => [$route . '.undestroy', $id], 'method' => 'PUT', 'data-confirm' => $id . '-ativar', 'style' => 'display: inline-block']);
    $out .= '<button data-toggle="tooltip" data-placement="top"
        data-original-title="' . $tooltip . '" type="submit" data-confirm="' . $id . '-ativar" class="btn btn-warning btn-fw btn-sm">';
    $out .= '<i class="fa fa-undo"></i> &nbsp;' . $text;
    $out .= '</button>';
    $out .= Form::close();
    return $out;
});


Form::macro('edit', function ($route, $id, $text = '', $tooltip = false) {
    $model = explode('.', $route);
    $model = ucfirst(substr($model[1], 0, -1));
    $tooltip = $tooltip ? $tooltip : 'Editar ' . $model;

    $out = '<a data-toggle="tooltip" data-placement="top" data-original-title="' . $tooltip . '" href="' . route($route . '.edit', $id) . '" class="btn btn-fw btn-success btn-sm">';
    $out .= '<i class="fa fa-pencil"></i> &nbsp;' . $text;
    $out .= '</a>';
    return $out;
});


HTML::macro('dataBr', function ($data_from_bd) {
    return Carbon\Carbon::createFromFormat('Y-m-d', $data_from_bd)->format('d/m/Y');
});

HTML::macro('cancel', function ($route, $title = 'Cancelar', $tooltip = '') {
    $out = '<a href="' . route($route . '.index') . '" class="btn btn-info btn-sm">';
    $out .= $title;
    $out .= '</a>';
    return $out;
});

HTML::macro('details', function ($route, $id, $title = '', $tooltip = false) {
    $model = explode('.', $route);
    $model = ucfirst(substr($model[1], 0, -1));
    $tooltip = $tooltip ? $tooltip : 'Ver ' . $model;

    $out = '<a href="' . route($route . '.show', [$id]) . '" class="btn btn-fw btn-info btn-sm" data-toggle="tooltip" data-original-title="' . $tooltip . '">';
    $out .= '<i class="fa fa-info-circle"></i> &nbsp;' . $title;
    $out .= '</a>';
    return $out;
});

HTML::macro('pageHeader', function ($name) {
    $out = '<header class="page-header">';
    $out .= '<h1>' . $name . '</h1>';
    $out .= '</header>';
    return $out;
});

HTML::macro('currency', function ($number, $prefix = 'R$ ') {
    return $prefix . number_format($number, 2, ',', '.');
});

Form::macro('inputGroup', function ($name, $label, $end = false, $icon, $content, array $attributes = [], $value = NULL) {
    $addon = '<span class="input-group-addon">';
    $addon .= $icon ? '<span class="fa fa-' . $content . '"></span>' : $content;
    $addon .= "</span>";
    $element = Form::text($name, $value ? $value : old($name), field_attributes($name, $attributes));
    $out = '<div class="input-group">';
    $out .= $end ? '' : $addon;
    $out .= $element;
    $out .= $end ? $addon : '';
    $out .= '</div>';

    return field_wrapper($name, $label, $out);
});

Form::macro('textFieldIcon', function ($name, $label, $content = 'pencil', $end = false, array $attributes = [], $value = NULL) {
    $addon = '<span class="input-group-addon">';
    $addon .= '<span class="fa fa-' . $content . '"></span>';
    $addon .= "</span>";
    $element = Form::text($name, $value ? $value : old($name), field_attributes($name, $attributes));
    $out = '<div class="input-group">';
    $out .= $end ? '' : $addon;
    $out .= $element;
    $out .= $end ? $addon : '';
    $out .= '</div>';

    return field_wrapper($name, $label, $out);
});

Form::macro('textFieldIconClean', function ($name, $label = NULL, $content = 'pencil', $end = false, array $attributes = [], $value = NULL) {
    $addon = '<span class="input-group-addon">';
    $addon .= '<span class="fa fa-' . $content . '"></span>';
    $addon .= "</span>";
    $attributes = array_merge($attributes, ['placeholder' => $label]);
    $element = Form::text($name, $value ? $value : old($name), field_attributes($name, $attributes));
    $out = '<div class="input-group">';
    $out .= $end ? '' : $addon;
    $out .= $element;
    $out .= $end ? $addon : '';
    $out .= '</div>';

    return field_wrapper($name, $out, '');
});


Form::macro('emailFieldIcon', function ($name, $label, $content = 'envelope', $end = false, array $attributes = [], $value = NULL) {
    $addon = '<span class="input-group-addon">';
    $addon .= '<span class="fa fa-' . $content . '"></span>';
    $addon .= "</span>";
    $element = Form::email($name, $value ? $value : old($name), field_attributes($name, $attributes));
    $out = '<div class="input-group">';
    $out .= $end ? '' : $addon;
    $out .= $element;
    $out .= $end ? $addon : '';
    $out .= '</div>';

    return field_wrapper($name, $label, $out);
});

Form::macro('emailFieldIconClean', function ($name, $label = NULL, $content = 'envelope', $end = false, array $attributes = [], $value = NULL) {
    $addon = '<span class="input-group-addon">';
    $addon .= '<span class="fa fa-' . $content . '"></span>';
    $addon .= "</span>";
    $attributes = array_merge($attributes, ['placeholder' => $label]);
    $element = Form::email($name, $value ? $value : old($name), field_attributes($name, $attributes));
    $out = '<div class="input-group">';
    $out .= $end ? '' : $addon;
    $out .= $element;
    $out .= $end ? $addon : '';
    $out .= '</div>';

    return field_wrapper($name, $out, '');
});

Form::macro('passwordFieldIcon', function ($name, $label, $content = 'lock', $end = false, array $attributes = [], $value = NULL) {
    $addon = '<span class="input-group-addon">';
    $addon .= '<span class="fa fa-' . $content . '"></span>';
    $addon .= "</span>";
    $element = Form::password($name, field_attributes($name, $attributes));
    $out = '<div class="input-group">';
    $out .= $end ? '' : $addon;
    $out .= $element;
    $out .= $end ? $addon : '';
    $out .= '</div>';

    return field_wrapper($name, $label, $out);
});

Form::macro('passwordFieldIconClean', function ($name, $label = NULL, $content = 'lock', $end = false, array $attributes = [], $value = NULL) {
    $addon = '<span class="input-group-addon">';
    $addon .= '<span class="fa fa-' . $content . '"></span>';
    $addon .= "</span>";
    $attributes = array_merge($attributes, ['placeholder' => $label]);
    $element = Form::password($name, field_attributes($name, $attributes));
    $out = '<div class="input-group">';
    $out .= $end ? '' : $addon;
    $out .= $element;
    $out .= $end ? $addon : '';
    $out .= '</div>';

    return field_wrapper($name, $out, '');
});

HTML::macro('modal', function ($id, $title, $msg, $confirm = 'Sim', $close = 'Fechar') {
    $out = '<div class="modal fade" id="' . $id . '">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">' . $title . '</h4>
        </div>
        <div class="modal-body">
        <p> ' . $msg . '</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">' . $close . '</button>
        <button type="button" class="btn btn-warning btn-confirmation">' . $confirm . '</button>
        </div>
        </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> ';
return $out;
});

HTML::macro('modalDelete', function ($model, $msg = NULL, $confirmation = 'Deletar', $close = 'Fechar') {
    $msg = $msg ? $msg : "Tem certeza que deseja excluir este dado?";
    $out = '<div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">' . $confirmation . ' ' . $model . '</h4>
        </div>
        <div class="modal-body">
        <p> ' . $msg . '</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">' . $close . '</button>
        <button type="button" class="btn btn-danger btn-delete">' . $confirmation . '</button>
        </div>
        </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> ';

return $out;
});

HTML::macro('table', function ($fields = [], $data = [], $msg, $resource, $showView = true, $showEdit = true, $showDelete = true) {
    if(!$data->count()) return '<p>' . $msg . '</p>';
    $table = '<table class="table dt-responsive table-bordered table-striped table-condensed table-hover" cellspacing="0" width="100%">';
    $table .= '<thead>';
    $table .= '<tr>';

    foreach(array_keys($fields) as $field) {
        $table .= '<th>' . Str::title($field) . '</th>';
    }

    if($showEdit || $showDelete || $showView)
        $table .= '<th>Gerenciar</th>';

    $table .= '</thead>';
    $table .= '</tr>';

    $table .= '<tbody>';
    foreach($data as $d) {
        $table .= '<tr>';

        foreach(array_values($fields) as $key) {
            $table .= '<td>' . $d->$key . '</td>';
        }

        if($showEdit || $showDelete || $showView) {
            $table .= '<td>';
            if($showView)
                $table .= HTML::details($resource, $d->id, 'Detalhes');
            if($showEdit)
                $table .= Form::edit($resource, $d->id, 'Editar');
            if($showDelete)
                $table .= Form::delete($resource, $d->id, 'Deletar');
            $table .= '</td>';
        }
        $table .= '</tr>';
    }
    $table .= '</tbody>';
    $table .= '</table>';
    return $table;
});


HTML::macro('tableIcon', function ($fields = [], $data = [], $msg, $resource, $showView = true, $showEdit = true, $showDelete = true) {
    if(!$data->count()) return '<p>' . $msg . '</p>';
    $table = '<table class="table table-responsive table-condensed table-bordered table-hover">';
    $table .= '<thead>';
    $table .= '<tr>';

    foreach(array_keys($fields) as $field) {
        $table .= '<th>' . Str::title($field) . '</th>';
    }

    if($showEdit || $showDelete || $showView)
        $table .= '<th>Gerenciar</th>';

    $table .= '</thead>';
    $table .= '</tr>';

    $table .= '<tbody>';
    foreach($data as $d) {
        $table .= '<tr>';

        foreach(array_values($fields) as $key) {
            $table .= '<td>' . $d->$key . '</td>';
        }

        if($showEdit || $showDelete || $showView) {
            $table .= '<td>';
            if($showView)
                $table .= HTML::details($resource, $d->id);
            if($showEdit)
                $table .= Form::edit($resource, $d->id);
            if($showDelete)
                $table .= Form::delete($resource, $d->id);
            $table .= '</td>';
        }
        $table .= '</tr>';
    }
    $table .= '</tbody>';
    $table .= '</table>';
    return $table;
});

HTML::macro('alert', function ($msg, $class = 'success') {
    $class = empty($class) ? 'success' : $class;
    $out = '<div class="alert alert-' . $class . ' alert-dismissible" id="flash" role="alert">';
    $out .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times-circle"></i></button>';
    $out .= $msg;
    $out .= '</div>';

    return $out;
});

HTML::macro('flash', function () {

    $class = Session::get('flash-class') ? Session::get('flash-class') : 'success';
    $out = '<div class="alert alert-' . $class . ' alert-dismissible" id="flash"  role="alert">';
    $out .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times-circle"></i></button>';
    $out .= Session::get('flash-msg');
    $out .= '</div>';

    return Session::has('flash-msg') ? $out : '';

});

HTML::macro('openTable', function () {
    $table = '<table class="table table-responsive table-condensed table-bordered table-hover">';

    return $table;
});

HTML::macro('tableHeader', function ($headers = [], $manage = false) {

    $table = '<thead>';
    $table .= '<tr>';
    foreach($headers as $header)
        $table .= '<th>' . $header . '</th>';
    if($manage)
        $table .= '<th>Gerenciar</th>';
    $table .= '</tr>';
    $table .= '</thead>';

    return $table;
});

HTML::macro('tableBody', function (array $keys, array $data, $resource = NULL, $showView = true, $showEdit = true, $showDelete = true) {

    $table = '<tbody>';
    foreach($data as $d) {
        $table .= '<tr>';
        foreach($keys as $key) {
            $table .= '<td>' . $d->$key . '</td>';
        }
        if($showEdit || $showDelete || $showView) {
            $table .= '<td>';
            if($showView)
                $table .= HTML::details($resource, $d->id);
            if($showEdit)
                $table .= Form::edit($resource, $d->id);
            if($showDelete)
                $table .= Form::delete($resource, $d->id);
            $table .= '</td>';
        }
        $table .= '</tr>';
    }
    $table = '</tbody>';

    return $table;

});

HTML::macro('closeTable', function () {
    $table = '</table>';

    return $table;
});

function active($route, $active = 'active') {
    return Request::is($route) ? $active : '';
}

function active_route($route, $params = [], $active = 'active') {
    return URL::route($route, $params) == Request::url() ? $active : '';
}

function selected($condition) {
    return $condition ? 'selected' : '';
}

function disabled($condition) {
    return $condition ? 'disabled' : '';
}

function errors_msg($field) {
    $errors = Session::get('errors');

    if($errors && $errors->has($field)) {
        $msg = $errors->first($field);
        return '<p class="help-block">' . $msg . '</p>';
    }

    return '';
}

function field_error($field) {
    $error = '';

    if($errors = Session::get('errors')) {
        $error = $errors->first($field) ? ' has-error' : '';
    }

    return $error;
}

function field_label($name, $label) {
    if(is_null($label)) return '';

    $name = str_replace('[]', '', $name);

    $out = '<label for="' . $name . '" class="control-label">';
    $out .= $label . '</label>';

    return $out;
}

function field_attributes($name, $attributes = [], $noClass = false) {
    $name = str_replace('[]', '', $name);

    return array_merge(['class' => $noClass ? '' : 'form-control', 'id' => $name], $attributes);
}

function format_float($string) {
    $string = str_replace('R$ ', '', $string);
    $string = str_replace('.', '', $string);
    $string = str_replace(',', '.', $string);

    return floatval($string);
}

function field_wrapper($name, $label, $element) {
    $out = '<div class="form-group';
    $out .= field_error($name) . '">';
    $out .= field_label($name, $label);
    $out .= $element;
    $out .= errors_msg($name);
    $out .= '</div>';
    return $out;
}

function field_wrapper_float($name, $label, $element) {
    $out = '<div class="form-group label-floating';
    $out .= field_error($name) . '">';
    $out .= field_label($name, $label);
    $out .= $element;
    $out .= errors_msg($name);
    $out .= '</div>';
    return $out;
}

function form_group($element, $name = '') {

    $out = '<div class="form-group';
    $out .= field_error($name) . '">';
    $out .= $element;
    $out .= errors_msg($name);
    $out .= '</div>';

    return $out;
}

function errors() {
    $out = "";

    if(Session::has('errors')) {
        foreach(Session::get('errors') as $error) {
            $out .= '<p class="help-block">' . $error . '</p>';
        }
    }

    return $out;

}

/**
 * Returns a string with the actual Method and Path names of the request
 *
 * @return string
 */
function get_method_path() {
    return Request::method() . ' /' . Request::path();
}

/**
 * Returns the currency formated as brazillian money
 *
 * @return string
 */
function currency_format($number, $prefix = 'R$ ') {
    return $prefix . number_format($number, 2, ',', '.');
}

/**
 * Returns the day of the week translated for the current locale
 * @author SirFlyann
 * @param $day = null (int)
 *
 * @return string
 */
function get_weekdays($day = null, $locale = null) {
    if (!is_null($locale)){
        setlocale(LC_ALL, $locale);
    }
    if(!is_null($day)) {
        return strftime('%A', strtotime('next Monday +' . $day . ' days'));
    } else {
        $days = [];
        // 7 days in a week
        for( $i = 0; $i < 7; $i++ )
        {
            // combine strftime() with the nifty strtotime()
            $days[$i] = strftime( '%A', strtotime( 'next Monday +' . $i . ' days' ) );
        }

        return $days;
    }
}
/** 
 * Sets the App locale to the locale in the Session by the user
 * @author SirFlyann, brunoti
 */
    function restore_locale() {
        App::setlocale(Session::get('lang', 'en-US'));
    }

if (!function_exists('words')) {
    /**
     * Limit the number of words in a string.
     *
     * @param  string  $value
     * @param  int     $words
     * @param  string  $end
     * @return string
     */
    function words($value, $words = 100, $end = '...') {
        return \Illuminate\Support\Str::words($value, $words, $end);
    }
}