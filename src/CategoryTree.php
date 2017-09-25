<?php
/**
 * Category Tree plugin for Craft CMS 3.x
 *
 * Builds a Category tree structure for your menu and links.
 *
 * @link      https://github.com/pdaleramirez
 * @copyright Copyright (c) 2017 Precioud Dale Ramirez
 */

namespace pdaleramirez\categoryTree;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use pdaleramirez\categoryTree\services\Utilities;
use pdaleramirez\categoryTree\variables\CategoryTreeVariable;
use yii\base\Event;

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
	 * @var \pdaleramirez\categoryTree\services\Utilities
	 */
  public static $app;

  public function init()
  {
    parent::init();

	  $this->setComponents([
		  'utilities' => Utilities::class
	  ]);

	  self::$app = $this->get('utilities');

	  Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {

		  $variable = $event->sender;
		  $variable->set('categorytree', CategoryTreeVariable::class);
	  });
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
}
