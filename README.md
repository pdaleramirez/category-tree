# Category Tree plugin for Craft CMS 3.x

Builds a Category tree structure for your menu and links.


## Installation

To install Category Tree, follow these steps:

1. Download & unzip the file and place the `category-tree` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/dalewpdevph/category-tree.git` directly into your `craft/plugins` folder.  
You can then update it with `git pull`
3.  -OR- install with Composer via `composer require dalewpdevph/category-tree`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `category-tree` for Craft to see it.  GitHub recently started appending 
`-master` (the branch name) to the name of the folder for zip file downloads.

Category Tree works on Craft 3.x.

## Category Tree

You can use this plugin to fetch craft recursive categories tree in your control panel.

## Fetch Category Tree

Use ```{{ craft.categorytree.getTree(1) }}``` in you template to you fetch the category tree structure from your category control panel with "groupId" as your first parameter.

### Example output:
```php
[
    0 => [
        'id' => '14'
        'parentId' => 0
        'title' => 'Dropdown 1'
        'model' => 'craft\\elements\\Category'
        'children' => [
            0 => [
                'id' => '15'
                'parentId' => '14'
                'title' => 'Dropdown 1.1'
                'model' => 'craft\\elements\\Category'
                'children' => [
                    0 => [
                        'id' => '22'
                        'parentId' => '15'
                        'title' => 'Dropdown 1.1.1'
                        'model' => 'craft\\elements\\Category'
                    ]
                    1 => [
                        'id' => '23'
                        'parentId' => '15'
                        'title' => 'Dropdown 1.1.2'
                        'model' => 'craft\\elements\\Category'
                    ]
                    2 => [
                        'id' => '24'
                        'parentId' => '15'
                        'title' => 'Dropdown 1.1.3'
                        'model' => 'craft\\elements\\Category'
                    ]
                ]
            ]
            1 => [
                'id' => '13'
                'parentId' => '14'
                'title' => 'Dropdown 1.2'
                'model' => 'craft\\elements\\Category'
            ]
            2 => [
                'id' => '11'
                'parentId' => '14'
                'title' => 'Dropdown 1.3'
                'model' => 'craft\\elements\\Category'
            ]
        ]
    ]
    1 => [
        'id' => '17'
        'parentId' => 0
        'title' => 'Dropdown 2'
        'model' => 'craft\\elements\\Category'
        'children' => [
            0 => [
                'id' => '25'
                'parentId' => '17'
                'title' => 'Dropdown 2.1'
                'model' => 'craft\\elements\\Category'
                'children' => [
                    0 => [
                        'id' => '27'
                        'parentId' => '25'
                        'title' => 'Dropdown 2.1.1'
                        'model' => 'craft\\elements\\Category'
                    ]
                    1 => [
                        'id' => '30'
                        'parentId' => '25'
                        'title' => 'Dropdown 2.1.2'
                        'model' => 'craft\\elements\\Category'
                    ]
                ]
            ]
            1 => [
                'id' => '28'
                'parentId' => '17'
                'title' => 'Dropdown 2.2'
                'model' => 'craft\\elements\\Category'
            ]
            2 => [
                'id' => '26'
                'parentId' => '17'
                'title' => 'Dropdown 2.3'
                'model' => 'craft\\elements\\Category'
            ]
        ]
    ]
    2 => [
        'id' => '12'
        'parentId' => 0
        'title' => 'Dropdown 3'
        'model' => 'craft\\elements\\Category'
        'children' => [
            0 => [
                'id' => '16'
                'parentId' => '12'
                'title' => 'Dropdown 3.1'
                'model' => 'craft\\elements\\Category'
            ]
            1 => [
                'id' => '29'
                'parentId' => '12'
                'title' => 'Dropdown 3.2'
                'model' => 'craft\\elements\\Category'
            ]
        ]
    ]
]
```
The model index returns the Category object.

### Example Implementation  
```
{% set categories = craft.categorytree.getTree() %}

{% for category in categories %}
  <ul>
  <li>{{ category.model.slug }}</li>

  {% if category.children is defined %}
    <ul>
    {% for category in category.children %}
      <li>{{ category.model.slug }}</li>
    {% endfor %}
    </ul>
  {% endif %}
  </ul>
{% endfor %}
```


## Display Category List

Use the function below to display html category list.

First parameter is the base url link.

Second parameter is the attribute key of the category model and this will get display at the end of your base url.

Third parameter is the css class of the "ul" html element.

```php
{{ craft.categorytree.getList(1,{'base': '/category/',
                                  'attribute': 'slug',
                                  'class': 'category-tree'
                                  }) }}
```
### HTML Output:
```
<ul class="category-tree category-tree-menu" id="category-tree-menu">
   <li>
      <a class="menulink" href="/category/dropdown1">Dropdown 1</a>
      <ul class="category-tree category-tree-menu">
         <li>
            <a class="menulink" href="/category/dropdown1-1">Dropdown 1.1</a>
            <ul class="category-tree category-tree-menu">
               <li><a href="/category/dropdown-1-1-1">Dropdown 1.1.1</a></li>
               <li><a href="/category/dropdown-1-1-2">Dropdown 1.1.2</a></li>
               <li><a href="/category/dropdown-1-1-3">Dropdown 1.1.3</a></li>
            </ul>
         </li>
         <li><a href="/category/dropdown1-2">Dropdown 1.2</a></li>
         <li><a href="/category/dropdown1-3">Dropdown 1.3</a></li>
      </ul>
   </li>
   <li>
      <a class="menulink" href="/category/dropdown2">Dropdown 2</a>
      <ul class="category-tree category-tree-menu">
         <li>
            <a class="menulink" href="/category/dropdown-2-1">Dropdown 2.1</a>
            <ul class="category-tree category-tree-menu">
               <li><a href="/category/dropdown-2-1-1">Dropdown 2.1.1</a></li>
               <li><a href="/category/dropdown-2-1-2">Dropdown 2.1.2</a></li>
            </ul>
         </li>
         <li><a href="/category/dropdown-2-2">Dropdown 2.2</a></li>
         <li><a href="/category/dropdown-2-3">Dropdown 2.3</a></li>
      </ul>
   </li>
   <li>
      <a class="menulink" href="/category/dropdown3">Dropdown 3</a>
      <ul class="category-tree category-tree-menu">
         <li><a href="/category/dropdown-3-1">Dropdown 3.1</a></li>
         <li><a href="/category/dropdown-3-2">Dropdown 3.2</a></li>
      </ul>
   </li>
</ul>
```

## Display JavaScript dropdown menu

```
{{ craft.categorytree.getMenu(1,{'base': '/category/',
                                  'attribute': 'slug',
                                  'class': 'category-tree'
                                  }) }}
```
Source Demo: http://sandbox.scriptiny.com/dropdown-menu/
                                  
                                

Brought to you by [Precious Dale Ramirez](https://github.com/dalewpdevph)