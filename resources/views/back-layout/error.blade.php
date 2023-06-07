@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <strong><li>{{ $error }}</li></strong>
        @endforeach
    </div>
@endif
@if (session()->has('val_errors'))
    <div class="alert alert-danger">
        @foreach (session()->get('val_errors') as $k=>$v)
            <?php
              $msg=array_values($v);
            ?>
            <strong><li>{{ $msg[0][0] }}</li></strong>
        @endforeach
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger text-center">
        {{ session()->get('error') }}
    </div>
@endif
@if (session()->has('profile_complete'))
    <div class="alert alert-danger text-center">
    {{ session()->get('profile_complete') }}
         <a  href="{{ route('parentssettings.create')}}" class="">Here <i class="lni-angle-double-right"></i></a>
        To Continue Thank You.
    </div>
@endif
@if (session()->has('success'))
    <div id="alert" class="alert alert-success text-center">
        {{ session()->get('success') }}
    </div>
@endif
@if (session()->has('canvas'))
        {!! session()->get('canvas') !!}
@endif
