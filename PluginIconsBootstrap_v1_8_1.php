<?php
class PluginIconsBootstrap_v1_8_1{
  private $icons_file = null;
  private $icons_dir = null;
  function __construct() {
    wfPlugin::includeonce('wf/yml');
    $this->icons_file = '/plugin/icons/bootstrap_v1_8_1/data/icons.yml';
    $this->icons_dir = '/plugin/icons/bootstrap_v1_8_1/new_icons';
  }
  public function page_create_file(){
    $this->webmaster_check();
    $scan = wfFilesystem::getScandir(__DIR__.'/new_icons');
    $scan_count = sizeof($scan);
    if($scan_count==0){
      exit('No icons in folder /new_icons!');
    }
    $icons = new PluginWfYml($this->icons_file);
    foreach($scan as $v){
      $c = wfFilesystem::getContents($this->icons_dir.'/'.$v);
      $k = wfPhpfunc::str_replace('.svg', '', $v);
      $icons->set("icons/$k", $c);
    }
    $icons->save();
    wfHelp::print("$scan_count icons was saved to file $this->icons_file!", true);
  }
  /**
   * Webmaster widget test page.
   */
  public function page_icon(){
    $this->webmaster_check();
    /**
     * 
     */
    wfPlugin::enable('icons/bootstrap_v1_8_1');
    $element = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    $element->setByTag(wfRequest::getAll(), 'get');
    wfDocument::renderElement($element);
  }
  public function widget_list($data){
    $icons = new PluginWfYml($this->icons_file);
    $data = array();
    foreach($icons->get('icons') as $k => $v){
      $data[] = array('name' => $k, 'icon' => $v);
    }
    $element = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    $element->setByTag(array('data' => $data));
    wfDocument::renderElement($element);
  }
  public function page_list(){
    wfPlugin::enable('icons/bootstrap_v1_8_1');
    wfPlugin::enable('wf/table');
    $widget = wfDocument::createWidget('icons/bootstrap_v1_8_1', 'list');
    wfDocument::renderElement(array($widget));
  }
  public function widget_icon($data){
    $data = new PluginWfArray($data);
    $icon = $data->get('data/icon');
    if(!$icon){
      throw new Exception(__CLASS__.' says: Param icon is missing in widget icon.');
    }
    $icons = new PluginWfYml($this->icons_file);
    $content = $icons->get("icons/$icon");
    if(!$content){
      /**
       * The icon does not exist.
       */
      $content = $icons->get("icons/question-diamond-fill");
    }
    /**
     * style
     */
    $content = wfPhpfunc::str_replace('<svg', '<svg style="'.$data->get('data/style').'"', $content);
    /**
     * 
     */
    $element = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    $element->setByTag(array('content' => $content));
    wfDocument::renderElement($element);
  }
  private function webmaster_check(){
    if(!wfUser::hasRole('webmaster')){
      exit('Only for webmaster!');
    }
    return null;
  }
}
