<?php

class opUserStylePluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    $this->dispatcher->connect('op_action.pre_execute', array(__CLASS__, 'listenToPreExecute'));
  }

  static public function listenToPreExecute($params)
  {
    $action = $params['actionInstance'];
    $action->getResponse()->addStylesheet('/userstyle/design.css');
  }
}
