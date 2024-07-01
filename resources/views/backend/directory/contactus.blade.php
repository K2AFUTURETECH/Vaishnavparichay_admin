@extends('layout.main')
@section('content')
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissable fade show">

                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissable fade show">

                    {{ session('success') }}
                </div>
            @endif
            <div class="section-title">
                <h2>Contact Us</h2>

            </div>

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="info">
                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email Address:</h4>
                            <p>vaishnavparichay@gmail.com</p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('backend.directory.email') }}" method="post" role="form"
                        class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Your Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Your Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="name">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <select name="subject" class="form-control" required="required">
                                <option value="">Select Subject</option>
                                <option value="for advertisment">Advertise on website</option>
                                <option value="for change in family">Update Family Memeber</option>
                                <option value="Normal Enquery">Normal Enquery</option>
                                <option value="Suggestion">Suggestion / Tip</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="message" rows="10" required placeholder="Your Message"></textarea>
                            <div class="clearfix"></div>
                            <small> फॅमिली डिटेल में चेंज करवाने के लिए परिवार के मुखिया
                                का मोबाइल नंबर जरूर लिखें </small>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Us Section -->
@endsection
