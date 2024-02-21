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
            <div class="">
                <form method="POST" action="{{ route('menus_save') }}">
                    @csrf
                    @if(isset($menuSelected))
                        @php
                            $menuItem = json_decode($menuSelected->menu_item, 1);
                        @endphp
                    @endif
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Root Menu</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="menu_id">Menu Id</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="menu_id" name="menu_id"
                                    placeholder="users"
                                    value="{{ isset($menuSelected) ? $menuItem['menu_id'] : old('menu_id') }}" 
                                    required
                                />
                            </div>
                            @error('menu_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="menu_title">Menu title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="menu_title" name="menu_title"
                                    placeholder="User Management"
                                    value="{{ isset($menuSelected) ? $menuItem['menu_title'] : old('menu_title') }}" 
                                    required
                                />
                            </div>
                            @error('menu_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="route">Route</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="route" name="route"
                                    placeholder="users"
                                    value="{{ isset($menuSelected) ? $menuItem['route'] : old('route') }}" 
                                    required
                                />
                                <small class="text-muted">
                                    Fill route with symbol <span style="color: green;">#</span> (Hash), if menu have sub-menu.
                                    |
                                    Fill route with prefix group route (e.g <span style="color: green;">users</span>) from web.php, if menu does not have sub-menu.
                                </small>
                            </div>
                            @error('route')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="icon" name="icon"
                                    placeholder="fas fa-users"
                                    value="{{ isset($menuSelected) ? $menuItem['icon'] : old('icon') }}" 
                                    required
                                />
                                <small class="text-muted">
                                    Reference icon from Font Awesome v5.15.4
                                </small>
                            </div>
                            @error('icon')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="sort_order">Sort Order</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="sort_order" name="sort_order"
                                    placeholder="10"
                                    value="{{ isset($menuSelected) ? $menuSelected['sort_order'] : old('sort_order') }}"
                                    required
                                />
                                <small class="text-muted">
                                    Numeric only
                                </small>
                            </div>
                            @error('sort_order')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Sub Menu</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea
                                    class="form-control"
                                    rows="2"
                                    id="submenu"
                                    name="submenu"
                                    style="white-space: normal"
                                >
                                @if(isset($menuSelected))
                                    @if(isset($menuItem['items']))
                                        {{ json_encode($menuItem['items']) }}
                                    @endif
                                @endif</textarea>
                                <small class="text-muted">
                                    Fill with array of json as string. e.g: <code>[{"menu_id":"users","menu_title":"Show Users","route":"users","icon":"fas fa-eye"}]</code>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-footer">
                            <input type="hidden" name="id" value="{{isset($menuSelected) ? $menuSelected->id : ''}}" />
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a type="submit" href="{{ route('menus') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // JavaScript to automatically remove whitespace from the textarea value
    document.addEventListener("DOMContentLoaded", function() {
        // Get the textarea element by its ID
        var textareaElement = document.getElementById('submenu');

        // Attach an event listener for the input event (while typing)
        textareaElement.addEventListener('input', function() {
            // Remove leading and trailing whitespace using trim()
            textareaElement.value = textareaElement.value.trim();
        });

        // Attach an event listener for the blur event (when leaving the textarea)
        textareaElement.addEventListener('blur', function() {
            // Remove leading and trailing whitespace using trim()
            textareaElement.value = textareaElement.value.trim();
        });
    });
</script>
@endsection