@extends('admin.layouts.default')
@section('content')
<div class="container mt-4">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <form method="POST" action="{{ route('settings_integration_save') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Integration Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                aria-label="Integration Name"
                                value="{{isset($integrationSelected) ? $integrationSelected->name : ''}}"
                            >
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="token_type">Type</label>
                            <select class="custom-select rounded-0" name="token_type" {{isset($integrationSelected) ? 'disabled' : ''}}>
                                @foreach($integrationMasterData['token_type'] as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('token')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="token">Token</label>
                            <input
                                type="text"
                                class="form-control"
                                id="token"
                                name="token"
                                aria-label="Token"
                                value="{{isset($integrationSelected) ? $integrationSelected->token : ''}}"
                                disabled
                            >
                            <small>Auto generate upon initial creation.</small>
                        </div>
                        @error('token')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="expired_at">Expired Date</label>
                            <input
                                type="text"
                                class="form-control"
                                id="expired_at"
                                name="expired_at"
                                aria-label="Expired Date"
                                value="{{isset($integrationSelected) ? date('d/m/Y', strtotime($integrationSelected->expired_at)) : ''}}"
                                disabled
                            >
                        </div>
                        @error('expired_at')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="permission">Permission</label>
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Allow</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($integrationMasterData['permission_list'] as $permission)
                                        <tr>
                                            <td>{{ ucwords(str_replace('_', ' ', $permission)) }}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <label>
                                                        <input
                                                            type="checkbox"
                                                            name="allow[]"
                                                            value="{{ $permission }}"
                                                            @if(isset($integrationSelected))
                                                                @php
                                                                    $currIntegration = json_decode($integrationSelected['permissions'], true);
                                                                @endphp
                                                                @if(in_array($permission, $currIntegration))
                                                                    checked
                                                                @endif
                                                            @endif
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{isset($integrationSelected) ? $integrationSelected->id : ''}}" />
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a type="submit" href="{{ route('settings_integration') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection