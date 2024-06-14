@extends('layout.main')
@section('content')
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">


            <div class="row">
                <div class="col-lg-6 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('backend.directory.list') }}" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="name">Select State</label>
                            <select name="states" class="form-control" required id="state"
                                onchange="getDistrict(this.value);">>
                                @foreach ($states as $state)
                                <option value="0">Select State</option>
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Select District</label>
                            <select name="district" class="form-control" required id="district"
                                onchange="getTehsil(this.value)">
                                <option value="0">Select district</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Select Tehsil</label>
                            <select name="tehsils" class="form-control" required id="tehsils"
                                onchange="getCity(this.value)">
                                <option value="0">Select Tehsil</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Select Town / Village</label>
                            <select name="cities" class="form-control" required id="cities">
                                <option value="0">Select city</option>
                            </select>
                        </div>


                        <div class="text-center"><button type="submit" value="सर्च करें">सर्च करें</button></div>
                    </form>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="info">
                        <h4> सर्च कैसे करे ?</h4>

                        <p>इस वेबसाइट पर आप अभी पाली ज़िला के कुछ गांव / सिटी के परिवार देख सकते है
                            वेबसाइट में इस तरह चुने </p>
                        <p><b>State</b> - Rajasthan</p>
                        <p><b> District </b> - Pali/jalore </p>
                        <p><b>Tehsil</b> -रानी /बाली / सुमेरपुर / देसूरी </p>
                        <p><b>City/town in rani tehsil </b> -रानी गांव / पुनाडिया पुरोहितान / माँडल </p>
                        <p><b>City/town in bali tehsil </b>-बाली / फालना / सेसलि /सेवाड़ी / लुणावा / पैरवा/ बेड़ल / बीजापुर/
                            भाटुन / खिमेल /कोट बालियान / खुडाला / लाटाड़ा </p>
                        <p><b> City/town in sumerpur tehsil </b>-जवाई बांध / सुमेरपुर / गलथनी </p>
                        <p><b> City/town in desuri tehsil </b>- देसूरी / मोरखा / गिराली</p>
                        <p><b> Tehsil in jalore district </b>-आहोर-village-भेंसवाड़ा</p>
                    </div>

                </div>



            </div>

        </div>
    </section><!-- End Contact Us Section -->
@endsection


@push('script')
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
    </script>
@endpush
