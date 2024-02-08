@extends('admin.layouts.default')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-start">
        <div class="col-md-12">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif
            <form method="POST" action="{{ route('settings_configuration_save') }}">
                @csrf
                @foreach($configurations as $key => $items)
                    <div class="card">
                        <div class="card-header" id="{{ strtolower($key) }}">
                            <h5 class="mb-0">
                                <span style="font-weight: 700;">
                                    {{ $key }}
                                </span>
                            </h5>
                        </div>
                        <div class="card-body">
                            @foreach($items as $item)
                                @if(strcasecmp($item['type'], 'string') === 0)
                                    <div class="form-group">
                                        <label style="font-weight: 600;" for="{{ $item['name'] }}">{{ ucwords(str_replace('_', ' ', $item['name'])) }}</label>
                                        <input type="text" class="form-control" name="configs[{{ $item['id'] }}]" value="{{ $item['value'] }}"/>
                                    </div>
                                    @error($item['name'])
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                @elseif(strcasecmp($item['type'], 'boolean') === 0)
                                <div class="form-group">
                                    <label style="font-weight: 600;" for="{{ $item['name'] }}">{{ ucwords(str_replace('_', ' ', $item['name'])) }}</label>
                                    <select class="custom-select rounded-0" name="configs[{{ $item['id'] }}]">
                                        @if((int)$item['value'] === 1)
                                            @php echo 'test' @endphp
                                            <option value="1" selected>Enable</option>
                                            <option value="0">Disable</option>
                                        @elseif((int)$item['value'] === 0)
                                            @php echo 'test' @endphp
                                            <option value="1">Enable</option>
                                            <option value="0" selected>Disable</option>
                                        @endif
                                    </select>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection