<?php

namespace frontend\models;

use Yii;
use backend\models\Unidad;
use frontend\models\Clasificacion;
use frontend\models\Partida;

/**
 * This is the model class for table "ISPR_CNU".
 *
 * @property int $id_cnu
 * @property int $id_unidad
 * @property int $id_clasificacion
 * @property string $id_partida
 * @property string $CodItem
 * @property int $EsServicio
 * @property string $cuentaC
 */
class Cnu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISPR_CNU';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partida', 'id_cuenta','CodItem'], 'required'],
            [['EsServicio', 'activo'], 'integer'],
            [['id_partida', 'id_cuenta', 'CodItem'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cnu' => 'Id Cnu',
            'id_cuenta' => 'Cuenta',
            'id_partida' => 'Partida',
            'CodItem' => 'Item',
            'EsServicio' => 'Es Servicio',
            'activo' => 'Activo',
        ];
    }
    
    public function getCnuPartida()
    {
        return $this->hasOne(Partida::className(), ['id_partida' => 'id_partida']);
    }
}
