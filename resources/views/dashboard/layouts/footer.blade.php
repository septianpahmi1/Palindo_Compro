<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/input-idr.js"></script>
<script src="dist/js/discount.js"></script>
<script src="dist/js/salary.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>


<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>

<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $('#searchByMonth').on('change', function() {
        let monthValue = $(this).val();
        let tbody = $('#example1 tbody');

        $.ajax({
            url: "{{ route('tasks.filter') }}",
            type: "GET",
            data: {
                month: monthValue
            },
            success: function(res) {
                // Hapus DataTables lama
                $('#example1').DataTable().clear().destroy();

                // Ganti isi tbody
                tbody.html(res.html);

                // Init ulang DataTables supaya export hanya ambil data baru
                $('#example1').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'excel', 'pdf', 'print']
                });
            }
        });
    });
</script>



<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $('.delete').click(function() {
        var dataid = $(this).attr('data-id');
        var url = $(this).attr('url')
        Swal.fire({
            title: "Anda Yakin?",
            text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "" + url + ""

            }

        });
    });
</script>

<script>
    $('.status').click(function() {
        var dataid = $(this).attr('data-id');
        var url = $(this).attr('url')
        Swal.fire({
            title: "Anda Yakin?",
            text: "Setelah dirubah, Anda tidak akan dapat memulihkan data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "" + url + ""

            }

        });
    });
</script>
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
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function() {
        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });



        // Date range picker
        $('#reservation').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end) {
            fetchData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        });

        // Panggil default: all time
        fetchData(); // tanpa parameter untuk ambil semua data

        function fetchData(startDate = '', endDate = '') {
            $('#metric-spending').text('Loading...');
            $('#metric-submission').text('Loading...');
            $('#metric-cost').text('Loading...');
            $('#metric-benefit').text('Loading...');

            let url = `{{ route('dashboard.data') }}`;
            if (startDate && endDate) {
                url += `?start=${startDate}&end=${endDate}`;
            }

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status) {
                        $('#metric-spending').text(rupiah(data.spendingTotal));
                        $('#metric-submission').text(rupiah(data.submissionTotal));
                        $('#metric-cost').text(rupiah(data.totalCost));
                        $('#metric-benefit').text(rupiah(data.totalBenefit));
                    } else {
                        alert(data.message || 'Gagal mengambil data');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Terjadi error saat memuat data');
                });
        }

        function rupiah(num) {
            num = Number(num) || 0;
            return 'Rp ' + num.toLocaleString('id-ID');
        }
    });
</script>

<script>
    $(function() {
        //Enable check and uncheck all functionality
        $('.checkbox-toggle').click(function() {
            var clicks = $(this).data('clicks')
            if (clicks) {
                //Uncheck all checkboxes
                $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
                $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass(
                    'fa-square')
            } else {
                //Check all checkboxes
                $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
                $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass(
                    'fa-check-square')
            }
            $(this).data('clicks', !clicks)
        })

        //Handle starring for font awesome
        $('.mailbox-star').click(function(e) {
            e.preventDefault()
            //detect type
            var $this = $(this).find('a > i')
            var fa = $this.hasClass('fa')

            //Switch states
            if (fa) {
                $this.toggleClass('fa-star')
                $this.toggleClass('fa-star-o')
            }
        })
    })
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const searchBtn = document.getElementById('search-btn');
        const mailboxContent = document.getElementById('mailbox-content');

        function fetchData(query = '') {
            fetch(`{{ route('consultation') }}?q=${encodeURIComponent(query)}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Gagal memuat data');
                    return response.text();
                })
                .then(html => {
                    if (mailboxContent) {
                        mailboxContent.innerHTML = html;
                    } else {
                        console.error('Element #mailbox-content not found.');
                    }
                })
                .catch(error => alert(error.message));
        }

        // Trigger on button click
        searchBtn.addEventListener('click', function() {
            fetchData(searchInput.value);
        });

        // Trigger on "Enter"
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                fetchData(searchInput.value);
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle semua checkbox
        const toggleBtn = document.querySelector('.checkbox-toggle');
        toggleBtn.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.select-item');
            const allChecked = [...checkboxes].every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);
            document.getElementById('delete-selected').disabled = !checkboxes.length;
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.select-item');
        const deleteButton = document.getElementById('delete-selected');
        const deleteForm = document.getElementById('delete-form');

        function toggleDeleteButton() {
            const selected = document.querySelectorAll('.select-item:checked');
            deleteButton.disabled = selected.length === 0;
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleDeleteButton);
        });

        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const selectedIds = Array.from(document.querySelectorAll('.select-item:checked'))
                .map(cb => cb.value);

            if (selectedIds.length === 0) {
                Swal.fire('Oops!', 'Pilih minimal 1 data untuk dihapus.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Data yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('consultation.delete') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                ids: selectedIds
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Berhasil!', 'Data berhasil dihapus.', 'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Gagal!', 'Data gagal dihapus.', 'error');
                            }
                        })
                        .catch(() => Swal.fire('Error', 'Terjadi kesalahan.', 'error'));
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-password').forEach(function(icon) {
            icon.addEventListener('click', function() {
                const input = document.querySelector(this.getAttribute('toggle'));
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    });
</script>

</body>

</html>
