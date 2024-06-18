@extends('layout.admin.adminapp')
@section('title', 'Gotra')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">Gotra Listing</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{url('state/add')}}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add Gotra
                        </a>
                    </div>
                </div>
            </div>
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
                            <table class="table table-hover" id="data-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase">#</th>
                                        <th class="text-uppercase">Gotra Name</th>
                                        <th class="text-uppercase">Dawara Name</th>
                                        <th class="text-uppercase">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gotras as $gotra)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $gotra->gotra }}</td>
                                            <td>{{ $gotra->dawara }}</td>
                                            <td>
                                                <a href="{{ route('gotra.edit', ['id' => $gotra->id]) }}"
                                                    class="status-active rounded-pill" title="Edit">
                                                    <i class="lni lni-pencil-alt"></i>
                                                </a>
                                                <a href="{{ route('gotra.delete', ['id' => $gotra->id]) }}"
                                                    class="status-inactive rounded-pill"
                                                    onclick="return confirm('Are you sure?')" title="Delete">
                                                    <i class="lni lni-trash-can"></i>
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

@endsection
