<!doctype html>
<html lang="en">
<head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= $base_url ?>/css/style.css">
</head>
<body onload="initAutocomplete()">
<main>
    <div class="container">
        <input id="autocomplete" placeholder="Enter city" type="text">
        <button id="send">Send</button>
    </div>
</main>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDeWM8R1-lVp0_X7ewC3jM-b8fe0Ffpms&libraries=places&language=en"
        async defer></script>
<script type="text/javascript" src="<?= $base_url ?>/js/common.js"></script>
</body>
</html>
