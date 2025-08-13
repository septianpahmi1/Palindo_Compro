function parseRupiah(str) {
    return parseInt(str.replace(/[^0-9]/g, "")) || 0;
}

function hitungTotal() {
    let salary = parseRupiah(document.getElementById("salary").value);
    let allowance = parseRupiah(document.getElementById("allowance").value);
    let deduction = parseRupiah(document.getElementById("deduction").value);

    let total = salary + allowance - deduction;
    document.getElementById("total").value = formatRupiah(total.toString());
}

// Event listener untuk setiap perubahan input
document.getElementById("salary").addEventListener("input", hitungTotal);
document.getElementById("allowance").addEventListener("input", hitungTotal);
document.getElementById("deduction").addEventListener("input", hitungTotal);
