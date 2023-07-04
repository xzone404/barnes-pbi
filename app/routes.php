<?php

return (object) [
  'pages' => [
    (object) [
      'uri' => '',
      'view' => 'index',
      'menu_label' => __('Home'),
      //'layout' => 'html', // html is the default value
    ],

    (object) [
      'uri' => 'bu',
      'view' => '404',
      'menu_label' => __('My BUs'),
      'menu_icon' => 'fas fa-warehouse',
    ],
    (object) [
      'uri' => 'bu/edit',
      'view' => 'bu.edit',
      'menu_label' => __('Add or edit a BU'),
      'menu_icon' => 'fas fa-warehouse',
    ],
    (object) [
      'uri' => 'bu/list',
      'view' => 'bu.list',
      'menu_label' => __('List all BUs'),
      'menu_icon' => 'fas fa-warehouse',
    ],

    (object) [
      'uri' => 'cluster',
      'view' => '404',
      'menu_label' => __('My Clusters'),
      'menu_icon' => 'fas fa-home',
    ],
    (object) [
      'uri' => 'cluster/edit',
      'view' => 'cluster.edit',
      'menu_label' => __('Add or edit a cluster'),
      'menu_icon' => 'fas fa-home',
    ],
    (object) [
      'uri' => 'cluster/list',
      'view' => 'cluster.list',
      'menu_label' => __('List all clusters'),
      'menu_icon' => 'fas fa-home',
    ],

    (object) [
      'uri' => 'collaborator',
      'view' => '404',
      'menu_label' => __('My Collaborators'),
      'menu_icon' => 'fas fa-user',
    ],
    (object) [
      'uri' => 'collaborator/edit',
      'view' => 'collaborator.edit',
      'menu_label' => __('Add or edit a collaborator'),
      'menu_icon' => 'fas fa-user',
    ],
    (object) [
      'uri' => 'collaborator/list',
      'view' => 'collaborator.list',
      'menu_label' => __('List all collaborators'),
      'menu_icon' => 'fas fa-user',
    ],

    (object) [
      'uri' => 'mentions',
      'view' => 'mentions',
      'menu_label' => __('Legals'),
    ],
    (object) [
      'uri' => '404',
      'view' => '404',
      'menu_label' => __('404'),
    ],
  ],
  'menu' => [
    (object)[
      "menu_item" => 'bu',
      "menu_children" => [
        (object)[
          "menu_item" => 'bu/edit',
          "menu_children" => [],
        ],
        (object)[
          "menu_item" => 'bu/list',
          "menu_children" => [],
        ],
      ],
    ],
    (object)[
      "menu_item" => 'cluster',
      "menu_children" => [
        (object)[
          "menu_item" => 'cluster/edit',
          "menu_children" => [],
        ],
        (object)[
          "menu_item" => 'cluster/list',
          "menu_children" => [],
        ],
      ],
    ],
    (object)[
      "menu_item" => 'collaborator',
      "menu_children" => [
        (object)[
          "menu_item" => 'collaborator/edit',
          "menu_children" => [],
        ],
        (object)[
          "menu_item" => 'collaborator/list',
          "menu_children" => [],
        ],
      ],
    ],
  ],
];