@extends('layout.admin.adminapp')
@section('title', 'Family')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">Family Listing</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ url('family/add') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add Family
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
                                        <th class="text-uppercase"> परिवार का नाम</th>
                                        <th class="text-uppercase"> गोत्र</th>
                                        <th class="text-uppercase"> संपर्क मोबाइल</th>
                                        <th class="text-uppercase">जुड़ने की तिथि</th>
                                        <th class="text-uppercase">एक्शन</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($families as $family)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $family->family_name }}</td>
                                            <td>{{ $family->gotra_name }}</td>
                                            <td>{{ $family->mobile }}</td>
                                            <td>{{ \Carbon\Carbon::parse($family->created)->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{ route('family.edit', ['id' => $family->id]) }}"
                                                    class="status-active rounded-pill" title="Edit">
                                                    <i class="lni lni-pencil-alt"></i>
                                                </a>
                                                <a href="{{ route('family.delete', ['id' => $family->id]) }}"
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
