@extends('layout.admin.adminapp')
@section('title', 'add')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">UpdateTehsil</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('tehsil.list') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            All Tehsil
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
                            <form action="{{ route('tehsil.addNew') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">

                                            <label for="district_id">District Name<span class="text-danger">*</span></label>
                                            <select id="district_id" name="district_id"
                                                class="form-control @error('district_id') is-invalid @enderror">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $districts)
                                                    <option value="{{ $districts->id }}"
                                                        {{ $districts->id == $data->district_id ? 'selected' : '' }}>
                                                        {{ $districts->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('district_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label id="name">Tehsil Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" value="{{ $data->name }}"
                                                class="form-control @error('name') is-invalid @enderror" />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary btn-round btn-border btn-sm"
                                        type="submit">Submit</button>
                                    <button class="btn btn-primary btn-round btn-border btn-sm"
                                        type="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
