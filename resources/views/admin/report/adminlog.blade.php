@extends('admin.layouts.default')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-start">
        <div class="col-md-12">
        <div class="card">
                <div class="card-body">
                    <div class="table">
                        <table id="adminLogTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Activity Type</th>
                                    <th>Activity Description</th>
                                    <th>Activity Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adminLogs as $adminLog)
                                    <tr>
                                        <td scope="row">{{ $adminLog->id }}</td>
                                        <td>{{ $adminLog->activity_type }}</td>
                                        <td class="limited-text">{{ $adminLog->activity_description }}</td>
                                        <td>{{ date("d/m/Y H:i:s", strtotime($adminLog->activity_date)) }}</td>
                                    <td>
                                        <a class="btn btn-primary mr-1 btn-sm" href="{{ route('reports_adminlog_detail', $adminLog->id) }}">
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

@section('css')
<style>
    .limited-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px; /* Set your preferred maximum width */
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#adminLogTable').DataTable({
            "columnDefs": [{
                "sortable": false
            }]
        });
    });
</script>
@endsection