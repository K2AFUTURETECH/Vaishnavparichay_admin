@extends('layout.admin.adminapp')
@section('title', 'Edit Family')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">Edit Family</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('family.list') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            All Family
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

            <ul class="nav nav-tabs" id="myTabs">
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('family.edit') ? ' active' : '' }} min-width text-sm"
                        data-toggle="tab" href="{{ route('family.edit', ['id' => request('id')]) }}">Edit Family</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('member.add') ? ' active' : '' }} min-width text-sm"
                        data-toggle="tab" href="{{ route('member.add', ['id' => request('id')]) }}">Add Memeber</a>
                </li>

            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('family.editfamily', $family->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label id="name">Family Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"
                                                value="{{ old('name', $family->name) }}"
                                                class="form-control @error('name') is-invalid @enderror" />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-style-1">
                                            <label for="gotra">Gotra Name<span class="text-danger">*</span></label>
                                            <select name="gotra" id="gotra"
                                                class="form-control @error('gotra') is-invalid @enderror">
                                                <option value="">Select Gotra</option>
                                                @foreach ($gotras as $gotra)
                                                    <option value="{{ $gotra->id }}"
                                                        {{ $gotra->id == $family->gotra ? 'selected' : '' }}>
                                                        {{ $gotra->gotra }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('gotra')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-style-1">
                                            <label for="state_id">State Name<span class="text-danger">*</span></label>
                                            <select name="state_id" class="form-control" required id="state"
                                                onchange="getDistrict(this.value);">
                                                <option value="0">Select State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        {{ $state->id == $family->state_id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('state_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="district_id">District Name<span class="text-danger">*</span></label>
                                            <select name="district_id" class="form-control" required id="district"
                                                onchange="getTehsil(this.value)">
                                                <option value="0">Select district</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}"
                                                        {{ $district->id == $family->district_id ? 'selected' : '' }}>
                                                        {{ $district->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('district_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="tehsil_id">Tehsil Name<span class="text-danger">*</span></label>
                                            <select name="tehsil_id" class="form-control" required id="tehsils"
                                                onchange="getCity(this.value)">
                                                <option value="0">Select Tehsil</option>
                                                @foreach ($tehsils as $tehsil)
                                                    <option value="{{ $tehsil->id }}"
                                                        {{ $tehsil->id == $family->tehsil_id ? 'selected' : '' }}>
                                                        {{ $tehsil->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tehsil_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label id="city_id">City/Village Name<span
                                                    class="text-danger">*</span></label>
                                            <select name="city_id" class="form-control" required id="cities">
                                                <option value="0">Select city</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ $city->id == $family->city_id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label id="mobile">Contact Number <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="mobile" id="mobile"
                                                value="{{ old('mobile', $family->mobile) }}"
                                                class="form-control @error('mobile') is-invalid @enderror" />
                                            @error('mobile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="fphoto">Family Photo</label>
                                            <input class="form-control" type="file" name="fphoto" id="fphoto"
                                                onchange="previewImage('fphoto', 'preview_fphoto')" accept="image/*">
                                            <img id="preview_fphoto"
                                                src="{{ asset('upload/family_photos/' . $family->fphoto) }}"
                                                alt="Image Preview" style="max-width: 150px; max-height: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="fphoto2">Family Photo 2</label>
                                            <input class="form-control" type="file" name="fphoto2" id="fphoto2"
                                                onchange="previewImage('fphoto2', 'preview_fphoto2')" accept="image/*">
                                            <img id="preview_fphoto2"
                                                src="{{ asset('upload/family_photos/' . $family->fphoto2) }}"
                                                alt="Image Preview" style="max-width: 150px; max-height: 100px;">
                                        </div>
                                    </div>
                                </div><br>

                                <div class="card-footer">
                                    <button class="btn btn-primary btn-round btn-border btn-sm"
                                        type="submit">Update</button>
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

    <script>
        function getDistrict(id) {
            var url = '{{ route('district', ':state_id') }}'.replace(':state_id', id);
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {

                    $('#district').empty();
                    if (response.dist.length > 0) {
                        $('#district').append($('<option>').text('Select District').attr('value', 0));
                        $.each(response.dist, function(i, obj) {
                            $('#district').append($('<option>').text(obj.name).attr('value', obj.id));
                        });
                    } else {
                        $('#district').append($('<option>').text('No District').attr('value', 0));
                    }
                }
            });
        }

        function getTehsil(id) {
            var url = '{{ route('tehsil', ':distid') }}'.replace(':distid', id);
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {

                    $('#tehsils').empty();
                    if (response.tehsil.length > 0) {
                        $('#tehsils').append($('<option>').text('Select Tehsil').attr('value', 0));
                        $.each(response.tehsil, function(i, obj) {
                            $('#tehsils').append($('<option>').text(obj.name).attr('value', obj.id));
                        });
                    } else {
                        $('#tehsils').append($('<option>').text('No Tehsil Added').attr('value', 0));
                    }
                }
            });
        }

        function getCity(id) {
            var url = '{{ route('city', ':tehsil_id') }}'.replace(':tehsil_id', id);
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {

                    $('#cities').empty();
                    if (response.city.length > 0) {
                        $('#cities').append($('<option>').text('Select City').attr('value', 0));
                        $.each(response.city, function(i, obj) {
                            $('#cities').append($('<option>').text(obj.name).attr('value', obj.id));
                        });
                    } else {
                        $('#cities').append($('<option>').text('No City Added').attr('value', 0));
                    }
                }
            });
        }

        function previewImage(inputId, previewId) {
            var input = document.getElementById(inputId);
            var preview = document.getElementById(previewId);

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
