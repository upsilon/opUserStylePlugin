<?php

/**
 * userstyle actions.
 *
 * @package    OpenPNE
 * @subpackage userstyle
 * @author     Your name here
 */
class userstyleActions extends sfActions
{
  public function executeDesign(sfWebRequest $request)
  {
    static $configs = array(
      'design_background_mode',
      'design_background',
      'design_text',
      'design_links'
    );

    $memberId = $this->getUser()->getMemberId();
    $configTable = Doctrine::getTable('MemberConfig');
    foreach ($configs as $configName)
    {
      $config = $configTable->retrieveByNameAndMemberId($configName, $memberId);
      if ($config)
      {
        $this->$configName = $config->value;
      }
    }
  }
}
