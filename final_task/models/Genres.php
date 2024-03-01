<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genres".
 *
 * @property int $id
 * @property string $genrename
 *
 * @property GenreOfBook[] $genreOfBooks
 */
class Genres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['genrename'], 'required'],
            [['genrename'], 'string', 'max' => 30],
            [['genrename'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'genrename' => 'Genre',
        ];
    }

    /**
     * Gets query for [[GenreOfBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenreOfBooks()
    {
        return $this->hasMany(GenreOfBook::class, ['genre' => 'id']);
    }

    public static function getGenres() {
        return Genres::find()->select(['id', 'genrename'])->all() ;
    } 
}
