<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <h1>Scan QR Code untuk Absensi</h1>
    <div id="reader" style="width: 300px;"></div>
    <p id="result"></p>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('result').innerText = `QR Code ditemukan: ${decodedText}`;
            
            fetch('save_scan.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ qr_data: decodedText })
            })
            .then(response => response.text())
            .then(data => alert(data))
            .catch(error => console.error('Error:', error));
        }

        function onScanFailure(error) {
            // handle scan failure
        }

        let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>
</html>
