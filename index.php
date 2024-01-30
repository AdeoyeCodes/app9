<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="PHP">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="author" content="Bolux"> 
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
    <script src="https://kit.fontawesome.com/965b829563.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1> IP Information </h1>
        <form action="api.php" method="post">
            <button class="btn btn-success" id="getInfoBtn"> Get Information </button>
        </form>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeBtn">&times;</span>
            <p id="ipInfo"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('modal');
            const ipInfoElement = document.getElementById('ipInfo');

            // Handle the form submission
            document.querySelector('form').addEventListener('submit', function (event) {
                event.preventDefault();

                // Fetch IP information using PHP
                fetch('api.php', {
                    method: 'POST',
                    body: new URLSearchParams(new FormData(this))
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    const ipInfoArray = [];

                    if (data.ip) {
                        ipInfoArray.push(`IP Address: ${data.ip}`);
                    }

                    if (data.country) {
                        ipInfoArray.push(`Country: ${data.country}`);
                    }

                    if (data.latitude && data.longitude) {
                        ipInfoArray.push(`Latitude: ${data.latitude}`);
                        ipInfoArray.push(`Longitude: ${data.longitude}`);
                    }

                    const ipInfo = ipInfoArray.join('<br>');
                    ipInfoElement.innerHTML = ipInfo;
                    modal.style.display = 'block';
                })
                .catch(error => console.error('Error fetching data:', error.message));
            });

            const closeBtn = document.getElementById('closeBtn');
            closeBtn.addEventListener('click', function () {
                modal.style.display = 'none';
            });
        });
    </script>
</body>
</html>
