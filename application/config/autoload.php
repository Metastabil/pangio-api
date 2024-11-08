<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = [];

$autoload['libraries'] = [
	'database',
	'form_validation',
	'session'
];

$autoload['drivers'] = [];

$autoload['helper'] = [
	'application_helper',
	'form',
	'url'
];

$autoload['config'] = [];

$autoload['language'] = [];

$autoload['model'] = [
	'ArticleGroupModel',
	'ArticleModel',
	'CartElementModel',
	'CartModel',
	'DealerGroupModel',
	'GroupModel',
	'OrderElementModel',
	'OrderModel',
	'UserDealerGroupAssociationModel',
	'UserGroupAssociationModel',
	'UserModel'
];
