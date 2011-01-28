<?php

class MemberConfigDesignForm extends MemberConfigForm
{
  static protected $designConfigs = array(
    'design_background' => 'Background color',
    'design_text' => 'Text color',
    'design_links' => 'Link color',
  );

  protected $category = 'design';
  protected $isAutoGenerate = false;

  public function configure()
  {
    static $choices = array(
      'none' => '背景画像を使用しない',
      'default' => '標準の背景画像を使用する',
    );

    $this->setWidget('design_background_mode', new sfWidgetFormSelectRadio(array(
      'choices' => $choices,
      'default' => 'default',
    )));
    $this->setValidator('design_background_mode', new sfValidatorChoice(array(
      'choices' => array_keys($choices),
    )));

    foreach (self::$designConfigs as $configName => $label)
    {
      $this->setWidget($configName, new opWidgetFormInputColor(array(
        'is_display_pre_color' => true,
      )));
      $this->setValidator($configName, new opValidatorColor(array(
        'required' => false,
      )));

    }

    $configTable = Doctrine::getTable('MemberConfig');
    foreach ($this->widgetSchema->getFields() as $name => $widget)
    {
      $config = $configTable->retrieveByNameAndMemberId($name, $this->member->id);
      if ($config)
      {
        $this->setDefault($name, $config->value);
      }

//      $label = $this->widgetSchema->getFormFormatter()->
//        generateLabelName(str_replace('design_', '', $name));
      $this->widgetSchema->setLabel($name, ucfirst(strtr($name, array('design_' => '', '_' => ' '))));
    }
  }
}
