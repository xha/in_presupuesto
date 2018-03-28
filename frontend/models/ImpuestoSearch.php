<?php

namespace frontend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\Models\Impuesto;

/**
 * ImpuestoSearch represents the model behind the search form of `frontend\Models\Impuesto`.
 */
class ImpuestoSearch extends Impuesto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodTaxs', 'Descrip', 'CodOper'], 'safe'],
            [['MtoTax', 'MontoMin', 'MontoMax', 'Sustraendo'], 'number'],
            [['Activo', 'EsFijo', 'EsReten', 'EsPorct', 'EsCosto', 'TipoIVA', 'EsLibroI', 'EsPartic', 'EsTaxVenta', 'EsTaxCompra'], 'integer'],
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
        $query = Impuesto::find();

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
            'MtoTax' => $this->MtoTax,
            'Activo' => $this->Activo,
            'EsFijo' => $this->EsFijo,
            'EsReten' => $this->EsReten,
            'EsPorct' => $this->EsPorct,
            'EsCosto' => $this->EsCosto,
            'TipoIVA' => $this->TipoIVA,
            'EsLibroI' => $this->EsLibroI,
            'EsPartic' => $this->EsPartic,
            'EsTaxVenta' => $this->EsTaxVenta,
            'EsTaxCompra' => $this->EsTaxCompra,
            'MontoMin' => $this->MontoMin,
            'MontoMax' => $this->MontoMax,
            'Sustraendo' => $this->Sustraendo,
        ]);

        $query->andFilterWhere(['like', 'CodTaxs', $this->CodTaxs])
            ->andFilterWhere(['like', 'Descrip', $this->Descrip])
            ->andFilterWhere(['like', 'CodOper', $this->CodOper]);

        return $dataProvider;
    }
}
