<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author_topics".
 *
 * @property int $id
 * @property int $author_id
 * @property int $topic_id
 *
 * @property Authors $author
 * @property Topics $topic
 * @property Books[] $books
 * @property Books[] $books0
 */
class AuthorTopics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author_topics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'topic_id'], 'required'],
            [['author_id', 'topic_id'], 'integer'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author_id' => 'id']],
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
            'author_id' => 'Author ID',
            'topic_id' => 'Topic ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasOne(Topics::className(), ['id' => 'topic_id']);
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getBookAuthor()
//    {
//        return $this->hasMany(Books::className(), ['author_id' => 'author_id']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getBookTopic()
//    {
//        return $this->hasMany(Books::className(), ['topics_id' => 'topic_id']);
//    }
}
