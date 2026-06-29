<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Agriculture Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #d8f3dc 0%, #b7e4c7 100%); min-height: 100vh; font-family: 'Segoe UI', sans-serif; }
        .card { border-radius: 25px; background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: none; box-shadow: 0 8px 32px rgba(0,0,0,0.1); }
        h2 { color: #081c15; font-weight: 800; }
        h5 { color: #2d6a4f; font-weight: 600; }
    </style>
</head>
<body class="p-4">
    <div class="container">
        <h2 class="text-center mb-4">🌱 Monitoring Kelembapan Tanah</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <h5>Persentase Kelembapan Tanah</h5>
                    <div class="progress mt-3" style="height: 35px; border-radius: 10px;">
                        <div id="barKelembapan" class="progress-bar" style="width: 0%">-</div>
                    </div>
                    <p id="labelStatus" class="mt-3 fw-bold text-muted fs-4">Status: -</p>
                </div>
            </div>
        </div>

        <div class="card mt-4 p-4">
            <h5>Histori Penyiraman Otomatis</h5>
            <table class="table mt-3">
                <thead><tr><th>Waktu</th><th>Status Aksi</th></tr></thead>
                <tbody id="historiBody"></tbody>
            </table>
        </div>
    </div>

<script>
    function updateUI() {
        fetch('/api/sensor/status')
            .then(r => r.json())
            .then(data => {
                let val = data.kelembapan;
                let bar = document.getElementById('barKelembapan');
                let label = document.getElementById('labelStatus');
                
                if (val === 0 || val === null || val === undefined) {
                    bar.style.width = "0%";
                    bar.innerText = "-";
                    bar.className = "progress-bar bg-secondary";
                    label.innerText = "Status: Menunggu Data...";
                } else {
                    bar.style.width = val + "%";
                    bar.innerText = val + "%";
                    if (val < 40) {
                        bar.className = "progress-bar bg-danger";
                        label.innerText = "Status: Kering (Pompa ON)";
                    } else if (val <= 70) {
                        bar.className = "progress-bar bg-warning";
                        label.innerText = "Status: Normal/Lembab (Pompa OFF)";
                    } else {
                        bar.className = "progress-bar bg-success";
                        label.innerText = "Status: Basah (Pompa OFF)";
                    }
                }
            });
    }

    function loadHistori() {
        fetch('/api/sensor/histori')
            .then(r => r.json())
            .then(data => {
                let html = '';
                data.forEach(d => html += `<tr><td>${d.created_at}</td><td>${d.status_pompa}</td></tr>`);
                document.getElementById('historiBody').innerHTML = html;
            });
    }

    setInterval(() => {
        updateUI();
        loadHistori();
    }, 3000);

    loadHistori(); 
    updateUI();
</script>
</body>
</html>
