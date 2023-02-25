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

$nethash = curl_exec($curl);

$clean_string = str_replace('"', '', $nethash);
$float_number = $clean_string;

$magahash = $float_number; // evalue in megahash
$terahash = $magahash / 1000000000; // convert megahash to gigahash


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

$net_diff = curl_exec($curl);

$clean_string = str_replace('"', '', $net_diff);
$float_number = $clean_string;
$rounded_number = round($float_number, 2);
$cdiff = $rounded_number;
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

$supply = curl_exec($curl);
$clean_string = str_replace('"', '', $supply);
$num = $clean_string;
$formatted_num = number_format($num, 0, '.', ',');
$csupply = $formatted_num;
$err = curl_error($curl);

curl_close($curl);
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

// Block Height 
$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://openchains.info/api/v1/dingocoin/getheight",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",

]);

$bheight = curl_exec($curl);
$clean_string = str_replace('"', '', $bheight);
$num = $clean_string;
$formatted_num = number_format($num, 0, '.', ',');
$blockheight = $formatted_num;
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

// Current Price

if (isset($_POST['submit'])) {
	// code to be executed if condition is true
	$csym = $_POST["currencies"];
	// Set API endpoint URL and parameters + POST Data
	$api_url = "https://api.coingecko.com/api/v3/simple/price?ids=dingocoin&vs_currencies=$csym";
	$parameters = array(
		'symbol' => 'DINGOCOIN',
		"convert" => $csym
	);

	// Send API request and get response
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $api_url . '?' . http_build_query($parameters));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);

	// Parse the response JSON and extract the price value
	$data = json_decode($response, true);
	$dprice = $data['data']['DINGO']['quote'][$csym]['price'];

} else {
	$csym = 'USD';

	// Set API endpoint URL and parameters defaults
	$api_url = "https://api.coingecko.com/api/v3/simple/price?ids=dingocoin&vs_currencies=$csym";
	$parameters = array(
		'symbol' => 'DINGOCOIN',
		"convert" => $csym
	);
	// Send API request and get response
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $api_url . '?' . http_build_query($parameters));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);

	// Parse the response JSON and extract the price value
	$data = json_decode($response, true);
	$dprice = $data['data']['DINGO']['quote']['USD']['price'];
}
?>
<div class="container py-5">
	<div class="row g-5">
		<div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.1s">
			<img class="img-fluid mb-4" src="img/icon-9.png" alt="">
			<h4 data-toggle="counter-up">
				<?php echo number_format($terahash, 3, '.', ','); ?>
			</h4>
			<p class="fs-5 text-dark mb-0">Network (Th/s)</p>
		</div>
		<div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.3s">
			<img class="img-fluid mb-4" src="img/icon-10.png" alt="">
			<h4 data-toggle="counter-up">
				<?php echo $cdiff ?>
			</h4>
			<p class="fs-5 text-dark mb-0">Difficulty</p>
		</div>
		<div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.5s">
			<img class="img-fluid mb-4" src="img/icon-2.png" alt="">
			<h4 data-toggle="counter-up">
				<?php echo $csupply ?>
			</h4>
			<p class="fs-5 text-dark mb-0">Coin Supply</p>
		</div>
		<div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.5s">
			<img class="img-fluid mb-4" src="img/icon-2.png" alt="">
			<h4 data-toggle="counter-up">
				<?php echo $blockheight ?>
			</h4>
			<p class="fs-5 text-dark mb-0">Block Height</p>
		</div>
		<div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.5s">
			<img class="img-fluid mb-4" src="img/icon-2.png" alt="">
			<h4 data-toggle="counter-up">
				<?php echo number_format($dprice, 8) ?>
			</h4>

			<p class="fs-5 text-dark mb-0">Dingo Price [<?php echo $csym; ?> ]</p>
		</div>
		<div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.5s">

		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<div class="input-group">
					<select class="form-select form-select-sm" name="currencies" aria-label="">
						<option value="USD" label="USD">USD</option>;
						<option value="EUR" label="EUR">EUR</option>;
						<option value="JPY" label="JPY">JPY</option>
						<option value="GBP" label="GBP">GBP</option>
						<option value="AED" label="AED">AED</option>
						<option value="AFN" label="AFN">AFN</option>
						<option value="ALL" label="ALL">ALL</option>
						<option value="AMD" label="AMD">AMD</option>
						<option value="ANG" label="ANG">ANG</option>
						<option value="AOA" label="AOA">AOA</option>
						<option value="ARS" label="ARS">ARS</option>
						<option value="AUD" label="AUD">AUD</option>
						<option value="AWG" label="AWG">AWG</option>
						<option value="AZN" label="AZN">AZN</option>
						<option value="BAM" label="BAM">BAM</option>
						<option value="BBD" label="BBD">BBD</option>
						<option value="BDT" label="BDT">BDT</option>
						<option value="BGN" label="BGN">BGN</option>
						<option value="BHD" label="BHD">BHD</option>
						<option value="BIF" label="BIF">BIF</option>
						<option value="BMD" label="BMD">BMD</option>
						<option value="BND" label="BND">BND</option>
						<option value="BOB" label="BOB">BOB</option>
						<option value="BRL" label="BRL">BRL</option>
						<option value="BSD" label="BSD">BSD</option>
						<option value="BTN" label="BTN">BTN</option>
						<option value="BWP" label="BWP">BWP</option>
						<option value="BYN" label="BYN">BYN</option>
						<option value="BZD" label="BZD">BZD</option>
						<option value="CAD" label="CAD ">CAD</option>
						<option value="CDF" label="CDF">CDF</option>
						<option value="CHF" label="CHF">CHF</option>
						<option value="CLP" label="CLP">CLP</option>
						<option value="CNY" label="CNY">CNY</option>
						<option value="COP" label="COP">COP</option>
						<option value="CRC" label="CRC">CRC</option>
						<option value="CUC" label="CUC">CUC</option>
						<option value="CUP" label="CUP">CUP</option>
						<option value="CVE" label="CVE">CVE</option>
						<option value="CZK" label="CZK">CZK</option>
						<option value="DJF" label="DJF">DJF</option>
						<option value="DKK" label="DKK">DKK</option>
						<option value="DOP" label="DOP">DOP</option>
						<option value="DZD" label="DZD">DZD</option>
						<option value="EGP" label="EGP">EGP</option>
						<option value="ERN" label="ERN">ERN</option>
						<option value="ETB" label="ETB">ETB</option>
						<option value="FJD" label="FJD">FJD</option>
						<option value="FKP" label="FKP">FKP</option>
						<option value="GBP" label="GBP">GBP</option>
						<option value="GEL" label="GEL">GEL</option>
						<option value="GGP" label="GGP">GGP</option>
						<option value="GHS" label="GHS">GHS</option>
						<option value="GIP" label="GIP">GIP</option>
						<option value="GMD" label="GMD">GMD</option>
						<option value="GNF" label="GNF">GNF</option>
						<option value="GTQ" label="GTQ">GTQ</option>
						<option value="GYD" label="GYD">GYD</option>
						<option value="HKD" label="HKD">HKD</option>
						<option value="HNL" label="HNL">HNL</option>
						<option value="HRK" label="HRK">HRK</option>
						<option value="HTG" label="HTG">HTG</option>
						<option value="HUF" label="HUF">HUF</option>
						<option value="IDR" label="IDR">IDR</option>
						<option value="ILS" label="ILS">ILS</option>
						<option value="IMP" label="IMP">IMP</option>
						<option value="INR" label="INR">INR</option>
						<option value="IQD" label="IQD">IQD</option>
						<option value="IRR" label="IRR">IRR</option>
						<option value="ISK" label="ISK">ISK</option>
						<option value="JEP" label="JEP">JEP</option>
						<option value="JMD" label="JMD">JMD</option>
						<option value="JOD" label="JOD">JOD</option>
						<option value="KES" label="KES">KES</option>
						<option value="KGS" label="KGS">KGS</option>
						<option value="KHR" label="KHR">KHR</option>
						<option value="KID" label="KID">KID</option>
						<option value="KMF" label="KMF">KMF</option>
						<option value="KPW" label="KPW">KPW</option>
						<option value="KRW" label="KRW">KRW</option>
						<option value="KWD" label="KWD">KWD</option>
						<option value="KYD" label="KYD">KYD</option>
						<option value="KZT" label="KZT">KZT</option>
						<option value="LAK" label="LAK">LAK</option>
						<option value="LBP" label="LBP">LBP</option>
						<option value="LKR" label="LKR">LKR</option>
						<option value="LRD" label="LRD">LRD</option>
						<option value="LSL" label="LSL">LSL</option>
						<option value="LYD" label="LYD">LYD</option>
						<option value="MAD" label="MAD">MAD</option>
						<option value="MDL" label="MDL">MDL</option>
						<option value="MGA" label="MGA">MGA</option>
						<option value="MKD" label="MKD">MKD</option>
						<option value="MMK" label="MMK">MMK</option>
						<option value="MNT" label="MNT">MNT</option>
						<option value="MOP" label="MOP">MOP</option>
						<option value="MRU" label="MRU">MRU</option>
						<option value="MUR" label="MRU">MUR</option>
						<option value="MVR" label="MVR">MVR</option>
						<option value="MWK" label="MWK">MWK</option>
						<option value="MXN" label="MXN">MXN</option>
						<option value="MYR" label="MYR">MYR</option>
						<option value="MZN" label="MZN">MZN</option>
						<option value="NAD" label="NAD">NAD</option>
						<option value="NGN" label="NGN">NGN</option>
						<option value="NIO" label="NIO">NIO</option>
						<option value="NOK" label="NOK">NOK</option>
						<option value="NPR" label="NPR">NPR</option>
						<option value="NZD" label="NZD">NZD</option>
						<option value="OMR" label="OMR">OMR</option>
						<option value="PAB" label="PAB">PAB</option>
						<option value="PEN" label="PEN">PEN</option>
						<option value="PGK" label="PGK">PGK</option>
						<option value="PHP" label="PHP">PHP</option>
						<option value="PKR" label="PKR">PKR</option>
						<option value="PLN" label="PLN">PLN</option>
						<option value="PRB" label="PRB">PRB</option>
						<option value="PYG" label="PYG">PYG</option>
						<option value="QAR" label="QAR">QAR</option>
						<option value="RON" label="RON">RON</option>
						<option value="RSD" label="RSD">RSD</option>
						<option value="RUB" label="RUB">RUB</option>
						<option value="RWF" label="RWF">RWF</option>
						<option value="SAR" label="SAR">SAR</option>
						<option value="SEK" label="SEK">SEK</option>
						<option value="SGD" label="SGD">SGD</option>
						<option value="SHP" label="SHP">SHP</option>
						<option value="SLL" label="SLL">SLL</option>
						<option value="SLS" label="SLS">SLS</option>
						<option value="SOS" label="SOS">SOS</option>
						<option value="SRD" label="SRD">SRD</option>
						<option value="SSP" label="SSP">SSP</option>
						<option value="STN" label="STN">STN</option>
						<option value="SYP" label="SYP">SYP</option>
						<option value="SZL" label="SZL">SZL</option>
						<option value="THB" label="THB">THB</option>
						<option value="TJS" label="TJS">TJS</option>
						<option value="TMT" label="TMT">TMT</option>
						<option value="TND" label="TND">TND</option>
						<option value="TOP" label="TOP">TOP</option>
						<option value="TRY" label="TRY">TRY</option>
						<option value="TTD" label="TTD">TTD</option>
						<option value="TVD" label="TVD">TVD</option>
						<option value="TWD" label="TWD">TWD</option>
						<option value="TZS" label="TZS">TZS</option>
						<option value="UAH" label="UAH">UAH</option>
						<option value="UGX" label="UGX">UGX</option>
						<option value="UYU" label="UYU">UYU</option>
						<option value="UZS" label="UZS">UZS</option>
						<option value="VES" label="VES">VES</option>
						<option value="VND" label="VND">VND</option>
						<option value="VUV" label="VUV">VUV</option>
						<option value="WST" label="WST">WST</option>
						<option value="XAF" label="XAF">XAF</option>
						<option value="XCD" label="XCD">XCD</option>
						<option value="XOF" label="XOF">XOF</option>
						<option value="XPF" label="XPF">XPF</option>
						<option value="ZAR" label="ZAR">ZAR</option>
						<option value="ZMW" label="ZMW">ZMW</option>
						<option value="ZWB" label="ZWB">ZWB</option>
					</select>
					<button class="btn btn-outline-secondary" name="submit" type="submit">Select Currency</button>
				</div>
			</form>
		</div>
	</div>
</div>
