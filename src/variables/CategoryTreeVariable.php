<?php

namespace dalewpdevph\categoryTree\variables;

use Craft;
use craft\helpers\Template;
use craft\web\View;
use dalewpdevph\categoryTree\CategoryTree;

class CategoryTreeVariable
{
	public function getTree($groupId = 1)
	{
		return CategoryTree::$app->getTree($groupId);
	}

	public function getList($groupId = 1, $options = array())
	{
		$list = CategoryTree::$app->getList($groupId, $options);

		return Template::raw($list);
	}

	public function getMenu($groupId = 1, $options = array())
	{
		$list = CategoryTree::$app->getList($groupId, $options);

		$oldMode = Craft::$app->view->getTemplateMode();

		Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);

		$html = Craft::$app->view->renderTemplate('category-tree/menu', [
			'list' => Template::raw($list)
		]);

		Craft::$app->view->setTemplateMode($oldMode);

		return Template::raw($html);
	}
}