<?php
/**
 * @brief		Changelog Releases Application Class
 * @author		<a href=''>S!r.ReaDy</a>
 * @copyright	(c) 2021 S!r.ReaDy
 * @package		Invision Community
 * @subpackage	Changelog Releases
 * @since		12 Feb 2021
 * @version		
 */
 
namespace IPS\changelogrelease;

/**
 * Changelog Releases Application Class
 */
class _Application extends \IPS\Application
{

	
	public function defaultFrontNavigation()
	{
		return array(
			'rootTabs'		=> array(),
			'browseTabs'	=> array( array( 'key' => 'changelogrelease' ) ),
			'browseTabsEnd'	=> array(),
			'activityTabs'	=> array()
		);
	}
}