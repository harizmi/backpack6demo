@extends(backpack_view('layouts.app'))

@php
    if (isset($widgets)) {
        foreach ($widgets as $section => $widgetSection) {
            foreach ($widgetSection as $key => $widget) {
                \Backpack\CRUD\app\Library\Widget::add($widget)->section($section);
            }
        }
    }
@endphp

@section('before_breadcrumbs_widgets')
    @include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection

@section('after_breadcrumbs_widgets')
    @include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'after_breadcrumbs')->toArray() ])
@endsection

@section('before_content_widgets')
    @include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_content')->toArray() ])
@endsection

@section('content')
@endsection

@section('after_content_widgets')
    @include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'after_content')->toArray() ])
@endsection