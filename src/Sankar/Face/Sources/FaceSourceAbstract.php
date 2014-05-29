<?php

/*                                                                        *
 * This script belongs to the "Sankar/Face.				              *
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
/**
 *
 */
abstract class FaceSourceAbstract
{
	/**
	 * BaseUrl
	 *
	 * @var string
	 */
	protected $baseUrl = null;

	protected $options = [];

	/**
	 * Result
	 *
	 * @var string
	 */
	protected $image = null;

	public function __construct($email, $options = array())
	{

	}

	public function getUrl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($http_code != 200) {
			return null;
		}
		return $result;
	}

	public function getImage()
	{

	}

	public function getSource()
	{
		return __CLASS__;
	}
}