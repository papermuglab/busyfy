<?php

require_once APPPATH . 'custom_class/Model.php';

$config['pagination'] = array(
    'per_page' => Model::ADMIN_PAGE_LIMIT,
    'first_link' => 'First',
    'last_link' => 'Last',
    'first_tag_open' => '<li class="page-link">',
    'first_tag_close' => '</li>',
    'last_tag_open' => '<li class="page-link">',
    'last_tag_close' => '</li>',
    'next_tag_open' => '<li class="page-link">',
    'next_tag_close' => '</li>',
    'prev_tag_open' => '<li class="page-link">',
    'prev_tag_close' => '</li>',
    'num_tag_open' => '<li class="page-link">',
    'num_tag_close' => '</li>',
    'cur_tag_open' => '<li class="page-link"><b>',
    'cur_tag_close' => '</b></li>',
    'prev_link' => 'Previous',
    'next_link' => 'Next'
);
$config['front_pagination'] = array(
    'per_page' => 10,
    'first_link' => 'First',
    'last_link' => 'Last',
    'first_tag_open' => '<li class="page-link">',
    'first_tag_close' => '</li>',
    'last_tag_open' => '<li class="page-link">',
    'last_tag_close' => '</li>',
    'next_tag_open' => '<li class="page-link">',
    'next_tag_close' => '</li>',
    'prev_tag_open' => '<li class="page-link">',
    'prev_tag_close' => '</li>',
    'num_tag_open' => '<li class="page-link">',
    'num_tag_close' => '</li>',
    'cur_tag_open' => '<li class="page-link"><b>',
    'cur_tag_close' => '</b></li>',
    'prev_link' => 'Previous',
    'next_link' => 'Next'
);
?>