<?php

// Network Hashrate
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://explorer.dingocoin.org/api/getnetworkhashps",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",

]);

$dhash = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

// Difficulty
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://explorer.dingocoin.org/api/getdifficulty",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",

]);

$difficulty = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

// Coin Supply
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://explorer.dingocoin.org/ext/getmoneysupply",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",

]);

$csupply = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
?>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.1s">
                <img class="img-fluid mb-4" src="img/icon-9.png" alt="">
                <h4 data-toggle="counter-up"><?php echo $dhash ?></h4>
                <p class="fs-5 text-dark mb-0">Network (GH/s)</p>

            </div>
            <div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.3s">
                <img class="img-fluid mb-4" src="img/icon-10.png" alt="">
                <h4 data-toggle="counter-up"><?php echo $difficulty ?></h4>
                <p class="fs-5 text-dark mb-0">Difficulty</p>
                     
            </div>
            <div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.5s">
                <img class="img-fluid mb-4" src="img/icon-2.png" alt="">
                <h4 data-toggle="counter-up"><?php echo $csupply ?></h4>
                <p class="fs-5 text-dark mb-0">Coin Supply</p>
        </div>            
    </div>
</div>
