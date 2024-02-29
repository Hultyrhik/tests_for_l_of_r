<?php

use app\models\Books;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BooksSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\models\Books $model */

$this->title = 'Главная страница';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <!-- <pre>
        <?php var_dump($dataProvider->models) ?>
    </pre> -->

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
            [
                'label' => 'Жанры',
                'format' => 'ntext',
                'attribute' => 'genrename',
                'value' => function ($model) {
                    foreach ($model->genres as $genrename) {
                        $Genres[] = $genrename->genrename;
                    }
                    return implode ("\n", $Genres);
                }
            ],
            [
                'label' => 'Имя Автора',
                'format' => 'ntext',
                'attribute' => 'first_name',
                'value' => function ($model) {
                    
                   // var_dump($model->authors);
                    
                    foreach ($model->authors as $first_name) {
                        $Authors_first_name[] = $first_name->first_name;
                    }
                   return implode ("\n", $Authors_first_name);
                }
            ],
            [
                'label' => 'Фамилия Автора',
                'format' => 'ntext',
                'attribute' => 'last_name',
                'value' => function ($model) {
                    
                   // var_dump($model->authors);
                    
                    foreach ($model->authors as $last_name) {
                        $Authors_last_name[] = $last_name->last_name;
                    }
                   return implode ("\n", $Authors_last_name);
                }
            ],
            
        ],
    ]); ?>


</div>
