<?php


namespace IPS\changelogrelease\Item;
/* To prevent PHP errors (extending class does not exist) revealing path */
if (!\defined('\IPS\SUITE_UNIQUE_KEY')) {
	header((isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0') . ' 403 Forbidden');
	exit;
}


abstract class _Category extends \IPS\Node\Model
{
	public static $descriptionLangSuffix = '_desc';
	public static $seoTitleColumn = 'name_seo';
	public static $databaseColumnOrder = 'position';


	/**
	 * Get SEO name
	 *
	 * @return	string
	 */
	public function get_name_seo()
	{
		if( !$this->_data['name_seo'] )
		{
			$this->name_seo	= \IPS\Http\Url\Friendly::seoTitle( \IPS\Lang::load( \IPS\Lang::defaultLanguage() )->get( static::$titleLangPrefix . $this->id ) );
			$this->save();
		}

		return $this->_data['name_seo'] ?: \IPS\Http\Url\Friendly::seoTitle( \IPS\Lang::load( \IPS\Lang::defaultLanguage() )->get( static::$titleLangPrefix . $this->id ) );
	}


	public function delete()
	{
		/* Delete Children */
		foreach ( $this->children() AS $item )
		{
			$item->delete();
		}

		parent::delete();
	}

}