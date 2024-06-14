<?php

/**
 * @copyright   Copyright (c) 2016 ublaboo <ublaboo@paveljanda.com>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Ublaboo
 */

namespace Ublaboo\AwsSdkNetteExtension\DI;

use Nette;

class AwsSdkNetteExtension extends Nette\DI\CompilerExtension
{

	private $defaults = [
		'region' => NULL,
		'version' => 'latest',
		'endpoint' => NULL,
		'credentials' => [
			'key' => NULL,
			'secret' => NULL
		],
		'use_aws_shared_config_files' => true
	];

	/**
	 * @var array
	 */
	protected $config;


	/**
	 * @return void
	 */
	public function loadConfiguration()
	{
		$this->config = $this->_getConfig();
	}


	/**
	 * @return void
	 */
	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->config;

		$builder->addDefinition($this->prefix('sdk'))
			->setClass('Aws\S3\S3Client')
			->setArguments([$config]);
	}


	/**
	 * @return array
	 */
	protected function _getConfig()
	{
		$config = $this->validateConfig($this->defaults, $this->config);

		return $config;
	}

}
