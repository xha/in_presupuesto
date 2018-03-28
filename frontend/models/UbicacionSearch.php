<?php

namespace frontend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\Models\Ubicacion;

/**
 * UbicacionSearch represents the model behind the search form of `frontend\Models\Ubicacion`.
 */
class UbicacionSearch extends Ubicacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodUbic', 'Descrip', 'Clase', 'Represent', 'Direc1', 'Direc2', 'ZipCode', 'Telef'], 'safe'],
            [['Activo', 'Printer'], 'integer'],
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
        $query = Ubicacion::find();

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
            'Activo' => $this->Activo,
            'Printer' => $this->Printer,
        ]);

        $query->andFilterWhere(['like', 'CodUbic', $this->CodUbic])
            ->andFilterWhere(['like', 'Descrip', $this->Descrip])
            ->andFilterWhere(['like', 'Clase', $this->Clase])
            ->andFilterWhere(['like', 'Represent', $this->Represent])
            ->andFilterWhere(['like', 'Direc1', $this->Direc1])
            ->andFilterWhere(['like', 'Direc2', $this->Direc2])
            ->andFilterWhere(['like', 'ZipCode', $this->ZipCode])
            ->andFilterWhere(['like', 'Telef', $this->Telef]);

        return $dataProvider;
    }
}
