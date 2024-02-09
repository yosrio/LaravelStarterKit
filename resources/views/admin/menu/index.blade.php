@extends('admin.layouts.default')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 style="font-weight: 600;"> Menu Data </h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a type="submit" class="btn btn-primary" href="{{ route('menus_add') }}">Add Menu</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table">
                        <table id="menusTable" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Menu Id</th>
                                    <th>Menu Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menuList as $menu)
                                @php
                                    $menuItem = json_decode($menu->menu_item, 1);
                                @endphp
                                <tr>
                                    <td scope="row">{{ $menu->id }}</td>
                                    <td>{{ strtolower($menu->menu_group) }}</td>
                                    <td>{{ $menuItem['menu_title'] }}</td>
                                    <td>
                                        <a class="btn btn-primary mr-1 btn-sm" href="{{ route('menus_update', $menu->id) }}">
                                            Edit
                                        </a>
                                        <a class="btn btn-danger deleteItem btn-sm" href="#modalDelete" data-toggle="modal" data-href="{{ route('menus_delete', $menu->id) }}">
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
                <h4 class="modal-title">Delete menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete menu data?</p>
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
        $('#menusTable').DataTable({
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