<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISPR_Empresa".
 *
 * @property int $id_empresa
 * @property string $codigo_onapre
 * @property string $descripcion
 * @property string $organismo
 * @property int $tipo_ente
 * @property int $activo
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_Empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_onapre', 'descripcion', 'organismo'], 'string'],
            [['descripcion', 'organismo'], 'required'],
            [['tipo_ente', 'activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_empresa' => 'Id Empresa',
            'codigo_onapre' => 'Codigo Onapre',
            'descripcion' => 'Descripcion',
            'organismo' => 'Organismo',
            'tipo_ente' => 'Tipo Ente',
            'activo' => 'Activo',
        ];
    }
}
