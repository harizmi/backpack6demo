@php
    // defaults; backwards compatibility with Backpack 4.0 widgets
    $widget['wrapper']['class'] = $widget['wrapper']['class'] ?? $widget['wrapperClass'] ?? 'col-sm-6 col-lg-3';
    $accentColor = $widget['accentColor'] ?? 'primary';
@endphp

@includeWhen(!empty($widget['wrapper']), backpack_view('widgets.inc.wrapper_start'))

<div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-{{ $accentColor }}">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <p class="mb-0 text-secondary">{!! $widget['description'] !!}</p>
                    <h4 class="my-1 text-info">{{ $widget['value'] }}</h4>
                    <p class="mb-0 font-13">{{ $widget['hint'] }}</p>
                </div>
                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class="bx bxs-cart"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@includeWhen(!empty($widget['wrapper']), backpack_view('widgets.inc.wrapper_end'))
