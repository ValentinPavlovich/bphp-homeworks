<?php
class Person
{
  public $name;
  public $surName;
  public $patronymic;
  public $gender;
  const GENDER_MALE = 1;
  const GENDER_FEMALE = -1;
  const GENDER_UNDEFINED = 0;
  public function __construct(string $name, string $surName, string $patronymic = null) 
  {
    $this->name = $name; 
    $this->surName = $surName;
    if ($patronymic != null) {
      $this->patronymic = $patronymic;
    }
    $patronymicEnding = mb_substr($patronymic, -3);
    if (
      $patronymicEnding == 'вич'
      || $patronymicEnding == 'ьич'
      || $patronymicEnding == 'тич'
      || $patronymicEnding == 'глы'
      ) {
        $this->gender = self::GENDER_MALE;
    } elseif (
      $patronymicEnding == 'вна'
      || $patronymicEnding == 'чна'
      || $patronymicEnding == 'шна'
      || $patronymicEnding == 'ызы'
      ) {
        $this->gender = self::GENDER_FEMALE; 
    } else {
        $this->gender = self::GENDER_UNDEFINED;
    }
  }
  public function getFIO() 
  {
    return $this->surName . ' ' . $this->name . ' ' . $this->patronymic . ' ';
  }
  public function getGender() 
  {
    if ($this->gender === 1) {
      return 'male';
    }
    if ($this->gender === 0) {
      return 'undefined';
    }
    if ($this->gender === -1) {
      return 'female';
    }
  }
  
  public function getGenderSymbol() 
  {
    if($this->gender === 1) {
      return "\u{2642}";
    }
    if($this->gender === 0) {
      return "\u{1F60E}";
    }
    if($this->gender === -1) {
      return "\u{2640}";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>bPHP - 3.2.1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php $newPerson = new Person('Иван', 'Иванов')?>
    <h2>
      <span class="gender-<?php echo $newPerson->getGender()?>">
        <?php echo $newPerson->getGenderSymbol()?>
      </span> 
      <?php echo $newPerson->getFIO()?>
    </h2>
  </body>
</html>