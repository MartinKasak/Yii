<?php
use app\models\LoginForm;
/* @var $this yii\web\View */

$this->title = 'My Forum';
?>	
<div class="site-index">
	<?php if(Yii::$app->user->isGuest) : ?>
		<?php Yii::$app->response->redirect(['site/login']); ?>
	<?php else : ?>
		<?php Yii::$app->response->redirect(['topics/index']); ?>
	<?php endif ?>
</div>

