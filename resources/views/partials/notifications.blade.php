<div class="row">
<div class="col-sm-2"></div>
<div class="col-sm-8">
    @if (count($errors) === 1)
        <div class="spacer-50"></div>
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    @if (count($errors) > 1)
        <div class="spacer-50"></div>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('successful'))
        @if (count(session('successful')) === 1)
            <div class="spacer-50"></div>
            <div class="alert alert-success">
                @foreach (session('successful')->all() as $success)
                    {{ $success }}
                @endforeach
            </div>
        @endif
        @if (count(session('successful')) > 1)
            <div class="spacer-50"></div>
            <div class="alert alert-success">
                <ul>
                    @foreach (session('successful')->all() as $success)
                        <li>{{ $success }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif

    @if (session('danger'))
        <div class="spacer-50"></div>
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    @if (session('success'))
        <div class="spacer-50"></div>
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('info'))
        <div class="spacer-50"></div>
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="spacer-50"></div>
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
</div>
</div>
