@extends('layout.main')
@section('content')
    <section id="contact" class="contact">
        <div class="container section-padding">
            <div class="row">
                <div class="col-sm">
                    <img src="{{ url('assets\img\mukhiya.png') }}" alt="ad banner1" width="100%">
                </div>
                <div class="col-sm">
                    <h4 class="title"> <B> पता :</B><Br><span class="btn primary">{{ $family->name }}</span>
                        <BR> गोत्र: {{ $family->gotra_name }} <br> शहर : {{ $family->tehsil_name }} <br> जिला :
                        {{ $family->district_name }} <BR>राज्य : {{ $family->state_name }}
                    </h4>
                </div>
                <div class="col-sm">
                    <img src="{{ url('assets\img\mukhiya.png') }}" alt="ad banner1" width="100%">
                </div>
            </div>
        </div>
        <div class="container" data-aos="fade-up">
            <h5 class="title"> परिवार के सदस्य </h5>
            <div class="row">
                <div class="col-lg-12 col-sm-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="info">
                        <div class="content table-responsive table-full-width">
                            {{-- <h4>{{$cityName}} में कुल परिवार : {{$count}}</h4> --}}

                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>क्रम संख्या</th>
                                    <th>नाम </th>
                                    <th>गोत्र </th>
                                    <th>मुखिया से सम्बन्ध </th>
                                    <th>आयु </th>
                                    <th>शिक्षा </th>
                                    <th>वर्तमान पता</th>
                                    <th>आवासीय स्थायी पता </th>
                                    <th>व्यवसाय</th>
                                    <th>वैवाहिक स्थिति</th>
                                    <th>मोबाइल</th>

                                </thead>

                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($members as $member)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $member->name }}</td>
                                            <td>{{ $member->gotra_name }}</td>
                                            <td>{{ $member->relation }}</td>
                                            <td>
                                                @if ($member->birth_year)
                                                    {{ \Carbon\Carbon::now()->year - $member->birth_year }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $member->education }}</td>
                                            <td>{{ $member->native }}</td>
                                            <td>{{ $member->current }}</td>
                                            <td>{{ $member->occupation }}</td>
                                            <td>{{ $member->marital_status }}</td>
                                            <td>{{ $member->mobile }}</td>
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
    </section><!-- End Contact Us Section -->
@endsection
