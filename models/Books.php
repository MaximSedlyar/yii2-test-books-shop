<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property int $author_id
 * @property int $topic_id
 * @property int $pages
 * @property int $year
 * @property int $price
 * @property string $isbn
 *
 * @property AuthorTopics $authorTopics
 * @property Topics $topics
 * @property Authors $authors
 */
class Books extends \yii\db\ActiveRecord
{
    public $authors;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'topic_id', 'pages', 'year', 'price', 'isbn'], 'required'],
            [['author_id', 'topic_id', 'pages'], 'integer', 'min' => 1],
            [['price'], 'number', 'min' => 1],
            [['year'], 'safe'],
            [['isbn'], 'string', 'max' => 255],
            [['isbn'], 'unique'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuthorTopics::className(), 'targetAttribute' => ['author_id' => 'author_id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuthorTopics::className(), 'targetAttribute' => ['topic_id' => 'topic_id']],
            [['topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Topics::className(), 'targetAttribute' => ['topic_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author',
            'topic_id' => 'Topic',
            'pages' => 'Pages',
            'year' => 'Year',
            'price' => 'Price',
            'isbn' => 'Isbn',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorTopics()
    {
        return $this->hasMany(AuthorTopics::className(), ['author_id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topics::className(), ['id' => 'topic_id'])->via('authorTopics');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(Topics::className(), ['id' => 'topic_id']);
    }
}
