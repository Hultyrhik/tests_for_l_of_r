<?php

namespace app\controllers;

use app\models\Books;
use app\models\BooksSearch;
use app\models\BooksIndexSearch;
use app\models\Authored;
use app\models\GenreOfBook;
use app\models\Genres;
use app\models\Authors;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Books models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BooksIndexSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMainpage()
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $topgenres = (new \yii\db\Query())
                    ->select(['genrename', 'Count(genrename)'])
                    ->from('genres')
                    ->join('INNER JOIN', 'genre_of_book', 'genres.id = genre_of_book.genre')
                    ->groupBy('genrename')
                    ->orderBy('COUNT(genrename) DESC')
                    ->limit(3)
                    ->all();

        $topauthors = (new \yii\db\Query())
                    ->select(['first_name', 'last_name', 'Count(authors.id)'])
                    ->from('authors')
                    ->join('INNER JOIN', 'authored', 'authors.id = authored.author')
                    ->groupBy('authors.id')
                    ->orderBy('Count(authors.id) DESC')
                    ->limit(3)
                    ->all();

        return $this->render('mainpage', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'topgenres' => $topgenres,
            'topauthors' => $topauthors
        ]);
    }

    /**
     * Displays a single Books model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Books();

        if ($this->request->isPost) {            
            if ($model->load($this->request->post()) && $model->save()) {
                
                foreach($_POST['Books']['genres'] as $genreID) {
                    $genre_of_book = new GenreOfBook;
                    $genre_of_book->book = $model->id;
                    $genre_of_book->genre = $genreID;
                    $genre_of_book->save(); 
                }

                foreach($_POST['Books']['authors'] as $genreID) {
                    $authored = new Authored;
                    $authored->book = $model->id;
                    $authored->author = $genreID;
                    $authored->save(); 
                    }
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'genres' => Genres::getGenres(),
            'authors' => Authors::getAuthors(),
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $authored = Authored::find()->where(['book' => $id])->all();
       
        if ($authored != null) {
            foreach($authored as $row)
            $row->delete();
        }

        $genreOfBook = GenreOfBook::find()->where(['book' => $id])->all();
       
        if ($genreOfBook != null) {
            foreach($genreOfBook as $row)
            $row->delete();
        }


        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
