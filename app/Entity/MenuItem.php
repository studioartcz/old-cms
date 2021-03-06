<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Nette\Utils\Json;

/**
 * Petr Besir Horáček <sirbesir@gmail.com>
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 * @ORM\Table(name="menu_item")
 * @Gedmo\Tree(type="nested")
 */
class MenuItem extends \Kdyby\Doctrine\Entities\BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $presenter;

    /**
     * @ORM\Column(type="string")
     */
    protected $action;

    /**
     * @ORM\Column(type="string")
     */
    protected $params;

    /**
     * @ORM\Column(type="string")
     */
    protected $options;

    /**
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    protected $lft;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    protected $rgt;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="MenuItem", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="parent", cascade={"persist", "remove"})
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $children;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    protected $depth;

    /**
     * @ORM\Column(type="integer")
     */
    protected $published;

    /**
     * @ORM\Column(type="integer")
     */
    protected $homepage = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Menu")
     */
    protected $menu;

    /**
     * @ORM\Column(type="string")
     */
    protected $status = 'ok';

    /**
     * @ORM\Column(type="string")
     */
    protected $target = '_self';

    public function getEncodedParams($decode = false)
    {
        if ($decode) {
            return Json::decode($this->params, Json::FORCE_ARRAY);
        }

        return $this->params;
    }

    public function getPresenter()
    {
        return $this->presenter;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getHomepage()
    {
        return $this->homepage;
    }

    public function getRgt()
    {
        return $this->rgt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getLft()
    {
        return $this->lft;
    }

    /**
     * @return MenuItem|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return ArrayCollection|MenuItem[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @return Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getDepth()
    {
        return $this->depth;
    }

    public function delete()
    {
        $this->status = 'del';
    }

}
