<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISPR_UnidadMedida".
 *
 * @property int $id_unidad_medida
 * @property string $descripcion
 * @property int $activo
 */
class UnidadMedida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_UnidadMedida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_unidad_medida' => 'Id Unidad Medida',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }
}
