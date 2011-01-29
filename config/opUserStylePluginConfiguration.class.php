<?php

class opUserStylePluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    $this->dispatcher->connect('op_action.pre_execute', array(__CLASS__, 'listenToPreExecute'));
  }

  static public function listenToPreExecute($params)
  {
    $cssUrl = '@userstyle_design';

    $action = $params['actionInstance'];
    $route = $action->getRoute();
    if (is_callable(array($route, 'getObject')))
    {
      $object = $route->getObject();
      if ($object instanceof Member)
      {
        $cssUrl = '@userstyle_design_member?id='.$object->id;
      }
      else if (isset($object->member_id))
      {
        $cssUrl = '@userstyle_design_member?id='.$object->member_id;
      }
    }

    $cssUrl = $action->getController()->genUrl($cssUrl);
    $action->getResponse()->addStylesheet($cssUrl);
  }
}
