<?php


namespace IPS\changelogrelease\modules\front\change;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * main
 */
class _main extends \IPS\Dispatcher\Controller
{


	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		
		 \IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'changelog.css', 'changelogrelease', 'front' ) );
   \IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( '__app_changelogrelease' );
   \IPS\Output::i()->breadcrumb[] = array( null, \IPS\Member::loggedIn()->language()->addToStack( '__app_changelogrelease' ) );
   \IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'main', 'changelogrelease', 'front' )->mainCategories();
   
   

		


	}
	

}