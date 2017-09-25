<?php

namespace pdaleramirez\categoryTree\assetbundles\tree;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class CategoryTreeAsset extends AssetBundle
{
	public function init()
	{
		$this->sourcePath = "@pdaleramirez/categoryTree/assetbundles/tree/dist";

		$this->depends = [
			CpAsset::class,
		];

		$this->js = [
			'js/script.js',
		];

		$this->css = [
			'css/style.css',
		];

		parent::init();
	}
}