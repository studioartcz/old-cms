<?php

namespace Wunderman\CMS\PrivateModule\PagesModule\Component;
use Kdyby\Doctrine\EntityManager;

/**
 * Menu
 * @author Petr Besir Horáček <sirbesir@gmail.com>
 */
class FlatPhotoGallery extends \App\PublicModule\Component\FlatPhotoGallery
{
	/**
	 * @var array
	 */
	protected $componentParams;

	public function __construct(EntityManager $em, $componentParams)
	{
		parent::__construct($em);

		$this->componentParams = $componentParams;
	}

	/**
	 * Render setup
	 * @author Petr Besir Horáček <sirbesir@gmail.com>
	 * @var integer $textId
	 * @see Nette\Application\Control#render()
	 */
	public function render($id = null)
	{
		$id = (int) $this->componentParams->params[0]->value;
		parent::render($id);
	}
}
