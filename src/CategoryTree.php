<?php
/**
 * Category Tree plugin for Craft CMS 3.x
 *
 * Builds a Category tree structure for your menu and links.
 *
 * @link      https://github.com/dalewpdevph
 * @copyright Copyright (c) 2017 Precioud Dale Ramirez
 */

namespace dalewpdevph\categoryTree;


use Craft;
use craft\base\Plugin;
use dalewpdevph\categoryTree\services\Utilities;
use dalewpdevph\categoryTree\variables\CategoryTreeVariable;

/**
 * @author    Precioud Dale Ramirez
 * @package   CategoryTree
 * @since     1
 *
 */
class CategoryTree extends Plugin
{
	/**
	 * Enable use of CategoryTree::$plugin-> in place of Craft::$app->
	 *
	 * @var \dalewpdevph\categoryTree\services\Utilities
	 */
  public static $app;

  public function init()
  {
    parent::init();

	  $this->setComponents([
		  'utilities' => Utilities::class
	  ]);

	  self::$app = $this->get('utilities');
  }

	/**
	 * @param       $message
	 * @param array $params
	 *
	 * @return string
	 */
	public static function t($message, array $params = [])
	{
		return Craft::t('categorytree', $message, $params);
	}

	/**
	 * @return mixed
	 */
	public function defineTemplateComponent()
	{
		return CategoryTreeVariable::class;
	}
}
