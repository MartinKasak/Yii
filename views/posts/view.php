<?php
use app\models\User;
use app\models\PostViews;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii2mod\comments\widgets\Comment;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$postViews = PostViews::find(['post_id'=>$model->id])->orderBy(['view_time'=>SORT_ASC])->all();

$viewData = array();
$viewUsers = array();
foreach($postViews as $postView) {
    $time = strtotime($postView->view_time);
    $newformat = date('Y-m-d',$time);
    if (!isset($viewData[$newformat])) {
        $viewData[$newformat] = 1;
    } else {
        $viewData[$newformat] = $viewData[$newformat] + 1;
    }
    if (!in_array($postView->user_id, $viewUsers)) {
        array_push($viewUsers, $postView->user_id);
    }
}
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div id="canvasWrapper" style="position: relative; height: 500px">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'content:ntext',
        ],
    ]) ?>
    <table>
    
        <th>Who has viewed this post</th>
        <?php
        foreach ($viewUsers as $viewUser) {
        ?>  
            <tr>
                <td><?php echo User::findIdentity($viewUser)->username ?></td>
            </tr>
        <?php
        }
        ?>
        
    </table>

    <?php echo \yii2mod\comments\widgets\Comment::widget([
    'model' => $model,
    ]); ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.0/dist/Chart.min.js"></script>
<script>
var labels = <?php echo json_encode(array_keys($viewData)); ?>;
var data = <?php echo json_encode(array_values($viewData)); ?>;
console.log(data);
var ctx = document.getElementById('myChart').getContext('2d');
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Views',
            data: data
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
