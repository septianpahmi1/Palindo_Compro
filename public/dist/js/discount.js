function parseRupiah(str) {
    return parseInt(str.replace(/[^0-9]/g, "")) || 0;
}

function hitungTotal() {
    let price = parseRupiah(document.getElementById("price").value);
    let qty = parseInt(document.getElementById("quantity").value) || 0;
    let discount = parseRupiah(document.getElementById("discount").value);

    let total = price * qty - discount;
    document.getElementById("total").value = formatRupiah(total.toString());
}

// Event listener untuk semua input yang mempengaruhi total
document.getElementById("price").addEventListener("input", hitungTotal);
document.getElementById("quantity").addEventListener("input", hitungTotal);
document.getElementById("discount").addEventListener("input", hitungTotal);
