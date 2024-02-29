<?php

use app\models\Books;
use app\models\Genres;
use app\models\GenresSearch;
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

    <div class="clo-lg-4">
        <?php if(count($topauthors) > 0): ?>
            <h2>Топ 3 авторов по популярности (Имя и Фамилия - количество книг автора)</h2>
            <ul class="list-group">
                <?php foreach($topauthors as $author): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $author["first_name"] . " " . $author["last_name"] ?>
                        <span>
                            <?= $author["Count(authors.id)"]; ?>
                        </span>
                     </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="clo-lg-4">
        <?php if(count($topgenres) > 0): ?>
            <h2>Топ 3 жанров по популярности (Жанр - количество книг такого жанра)</h2>
            <ul class="list-group">
                <?php foreach($topgenres as $genre): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $genre["genrename"] ?>
                        <span>
                            <?= $genre["Count(genrename)"]; ?>
                        </span>
                     </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

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
