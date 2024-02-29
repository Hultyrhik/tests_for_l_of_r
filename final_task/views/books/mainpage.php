<?php

use app\models\Books;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BooksSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Главная страница';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <pre>
        <?php print_r($dataProvider->models) ?>
    </pre>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'isbn',
            [
                'label' => 'Название',
                'attribute' => 'title'
            ],
            [
                'label' => 'Количество страниц',
                'attribute' => 'number_of_pages'
            ],
            [
                'label' => 'Опубликовано',
                'attribute' => 'published_at'
            ],
            
        ],
    ]); ?>


</div>
