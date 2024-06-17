@extends('layout.admin.adminapp')
@section('title', 'City')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">City/Village Listing</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ url('city/add') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add City/Village
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
                                        <th class="text-uppercase">Tehsil Name</th>
                                        <th class="text-uppercase">City/Village Name</th>
                                        <th class="text-uppercase">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $city->tehsil_name }}</td>
                                            <td>{{ $city->city_name }}</td>
                                            <td>
                                                <a href="{{ route('city.edit', ['id' => $city->id ]) }}" class="status-active rounded-pill" title="Edit">
                                                    <i class="lni lni-pencil-alt"></i>
                                                </a>
                                                <a href="{{ route('city.delete', ['id' => $city->id ]) }}" class="status-inactive rounded-pill" onclick="return confirm('Are you sure?')" title="Delete">
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
