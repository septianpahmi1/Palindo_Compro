function formatRupiah(value) {
    // Hapus semua karakter non-angka
    let numberString = value.replace(/[^,\d]/g, ""),
        split = numberString.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // Tambahkan titik pemisah ribuan
    if (ribuan) {
        let separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    // Tambahkan koma jika ada angka desimal
    rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;

    return rupiah ? "Rp " + rupiah : "";
}

// Tambahkan event ke semua input dengan class .rupiah
document.querySelectorAll(".rupiah").forEach(function (input) {
    input.addEventListener("input", function (e) {
        this.value = formatRupiah(this.value);
    });
});
