@extends('layout.admin.adminapp')
@section('title', 'Edit')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">Update State</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('state.list') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            All State
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
                            <form action="{{ route('state.editstate',$state->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label id="name">State Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" value="{{$state->name}}"
                                                class="form-control @error('name') is-invalid @enderror" />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label id="short">Short<span class="text-danger">*</span></label>
                                            <input type="text" name="short" id="short" value="{{$state->short}}"
                                                class="form-control @error('short') is-invalid @enderror" />
                                            @error('short')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label id="short">Status<span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="1" {{ $state->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $state->status == 0 ? 'selected' : '' }}>Inactive </option>
                                            </select>
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
