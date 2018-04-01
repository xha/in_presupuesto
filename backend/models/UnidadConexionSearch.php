<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UnidadConexion;

/**
 * UnidadConexionSearch represents the model behind the search form of `backend\models\UnidadConexion`.
 */
class UnidadConexionSearch extends UnidadConexion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_unidad_conexion', 'puerto', 'id_unidad', 'activo'], 'integer'],
            [['base_datos', 'usuario', 'clave', 'ip'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UnidadConexion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_unidad_conexion' => $this->id_unidad_conexion,
            'puerto' => $this->puerto,
            'id_unidad' => $this->id_unidad,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'base_datos', $this->base_datos])
            ->andFilterWhere(['like', 'usuario', $this->usuario])
            ->andFilterWhere(['like', 'clave', $this->clave])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
