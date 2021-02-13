<?php
namespace IPS\changelogrelease;

if( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
    header( ( isset( $_SERVER[ 'SERVER_PROTOCOL' ] ) ? $_SERVER[ 'SERVER_PROTOCOL' ] :
            'HTTP/1.0' ) . ' 403 Forbidden' );
    exit;
}

class _Categories extends \IPS\changelogrelease\Item\Category
{

   protected static $multitons;

    public static $nodeTitle = 'changecategory';
	public static $titleLangPrefix = 'changelog__changecategories_';
	public static $subnodeClass = 'IPS\changelogrelease\Change';



	public static $databaseTable = 'changelogrelease_cats';
	
	protected static $databaseIdFields = [ 'id', 'name' ];
	
	public static $databasePrefix = '';
	
	public static $databaseColumnOrder = 'position';
	
	public static $databaseColumnParent = 'parent';
	
	
	public static $contentItemClass = 'IPS\changelogrelease\Change';
	
	//public static $nodeTitle = 'categories';
	
	public static $permApp = 'changelogrelease';
	
	public static $databaseColumnParentRootValue = 0;
	
	public static $permType = 'category';
	
	public static $permissionLangPrefix = 'changelogrelease_';
	
	public static $modPerm = 'changelogrelease_categories';
	
	protected $_url	= NULL;
	
	//public static $urlBase = 'app=changelogrelease&module=change&controller=main&do=category&id=';
	
	public static $urlTemplate = 'changelogrelease_category';
	
	public static $seoTitleColumn = 'name_seo';
	
	public static $permissionMap = array(
		'view' 				=> 'view',
		'read'				=> 2,
		'add'				=> 3,
	);
	
	public static function canOnAny( $permission, $member=NULL, $where = array(), $considerPostBeforeRegistering = TRUE )
	{
		$member	= ( $member === NULL ) ? \IPS\Member::loggedIn() : $member;

		return parent::canOnAny( $permission, $member, $where, FALSE );
	}
	
	protected function get__title()
    {
       return $this->name;
    }
	
	public function canDelete()
	{
		return TRUE;
	}
	
	public function canCopy()
	{
		return FALSE;
	}
	
	public function canAdd()
	{
		return TRUE;
	}
	
	public function form( &$form )
    {
		$form = new \IPS\Helpers\Form;
		$form->addHeader('Category Settings');
		$form->add( new \IPS\Helpers\Form\Text( 'changelogrelease_title', $this ? $this->name : NULL, TRUE, array( ) ) );
		$form->add( new \IPS\Helpers\Form\Date( 'changelogrelease_cat_date', NULL, TRUE, array( 'time' => TRUE, 'max' => \IPS\DateTime::create() ) ) );
		
	
		}
	
	public function formatFormValues( $values )
	{
		if ( !$this->id )
		{
			$this->save();
		}
		$this->name = $values['changelogrelease_title'];

	
		$this->cat_date = $values['changelogrelease_cat_date']->getTimestamp();
		$this->name_seo = \IPS\Http\Url\Friendly::seoTitle( $values['changelogrelease_title'] );
		
		$this->save();
		unset($values['changelogrelease_title']);
		unset($values['changelogrelease_cat_date']);

		return $values;
	}
	
	public static function clubAcpTitle()
	{
		return 'change_categories';
	}
	
	
}