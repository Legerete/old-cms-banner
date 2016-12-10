<?php

/**
 * @copyright   Copyright (c) 2016 Wunderman s.r.o. <wundermanprague@wunwork.cz>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Wunderman\CMS\Banner
 */

namespace Wunderman\CMS\Banner\PrivateModule\Components\Banner;

use Kdyby\Doctrine\EntityManager;
use Wunderman\CMS\Banner\PublicModule;

class Banner extends PublicModule\Components\Banner\Banner
{

	/**
	 * @var array
	 */
	protected $componentParams;

	public function __construct(array $componentParams = [], EntityManager $em)
	{
		parent::__construct($em);

		$this->componentParams = $componentParams;
	}

	/**
	 * @var int $id
	 */
	public function render($id = null)
	{
		$params = [];

		foreach ($this->componentParams->params as $param)
		{
			$params[$param->name] = $param->value;
		}

		parent::render($params);
	}

}
