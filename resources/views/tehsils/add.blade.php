@extends('layout.admin.adminapp')
@section('title', 'add')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">Add New Tehsil</h4>
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

                                            <label for="state_id">State Name<span class="text-danger">*</span></label>
                                            <select id="state_id" name="state_id"
                                                class="form-control @error('state_id') is-invalid @enderror">
                                                <option value="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        {{ old('state_id', $district->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('state_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label id="name">District Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
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
