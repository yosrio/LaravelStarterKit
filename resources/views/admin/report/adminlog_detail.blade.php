@extends('admin.layouts.default')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="activity_type">Activity Type</label>
                        <input
                            type="text"
                            class="form-control"
                            id="activity_type"
                            name="activity_type"
                            aria-label="Activity Type"
                            value="{{ $adminLogSelected->activity_type }}"
                            disabled
                        >
                    </div>
                    <div class="form-group">
                        <label for="activity_description">Activity Description</label>
                        <textarea
                            class="form-control"
                            rows="2"
                            id="activity_description"
                            name="activity_description"
                            disabled
                        >{{ $adminLogSelected->activity_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="activity_data">Activity Data</label>
                        <textarea
                            class="form-control"
                            rows="20"
                            id="activity_data"
                            name="activity_data"
                            disabled
                        >{{ json_encode(json_decode($adminLogSelected->activity_data, true), JSON_PRETTY_PRINT) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="activity_date">Activity Date</label>
                        <input
                            type="text"
                            class="form-control"
                            id="activity_date"
                            name="activity_date"
                            aria-label="Activity Date"
                            value="{{ date('d/m/Y H:i:s', strtotime($adminLogSelected->activity_date)) }}"
                            disabled
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection