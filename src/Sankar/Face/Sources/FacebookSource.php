<?php

/*                                                                        *
 * This script belongs to the "Sankar/Faces.				              *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License as published by the Free   *
 * Software Foundation, either version 3 of the License, or (at your      *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        *
 * You should have received a copy of the GNU General Public License      *
 * along with the script.                                                 *
 * If not, see http://www.gnu.org/licenses/gpl.html                       *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

namespace Sankar\Face\Sources;

use Sankar\Face\Sources\FaceSourceAbstract;
/**
 *
 */
class FacebookSource extends FaceSourceAbstract
{
	/**
	 * BaseUrl
	 *
	 * @var string
	 */
	protected $baseUrl = 'http://graph.facebook.com/{uid}/picture';

	protected $options = [
		"width" => 140,
		"height" => 140,
		"appid" => '249199871932396',
		"secret" => '50b31c51a280d2523836cc3280da9d04'
	];

	public function __construct($email, $options = array()) {

		$this->options = array_merge($this->options,$options);

		$fb = new \Facebook(array(
			'appId' => $this->options['appid'],
			'secret' => $this->options['secret']
		));

		$user = $fb->getUser();

		if ($user) {
			$userData = $fb->api('/search?q='.$email.'&type=user&limit=25&access_token=' . $fb->getAccessToken(), 'GET');
		} else {
			echo '<meta http-equiv="refresh" content="0;url=' . $fb->getLoginUrl() . '">';
			exit();
		}

		print_r($userData);

		if (isset($userData['data'][0]['id'])) {
			$id = $userData['data'][0]['id'];
			$picture = $fb->api('/' . $id . '/picture', 'GET');
			$this->image = 'http://graph.facebook.com/' . $id . '/picture?width=' . $this->options['width'] . '&height=' . $this->options['height'];
		}
	}

	public function getImage() {
		return $this->image;
	}

	public function getSource() {
		return 'facebook';
	}

}
