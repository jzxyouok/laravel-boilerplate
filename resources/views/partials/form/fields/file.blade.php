@if(!isset($attributes))
    @php($attributes = [])
@endif
@if (isset($required))
    @php($attributes += ['required'])
    @php($rules = isset($rules) ? "required|$rules" : 'required')
@endif
@if (isset($rules))
    @php($attributes += ['v-validate' => "'$rules'"])
@endif
@if (isset($tooltip))
    @php($attributes += ['data-toggle' => 'tooltip', 'data-placement' => $tooltip['position'], 'title' => $tooltip['title']])
@endif

{{ Form::file($name, ['id' => $name, 'class' => isset($field_class) ? "$field_class form-control" : 'form-control'] + $attributes) }}
