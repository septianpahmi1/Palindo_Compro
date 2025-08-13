 <footer class="footer pt-5 pb-5">
     <div class="container">
         <div class="row justify-content-between mb-5 g-xl-5">
             <div class="col-md-4 mb-5 mb-lg-0">
                 <a class="navbar-brand mb-4" href="#home">
                     <img class="img-fluid mb-4" width="300" src="dist/img/combain.png" alt="Logo Ghaleb" />
                 </a>
                 <br>
                 <h3 class="mb-3" data-translate="footerTitle">About</h3>
                 <p class="mb-4" data-translate="footerSubTitle">
                     PT. Ghaleb Palindo International is a service-oriented company
                     specializing in public services and tourism. We are committed
                     to providing fast, reliable, and high-quality assistance to
                     every client.
                 </p>
             </div>
             <div class="col-md-4">
                 <div class="row g-2">
                     <div class="col-md-6 col-lg-12 mb-4 mb-lg-0 quick-contact">
                         <h3 class="mb-3">Contact</h3>
                         <p class="d-flex mb-3">
                             <i class="bi bi-geo-alt-fill me-3"></i><span>Jl. Hanjawar, Sukanagalih, Kec. Cipanas,
                                 Kabupaten
                                 Cianjur, Jawa Barat 43253, Indonesia</span>
                         </p>
                         <a class="d-flex mb-3" href="mailto:info@mydomain.com"><i
                                 class="bi bi-envelope-fill me-3"></i><span>admin@alharamainservices.id</span></a><a
                             class="d-flex mb-3" href="tel://+123456789900"><i
                                 class="bi bi-telephone-fill me-3"></i><span>+62 813-2020-558</span></a><a
                             class="d-flex mb-3" href="https://freebootstrap.net"><i
                                 class="bi bi-globe me-3"></i><span>www.alharamainservices.id</span></a>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="row justify-content-center">
                     <h3 class="mb-3">Subscribe to Our Newletter </h3>
                     <form action="{{ route('subscribed') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <div class="col-md-12 mb-lg-0 w-full">
                             <input class="form-control mb-3" id="name" type="text" name="name"
                                 placeholder="Ex. John Doe" required />
                             <input class="form-control mb-3" id="email" type="email" name="email"
                                 placeholder="Ex. yourname@mail.com" required />
                         </div>
                         <div class="col-md-12">
                             <button class="btn btn-primary fw-semibold w-full" type="submit">
                                 Subscribe
                             </button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
         <div class="row credits pt-3">
             <div class="col-xl-12 text-center text-xl-center mb-3 mb-xl-0">
                 <!--
                Note:
                =>>> Please keep all the footer links intact. <<<=
                =>>> You can only remove the links if you buy the pro version. <<<=
                =>>> Buy the pro version, which includes a functional PHP/AJAX contact form and many additional features.: https://freebootstrap.net/template/vertex-pro-bootstrap-website-template-for-portfolio/ <<<=
                -->
                 &copy;
                 <script>
                     document.write(new Date().getFullYear());
                 </script>
                 PT Ghaleb Palindo International. All rights reserved.
             </div>
         </div>
     </div>
 </footer>
 <!-- End Footer-->
 </main>
 </div>

 <!-- ======= Back to Top =======-->
 {{-- <button id="back-to-top"><i class="bi bi-arrow-up-short"></i></button> --}}
 <button class="customer-service-btn" onclick="window.open('https://wa.me/628132020558', '_blank')">
     <i class="bi bi-whatsapp"></i>
 </button>


 <!-- End Back to top-->


 <!-- ======= Javascripts =======-->
 <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
 <script src="assets/vendors/gsap/gsap.min.js"></script>
 <script src="assets/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
 <script src="assets/vendors/isotope/isotope.pkgd.min.js"></script>
 <script src="assets/vendors/glightbox/glightbox.min.js"></script>
 <script src="assets/vendors/swiper/swiper-bundle.min.js"></script>
 <script src="assets/vendors/aos/aos.js"></script>
 <script src="assets/vendors/purecounter/purecounter.js"></script>
 <script src="assets/js/custom.js"></script>
 {{-- <script src="assets/js/send_email.js"></script> --}}
 <script src="assets/js/language.js"></script>
 {{-- <script src="assets/js/track.js"></script> --}}
 <script src="assets/js/custom-chat.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script>
     @if (Session::has('success'))
         Swal.fire({
             title: "Berhasil!",
             text: "{{ Session::get('success') }}",
             icon: "success"
         });
     @endif
     @if (Session::has('error'))
         toastr.options.closeButton = true;
         toastr.error("{{ Session::get('error') }}", 'Gagal!')
     @endif
 </script>
 <script>
     document.getElementById("track-form").addEventListener("submit", function(e) {
         e.preventDefault();

         const regId = document.getElementById("registration_id").value.trim();
         const resultDiv = document.getElementById("track-result");

         if (!regId) {
             resultDiv.innerHTML =
                 '<p class="text-danger">Please enter a Registration ID.</p>';
             return;
         }

         resultDiv.innerHTML = "<p>Loading...</p>";

         fetch(
                 `{{ route('track.document') }}?registration_id=${encodeURIComponent(
            regId
        )}`
             )
             .then((response) => response.json())
             .then((data) => {
                 if (!data.status) {
                     resultDiv.innerHTML = `<p class="text-danger">${
                    data.message ?? "Document not found."
                }</p>`;
                     return;
                 }

                 // --- Mapping status dari server ke index langkah ---
                 const statusRaw = (data.data.latest_status || "")
                     .toString()
                     .trim()
                     .toLowerCase();
                 let currentStep = 0;
                 switch (statusRaw) {
                     case "submitted":
                     case "submited": // toleransi typo
                         currentStep = 0;
                         break;
                     case "in review":
                     case "review":
                         currentStep = 1;
                         break;
                     case "in process":
                     case "on process":
                     case "on progres":
                     case "processing":
                         currentStep = 2;
                         break;
                     case "completed":
                     case "complete":
                     case "done":
                         currentStep = 3;
                         break;
                     default:
                         currentStep = 0;
                 }

                 const steps = [{
                         label: "Submitted",
                     },
                     {
                         label: "In Review",
                     },
                     {
                         label: "In Process",
                     },
                     {
                         label: "Completed",
                     },
                 ];

                 // Hitung width progress bar (0%, 33%, 66%, 100%) relatif ke jumlah step
                 const progressPercent = (currentStep / (steps.length - 1)) * 100;

                 // Build markup timeline
                 const timelineHtml = `
                    <div class="p-4 border rounded-4">
                        <div class="mb-4 text-center">
                            <h3 class="fs-5 mb-1">${
                                data.data.document_type ?? "Document"
                            }</h3>
                            <small class="text-muted">Registration: ${regId}</small>
                        </div>
                        <div class="doc-timeline">
                            ${steps
                                .map((s, idx) => {
                                    const stateClass =
                                        idx < currentStep
                                            ? "completed"
                                            : idx === currentStep
                                            ? "current"
                                            : "";
                                    return `
                                                                        <div class="doc-step ${stateClass}">
                                                                            <div class="doc-step-circle">${
                                                                                idx + 1
                                                                            }</div>
                                                                            <div class="doc-step-label">${
                                                                                s.label
                                                                            }</div>
                                                                        </div>
                                                                    `;
                                })
                                .join("")}
                        </div>
                        ${
                            data.data.file
                                ? `<a href="/file/documents/${data.data.file}" class="btn btn-outline-primary" download>Download File</a>`
                                : ``
                        }
                    </div>
                `;

                 resultDiv.innerHTML = timelineHtml;
             })
             .catch(() => {
                 resultDiv.innerHTML = `<p class="text-danger">Something went wrong!</p>`;
             });
     });
 </script>
 <!-- End JavaScripts-->
 </body>

 </html>
