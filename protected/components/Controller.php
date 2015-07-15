<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/default';

    public $pagename;

    public static function sanitize($string) {
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<alert[^>]*?>.*?</alert>@siU', // Strip alert tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@' // Strip multi-line comments
        );

        $string = trim($string);
        $string = strip_tags($string);
        $string = preg_replace($search, '', $string);

        return $string;
    }

    protected function clean_all($arr)
    {
        foreach($arr as $key=>$value)
        {
            if(is_array($value)) $arr[$key] = $this->clean_all($value);
            else  $arr[$key] = self::sanitize($value);
        }

        return $arr;
    }

    protected function sanitizeData($mixed){
        if (!is_array($mixed)){
            return self::sanitize($mixed);
        } else {
            return $this->clean_all($mixed);
        }
    }

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

}