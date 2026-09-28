import Chart from "chart.js/auto";

document.addEventListener("DOMContentLoaded", () => {
    const giziCanvas = document.getElementById("giziChart");
    const ibuHamilCanvas = document.getElementById("ibuHamilChart");
    const chartDataEl = document.getElementById("chart-data");

    let giziData = [];
    let ibuData = [];

    if (chartDataEl) {
        giziData = JSON.parse(chartDataEl.dataset.gizi);
        ibuData = JSON.parse(chartDataEl.dataset.ibu);
    }

    // Chart Status Gizi Balita
    if (giziCanvas && giziData.length) {
        const ctx = giziCanvas.getContext("2d");
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Gizi Baik", "Gizi Buruk", "Stunting"],
                datasets: [
                    {
                        data: giziData,
                        backgroundColor: ["#10B981", "#F59E0B", "#EF4444"],
                    },
                ],
            },
            options: {
                plugins: {
                    legend: {
                        display: false,
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: { y: { beginAtZero: true } },
                    },
                },
            },
        });
    }

    // Chart Kondisi Ibu Hamil
    if (ibuHamilCanvas && ibuData.length) {
        const ctx = ibuHamilCanvas.getContext("2d");
        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Kondisi Baik", "Anemia"],
                datasets: [
                    {
                        data: ibuData,
                        backgroundColor: ["#10B981", "#476EAE"],
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: "right" } },
            },
        });
    }
});
