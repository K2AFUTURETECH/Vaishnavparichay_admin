@extends('layout.admin.adminapp')
@section('title', 'Update Gotra')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div>
            <div class="row align-items-center">
                <div class="col-md-6 text-left">
                    <h4 class="page-title">Update Gotra</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('gotra.list') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        All Gotra
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
                        <form action="{{ route('gotra.editgotra', $gotra->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-style-1">
                                        <label for="gotra">Gotra Name<span class="text-danger">*</span></label>
                                        <input type="text" name="gotra" id="gotra" value="{{ old('gotra', $gotra->gotra) }}"
                                            class="form-control @error('gotra') is-invalid @enderror" />
                                        @error('gotra')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-style-1">
                                        <label for="dawara">Dawara Name<span class="text-danger">*</span></label>
                                        <input type="text" name="dawara" id="dawara" value="{{ old('dawara', $gotra->dawara) }}"
                                            class="form-control @error('dawara') is-invalid @enderror" />
                                        @error('dawara')
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
