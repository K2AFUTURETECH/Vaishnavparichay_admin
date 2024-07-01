@extends('layout.admin.adminapp')
@section('title', 'add')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">Add New Member</h4>
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


            <div class="row">
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('member.addNew') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="family_id" value="{{ request('id') }}">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label id="name"> Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror" />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="birth_year">Birth Year<span class="text-danger">*</span></label>
                                            <input type="number" name="birth_year" id="birth_year"
                                                value="{{ old('birth_year') }}"
                                                class="form-control @error('birth_year') is-invalid @enderror" />
                                            @error('birth_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label id="education"> Education<span class="text-danger">*</span></label>
                                            <input type="text" name="education" id="education"
                                                value="{{ old('education') }}"
                                                class="form-control @error('education') is-invalid @enderror" />
                                            @error('education')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="relation">Relation<span class="text-danger">*</span></label>
                                            <select name="relation" id="relation"
                                                class="form-control @error('relation') is-invalid @enderror">
                                                <option value="">Select Relation</option>
                                                <option value="स्वयं" {{ old('relation') == 'स्वयं' ? 'selected' : '' }}>
                                                    स्वयं</option>
                                                <option value="पत्नी" {{ old('relation') == 'पत्नी' ? 'selected' : '' }}>
                                                    पत्नी</option>
                                                <option value="पुत्र" {{ old('relation') == 'पुत्र' ? 'selected' : '' }}>
                                                    पुत्र</option>
                                                <option value="पुत्री" {{ old('relation') == 'पुत्री' ? 'selected' : '' }}>
                                                    पुत्री</option>
                                                <option value="पुत्रवधु"
                                                    {{ old('relation') == 'पुत्रवधु' ? 'selected' : '' }}>पुत्रवधु</option>
                                                <option value="पौत्र" {{ old('relation') == 'पौत्र' ? 'selected' : '' }}>
                                                    पौत्र</option>
                                                <option value="पौत्री" {{ old('relation') == 'पौत्री' ? 'selected' : '' }}>
                                                    पौत्री</option>
                                                <option value="पौत्रवधु"
                                                    {{ old('relation') == 'पौत्रवधु' ? 'selected' : '' }}>पौत्रवधु</option>
                                                <option value="परपौत्र"
                                                    {{ old('relation') == 'परपौत्र' ? 'selected' : '' }}>परपौत्र</option>
                                                <option value="परपौत्री"
                                                    {{ old('relation') == 'परपौत्री' ? 'selected' : '' }}>परपौत्री</option>
                                                <option value="भाई" {{ old('relation') == 'भाई' ? 'selected' : '' }}>भाई
                                                </option>
                                                <option value="बहन" {{ old('relation') == 'बहन' ? 'selected' : '' }}>बहन
                                                </option>
                                                <option value="भानजी" {{ old('relation') == 'भानजी' ? 'selected' : '' }}>
                                                    भानजी</option>
                                                <option value="भतीजा" {{ old('relation') == 'भतीजा' ? 'selected' : '' }}>
                                                    भतीजा</option>
                                                <option value="भांजा" {{ old('relation') == 'भांजा' ? 'selected' : '' }}>
                                                    भांजा</option>
                                                <option value="भतीजी" {{ old('relation') == 'भतीजी' ? 'selected' : '' }}>
                                                    भतीजी</option>
                                                <option value="बुआ" {{ old('relation') == 'बुआ' ? 'selected' : '' }}>बुआ
                                                </option>
                                                <option value="दादा जी"
                                                    {{ old('relation') == 'दादा जी' ? 'selected' : '' }}>दादा जी</option>
                                                <option value="दादी जी"
                                                    {{ old('relation') == 'दादी जी' ? 'selected' : '' }}>दादी जी</option>
                                                <option value="पिता" {{ old('relation') == 'पिता' ? 'selected' : '' }}>
                                                    पिता</option>
                                                <option value="माता" {{ old('relation') == 'माता' ? 'selected' : '' }}>
                                                    माता</option>
                                                <option value="काका" {{ old('relation') == 'काका' ? 'selected' : '' }}>
                                                    काका</option>
                                                <option value="काकी" {{ old('relation') == 'काकी' ? 'selected' : '' }}>
                                                    काकी</option>
                                            </select>
                                            @error('relation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="native">Native Address <span class="text-danger">*</span></label>
                                            <input type="text" name="native" id="native"
                                                value="{{ old('native') }}"
                                                class="form-control @error('native') is-invalid @enderror" />
                                            @error('native')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="current">Current Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="current" id="current"
                                                value="{{ old('current') }}"
                                                class="form-control @error('current') is-invalid @enderror" />
                                            @error('current')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label id="mobile"> Mobile<span class="text-danger">*</span></label>
                                            <input type="number" name="mobile" id="mobile"
                                                value="{{ old('mobile') }}"
                                                class="form-control @error('mobile') is-invalid @enderror" />
                                            @error('mobile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="occupation">Occupation <span class="text-danger">*</span></label>
                                            <select name="occupation" id="occupation"
                                                class="form-control @error('occupation') is-invalid @enderror">
                                                <option value="">Select Occupation</option>
                                                <option value="विद्यार्थी"
                                                    {{ old('occupation') == 'विद्यार्थी' ? 'selected' : '' }}>विद्यार्थी
                                                </option>
                                                <option value="सरकारी कर्मचारी"
                                                    {{ old('occupation') == 'सरकारी कर्मचारी' ? 'selected' : '' }}>सरकारी
                                                    कर्मचारी</option>
                                                <option value="डॉक्टर"
                                                    {{ old('occupation') == 'डॉक्टर' ? 'selected' : '' }}>डॉक्टर</option>
                                                <option value="इंजीनियर"
                                                    {{ old('occupation') == 'इंजीनियर' ? 'selected' : '' }}>इंजीनियर
                                                </option>
                                                <option value="नौकरी"
                                                    {{ old('occupation') == 'नौकरी' ? 'selected' : '' }}>नौकरी</option>
                                                <option value="व्यापार"
                                                    {{ old('occupation') == 'व्यापार' ? 'selected' : '' }}>व्यापार</option>
                                                <option value="शिक्षक"
                                                    {{ old('occupation') == 'शिक्षक' ? 'selected' : '' }}>शिक्षक</option>
                                                <option value="खेती"
                                                    {{ old('occupation') == 'खेती' ? 'selected' : '' }}>खेती</option>
                                                <option value="पुजारी"
                                                    {{ old('occupation') == 'पुजारी' ? 'selected' : '' }}>पुजारी</option>
                                                <option value="भजनी"
                                                    {{ old('occupation') == 'भजनी' ? 'selected' : '' }}>भजनी</option>
                                                <option value="संगीतकार"
                                                    {{ old('occupation') == 'संगीतकार' ? 'selected' : '' }}>संगीतकार
                                                </option>
                                                <option value="लाइट्स-टेंट"
                                                    {{ old('occupation') == 'लाइट्स-टेंट' ? 'selected' : '' }}>लाइट्स-टेंट
                                                </option>
                                                <option value="DJ" {{ old('occupation') == 'DJ' ? 'selected' : '' }}>
                                                    DJ</option>
                                                <option value="गृहणी"
                                                    {{ old('occupation') == 'गृहणी' ? 'selected' : '' }}>गृहणी</option>
                                                <option value="अन्य"
                                                    {{ old('occupation') == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                                                <option value="फोटोग्राफर"
                                                    {{ old('occupation') == 'फोटोग्राफर' ? 'selected' : '' }}>फोटोग्राफर
                                                </option>
                                                <option value="प्रिंसिपल"
                                                    {{ old('occupation') == 'प्रिंसिपल' ? 'selected' : '' }}>प्रिंसिपल
                                                </option>
                                                <option value="प्राइवेट स्कूल"
                                                    {{ old('occupation') == 'प्राइवेट स्कूल' ? 'selected' : '' }}>प्राइवेट
                                                    स्कूल</option>
                                                <option value="प्रोफेसर"
                                                    {{ old('occupation') == 'प्रोफेसर' ? 'selected' : '' }}>प्रोफेसर
                                                </option>
                                                <option value="कैटरर्स"
                                                    {{ old('occupation') == 'कैटरर्स' ? 'selected' : '' }}>कैटरर्स</option>
                                                <option value="सेवानिवृत"
                                                    {{ old('occupation') == 'सेवानिवृत' ? 'selected' : '' }}>सेवानिवृत
                                                </option>
                                                <option value="टूर्स एंड ट्रेवल्स"
                                                    {{ old('occupation') == 'टूर्स एंड ट्रेवल्स' ? 'selected' : '' }}>टूर्स
                                                    एंड ट्रेवल्स</option>
                                            </select>
                                            @error('occupation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="marital_status">Marital Status <span
                                                    class="text-danger">*</span></label>
                                            <select name="marital_status" id="marital_status"
                                                class="form-control @error('marital_status') is-invalid @enderror">
                                                <option value="">Select Marital Status</option>
                                                <option value="अविवाहित"
                                                    {{ old('marital_status') == 'अविवाहित' ? 'selected' : '' }}>अविवाहित
                                                </option>
                                                <option value="विवाहित"
                                                    {{ old('marital_status') == 'विवाहित' ? 'selected' : '' }}>विवाहित
                                                </option>
                                                <option value="विधुर"
                                                    {{ old('marital_status') == 'विधुर' ? 'selected' : '' }}>विधुर</option>
                                                <option value="विधवा"
                                                    {{ old('marital_status') == 'विधवा' ? 'selected' : '' }}>विधवा</option>
                                                <option value="तलाकशुदा"
                                                    {{ old('marital_status') == 'तलाकशुदा' ? 'selected' : '' }}>तलाकशुदा
                                                </option>
                                            </select>
                                            @error('marital_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="is_dead">Is Dead <span class="text-danger">*</span></label>
                                            <select name="is_dead" id="is_dead"
                                                class="form-control @error('is_dead') is-invalid @enderror">
                                                <option value="">Select</option>
                                                <option value="Yes" {{ old('is_dead') == 'Yes' ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="No"
                                                    {{ old('is_dead', 'No') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>

                                            @error('is_dead')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="photo">Photo</label>
                                            <input class="form-control" type="file" name="photo" id="photo"
                                                onchange="previewImage('photo', 'preview_photo')" accept="image/*">
                                            <img id="preview_photo" src="#" alt="Image Preview"
                                                style="display:none; max-width: 150px; max-height: 100px;">
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

                {{-- //listing members --}}
                <!-- Display Member Listing -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Added Members</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Birth Year</th>
                                                <th>Education</th>
                                                <th>Relation</th>
                                                <th>Native Address</th>
                                                <th>Current Address</th>
                                                <th>Occupation</th>
                                                <th>Marital Status</th>
                                                <th>Mobile</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($family))


                                                @foreach ($family as $member)
                                                    <tr>

                                                        <td>{{ $member->name }}</td>
                                                        <td>{{ $member->birth_year }}</td>
                                                        <td>{{ $member->education }}</td>
                                                        <td>{{ $member->relation }}</td>
                                                        <td>{{ $member->native }}</td>
                                                        <td>{{ $member->current }}</td>
                                                        <td>{{ $member->mobile }}</td>
                                                        <td>{{ $member->occupation }}</td>
                                                        <td>{{ $member->marital_status }}</td>
                                                        <td>
                                                            <a href="{{ route('member.edit', ['id' => $member->id]) }}"
                                                                class="status-active rounded-pill" title="Edit">
                                                                <i class="lni lni-pencil-alt"></i>
                                                            </a>
                                                            <a href="{{ route('member.delete', ['id' => $member->id]) }}"
                                                                class="status-inactive rounded-pill"
                                                                onclick="return confirm('Are you sure?')" title="Delete">
                                                                <i class="lni lni-trash-can"></i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>




@endsection
