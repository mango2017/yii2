<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
echo HtmlPurifier::process($user);
?>
<h1>fjdskjf</h1>
<h2><?= Html::encode($user) ?></h2>

