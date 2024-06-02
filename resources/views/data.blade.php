<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="bg-light">

    <div class="container d-flex min-vh-100 justify-content-center align-items-center">
        <div class="card w-50 ">
            <div class="card-body" style="font-size: 20px;">
                <p>DevEUI: <span id="devEui">{{ $data['dev_eui'] }}</span></p>
                <p>SNR: <span id="snr">{{ $data['data']->snr }}</span></p>
                <p>RSSI: <span id="rssi">{{ $data['data']->rssi }}</span></p>
                <p>Last Update: <span id="lastUpdate">{{ \Carbon\Carbon::parse($data['data']->timestamp)->format('d/m/Y - H:i:s') }}</span></p>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="{{route('home')}}">Kembali</a>
                <a class="btn btn-success" href="{{url('device/'. $data['id'])}}">Get Data</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk memperbarui data secara berkala
            function fetchData() {
                $.ajax({
                    url: "{{ url('device/' . $data['id'] . '/ajax') }}",
                    type: 'GET',
                    success: function(response) {
                        // Periksa apakah ada data baru
                        if (response.dev_eui !== undefined) {
                            // Perbarui tampilan dengan data baru
                            $('#devEui').text(response.dev_eui);
                            $('#snr').text(response.snr);
                            $('#rssi').text(response.rssi);
                            $('#lastUpdate').text(response.last_update);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Panggil fungsi fetchData setiap beberapa detik (misalnya, setiap 5 detik)
            setInterval(fetchData, 5000); // 5000 milliseconds = 5 seconds
        });
    </script>
</body>

</html>