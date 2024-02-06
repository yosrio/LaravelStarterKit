@extends('admin.layouts.default')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table">
                        <table id="usersTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td scope="row">{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        @if ($user->status === 1)
                                        <span style="color: green;">Active</span>
                                        @else
                                        <span style="color: red;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary mr-1 btn-sm" href="{{ route('users_update', $user->id) }}">
                                            Edit
                                        </a>
                                        <a class="btn btn-danger deleteItem btn-sm" href="#modalDelete" data-toggle="modal" data-href="{{ route('users_delete', $user->id) }}">
                                            Delete
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

<div id="modalDelete" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete user data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <a href="" class="btn btn-danger deleteModal">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "columnDefs": [{
                "sortable": false
            }]
        });

        $('.deleteItem').click(function() {
            var href = $(this).data('href');
            $('.deleteModal').attr('href', href);
        });
    });
</script>
@endsection