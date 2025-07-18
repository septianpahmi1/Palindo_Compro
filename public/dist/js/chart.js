let areaChartInstance = null;
let lineChartInstance = null;
let autoRefreshTimer = null;

const loadingEl = document.getElementById("dashboard-loading");
const applyBtn = document.getElementById("applyFilter");
const rangeEl = document.getElementById("range");
const yearEl = document.getElementById("year");
const monthEl = document.getElementById("month");
const monthWrap = document.getElementById("filter-month-wrap");

// Show/hide month select when range changes
rangeEl.addEventListener("change", function () {
    monthWrap.style.display = this.value === "month" ? "" : "none";
});

// Apply click
applyBtn.addEventListener("click", fetchDashboardData);

// Auto refresh every 60s
startAutoRefresh();

// Initial charts after page load (use current server values)
document.addEventListener("DOMContentLoaded", () => {
    fetchDashboardData(); // load fresh data + charts
});

/* ---------------- Core Fetch ---------------- */
function fetchDashboardData() {
    showLoading(true);
    const params = new URLSearchParams({
        range: rangeEl.value,
        year: yearEl.value,
        month: monthEl.value,
    });

    fetch(`{{ route('dashboard.data') }}?${params.toString()}`)
        .then((res) => res.json())
        .then((data) => {
            updateMetrics(data);
            renderCharts(data.chart);
        })
        .catch((err) => {
            console.error("Dashboard fetch failed:", err);
        })
        .finally(() => {
            showLoading(false);
            restartAutoRefresh();
        });
}

/* ---------------- Metrics Update ---------------- */
function updateMetrics(d) {
    document.getElementById("metric-spending").textContent = rupiah(
        d.spendingTotal
    );
    document.getElementById("metric-submission").textContent = rupiah(
        d.submissionTotal
    );
    document.getElementById("metric-cost").textContent = rupiah(d.totalCost);
    document.getElementById("metric-benefit").textContent = rupiah(
        d.totalBenefit
    );
}

/* ---------------- Charts ---------------- */
function renderCharts(chartData) {
    const labels = chartData.labels;

    // Consumers (area style)
    const areaCtx = document.getElementById("areaChart").getContext("2d");
    if (areaChartInstance) areaChartInstance.destroy();
    areaChartInstance = new Chart(areaCtx, {
        type: "line",
        data: {
            labels,
            datasets: [
                {
                    label: "Consumers",
                    data: chartData.consumers,
                    borderColor: "#007bff",
                    backgroundColor: "rgba(0,123,255,0.25)",
                    fill: true,
                    tension: 0.3,
                    borderWidth: 2,
                    pointRadius: 3,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                    },
                },
            },
        },
    });

    // Benefit
    const lineCtx = document.getElementById("lineChart").getContext("2d");
    if (lineChartInstance) lineChartInstance.destroy();
    lineChartInstance = new Chart(lineCtx, {
        type: "line",
        data: {
            labels,
            datasets: [
                {
                    label: "Total Benefit (Rp)",
                    data: chartData.benefit,
                    borderColor: "#28a745",
                    backgroundColor: "rgba(40,167,69,0.15)",
                    fill: false,
                    tension: 0.3,
                    borderWidth: 2,
                    pointRadius: 3,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (ctx) => " " + rupiah(ctx.parsed.y),
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: (v) => rupiah(v),
                    },
                },
            },
        },
    });
}

/* ---------------- Loading Spinner ---------------- */
function showLoading(show) {
    loadingEl.style.display = show ? "block" : "none";
}

/* ---------------- Auto Refresh ---------------- */
function startAutoRefresh() {
    autoRefreshTimer = setInterval(fetchDashboardData, 60000); // 60s
}

function restartAutoRefresh() {
    clearInterval(autoRefreshTimer);
    startAutoRefresh();
}

/* ---------------- Rupiah Format ---------------- */
function rupiah(num) {
    num = Number(num) || 0;
    return "Rp " + num.toLocaleString("id-ID");
}
