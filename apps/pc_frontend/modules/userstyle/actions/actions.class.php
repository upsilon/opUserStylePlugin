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
    $memberId = $request['id'] ? $request['id'] : $this->getUser()->getMemberId();
    $this->setViewParameters($memberId);
  }

  protected function setViewParameters($memberId)
  {
    static $configs = array(
      'design_background_mode',
      'design_background',
      'design_text',
      'design_links',
    );

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
