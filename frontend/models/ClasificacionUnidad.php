<?php

namespace frontend\models;

use Yii;
use backend\models\Unidad;
use frontend\models\Clasificacion;
/**
 * This is the model class for table "ISPR_ClasificacionUnidad".
 *
 * @property int $id_clasificacion
 * @property int $id_unidad
 *
 * @property ISPRClasificacion $clasificacion
 * @property ISPRUnidad $unidad
 */
class ClasificacionUnidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $nivel_clasificacion;
    public $nivel_unidad;
    public static function tableName()
    {
        return 'ISPR_ClasificacionUnidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_clasificacion', 'id_unidad'], 'required'],
            [['id_clasificacion', 'id_unidad'], 'integer'],
            [['id_clasificacion', 'id_unidad'], 'unique', 'targetAttribute' => ['id_clasificacion', 'id_unidad']],
            [['id_clasificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Clasificacion::className(), 'targetAttribute' => ['id_clasificacion' => 'id_clasificacion']],
            [['id_unidad'], 'exist', 'skipOnError' => true, 'targetClass' => Unidad::className(), 'targetAttribute' => ['id_unidad' => 'id_unidad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_clasificacion' => 'Clasificación',
            'id_unidad' => 'Unidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClasificacion()
    {
        return $this->hasOne(Clasificacion::className(), ['id_clasificacion' => 'id_clasificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidad()
    {
        return $this->hasOne(Unidad::className(), ['id_unidad' => 'id_unidad']);
    }
}
