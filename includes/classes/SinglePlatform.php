<?php

	class SinglePlatform {

		private $baseUrl = 'http://publishing-api.singleplatform.com';
		private $clientId = '';
		private $clientSecret = '';

		public function __construct($clientId, $clientSecret) {
			$this->clientId = $clientId;
			$this->clientSecret = $clientSecret;
		}

		public function getLocationData($locationId) {

			// construct request
			$request = '/locations/' . $locationId . '/all/';
			//$request = '/locations/' . $locationId . '/menus/';
			$request .= '?client=' . $this->clientId;

			// calculate the signature
			$signature = hash_hmac('sha1', $request, $this->clientSecret, TRUE);
			$signature = base64_encode($signature);
			$signature = urlencode($signature);

			// construct url
			$url = $this->baseUrl . $request . '&signature=' . $signature;

			// get content
			$content = @file_get_contents($url);
			if ($content) {
				return json_decode($content, TRUE);
			}
			return FALSE;

		}

	}
