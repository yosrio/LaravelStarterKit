@extends('admin.layouts.default')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 style="font-weight: 600;"> Integrations </h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a type="submit" class="btn btn-primary" href="{{ route('settings_integration_add') }}">Add Integration</a>
                        </div>
                    </div>
                </div>
            </div>
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
                    <div class="table">
                        <table id="integrationTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Expired At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($integrations as $integration)
                                    <tr>
                                        <td scope="row">{{ $integration->id }}</td>
                                        <td>{{ $integration->name }}</td>
                                        <td>{{ $integration->token_type }}</td>
                                        <td>{{ date("d/m/Y", strtotime($integration->expired_at)) }}</td>
                                    <td>
                                        <a class="btn btn-primary mr-1 btn-sm" href="{{ route('settings_integration_update', $integration->id) }}">
                                            View
                                        </a>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#integrationTable').DataTable({
            "columnDefs": [{
                "sortable": false
            }]
        });
    });
</script>
@endsection