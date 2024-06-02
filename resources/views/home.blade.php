<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Drive Test</title>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container d-flex min-vh-100 justify-content-center align-items-center">
        <div class="card w-100">
            <div class="card-body">
                <form id="device-form" action="" method="get">
                    <select class="form-select js-example-basic-single" name="device_id" id="device-select">
                        @foreach ($device as $dev)
                        <option value="{{ $dev['id'] }}">{{ $dev['dev_eui'] }}</option>
                        @endforeach
                    </select>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mt-3">Pilih</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('device-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            var selectedDeviceId = document.getElementById('device-select').value;
            this.action = 'device/' + selectedDeviceId;
            this.submit(); // Now submit the form
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</body>

</html>