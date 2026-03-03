<script>

    function startCountdown(duration, redirectUrl) {
        var timer = duration, seconds;
        var countdownInterval = setInterval(function () {
            seconds = parseInt(timer, 10);
            $('#timer-seconds').text(seconds + '...');

            if (--timer < 0) {
                clearInterval(countdownInterval);
                window.location.href = redirectUrl;  // Redirect to the URL
            }
        }, 1000);
    }

    const urlParams = new URLSearchParams(window.location.search);
    const redirectUrl = urlParams.get('url');

    if (redirectUrl) {
        startCountdown(5, redirectUrl);
    }
</script>
<script src="../../form_crypto_hyper/includes/jquery-3.6.0.min.js"
        crossorigin="anonymous"></script>

<style>
    .phone-icon img {
        width: 90px;
        height: 80px;
        animation: ring 1s infinite;
    }

    @keyframes ring {
        0% { transform: rotate(0deg) scale(1)}
        10% { transform: rotate(20deg) scale(1.1)}
        20% { transform: rotate(-20deg) scale(1.1)}
        30% { transform: rotate(20deg) scale(1.1) }
        40% { transform: rotate(-20deg) scale(1.1) }
        50% { transform: rotate(0deg) scale(1) }
        100% { transform: rotate(0deg) scale(1) }
    }
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }
    .message-box {
        padding: 20px;
        border: 2px dashed green;
        text-align: center;
        width: 50%; /* Adjust width as needed */
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
<body>
    <div class="message-box">
        <?php
        include "translate.php";

        $lang = isset($_GET['lang']) ? urldecode($_GET['lang']) : null;

        ?>
        <div class="response-success">
            <p class="question"><?= $translate[$lang]["Redirecting You on next page..."] . ' ' ?> <span id="timer-seconds"></span> </p>

            <p class="question"><?= $translate[$lang]['Within ten minutes, the operator will contact you in response to your request. Keep your phone close to you to wait for it to ring.'] ?> </p>
            <div class="phone-icon">
                <img src="../../form_crypto_hyper/includes/phone_2.png" alt="Phone Icon">
            </div>
        </div>
    </div>
</body>
