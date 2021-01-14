<?php
$subst = [
  '1' => 'one',
  '2' => 'two',
];
echo strtr('123', $subst);

echo "<br />";
echo strtr('123', '1', 'abc');
