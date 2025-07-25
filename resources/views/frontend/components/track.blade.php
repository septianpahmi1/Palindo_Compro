<section class="section track_v1" id="track">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 col-lg-7 mx-auto text-center">
                <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-translate="trackLabel"
                    data-aos-delay="0">Track</span>
                <h2 class="h2 fw-bold mb-3" data-aos="fade-up" data-aos-delay="0" data-translate="trackTitle">
                    Track your documents
                </h2>
                <p data-aos="fade-up" data-aos-delay="100" data-translate="trackSubTitle">
                    Stay informed on the progress of your legal, immigration, or
                    travel documents.
                </p>
            </div>
        </div>
        <form id="track-form" class="d-flex gap-2">
            <input class="form-control" type="text" id="registration_id" placeholder="Enter Registration ID"
                required="" />
            <button class="btn btn-primary fs-6" type="submit" data-translate="trackButton">Track</button>
        </form>
        {{-- hasil-pencarian --}}
        <div id="track-result" class="mt-4"></div>
        {{-- <div class="col-md-6 col-lg-12 mt-4" data-aos="fade-up" data-aos-delay="200">
            <div class="p-4 border rounded-4 h-100">
                <div>
                    <div class="d-flex justify-content-between mb-2">

                        <h3 class="fs-5 mb-3">KITAS</h3>
                        <span class="border border-primary rounded-2 fs-6 p-2">In
                            review</span>
                    </div>
                    <p class="mb-4">
                        Expert support in applying for and renewing KITAS
                        (Temporary Stay Permit), ensuring all documentation and
                        requirements are handled properly.
                    </p>
                    <span class="border rounded-2 border-primary p-2 align-items-center">
                        <svg width="30px" height="30px" viewBox="0 0 1024 1024" class="icon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M352.64512 313.58976V159.85664c0-1.024-0.20992-1.98144-0.24064-2.9952V149.9136h-0.5632c-3.90144-33.9456-27.06944-60.12928-55.35232-60.12928H98.50368c-28.28288 0-51.45088 26.18368-55.35232 60.12928h-0.80384v228.1984h0.24064v62.65856c-0.03584 1.10592-0.24064 2.14016-0.24064 3.25632V876.83584h0.80384c3.90144 33.9456 27.06432 60.12416 55.3472 60.12928H296.48896c28.28288 0 51.45088-26.18368 55.35232-60.12928h0.5632v-5.22752h0.24064V373.89824h-0.24064V316.59008c0.03584-1.01888 0.24064-1.9712 0.24064-3.00032z"
                                fill="#3BCDAE" />
                            <path
                                d="M197.49888 762.79808m-84.02432 0a84.02432 84.02432 0 1 0 168.04864 0 84.02432 84.02432 0 1 0-168.04864 0Z"
                                fill="#FFFFFF" />
                            <path d="M120.61184 192.54784h153.77408v390.84544H120.61184z" fill="#FFFFFF" />
                            <path
                                d="M197.49888 762.79808m-39.17312 0a39.17312 39.17312 0 1 0 78.34624 0 39.17312 39.17312 0 1 0-78.34624 0Z"
                                fill="#3BCDAE" />
                            <path
                                d="M662.96832 313.58976V159.85664c0-1.024-0.20992-1.98144-0.24064-2.9952V149.9136h-0.5632c-3.90144-33.9456-27.06944-60.12928-55.35232-60.12928H408.82688c-28.28288 0-51.45088 26.18368-55.35232 60.12928h-0.80384v228.1984h0.24064v62.65856c-0.03584 1.10592-0.24064 2.14016-0.24064 3.25632V876.83584h0.80384c3.90144 33.9456 27.06432 60.12416 55.3472 60.12928H606.81216c28.28288 0 51.45088-26.18368 55.35232-60.12928h0.5632v-5.22752h0.24064V373.89824h-0.24064V316.59008c0.03584-1.01888 0.24064-1.9712 0.24064-3.00032z"
                                fill="#FCE38A" />
                            <path
                                d="M507.82208 762.79808m-84.02432 0a84.02432 84.02432 0 1 0 168.04864 0 84.02432 84.02432 0 1 0-168.04864 0Z"
                                fill="#FFFFFF" />
                            <path d="M430.93504 192.54784h153.77408v390.84544H430.93504z" fill="#FFFFFF" />
                            <path
                                d="M507.82208 762.79808m-39.17312 0a39.17312 39.17312 0 1 0 78.34624 0 39.17312 39.17312 0 1 0-78.34624 0Z"
                                fill="#FCE38A" />
                            <path
                                d="M976.92672 313.58976V159.85664c0-1.024-0.20992-1.98144-0.24064-2.9952V149.9136h-0.5632c-3.90144-33.9456-27.06944-60.12928-55.35232-60.12928h-197.98528c-28.28288 0-51.45088 26.18368-55.35232 60.12928h-0.80384v228.1984h0.24064v62.65856c-0.03584 1.10592-0.24064 2.14016-0.24064 3.25632V876.83584h0.80384c3.90144 33.9456 27.06432 60.12416 55.3472 60.12928H920.77056c28.28288 0 51.45088-26.18368 55.35232-60.12928h0.5632v-5.22752h0.24064V373.89824h-0.24064V316.59008c0.03584-1.01888 0.24064-1.9712 0.24064-3.00032z"
                                fill="#78CEF4" />
                            <path
                                d="M821.78048 762.79808m-84.02432 0a84.02432 84.02432 0 1 0 168.04864 0 84.02432 84.02432 0 1 0-168.04864 0Z"
                                fill="#FFFFFF" />
                            <path d="M744.89344 192.54784h153.77408v390.84544h-153.77408z" fill="#FFFFFF" />
                            <path
                                d="M821.78048 762.79808m-39.17312 0a39.17312 39.17312 0 1 0 78.34624 0 39.17312 39.17312 0 1 0-78.34624 0Z"
                                fill="#78CEF4" />
                        </svg>

                        <a href="" download> Nama File.Pdf
                        </a> &nbsp;&nbsp; <i class="bi bi-download text-primary"></i>
                    </span>
                </div>
            </div>
        </div> --}}
    </div>

</section>
