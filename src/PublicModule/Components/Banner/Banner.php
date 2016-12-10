<?php

/**
 * @copyright   Copyright (c) 2016 Wunderman s.r.o. <wundermanprague@wunwork.cz>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Wunderman\CMS\Banner
 */

namespace Wunderman\CMS\Banner\PublicModule\Components\Banner;

use Nette\Application\UI\Control;
use Kdyby\Doctrine\EntityManager;
use Ap\Entity\Attachment;

/**
 * Menu
 * @author Petr Besir Horáček <sirbesir@gmail.com>
 */
class Banner extends Control
{

	/**
	 * @var EntityManager
	 */
	private $em;


	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}


	/**
	 * @var array $params
	 */
	public function render($params)
	{
		if (!isset($params['id'])) {
			throw new \InvalidArgumentException('Image id is not set.');
		}

		$this->getTemplate()->params = $params;
		$this->getTemplate()->image = $this->getAttachmentRepository()->find((int) $params['id']);

		$this->getTemplate()->render(__DIR__.'/templates/Banner.latte');
	}


	public function getAttachmentRepository()
	{
		return $this->em->getRepository(Attachment::class);
	}

}
