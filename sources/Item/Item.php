<?php


namespace IPS\changelogrelease;
/* To prevent PHP errors (extending class does not exist) revealing path */

use IPS\Helpers\Form;

if (!\defined('\IPS\SUITE_UNIQUE_KEY')) {
	header((isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0') . ' 403 Forbidden');
	exit;
}

abstract class _Item extends \IPS\Node\Model
{

	public static $seoTitleColumn = 'name_seo';
	public static $parentNodeColumnId = 'c_id';
	//public static $databaseColumnOrder = "sort";




	public static function all()
	{
		$return = [];
		{
			$select = \IPS\Db::i()->select( '*', static::$databaseTable );
			
			foreach ( $select as $data )
			{
				$changes = static::constructFromData( $data );
				$return[] = $changes->id;
			}
		}
		return $return;
	}

	public function isHideable()
	{
		return FALSE;
	}
	/**
	 * Get SEO name
	 *
	 * @return	string
	 */
	public function get_title_seo()
	{
		if( !$this->_data['name_seo'] )
		{
			$this->name_seo	= \IPS\Http\Url\Friendly::seoTitle( \IPS\Lang::load( \IPS\Lang::defaultLanguage() )->get( static::$titleLangPrefix . $this->id ) );
			$this->save();
		}

		return $this->_data['name_seo'] ?: \IPS\Http\Url\Friendly::seoTitle( \IPS\Lang::load( \IPS\Lang::defaultLanguage() )->get( static::$titleLangPrefix . $this->id ) );
	}


	

}