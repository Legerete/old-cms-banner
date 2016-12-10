<?php

namespace Wunderman\CMS\Banner\PrivateModule\Components\Banner;

interface IBannerFactory
{

	/**
	 * @return Banner
	 * @param  array $componentParams
	 */
	public function create(array $componentParams);

}
