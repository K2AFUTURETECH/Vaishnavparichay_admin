@extends('layout.main')
@section('content')
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 col-sm-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="info">
                        <div class="content table-responsive table-full-width">
                            <h4>{{$cityName}} में कुल परिवार : {{$count}}</h4>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>क्रम संख्या</th>
                                    <th>परिवार का नाम </th>
                                    <th>गोत्र </th>
                                    <th>संपर्क मोबाइल </th>

                                    <th>जुड़ने की तिथि </th>
                                    <th>एक्शन </th>
                                </thead>

                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($directory as $d)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->gotraname }}</td>
                                            <td>{{ $d->mobile }}</td>
                                            <td>{{ \Carbon\Carbon::parse($d->created)->format('d-m-Y') }}</td>


                                            <td>
                                                <a href="{{ route('backend.directory.view', $d->id) }}"> परिवार के सदस्य
                                                    देखे </a>

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
    </section><!-- End Contact Us Section -->
@endsection
