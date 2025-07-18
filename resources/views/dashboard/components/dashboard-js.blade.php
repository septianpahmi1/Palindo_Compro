<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let areaChart = null,
        lineChart = null;

    document.getElementById('applyFilter').addEventListener('click', fetchDashboard);

    function fetchDashboard() {
        const params = new URLSearchParams({
            range: document.getElementById('range').value,
            year: document.getElementById('year').value,
            month: document.getElementById('month').value
        });

        document.getElementById('dashboard-loading').style.display = 'block';

        fetch(`{{ route('dashboard.data') }}?${params.toString()}`)
            .then(res => {
                if (!res.ok) throw new Error('Server error: ' + res.status);
                return res.json();
            })
            .then(data => {
                if (!data.status) {
                    alert('Error: ' + (data.message || 'Unknown error'));
                    return;
                }

                // Update metrics
                document.getElementById('metric-spending').textContent = rupiah(data.spendingTotal);
                document.getElementById('metric-submission').textContent = rupiah(data.submissionTotal);
                document.getElementById('metric-cost').textContent = rupiah(data.totalCost);
                document.getElementById('metric-benefit').textContent = rupiah(data.totalBenefit);

                // Update charts
                updateCharts(data.chart);
            })
            .catch(err => {
                console.error(err);
                alert('Failed to fetch data. Check console or Laravel logs.');
            })
            .finally(() => {
                document.getElementById('dashboard-loading').style.display = 'none';
            });
    }

    function updateCharts(chart) {
        const labels = chart.labels;

        if (areaChart) areaChart.destroy();
        if (lineChart) lineChart.destroy();

        const areaCtx = document.getElementById('areaChart').getContext('2d');
        areaChart = new Chart(areaCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Consumers',
                    data: chart.consumers,
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0,123,255,0.3)',
                    fill: true
                }]
            }
        });

        const lineCtx = document.getElementById('lineChart').getContext('2d');
        lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Benefit (Rp)',
                    data: chart.benefit,
                    borderColor: '#28a745',
                    fill: false
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: ctx => ' ' + rupiah(ctx.parsed.y)
                        }
                    }
                }
            }
        });
    }

    function rupiah(num) {
        num = Number(num) || 0;
        return 'Rp ' + num.toLocaleString('id-ID');
    }
</script>
