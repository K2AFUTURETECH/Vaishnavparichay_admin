@extends('layout.admin.adminapp')
@section('title', 'Update City')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">Update City/Village</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('city.list') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                        City/Village Listing
                        </a>
                    </div>
                </div>
            </div>

            <!-- Display Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display Error Message -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('city.editcity', ['id' => $city->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <!-- Your form fields -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="tehsil_id">Select Tehsil</label>
                                            <select id="tehsil_id" name="tehsil_id" class="form-control @error('tehsil_id') is-invalid @enderror">
                                                <option value="">Select Tehsil</option>
                                                @foreach ($tehsils as $tehsil)
                                                    <option value="{{ $tehsil->id }}" {{ $tehsil->id == $city->tehsil_id ? 'selected' : '' }}>
                                                        {{ $tehsil->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tehsil_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">City/Village Name</label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{ $city->name }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('city.list') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
