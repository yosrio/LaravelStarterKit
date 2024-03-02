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
            <form method="POST" action="{{ route('settings_configuration_save') }}" enctype="multipart/form-data">
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
                                            <option value="1" selected>Enable</option>
                                            <option value="0">Disable</option>
                                        @elseif((int)$item['value'] === 0)
                                            <option value="1">Enable</option>
                                            <option value="0" selected>Disable</option>
                                        @endif
                                    </select>
                                </div>
                                @elseif(strcasecmp($item['type'], 'image') === 0)
                                <div class="form-group">
                                    @php
                                        $itemId = $item['id'];
                                        $itemValue = $item['value'];
                                    @endphp
                                    <label for="image">{{ ucwords(str_replace('_', ' ', $item['name'])) }}</label>
                                    <input 
                                        type="file"
                                        class="form-control-file"
                                        name="imageConfigs[{{ $item['id'] }}]"
                                        id="imageConfigs[{{ $item['id'] }}]"
                                        accept="image/*"
                                        onchange="previewImage('imageConfigs[{{ $itemId }}]')"
                                    >
                                </div>
                                <div class="form-group">
                                    <img
                                        id="previewimageConfigs[{{ $item['id'] }}]"
                                        src="{{ $item['value'] != '' ? asset('storage/'.$itemValue) : asset('admin/assets/dist/img/placeholder_100x100.png') }}"
                                        class="img-fluid"
                                        style="max-width: 100px; max-height: 100px;"
                                        alt="placeholder"
                                    >
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script>
  function previewImage(elementId) {
    var preview = document.getElementById('preview'+elementId);
    var fileInput = document.getElementById(elementId);
    var file = fileInput.files[0];
    
    if (file) {
      var reader = new FileReader();

      reader.onload = function(e) {
        preview.src = e.target.result;
      };

      reader.readAsDataURL(file);
    } else {
        alert('else');
      preview.src = "{{ asset('admin/assets/dist/img/placeholder_100x100.png') }}";
    }
  }
</script>

@endsection