<?php


namespace IPS\changelogrelease\modules\admin\change;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * categories
 */
class _categories extends \IPS\Node\Controller
{
	protected $nodeClass = 'IPS\changelogrelease\Categories';
	public static $csrfProtected = TRUE;

	
/*
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'categories_manage' );
		parent::execute();
	}
	*/
}