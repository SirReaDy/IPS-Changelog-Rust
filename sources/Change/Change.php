<?php

namespace IPS\changelogrelease;

if( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
    header( ( isset( $_SERVER[ 'SERVER_PROTOCOL' ] ) ? $_SERVER[ 'SERVER_PROTOCOL' ] :
			'HTTP/1.0' ) . ' 403 Forbidden' );
    exit;
}

class _Change extends \IPS\changelogrelease\Item 
{
	
	
	public static $csrfProtected = TRUE;
    protected static $multitons;
    public static $databaseTable = 'changelogrelease_items';
    public static $nodeTitle = 'change';
	public static $titleLangPrefix = 'changelogrelease_items_';
	public static $seoTitleColumn = 'name_seo';
	protected static $databaseIdFields = [ 'id', 'name' , 'additional'];
	
	public static $databasePrefix = '';
	
	public static $databaseColumnMap = array(
		'container'				=> 'c_id',
		'content'				=> 'name',
		'title'					=> 'name_seo',

	);

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
	
	   public function form( &$form)
    {
		
		
	



		\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'global.css', 'changelogrelease', 'front' ) );

		$form->addHeader('Release Settings');

		$form->add( new \IPS\Helpers\Form\Editor( 'changelogrelease_title', $this->additional ? $this->additional : NULL, TRUE, array( 'app' => 'changelogrelease', 'key' => 'titleEditor', 'autoSaveKey' => ( $this->id ? "changelog-changes-{$this->id}" : "changelog-new-changes" ), 'attachIds' => $this->id ? array( $this->id, NULL, 'description' ) : NULL, 'minimize' => 'cdesc_placeholder' ), NULL, NULL, NULL, 'changelogrelease_additional' ) );

		$form->canSaveAndReload = true;

    }

	public function formatFormValues( $values )
	{
		
    		$_values = $values;
    		$values = array();
    		foreach ( $_values as $k => $v )
    		{
    			if( mb_substr( $k, 0, 7 ) === 'changelogrelease_' )
    			{
    				$values[ mb_substr( $k, 7 ) ] = $v;
    			}
    			else
    			{
    				$values[ $k ]	= $v;
    			}

			}
		
		
			if ( !$this->id )
            {
            	$this->save();
				\IPS\File::claimAttachments( 'changelog-new-changes', $this->id, NULL, 'additional' );
            }
       
			$this->additional = $values['changelogrelease_title'];
			
			//$this->name_seo = \IPS\Http\Url\Friendly::seoTitle( $values['changelogrelease_title'] );
			$this->save();
			unset($values['changelogrelease_title']);

			return $values;
	
	}


}