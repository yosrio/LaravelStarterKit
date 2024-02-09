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
                <form method="POST" action="{{ route('roles_save') }}">
                    @csrf
                    <div class="card-body">
                            <div class="form-group">
                                <label for="rolename">Role Name</label>
                                <input type="text" class="form-control" id="rolename" name="rolename" aria-label="Role Name" value="<?php echo (isset($roleSelected) ? $roleSelected->role_name : '') ?>">
                            </div>
                            @error('rolename')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        <div class="form-group">
                            <label for="permission">Permission</label>
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Permission Name</th>
                                        <th scope="col">Allow</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menuList as $item)
                                        @if(isset($roleSelected))
                                            @php
                                                $permission = json_decode($roleSelected['permission'], 1);
                                            @endphp
                                        @endif
                                        @php
                                            $menuItem = json_decode($item->menu_item, 1);
                                        @endphp
                                        @if(array_key_exists('items',$menuItem))
                                            @foreach($menuItem['items'] as $menu)
                                                <tr>
                                                    <td>{{ $menu['menu_title'] }}</td>
                                                    <td>
                                                        <div class="form-group mb-0">
                                                        <label>
                                                            <input
                                                                type="checkbox"
                                                                name="allow[]"
                                                                value="{{ strtolower($item['menu_group']) . '|' . $menu['menu_id'] }}"
                                                                @if(isset($permission) && array_key_exists(strtolower($item->menu_group), $permission))
                                                                    @php
                                                                        $permissionItem = $permission[strtolower($item->menu_group)];
                                                                    @endphp
                                                                    @if(in_array($menu['menu_id'], $permissionItem))
                                                                        checked
                                                                    @endif
                                                                @endif
                                                            >
                                                        </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>{{ $menuItem['menu_title'] }}</td>
                                                <td>
                                                    <label>
                                                        <input
                                                            type="checkbox"
                                                            name="allow[]"
                                                            value="{{ strtolower($item['menu_group']) . '|' . $menuItem['menu_id'] }}"
                                                            @if(isset($permission) && array_key_exists(strtolower($item->menu_group), $permission))
                                                                @php
                                                                    $permissionItem = $permission[strtolower($item->menu_group)];
                                                                @endphp
                                                                @if(in_array($menuItem['menu_id'], $permissionItem))
                                                                        checked
                                                                @endif
                                                            @endif
                                                        >
                                                    </label>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ isset($roleSelected) ? $roleSelected->id : '' }}" />
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a type="submit" href="{{ route('roles') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection