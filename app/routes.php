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
      'uri' => 'login',
      'view' => 'login',
      'menu_label' => __('Log in'),
      'layout' => 'login',
    ],
    (object) [
      'uri' => 'logout',
      'view' => 'login',
      'menu_label' => __('Log in'),
      'layout' => 'login',
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
      'menu_label' => __('Add a BU'),
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
      'menu_label' => __('Add a cluster'),
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
      'menu_label' => __('Add a collaborator'),
      'menu_icon' => 'fas fa-user',
    ],
    (object) [
      'uri' => 'collaborator/list',
      'view' => 'collaborator.list',
      'menu_label' => __('List all collaborators'),
      'menu_icon' => 'fas fa-user',
    ],

    (object) [
      'uri' => 'collaborator_bu',
      'view' => '404',
      'menu_label' => __('Rel BUs / Collaborators'),
      'menu_icon' => 'fas fa-address-book',
    ],
    (object) [
      'uri' => 'collaborator_bu/edit',
      'view' => 'collaborator_bu.edit',
      'menu_label' => __('Add a relationship'),
      'menu_icon' => 'fas fa-address-book',
    ],
    (object) [
      'uri' => 'collaborator_bu/list',
      'view' => 'collaborator_bu.list',
      'menu_label' => __('List all relations'),
      'menu_icon' => 'fas fa-address-book',
    ],

    (object) [
      'uri' => 'collaborator_cluster',
      'view' => '404',
      'menu_label' => __('Rel Clusters / Collaborators'),
      'menu_icon' => 'fas fa-address-book',
    ],
    (object) [
      'uri' => 'collaborator_cluster/edit',
      'view' => 'collaborator_cluster.edit',
      'menu_label' => __('Add a relationship'),
      'menu_icon' => 'fas fa-address-book',
    ],
    (object) [
      'uri' => 'collaborator_cluster/list',
      'view' => 'collaborator_cluster.list',
      'menu_label' => __('List all relations'),
      'menu_icon' => 'fas fa-address-book',
    ],

    (object) [
      'uri' => 'cluster_bu',
      'view' => '404',
      'menu_label' => __('Rel Clusters / BUs'),
      'menu_icon' => 'fas fa-address-book',
    ],
    (object) [
      'uri' => 'cluster_bu/edit',
      'view' => 'cluster_bu.edit',
      'menu_label' => __('Add a relationship'),
      'menu_icon' => 'fas fa-address-book',
    ],
    (object) [
      'uri' => 'cluster_bu/list',
      'view' => 'cluster_bu.list',
      'menu_label' => __('List all relations'),
      'menu_icon' => 'fas fa-address-book',
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
    (object)[
      "menu_item" => 'collaborator_bu',
      "menu_children" => [
        (object)[
          "menu_item" => 'collaborator_bu/edit',
          "menu_children" => [],
        ],
        (object)[
          "menu_item" => 'collaborator_bu/list',
          "menu_children" => [],
        ],
      ],
    ],
    (object)[
      "menu_item" => 'collaborator_cluster',
      "menu_children" => [
        (object)[
          "menu_item" => 'collaborator_cluster/edit',
          "menu_children" => [],
        ],
        (object)[
          "menu_item" => 'collaborator_cluster/list',
          "menu_children" => [],
        ],
      ],
    ],
    (object)[
      "menu_item" => 'cluster_bu',
      "menu_children" => [
        (object)[
          "menu_item" => 'cluster_bu/edit',
          "menu_children" => [],
        ],
        (object)[
          "menu_item" => 'cluster_bu/list',
          "menu_children" => [],
        ],
      ],
    ],
  ],
];