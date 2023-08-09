<?php

namespace App\Nova;

use App\Nova\Filters\ProductBrand;
use App\Nova\Metrics\AveragePrice;
use App\Nova\Metrics\NewProducts;
use App\Nova\Metrics\ProductsPerDay;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public function subtitle(){
        return "Brand: {$this->brand->name}";
    }

    public static $globalSherchResults =1;
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'description', 'sku'
    ];

    public static $clickAction = 'edit';

    public static $perPageOption = [25, 50, 100];

    // public static $tableStyle = 'tight';

    // public static $showColumnBorders = 'true';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            
            Slug::make('Slug')
            ->from('name')
            ->required()
            ->hideFromIndex()
            ->withMeta(['extraAttributes'=>[
                'readonly' =>true
            ]]),
            Text::make('Name')
            ->placeholder('Product name...')
            ->sortable()
            ->rules('required', 'max:255')
            ->updateRules('unique:products,Name,{{resourceId}}')
            ->creationRules('unique:products,Name,{{resourceId}}'),

            Markdown::make('Description')
            ->required()
            ->placeholder('Product Description...')
            ->sortable(),

            Currency::make('Price')
            ->required()
            ->currency('BDT')
            ->placeholder('Product price...')
            ->sortable(),

            Text::make('Sku')
            ->placeholder('Product SKU...')
            ->help('Number that retailers use to differentiate products and track inventory levels.')
            ->rules('required', 'max:255')
            ->updateRules('unique:products,Sku,{{resourceId}}')
            ->creationRules('unique:products,Sku,{{resourceId}}'),
            
            Number::make('Quantity')
            ->required()
            ->placeholder('Product quentity...')
            ->textAlign('center'),

            BelongsTo::make('Brand')
            ->required(),

            Boolean::make('Status', 'is_published')
            ->required()
            ->textAlign('left'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new NewProducts(),
            new AveragePrice(),
            new ProductsPerDay()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ProductBrand()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
