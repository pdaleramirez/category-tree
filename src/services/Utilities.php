<?php

namespace pdaleramirez\categoryTree\services;

use craft\elements\Category;
use yii\base\Component;

class Utilities extends Component
{
	/**
	 * @param int $groupId
	 *
	 * @return array
	 */
	public function arrangeCategory($groupId = 1)
	{
		$categories = Category::find()
			->groupId($groupId)
			->all();

		$rows = array();

		if (!empty($categories))
		{
			$count = 0;
			foreach ($categories as $category)
			{
				$parentId = ($category->getParent() == null)? 0 : $category->getParent()->id;

				$rows[$count]['id']       = $category->id;
				$rows[$count]['parentId'] = $parentId;
				$rows[$count]['title']    = $category->title;
				$rows[$count]['model']    = $category;

				$count++;
			}
		}

		return $rows;
	}

	/**
	 * @param array|null $elements
	 * @param int        $parentId
	 *
	 * @return array
	 */
	public function buildTree(array $elements = null, $parentId = 0)
	{
		$branch = array();

		foreach ($elements as $element)
		{
			if ($element['parentId'] == $parentId)
			{
				$children = $this->buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}

		return $branch;
	}

	/**
	 * @param int $groupId
	 *
	 * @return array
	 */
	public function getTree($groupId = 1)
	{
		$categories = $this->arrangeCategory($groupId);

		return $this->buildTree($categories);
	}

	/**
	 * @param       $branch
	 * @param array $options
	 *              base      - url base
	 *              attribute - model attribute to return at the end of the base
	 *              class = menu css class
	 *
	 * @return string
	 */
	public function getMenu($branch, $options = array(), $depth = 1)
	{
		$menuClass = (!empty($options['class']))? $options['class'] : 'category-tree';

		$cssId = ($depth == 1)? "id='category-tree-menu'" : "";

		$html = "<ul class='$menuClass category-tree-menu' $cssId>";
		foreach ($branch as $val)
		{
			$id    = $val['id'];
			$model = $val['model'];

			$attribute = $id;

			if (!empty($options['attribute']))
			{
				$attribute = $options['attribute'];
			}

			$url = '';
			if (!empty($options['base']))
			{
				$base = $options['base'];
				$url = $base . $model->$attribute;
			}

			if (!empty($val['children']))
			{
				$depth++;
				$html.= "<li>";
				$html.= (!empty($url))? "<a class='menulink' href='$url'>" : "";
				$html.= $val['title'];
				$html.= (!empty($url))? "</a>" : "";
				$html.= $this->getMenu($val['children'], $options, $depth);
				$html.=  "</li>";
			}
			else
			{
				$html.= "<li>";
				$html.= (!empty($url))? "<a href='$url'>" : "";
				$html.= $val['title'];
				$html.= (!empty($url))? "</a>" : "";
				$html.=  "</li>";
			}
		}

		$html.= "</ul>";

		return $html;
	}

	public function getList($groupId = 1, $options = array())
	{
		$branch = $this->getTree($groupId);

		$menu = $this->getMenu($branch, $options);

		return $menu;
	}
}