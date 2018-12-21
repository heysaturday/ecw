<?php

	class MaxMind {

		public $defaultLatitude = 36.14382;
		public $defaultLongitude = -80.29941;

		private $baseUrl = 'https://geoip.maxmind.com/geoip/v2.1';
		private $userId = '';
		private $licenseKey = '';

		public function __construct($userId, $licenseKey) {
			$this->userId = $userId;
			$this->licenseKey = $licenseKey;
		}

		public function getGeoLocation($ipAddress) {

			// defaults
			$data = array(
				'latitude' => $this->defaultLatitude,
				'longitude' => $this->defaultLongitude
			);

			// construct url
			$url = $this->baseUrl . '/city/' . $ipAddress;

			// get content
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Accept: application/json',
				'Accept-Charset: UTF-8'
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERPWD, $this->userId.':'.$this->licenseKey);
			$content = curl_exec($ch);
			curl_close($ch);

			// set data
			if ($content) {
				$content = json_decode($content, TRUE);
				if ($content && $content['location'] && $content['location']['latitude'] && $content['location']['longitude']) {
					$data['latitude'] = $content['location']['latitude'];
					$data['longitude'] = $content['location']['longitude'];
				}
			}

			return $data;

		}

	}
