<!-- Bootstrap JS -->
@basset(base_path('resources/assets/js/bootstrap.bundle.min.js'))

<!--plugins-->
@basset(base_path('resources/assets/js/jquery.min.js'))
@basset(base_path('resources/assets/js/simplebar.min.js'))
@basset(base_path('resources/assets/js/metisMenu.min.js'))
@basset(base_path('resources/assets/js/perfect-scrollbar.js'))
@basset(base_path('resources/assets/js/jquery-jvectormap-2.0.2.min.js'))
@basset(base_path('resources/assets/js/jquery-jvectormap-world-mill-en.js'))
@basset(base_path('resources/assets/js/chart.js'))

<!--app JS-->
@basset(base_path('resources/assets/js/app.js'))
<script>
    new PerfectScrollbar(".app-container");
</script>

{{-- Required by Backpack --}}
@basset('https://unpkg.com/noty@3.2.0-beta-deprecated/lib/noty.min.js')
@basset('https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js')

@if (backpack_theme_config('scripts') && count(backpack_theme_config('scripts')))
    @foreach (backpack_theme_config('scripts') as $path)
        @if(is_array($path))
            @basset(...$path)
        @else
            @basset($path)
        @endif
    @endforeach
@endif

@if (backpack_theme_config('mix_scripts') && count(backpack_theme_config('mix_scripts')))
    @foreach (backpack_theme_config('mix_scripts') as $path => $manifest)
        <script type="text/javascript" src="{{ mix($path, $manifest) }}"></script>
    @endforeach
@endif

@if (backpack_theme_config('vite_scripts') && count(backpack_theme_config('vite_scripts')))
    @vite(backpack_theme_config('vite_scripts'))
@endif

@include(backpack_view('inc.alerts'))

{{-- page script --}}
<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() { Pace.restart(); });

    // polyfill for `startsWith` from https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/startsWith
    if (!String.prototype.startsWith) {
        Object.defineProperty(String.prototype, 'startsWith', {
            value: function(search, rawPos) {
                var pos = rawPos > 0 ? rawPos|0 : 0;
                return this.substring(pos, pos + search.length) === search;
            }
        });
    }



    // polyfill for entries and keys from https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/entries#polyfill
    if (!Object.keys) Object.keys = function(o) {
        if (o !== Object(o))
            throw new TypeError('Object.keys called on a non-object');
        var k=[],p;
        for (p in o) if (Object.prototype.hasOwnProperty.call(o,p)) k.push(p);
        return k;
    }

    if (!Object.entries) {
        Object.entries = function( obj ){
            var ownProps = Object.keys( obj ),
                i = ownProps.length,
                resArray = new Array(i); // preallocate the Array
            while (i--)
                resArray[i] = [ownProps[i], obj[ownProps[i]]];
            return resArray;
        };
    }

    // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Enable deep link to tab
    document.querySelectorAll('.nav-tabs a').forEach(function (elem) {
        if(elem.dataset.name === location.hash.substr(1)) (new bootstrap.Tab(elem)).show();
        elem.addEventListener('click', () => location.hash = elem.dataset.name);
    });
</script>

@if(config('app.debug'))
    @include('crud::inc.ajax_error_frame')
@endif