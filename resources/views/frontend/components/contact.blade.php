<section class="section contact__v2" id="consultation">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 col-lg-7 mx-auto text-center">
                <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0"
                    data-translate="contactLable">Consultation</span>
                <h2 class="h2 fw-bold mb-3" data-aos="fade-up" data-aos-delay="0" data-translate="contactTitle">
                    Consultation
                </h2>
                <p data-aos="fade-up" data-aos-delay="100" data-translate="contactSubTitle">
                    Utilize our tools to develop your concepts and bring your
                    vision to life. Once complete, effortlessly share your
                    creations.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex gap-5 flex-column">
                    <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="0">
                        <div class="icon d-block">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <span>
                            <span class="d-block">Phone</span><strong>+62 813-2020-558</strong></span>
                    </div>
                    <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon d-block"><i class="bi bi-send"></i></div>
                        <span>
                            <span class="d-block">Email</span><strong>admin@alharamainservices.id</strong></span>
                    </div>
                    <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon d-block">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <span>
                            <span class="d-block">Address</span>
                            <address class="fw-bold">
                                Jl. Hanjawar, Palasari, Kec. Cipanas, Kabupaten Cianjur,
                                <br />
                                Jawa Barat 43253, Indonesia
                            </address>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-wrapper" data-aos="fade-up" data-aos-delay="300">
                    <form method="POST" action="{{ route('send-message') }}" id="contactForm">
                        @csrf
                        <div class="row gap-3 mb-3">
                            <div class="col-md-12">
                                <label class="mb-2" for="name">Name</label>
                                <input class="form-control" id="name" type="text" name="name"
                                    required="" />
                            </div>
                            <div class="col-md-12">
                                <label class="mb-2" for="email">Email</label>
                                <input class="form-control" id="email" type="email" name="email"
                                    required="" />
                            </div>
                        </div>
                        <div class="row gap-3 mb-3">
                            <div class="col-md-12">
                                <label class="mb-2" for="subject">Subject</label>
                                <input class="form-control" id="subject" type="text" name="subject" required />
                            </div>
                        </div>
                        <div class="row gap-3 gap-md-0 mb-3">
                            <div class="col-md-12">
                                <label class="mb-2" for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required=""></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary fw-semibold" type="submit">
                            Send Message
                        </button>
                    </form>
                    @if (session('success'))
                        {{-- <div class="alert alert-success">{{ session('success') }}</div> --}}
                        <div class="mt-3 d-none alert alert-success" id="successMessage"
                            data-translate="contactMessage">
                            Message sent successfully!
                        </div>
                    @endif

                    @if (session('error'))
                        {{-- <div class="alert alert-danger">{{ session('error') }}</div> --}}
                        <div class="mt-3 d-none alert alert-danger" id="errorMessage"
                            data-translate="contactErrorMessage">
                            Message sending failed. Please try again later.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
