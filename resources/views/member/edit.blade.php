@extends('layout.admin.adminapp')
@section('title', 'Edit Family')
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div>
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <h4 class="page-title">Edit member</h4>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('member.editmember', $member->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="family_id" value="{{ request('id') }}">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label id="name"> Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name"
                                                value="{{ old('name', $member->name) }}"
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
                                                value="{{ old('name', $member->birth_year) }}"
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
                                                value="{{ old('name', $member->education) }}"
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
                                                <option value="स्वयं"
                                                    {{ old('relation', $member->relation ?? '') == 'स्वयं' ? 'selected' : '' }}>
                                                    स्वयं</option>
                                                <option value="पत्नी"
                                                    {{ old('relation', $member->relation ?? '') == 'पत्नी' ? 'selected' : '' }}>
                                                    पत्नी</option>
                                                <option value="पुत्र"
                                                    {{ old('relation', $member->relation ?? '') == 'पुत्र' ? 'selected' : '' }}>
                                                    पुत्र</option>
                                                <option value="पुत्री"
                                                    {{ old('relation', $member->relation ?? '') == 'पुत्री' ? 'selected' : '' }}>
                                                    पुत्री</option>
                                                <option value="पुत्रवधु"
                                                    {{ old('relation', $member->relation ?? '') == 'पुत्रवधु' ? 'selected' : '' }}>
                                                    पुत्रवधु</option>
                                                <option value="पौत्र"
                                                    {{ old('relation', $member->relation ?? '') == 'पौत्र' ? 'selected' : '' }}>
                                                    पौत्र</option>
                                                <option value="पौत्री"
                                                    {{ old('relation', $member->relation ?? '') == 'पौत्री' ? 'selected' : '' }}>
                                                    पौत्री</option>
                                                <option value="पौत्रवधु"
                                                    {{ old('relation', $member->relation ?? '') == 'पौत्रवधु' ? 'selected' : '' }}>
                                                    पौत्रवधु</option>
                                                <option value="परपौत्र"
                                                    {{ old('relation', $member->relation ?? '') == 'परपौत्र' ? 'selected' : '' }}>
                                                    परपौत्र</option>
                                                <option value="परपौत्री"
                                                    {{ old('relation', $member->relation ?? '') == 'परपौत्री' ? 'selected' : '' }}>
                                                    परपौत्री</option>
                                                <option value="भाई"
                                                    {{ old('relation', $member->relation ?? '') == 'भाई' ? 'selected' : '' }}>
                                                    भाई</option>
                                                <option value="बहन"
                                                    {{ old('relation', $member->relation ?? '') == 'बहन' ? 'selected' : '' }}>
                                                    बहन</option>
                                                <option value="भानजी"
                                                    {{ old('relation', $member->relation ?? '') == 'भानजी' ? 'selected' : '' }}>
                                                    भानजी</option>
                                                <option value="भतीजा"
                                                    {{ old('relation', $member->relation ?? '') == 'भतीजा' ? 'selected' : '' }}>
                                                    भतीजा</option>
                                                <option value="भांजा"
                                                    {{ old('relation', $member->relation ?? '') == 'भांजा' ? 'selected' : '' }}>
                                                    भांजा</option>
                                                <option value="भतीजी"
                                                    {{ old('relation', $member->relation ?? '') == 'भतीजी' ? 'selected' : '' }}>
                                                    भतीजी</option>
                                                <option value="बुआ"
                                                    {{ old('relation', $member->relation ?? '') == 'बुआ' ? 'selected' : '' }}>
                                                    बुआ</option>
                                                <option value="दादा जी"
                                                    {{ old('relation', $member->relation ?? '') == 'दादा जी' ? 'selected' : '' }}>
                                                    दादा जी</option>
                                                <option value="दादी जी"
                                                    {{ old('relation', $member->relation ?? '') == 'दादी जी' ? 'selected' : '' }}>
                                                    दादी जी</option>
                                                <option value="पिता"
                                                    {{ old('relation', $member->relation ?? '') == 'पिता' ? 'selected' : '' }}>
                                                    पिता</option>
                                                <option value="माता"
                                                    {{ old('relation', $member->relation ?? '') == 'माता' ? 'selected' : '' }}>
                                                    माता</option>
                                                <option value="काका"
                                                    {{ old('relation', $member->relation ?? '') == 'काका' ? 'selected' : '' }}>
                                                    काका</option>
                                                <option value="काकी"
                                                    {{ old('relation', $member->relation ?? '') == 'काकी' ? 'selected' : '' }}>
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
                                                value="{{ old('native', $member->native) }}"
                                                class="form-control @error('native') is-invalid @enderror" />
                                            @error('native')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-style-1">
                                            <label for="current">Current Address <span class="text-danger">*</span></label>
                                            <input type="text" name="current" id="current"
                                                value="{{ old('current', $member->current) }}"
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
                                                value="{{ old('mobile', $member->mobile) }}"
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
                                                    {{ old('occupation', $member->occupation) == 'विद्यार्थी' ? 'selected' : '' }}>
                                                    विद्यार्थी</option>
                                                <option value="सरकारी कर्मचारी"
                                                    {{ old('occupation', $member->occupation) == 'सरकारी कर्मचारी' ? 'selected' : '' }}>
                                                    सरकारी कर्मचारी</option>
                                                <option value="डॉक्टर"
                                                    {{ old('occupation', $member->occupation) == 'डॉक्टर' ? 'selected' : '' }}>
                                                    डॉक्टर</option>
                                                <option value="इंजीनियर"
                                                    {{ old('occupation', $member->occupation) == 'इंजीनियर' ? 'selected' : '' }}>
                                                    इंजीनियर</option>
                                                <option value="नौकरी"
                                                    {{ old('occupation', $member->occupation) == 'नौकरी' ? 'selected' : '' }}>
                                                    नौकरी</option>
                                                <option value="व्यापार"
                                                    {{ old('occupation', $member->occupation) == 'व्यापार' ? 'selected' : '' }}>
                                                    व्यापार</option>
                                                <option value="शिक्षक"
                                                    {{ old('occupation', $member->occupation) == 'शिक्षक' ? 'selected' : '' }}>
                                                    शिक्षक</option>
                                                <option value="खेती"
                                                    {{ old('occupation', $member->occupation) == 'खेती' ? 'selected' : '' }}>
                                                    खेती</option>
                                                <option value="पुजारी"
                                                    {{ old('occupation', $member->occupation) == 'पुजारी' ? 'selected' : '' }}>
                                                    पुजारी</option>
                                                <option value="भजनी"
                                                    {{ old('occupation', $member->occupation) == 'भजनी' ? 'selected' : '' }}>
                                                    भजनी</option>
                                                <option value="संगीतकार"
                                                    {{ old('occupation', $member->occupation) == 'संगीतकार' ? 'selected' : '' }}>
                                                    संगीतकार</option>
                                                <option value="लाइट्स-टेंट"
                                                    {{ old('occupation', $member->occupation) == 'लाइट्स-टेंट' ? 'selected' : '' }}>
                                                    लाइट्स-टेंट</option>
                                                <option value="DJ"
                                                    {{ old('occupation', $member->occupation) == 'DJ' ? 'selected' : '' }}>
                                                    DJ</option>
                                                <option value="गृहणी"
                                                    {{ old('occupation', $member->occupation) == 'गृहणी' ? 'selected' : '' }}>
                                                    गृहणी</option>
                                                <option value="अन्य"
                                                    {{ old('occupation', $member->occupation) == 'अन्य' ? 'selected' : '' }}>
                                                    अन्य</option>
                                                <option value="फोटोग्राफर"
                                                    {{ old('occupation', $member->occupation) == 'फोटोग्राफर' ? 'selected' : '' }}>
                                                    फोटोग्राफर</option>
                                                <option value="प्रिंसिपल"
                                                    {{ old('occupation', $member->occupation) == 'प्रिंसिपल' ? 'selected' : '' }}>
                                                    प्रिंसिपल</option>
                                                <option value="प्राइवेट स्कूल"
                                                    {{ old('occupation', $member->occupation) == 'प्राइवेट स्कूल' ? 'selected' : '' }}>
                                                    प्राइवेट स्कूल</option>
                                                <option value="प्रोफेसर"
                                                    {{ old('occupation', $member->occupation) == 'प्रोफेसर' ? 'selected' : '' }}>
                                                    प्रोफेसर</option>
                                                <option value="कैटरर्स"
                                                    {{ old('occupation', $member->occupation) == 'कैटरर्स' ? 'selected' : '' }}>
                                                    कैटरर्स</option>
                                                <option value="सेवानिवृत"
                                                    {{ old('occupation', $member->occupation) == 'सेवानिवृत' ? 'selected' : '' }}>
                                                    सेवानिवृत</option>
                                                <option value="टूर्स एंड ट्रेवल्स"
                                                    {{ old('occupation', $member->occupation) == 'टूर्स एंड ट्रेवल्स' ? 'selected' : '' }}>
                                                    टूर्स एंड ट्रेवल्स</option>
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
                                                    {{ old('marital_status', $member->marital_status) == 'अविवाहित' ? 'selected' : '' }}>
                                                    अविवाहित</option>
                                                <option value="विवाहित"
                                                    {{ old('marital_status', $member->marital_status) == 'विवाहित' ? 'selected' : '' }}>
                                                    विवाहित</option>
                                                <option value="विधुर"
                                                    {{ old('marital_status', $member->marital_status) == 'विधुर' ? 'selected' : '' }}>
                                                    विधुर</option>
                                                <option value="विधवा"
                                                    {{ old('marital_status', $member->marital_status) == 'विधवा' ? 'selected' : '' }}>
                                                    विधवा</option>
                                                <option value="तलाकशुदा"
                                                    {{ old('marital_status', $member->marital_status) == 'तलाकशुदा' ? 'selected' : '' }}>
                                                    तलाकशुदा</option>
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
                                                <option value="Yes"
                                                    {{ old('is_dead', $member->is_dead ?? 'No') == 'Yes' ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="No"
                                                    {{ old('is_dead', $member->is_dead ?? 'No') == 'No' ? 'selected' : '' }}>
                                                    No</option>
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
                                            <img id="preview_photo" src="{{ asset('upload/members/' . $member->photo) }}"
                                                alt="Image Preview" style="max-width: 150px; max-height: 100px;">
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


    @endsection
    <script>
        function previewImage(inputId, imageId) {
            var input = document.getElementById(inputId);
            var image = document.getElementById(imageId);

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
