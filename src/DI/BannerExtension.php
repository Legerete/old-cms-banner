<?php

/**
 * @copyright   Copyright (c) 2016 Wunderman s.r.o. <wundermanprague@wunwork.cz>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Wunderman\CMS\Banner
 */

namespace Wunderman\CMS\Banner\DI;

use Nette\DI\CompilerExtension;
use Nette\Utils\Arrays;

class BannerExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$extensionConfig = $this->loadFromFile(__DIR__ . '/config.neon');
		$this->compiler->parseServices($builder, $extensionConfig, $this->name);

		$builder->parameters = Arrays::mergeTree($builder->parameters,
			Arrays::get($extensionConfig, 'parameters', []));
	}


	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();

		$builder->getDefinition('privateComposePresenter')->addSetup(
			'addExtensionService',
			['banner', $this->prefix('@privateModuleService')]
		);

		/**
		 * PublicModule component
		 */
		$builder->getDefinition('publicComposePresenter')->addSetup(
			'setComposeComponentFactory',
			['banner', $this->prefix('@publicBannerFactory')]
		);

		/**
		 * PrivateModule component
		 */
		$builder->getDefinition('privateComposePresenter')->addSetup(
			'setComposeComponentFactory',
			['banner', $this->prefix('@privateBannerFactory')]
		);
	}

}
