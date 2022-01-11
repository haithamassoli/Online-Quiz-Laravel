@if (Session::has('fail'))
    <div class="alert alert-danger text-center" role="alert">
        {{ Session::get('fail') }}
    </div>
@endif
