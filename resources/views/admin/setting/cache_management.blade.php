@extends('admin.layouts.default')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-weight: 600;">Cache Management</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div>
                    Clear All cache &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                    &nbsp;&nbsp;&nbsp;<a type="submit" href="{{ route('settings_cache_all') }}" class="btn btn-primary">Clear Cache</a>
                </div>
                <hr>
                <div>
                    Clear cache configuration : 
                    &nbsp;&nbsp;&nbsp;<a type="submit" href="{{ route('settings_cache_config') }}" class="btn btn-primary">Clear Cache</a>
                </div>
                <br>
                <div>
                    Clear cache route &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                    &nbsp;&nbsp;&nbsp;<a type="submit" href="{{ route('settings_cache_route') }}" class="btn btn-primary">Clear Cache</a>
                </div>
                <br>
                <div>
                    Clear cache view  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                    &nbsp;&nbsp;&nbsp;<a type="submit" href="{{ route('settings_cache_view') }}" class="btn btn-primary">Clear Cache</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection