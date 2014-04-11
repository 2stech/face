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
namespace Sankar\Face;

/**
 *
 */
class Face {
	/**
	 * sources
	 *
	 * @var array
	 */
	protected $options = array(
		'sources' => [
			//'Gravatar' => [],
			'Facebook' => []
		]
	);

	public function find($email, $options = array())
	{
		$options = array_merge($this->options, $options);

		foreach ($options['sources'] as $source => $config) {
			$config = (array)$options[$source];
			$source = '\Sankar\\Face\Sources\\'.ucfirst($source).'Source';
			$sourceObject = new $source($email, $config);
			if ($sourceObject->getImage() !== NULL) {
				break;
			}
		}

		$this->source = $sourceObject;
	}

	public function getImage() {
		return $this->source->getImage();
	}

	public function getSource() {
		return $this->source->getSource();
	}

	public function setConfig($options = array())
	{
		$this->options = array_merge($this->options,$options);
	}

	public function getConfig()
	{
		return $this->options;
	}
}