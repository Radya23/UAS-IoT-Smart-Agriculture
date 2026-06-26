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
        .btn-primary { background: #2d6a4f; border: none; border-radius: 12px; transition: 0.3s; }
        .btn-primary:hover { background: #1b4332; }
        .btn-danger { background: #d90429; border: none; border-radius: 12px; transition: 0.3s; }
        .btn-danger:hover { background: #9d0208; }
        h2 { color: #081c15; font-weight: 800; }
        h5 { color: #2d6a4f; font-weight: 600; }
    </style>
</head>
<body class="p-4">
    <div class="container">
        <h2 class="text-center mb-4">🌱 Smart Agriculture Dashboard</h2>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 text-center">
                    <h5>Kontrol Pompa</h5>
                    <div class="mt-3">
                        <button class="btn btn-primary px-4 py-2 mx-2" onclick="kirim('ON')">SIRAM</button>
                        <button class="btn btn-danger px-4 py-2 mx-2" onclick="kirim('OFF')">MATIKAN</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4 p-4">
            <h5>Histori Penyiraman</h5>
            <table class="table mt-3">
                <thead><tr><th>Waktu</th><th>Aksi</th></tr></thead>
                <tbody id="historiBody"></tbody>
            </table>
        </div>
    </div>

    <script>
        function kirim(status) {
            fetch('/api/sensor/update-pompa', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({status: status})
            }).then(() => loadHistori());
        }

        function loadHistori() {
            fetch('/api/sensor/histori')
                .then(r => r.json())
                .then(data => {
                    let html = '';
                    data.forEach(d => html += `<tr><td>${d.created_at}</td><td>Pompa ${d.status_pompa}</td></tr>`);
                    document.getElementById('historiBody').innerHTML = html;
                });
        }

        // Load data saat halaman dibuka
        loadHistori();
        // Update histori otomatis setiap 5 detik
        setInterval(loadHistori, 5000);
    </script>
</body>
</html>