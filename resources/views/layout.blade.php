<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Custom styles */
        .jumbotron {
            background-color: #007bff;
            color: white;
            padding: 4rem 2rem;
            margin-bottom: 0;
        }

        .feature-icon {
            font-size: 4rem;
            color: #007bff;
        }

        .feature-text {
            color: #007bff;
        }

        .feature-box {
            padding: 3rem;
            border-radius: 10px;
            background-color: #f8f9fa;
        }

        .feature-box:hover {
            background-color: #e9ecef;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Message container style */
        .message {
            margin-bottom: 10px;
            max-width: 80%;
            /* Adjust the maximum width as needed */
            padding: 8px;
            border-radius: 8px;
            clear: both;
            /* Clear floats */
        }

        /* Sent message style */
        .sent {
            background-color: #DCF8C6;
            /* Change to desired color */
            float: left;
            /* Align sent messages to the left */
        }

        /* Received message style */
        .received {
            background-color: #EDEDED;
            /* Change to desired color */
            float: right;
            /* Align received messages to the right */
        }

        /* Message content style */
        .message-content {
            padding: 5px 10px;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    @yield('content')

    {{-- <footer class="bg-dark text-light text-center py-4">
        <div class="container">
          <p>&copy; 2024 Student & Alumni Platform</p>
        </div>
      </footer> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
  </body>

</html>
