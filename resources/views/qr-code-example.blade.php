<!DOCTYPE html>
<html lang="en">
<head>
    <title>QR Code Scanner</title>
    <script src="{{ asset('js/html5-qrcode.min.js') }}" type="text/javascript"></script>
</head>
<body>
<h1>QR Code Scanner</h1>
<div style="width:500px;" id="reader"></div>
<script>
    function onScanSuccess(qrMessage) {
        // Handle the QR code data
        fetch('/qr-result', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({qrData: qrMessage})
        }).then(response => response.json())
            .then(data => {
                console.log(data);
                alert("QR Code scanned successfully: " + qrMessage);
            })
            .catch(error => console.error('Error:', error));
    }

    function onScanFailure(error) {
        // Handle scan failure, usually better to ignore and keep scanning.
        console.warn(`QR code scan error: ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {fps: 10, qrbox: 250});
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
</body>
</html>

{{--In the above code, we have created a simple HTML page with a title and a div element to display the QR code scanner. We have included the  html5-qrcode  library using the  script  tag.
We have also added a script tag that contains the JavaScript code to handle the QR code scanning. We have defined two functions  onScanSuccess  and  onScanFailure  to handle the success and failure of the QR code scanning.
In the  onScanSuccess  function, we are sending the scanned QR code data to the server using a POST request. We are also sending the CSRF token along with the request.
We have created an instance of the  Html5QrcodeScanner  class and called the  render  method to start the QR code scanning.
Step 4: Create a Route to Handle the QR Code Data
Next, we need to create a route in the  routes/web.php  file to handle the QR code data sent by the client.
Add the following route definition to the  routes/web.php  file:
# Path: routes/web.php--}}
