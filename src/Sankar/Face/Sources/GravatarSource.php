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
class GravatarSource extends FaceSourceAbstract
{
	/**
	 * BaseUrl
	 *
	 * @var string
	 */
	protected $baseUrl = 'http://www.gravatar.com/avatar/';

	protected $options = [
		"size" => 140
	];

	public function __construct($email, $options = array()) {

		if(is_array($options)) {
			$this->options =  array_merge($this->options,$options);
		}

		$emailHash = md5(strtolower( trim( $email ) ) );
		$url = $this->baseUrl . $emailHash . '?d=404&s=' . $this->options['size'];
		$response = $this->getUrl($url);

		if (!empty($response)) {
			$this->image = $url;
		}
	}


	public function getImage() {
		return $this->image;
	}

	public function getSource() {
		return 'gravatar';
	}

}